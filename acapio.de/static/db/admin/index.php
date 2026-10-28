<?php
/**
 * Admin Dashboard
 * acapio.de Scam Database
 */

$pageTitle = 'Dashboard';
$pageIcon = '📊';
require_once '../includes/admin-header.php';

// Get statistics
try {
    $stats = [
        'total_scams' => fetchOne("SELECT COUNT(*) as count FROM scams")['count'],
        'total_emails' => fetchOne("SELECT COUNT(DISTINCT email_address) as count FROM scam_emails")['count'],
        'total_names' => fetchOne("SELECT COUNT(DISTINCT name) as count FROM scam_names")['count'],
        'total_phones' => fetchOne("SELECT COUNT(DISTINCT phone_number) as count FROM scam_phone_numbers")['count'],
        'pending' => fetchOne("SELECT COUNT(*) as count FROM scams WHERE status = 'pending'")['count'],
        'recent_scams' => fetchAll("SELECT id, scam_type, DATE_FORMAT(date_submitted, '%d.%m.%Y %H:%i') as submitted, status 
                                     FROM scams 
                                     ORDER BY date_submitted DESC 
                                     LIMIT 10")
    ];
} catch (Exception $e) {
    die("Error loading statistics: " . $e->getMessage());
}
?>


<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number"><?php echo h($stats['total_scams']); ?></div>
        <div class="stat-label">Gesamt Scams</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo h($stats['total_emails']); ?></div>
        <div class="stat-label">Email-Adressen</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo h($stats['total_names']); ?></div>
        <div class="stat-label">Namen</div>
    </div>
    <div class="stat-card">
        <div class="stat-number"><?php echo h($stats['total_phones']); ?></div>
        <div class="stat-label">Telefonnummern</div>
    </div>
    <?php if ($stats['pending'] > 0): ?>
    <div class="stat-card">
        <div class="stat-number" style="color: #ffc107;"><?php echo h($stats['pending']); ?></div>
        <div class="stat-label">⏳ Ausstehend</div>
    </div>
    <?php endif; ?>
</div>

<div class="content-section">
    <div class="section-header">
        <h2>🕐 Neueste Einträge</h2>
        <a href="add-scam.php" class="btn btn-primary">➕ Neuer Scam</a>
    </div>
    
    <?php if (count($stats['recent_scams']) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Scam-Typ</th>
                <th>Eingereicht am</th>
                <th>Status</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stats['recent_scams'] as $scam): ?>
            <tr>
                <td>#<?php echo h($scam['id']); ?></td>
                <td><?php echo h($scam['scam_type']); ?></td>
                <td><?php echo h($scam['submitted']); ?></td>
                <td><?php echo getStatusBadge($scam['status']); ?></td>
                <td class="action-links">
                    <a href="view-scam.php?id=<?php echo h($scam['id']); ?>">Ansehen</a>
                    <a href="edit-scam.php?id=<?php echo h($scam['id']); ?>">Bearbeiten</a>
                    <a href="delete-scam.php?id=<?php echo h($scam['id']); ?>" 
                       onclick="return confirm('Wirklich löschen?')">Löschen</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="empty-state">
        <p>Noch keine Scams in der Datenbank.</p>
        <p style="margin-top: 10px;"><a href="add-scam.php" class="btn btn-primary">➕ Ersten Scam hinzufügen</a></p>
    </div>
    <?php endif; ?>
</div>

<?php require_once '../includes/admin-footer.php'; ?>