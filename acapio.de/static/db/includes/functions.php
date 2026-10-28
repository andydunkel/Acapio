<?php
/**
 * Common Functions
 * acapio.de Scam Database
 */

/**
 * Sanitize output for HTML display
 */
function h($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Redirect to another page
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Get all scams with optional filters
 */
function getScams($filters = [], $limit = null, $offset = 0) {
    $pdo = getDbConnection();
    
    $sql = "SELECT s.*, 
            GROUP_CONCAT(DISTINCT se.email_address SEPARATOR ', ') as emails,
            GROUP_CONCAT(DISTINCT sn.name SEPARATOR ', ') as names,
            GROUP_CONCAT(DISTINCT sp.phone_number SEPARATOR ', ') as phones
            FROM scams s
            LEFT JOIN scam_emails se ON s.id = se.scam_id
            LEFT JOIN scam_names sn ON s.id = sn.scam_id
            LEFT JOIN scam_phone_numbers sp ON s.id = sp.scam_id
            WHERE 1=1";
    
    $params = [];
    
    if (!empty($filters['status'])) {
        $sql .= " AND s.status = :status";
        $params[':status'] = $filters['status'];
    }
    
    if (!empty($filters['search'])) {
        $sql .= " AND (s.message_content LIKE :search 
                  OR s.scam_type LIKE :search
                  OR se.email_address LIKE :search
                  OR sn.name LIKE :search
                  OR sp.phone_number LIKE :search)";
        $params[':search'] = '%' . $filters['search'] . '%';
    }
    
    $sql .= " GROUP BY s.id ORDER BY s.date_submitted DESC";
    
    // Add LIMIT and OFFSET directly (not as parameters, to avoid PDO issues)
    if ($limit !== null) {
        $sql .= " LIMIT " . intval($limit) . " OFFSET " . intval($offset);
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

/**
 * Get single scam with all related data
 */
function getScamById($id) {
    $scam = fetchOne("SELECT * FROM scams WHERE id = :id", [':id' => $id]);
    
    if (!$scam) {
        return null;
    }
    
    // Get emails
    $scam['emails'] = fetchAll("SELECT * FROM scam_emails WHERE scam_id = :id", [':id' => $id]);
    
    // Get names
    $scam['names'] = fetchAll("SELECT * FROM scam_names WHERE scam_id = :id", [':id' => $id]);
    
    // Get phone numbers
    $scam['phones'] = fetchAll("SELECT * FROM scam_phone_numbers WHERE scam_id = :id", [':id' => $id]);
    
    // Get categories
    $scam['categories'] = fetchAll(
        "SELECT sc.* FROM scam_categories sc
         JOIN scam_category_link scl ON sc.id = scl.category_id
         WHERE scl.scam_id = :id",
        [':id' => $id]
    );
    
    return $scam;
}

/**
 * Delete scam and all related data
 */
function deleteScam($id) {
    // Foreign keys with CASCADE will handle related records
    executeQuery("DELETE FROM scams WHERE id = :id", [':id' => $id]);
}

/**
 * Format date for display
 */
function formatDate($date, $format = 'd.m.Y') {
    if (empty($date)) {
        return '-';
    }
    return date($format, strtotime($date));
}

/**
 * Format datetime for display
 */
function formatDateTime($datetime, $format = 'd.m.Y H:i') {
    if (empty($datetime)) {
        return '-';
    }
    return date($format, strtotime($datetime));
}

/**
 * Get categories list
 */
function getCategories() {
    return fetchAll("SELECT * FROM scam_categories ORDER BY name");
}

/**
 * Truncate text to specified length
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . $suffix;
}

/**
 * Get status label with styling
 */
function getStatusBadge($status) {
    $statusText = [
        'approved' => 'Genehmigt',
        'pending' => 'Ausstehend',
        'rejected' => 'Abgelehnt'
    ];
    
    return '<span class="status-badge status-' . h($status) . '">' 
           . h($statusText[$status] ?? $status) . '</span>';
}

/**
 * Validate email address
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Parse multiline input into array
 */
function parseMultilineInput($input) {
    if (empty($input)) {
        return [];
    }
    return array_filter(array_map('trim', explode("\n", $input)));
}

/**
 * Get total count of scams
 */
function getTotalScams($filters = []) {
    $sql = "SELECT COUNT(DISTINCT s.id) as count FROM scams s
            LEFT JOIN scam_emails se ON s.id = se.scam_id
            LEFT JOIN scam_names sn ON s.id = sn.scam_id
            LEFT JOIN scam_phone_numbers sp ON s.id = sp.scam_id
            WHERE 1=1";
    
    $params = [];
    
    if (!empty($filters['status'])) {
        $sql .= " AND s.status = :status";
        $params[':status'] = $filters['status'];
    }
    
    if (!empty($filters['search'])) {
        $sql .= " AND (s.message_content LIKE :search 
                  OR s.scam_type LIKE :search
                  OR se.email_address LIKE :search
                  OR sn.name LIKE :search
                  OR sp.phone_number LIKE :search)";
        $params[':search'] = '%' . $filters['search'] . '%';
    }
    
    $result = fetchOne($sql, $params);
    return $result['count'] ?? 0;
}

/**
 * Generate pagination HTML
 */
function getPagination($currentPage, $totalPages, $baseUrl) {
    if ($totalPages <= 1) {
        return '';
    }
    
    $html = '<div class="pagination">';
    
    // Previous
    if ($currentPage > 1) {
        $html .= '<a href="' . $baseUrl . '?page=' . ($currentPage - 1) . '">← Zurück</a>';
    }
    
    // Page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $html .= '<span class="current">' . $i . '</span>';
        } else {
            $html .= '<a href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a>';
        }
    }
    
    // Next
    if ($currentPage < $totalPages) {
        $html .= '<a href="' . $baseUrl . '?page=' . ($currentPage + 1) . '">Weiter →</a>';
    }
    
    $html .= '</div>';
    
    return $html;
}