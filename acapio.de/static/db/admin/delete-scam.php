<?php
/**
 * Delete Scam Handler
 * acapio.de Scam Database
 */

require_once '../config/database.php';
require_once '../includes/functions.php';

// Get scam ID
$scamId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($scamId <= 0) {
    header('Location: list-scams.php');
    exit;
}

// Check if scam exists
try {
    $scam = getScamById($scamId);
    if (!$scam) {
        header('Location: list-scams.php');
        exit;
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Handle confirmation
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    try {
        deleteScam($scamId);
        
        // Redirect with success message
        header('Location: list-scams.php?deleted=1');
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$pageTitle = 'Scam löschen';
$pageIcon = '🗑️';
require_once '../includes/admin-header.php';
?>

<a href="view-scam.php?id=<?php echo h($scamId); ?>" class="back-link">← Zurück zur Ansicht</a>

<div class="form-container">
    <div class="alert alert-warning">
        <strong>⚠️ Achtung!</strong> Diese Aktion kann nicht rückgängig gemacht werden.
    </div>

    <?php if (isset($error)): ?>
    <div class="alert alert-error">
        ❌ Fehler beim Löschen: <?php echo h($error); ?>
    </div>
    <?php endif; ?>

    <h2 style="margin-bottom: 20px; color: #dc3545;">Scam wirklich löschen?</h2>

    <!-- Scam Preview -->
    <div style="background: #f8f9fa; padding: 20px; border-radius: 6px; border-left: 4px solid #dc3545; margin-bottom: 25px;">
        <div style="margin-bottom: 15px;">
            <strong style="font-size: 16px;">Scam #<?php echo h($scam['id']); ?>: <?php echo h($scam['scam_type']); ?></strong>
        </div>
        
        <div style="margin-bottom: 10px;">
            <strong>Nachricht:</strong><br>
            <div style="margin-top: 5px; color: #666;">
                <?php echo h(truncate($scam['message_content'], 200)); ?>
            </div>
        </div>

        <?php if (!empty($scam['emails'])): ?>
        <div style="margin-bottom: 10px;">
            <strong>Emails:</strong> 
            <?php echo h(implode(', ', array_column($scam['emails'], 'email_address'))); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($scam['names'])): ?>
        <div style="margin-bottom: 10px;">
            <strong>Namen:</strong> 
            <?php echo h(implode(', ', array_column($scam['names'], 'name'))); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($scam['phones'])): ?>
        <div style="margin-bottom: 10px;">
            <strong>Telefonnummern:</strong> 
            <?php echo h(implode(', ', array_column($scam['phones'], 'phone_number'))); ?>
        </div>
        <?php endif; ?>

        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #ddd; font-size: 13px; color: #666;">
            <strong>Erstellt:</strong> <?php echo formatDateTime($scam['created_at']); ?>
        </div>
    </div>

    <div style="background: #fff3cd; padding: 15px; border-radius: 6px; margin-bottom: 25px;">
        <p style="margin: 0;"><strong>Was wird gelöscht?</strong></p>
        <ul style="margin: 10px 0 0 20px;">
            <li>Der Scam-Eintrag</li>
            <li>Alle zugehörigen Email-Adressen (<?php echo count($scam['emails']); ?>)</li>
            <li>Alle zugehörigen Namen (<?php echo count($scam['names']); ?>)</li>
            <li>Alle zugehörigen Telefonnummern (<?php echo count($scam['phones']); ?>)</li>
            <li>Alle Kategorie-Zuordnungen (<?php echo count($scam['categories']); ?>)</li>
        </ul>
    </div>

    <form method="POST" action="">
        <input type="hidden" name="confirm" value="yes">
        
        <div class="form-actions">
            <button type="submit" class="btn btn-danger">
                🗑️ Ja, endgültig löschen
            </button>
            <a href="view-scam.php?id=<?php echo h($scamId); ?>" class="btn btn-secondary">
                Abbrechen
            </a>
        </div>
    </form>
</div>

<?php require_once '../includes/admin-footer.php'; ?>