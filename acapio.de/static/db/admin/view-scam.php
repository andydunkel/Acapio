<?php
/**
 * View Single Scam
 * acapio.de Scam Database
 */

// Include dependencies first
require_once '../config/database.php';
require_once '../includes/functions.php';

// Get scam ID
$scamId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($scamId <= 0) {
    header('Location: list-scams.php');
    exit;
}

// Load scam data
try {
    $scam = getScamById($scamId);
    if (!$scam) {
        header('Location: list-scams.php');
        exit;
    }
} catch (Exception $e) {
    die("Error loading scam: " . $e->getMessage());
}

$pageTitle = 'Scam #' . $scamId;
$pageIcon = '👁️';
require_once '../includes/admin-header.php';
?>

<a href="list-scams.php" class="back-link">← Zurück zur Liste</a>

<div class="content-section">
    <div class="section-header">
        <h2>Scam #<?php echo h($scam['id']); ?>: <?php echo h($scam['scam_type']); ?></h2>
        <div style="display: flex; gap: 10px;">
            <a href="edit-scam.php?id=<?php echo h($scam['id']); ?>" class="btn btn-primary">✏️ Bearbeiten</a>
            <a href="delete-scam.php?id=<?php echo h($scam['id']); ?>" 
               class="btn btn-danger"
               onclick="return confirm('Diesen Scam wirklich löschen?')">🗑️ Löschen</a>
        </div>
    </div>

    <!-- Status Badge -->
    <div style="margin-bottom: 25px;">
        <?php echo getStatusBadge($scam['status']); ?>
    </div>

    <!-- Main Info Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px;">
        <!-- Left Column -->
        <div>
            <h3 style="font-size: 16px; margin-bottom: 15px; color: #333;">📋 Grundinformationen</h3>
            
            <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                <div style="margin-bottom: 10px;">
                    <strong>Scam-Typ:</strong><br>
                    <?php echo h($scam['scam_type']); ?>
                </div>
                
                <div style="margin-bottom: 10px;">
                    <strong>Sprache:</strong><br>
                    <?php 
                    $languages = [
                        'de' => '🇩🇪 Deutsch',
                        'en' => '🇬🇧 Englisch',
                        'fr' => '🇫🇷 Französisch',
                        'es' => '🇪🇸 Spanisch',
                        'other' => '🌍 Andere'
                    ];
                    echo h($languages[$scam['language']] ?? $scam['language']);
                    ?>
                </div>
                
                <div style="margin-bottom: 10px;">
                    <strong>Empfangen am:</strong><br>
                    <?php echo $scam['date_received'] ? formatDate($scam['date_received']) : '-'; ?>
                </div>
                
                <div>
                    <strong>Eingereicht am:</strong><br>
                    <?php echo formatDateTime($scam['date_submitted']); ?>
                </div>
            </div>

            <!-- Categories -->
            <?php if (!empty($scam['categories'])): ?>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 6px;">
                <strong>🏷️ Kategorien:</strong><br>
                <div style="margin-top: 10px; display: flex; flex-wrap: gap; gap: 8px;">
                    <?php foreach ($scam['categories'] as $cat): ?>
                    <span style="background: #007bff; color: white; padding: 4px 12px; border-radius: 12px; font-size: 13px;">
                        <?php echo h($cat['name']); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Right Column -->
        <div>
            <h3 style="font-size: 16px; margin-bottom: 15px; color: #333;">📞 Kontaktdaten</h3>
            
            <!-- Emails -->
            <?php if (!empty($scam['emails'])): ?>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                <strong>📧 Email-Adressen:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <?php foreach ($scam['emails'] as $email): ?>
                    <li style="margin-bottom: 5px;">
                        <a href="mailto:<?php echo h($email['email_address']); ?>" style="color: #007bff;">
                            <?php echo h($email['email_address']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Names -->
            <?php if (!empty($scam['names'])): ?>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; margin-bottom: 15px;">
                <strong>👤 Namen:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <?php foreach ($scam['names'] as $name): ?>
                    <li style="margin-bottom: 5px;"><?php echo h($name['name']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Phone Numbers -->
            <?php if (!empty($scam['phones'])): ?>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 6px;">
                <strong>📞 Telefonnummern:</strong>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <?php foreach ($scam['phones'] as $phone): ?>
                    <li style="margin-bottom: 5px;">
                        <a href="tel:<?php echo h($phone['phone_number']); ?>" style="color: #007bff;">
                            <?php echo h($phone['phone_number']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (empty($scam['emails']) && empty($scam['names']) && empty($scam['phones'])): ?>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 6px; color: #999; text-align: center;">
                Keine Kontaktdaten vorhanden
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Message Content -->
    <div style="margin-bottom: 30px;">
        <h3 style="font-size: 16px; margin-bottom: 15px; color: #333;">💬 Nachrichteninhalt</h3>
        <div style="background: #f8f9fa; padding: 20px; border-radius: 6px; border-left: 4px solid #dc3545;">
            <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit; margin: 0;"><?php echo h($scam['message_content']); ?></pre>
        </div>
    </div>

    <!-- Internal Notes -->
    <?php if (!empty($scam['notes'])): ?>
    <div>
        <h3 style="font-size: 16px; margin-bottom: 15px; color: #333;">📝 Interne Notizen</h3>
        <div style="background: #fff3cd; padding: 15px; border-radius: 6px; border-left: 4px solid #ffc107;">
            <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit; margin: 0;"><?php echo h($scam['notes']); ?></pre>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Metadata Section -->
<div class="content-section" style="background: #f8f9fa;">
    <h3 style="font-size: 14px; margin-bottom: 10px; color: #666;">ℹ️ Metadaten</h3>
    <div style="font-size: 13px; color: #666;">
        <div style="margin-bottom: 5px;">
            <strong>Erstellt:</strong> <?php echo formatDateTime($scam['created_at']); ?>
        </div>
        <div>
            <strong>Zuletzt geändert:</strong> <?php echo formatDateTime($scam['updated_at']); ?>
        </div>
    </div>
</div>

<?php require_once '../includes/admin-footer.php'; ?>