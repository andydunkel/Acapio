<?php
/**
 * List All Scams
 * acapio.de Scam Database
 */

$pageTitle = 'Alle Scams';
$pageIcon = '📋';
require_once '../includes/admin-header.php';

// Pagination settings
$itemsPerPage = 20;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Filters
$filters = [];
if (!empty($_GET['search'])) {
    $filters['search'] = $_GET['search'];
}
if (!empty($_GET['status']) && $_GET['status'] !== 'all') {
    $filters['status'] = $_GET['status'];
}

// Get scams and total count
try {
    $scams = getScams($filters, $itemsPerPage, $offset);
    $totalScams = getTotalScams($filters);
    $totalPages = ceil($totalScams / $itemsPerPage);
} catch (Exception $e) {
    die("Error loading scams: " . $e->getMessage());
}
?>

<div class="content-section">
    <div class="section-header">
        <h2>📋 Alle Scams (<?php echo h($totalScams); ?>)</h2>
        <a href="add-scam.php" class="btn btn-primary">➕ Neuer Scam</a>
    </div>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
    <div class="alert alert-success">
        ✅ Scam erfolgreich gelöscht!
    </div>
    <?php endif; ?>

    <!-- Search and Filter Form -->
    <form method="GET" action="" style="margin-bottom: 25px;">
        <div style="display: grid; grid-template-columns: 1fr 200px auto; gap: 10px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label for="search">Suche</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="<?php echo h($_GET['search'] ?? ''); ?>"
                       placeholder="Email, Name, Telefon oder Text...">
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="all" <?php echo (!isset($_GET['status']) || $_GET['status'] === 'all') ? 'selected' : ''; ?>>Alle</option>
                    <option value="approved" <?php echo (isset($_GET['status']) && $_GET['status'] === 'approved') ? 'selected' : ''; ?>>Genehmigt</option>
                    <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status'] === 'pending') ? 'selected' : ''; ?>>Ausstehend</option>
                    <option value="rejected" <?php echo (isset($_GET['status']) && $_GET['status'] === 'rejected') ? 'selected' : ''; ?>>Abgelehnt</option>
                </select>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">🔍 Suchen</button>
                <?php if (!empty($_GET['search']) || !empty($_GET['status'])): ?>
                    <a href="list-scams.php" class="btn btn-secondary">✕ Reset</a>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <!-- Results Info -->
    <?php if (!empty($filters['search']) || !empty($filters['status'])): ?>
    <div class="alert alert-info">
        <?php 
        $filterInfo = [];
        if (!empty($filters['search'])) {
            $filterInfo[] = 'Suche: "' . h($filters['search']) . '"';
        }
        if (!empty($filters['status'])) {
            $filterInfo[] = 'Status: ' . h($filters['status']);
        }
        echo '🔍 Aktive Filter: ' . implode(', ', $filterInfo);
        ?>
    </div>
    <?php endif; ?>

    <!-- Scams Table -->
    <?php if (count($scams) > 0): ?>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th>Scam-Typ</th>
                    <th>Kontakte</th>
                    <th style="width: 120px;">Eingereicht</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 200px;">Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scams as $scam): ?>
                <tr>
                    <td>#<?php echo h($scam['id']); ?></td>
                    <td>
                        <strong><?php echo h($scam['scam_type']); ?></strong>
                        <br>
                        <small style="color: #666;">
                            <?php echo h(truncate($scam['message_content'], 80)); ?>
                        </small>
                    </td>
                    <td>
                        <?php if (!empty($scam['emails'])): ?>
                            <div style="margin-bottom: 5px;">
                                📧 <?php echo h(truncate($scam['emails'], 50)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($scam['names'])): ?>
                            <div style="margin-bottom: 5px;">
                                👤 <?php echo h(truncate($scam['names'], 50)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($scam['phones'])): ?>
                            <div>
                                📞 <?php echo h(truncate($scam['phones'], 50)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (empty($scam['emails']) && empty($scam['names']) && empty($scam['phones'])): ?>
                            <small style="color: #999;">Keine Kontaktdaten</small>
                        <?php endif; ?>
                    </td>
                    <td>
                        <small><?php echo formatDateTime($scam['date_submitted']); ?></small>
                    </td>
                    <td><?php echo getStatusBadge($scam['status']); ?></td>
                    <td class="action-links">
                        <a href="view-scam.php?id=<?php echo h($scam['id']); ?>">👁️ Ansehen</a>
                        <a href="edit-scam.php?id=<?php echo h($scam['id']); ?>">✏️ Bearbeiten</a>
                        <a href="delete-scam.php?id=<?php echo h($scam['id']); ?>" 
                           onclick="return confirm('Scam #<?php echo h($scam['id']); ?> wirklich löschen?')"
                           style="color: #dc3545;">🗑️ Löschen</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo ($currentPage - 1); ?><?php echo !empty($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo !empty($_GET['status']) && $_GET['status'] !== 'all' ? '&status=' . urlencode($_GET['status']) : ''; ?>">← Zurück</a>
        <?php endif; ?>
        
        <?php
        // Show pagination numbers with ellipsis
        $range = 2; // Show 2 pages on each side of current page
        
        for ($i = 1; $i <= $totalPages; $i++) {
            // Always show first page, last page, current page and pages within range
            if ($i == 1 || $i == $totalPages || ($i >= $currentPage - $range && $i <= $currentPage + $range)) {
                if ($i == $currentPage) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="?page=' . $i;
                    echo !empty($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
                    echo !empty($_GET['status']) && $_GET['status'] !== 'all' ? '&status=' . urlencode($_GET['status']) : '';
                    echo '">' . $i . '</a>';
                }
            } elseif ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1) {
                // Show ellipsis
                echo '<span style="padding: 8px 12px;">...</span>';
            }
        }
        ?>
        
        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo ($currentPage + 1); ?><?php echo !empty($_GET['search']) ? '&search=' . urlencode($_GET['search']) : ''; ?><?php echo !empty($_GET['status']) && $_GET['status'] !== 'all' ? '&status=' . urlencode($_GET['status']) : ''; ?>">Weiter →</a>
        <?php endif; ?>
    </div>
    
    <div style="text-align: center; margin-top: 15px; color: #666; font-size: 14px;">
        Seite <?php echo h($currentPage); ?> von <?php echo h($totalPages); ?> 
        (<?php echo h($totalScams); ?> Scams gesamt)
    </div>
    <?php endif; ?>
    
    <?php else: ?>
    <div class="empty-state">
        <p>😕 Keine Scams gefunden.</p>
        <?php if (!empty($filters)): ?>
            <p style="margin-top: 10px;">
                <a href="list-scams.php" class="btn btn-secondary">Filter zurücksetzen</a>
            </p>
        <?php else: ?>
            <p style="margin-top: 10px;">
                <a href="add-scam.php" class="btn btn-primary">➕ Ersten Scam hinzufügen</a>
            </p>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<!-- Quick Stats -->
<div class="content-section" style="background: #f8f9fa;">
    <h3 style="margin-bottom: 15px; font-size: 16px;">📊 Schnelle Statistiken</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
        <?php
        $quickStats = [
            'Genehmigt' => fetchOne("SELECT COUNT(*) as count FROM scams WHERE status = 'approved'")['count'],
            'Ausstehend' => fetchOne("SELECT COUNT(*) as count FROM scams WHERE status = 'pending'")['count'],
            'Abgelehnt' => fetchOne("SELECT COUNT(*) as count FROM scams WHERE status = 'rejected'")['count']
        ];
        foreach ($quickStats as $label => $count):
        ?>
        <div style="background: white; padding: 15px; border-radius: 6px; text-align: center;">
            <div style="font-size: 24px; font-weight: bold; color: #007bff;"><?php echo h($count); ?></div>
            <div style="font-size: 13px; color: #666;"><?php echo h($label); ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once '../includes/admin-footer.php'; ?>