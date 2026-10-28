<?php
/**
 * Public Scam Detail Page
 * acapio.de
 */

require_once 'config/database.php';
require_once 'includes/functions.php';

// Get scam ID
$scamId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($scamId <= 0) {
    header('Location: index.php');
    exit;
}

// Load scam data (only approved scams)
try {
    $scam = getScamById($scamId);
    
    if (!$scam || $scam['status'] !== 'approved') {
        header('Location: index.php');
        exit;
    }
} catch (Exception $e) {
    header('Location: index.php');
    exit;
}

// Prepare SEO meta data
$pageTitle = 'Scam: ' . htmlspecialchars($scam['scam_type']) . ' - Scam-Datenbank';

$emailsText = !empty($scam['emails']) ? implode(', ', array_column($scam['emails'], 'email_address')) : '';
$namesText = !empty($scam['names']) ? implode(', ', array_column($scam['names'], 'name')) : '';

$pageDescription = 'Scam-Warnung: ' . htmlspecialchars($scam['scam_type']) . '. ';
if ($emailsText) {
    $pageDescription .= 'Email: ' . htmlspecialchars($emailsText) . '. ';
}
if ($namesText) {
    $pageDescription .= 'Name: ' . htmlspecialchars($namesText) . '. ';
}
$pageDescription .= 'Dokumentierter Betrugsversuch.';

// Prepare keywords
$keywords = [$scam['scam_type']];
if (!empty($scam['emails'])) {
    foreach ($scam['emails'] as $email) {
        $keywords[] = $email['email_address'];
    }
}
if (!empty($scam['names'])) {
    foreach ($scam['names'] as $name) {
        $keywords[] = $name['name'];
    }
}
$keywordsStr = implode(', ', $keywords);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($keywordsStr); ?>, Scam, Betrug, Warnung">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo $pageTitle; ?>">
    <meta property="og:description" content="<?php echo $pageDescription; ?>">
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="<?php echo date('c', strtotime($scam['date_submitted'])); ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo htmlspecialchars($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>">
    
    <link rel=apple-touch-icon sizes=180x180 href=https://acapio.de/icon/apple-touch-icon.png>
    <link rel=icon type=image/png sizes=32x32 href=https://acapio.de/icon/favicon-32x32.png>

    <link rel="stylesheet" href="assets/css/public.css">
    
    <?php include 'includes/public-header.php'; ?>

    <!-- Schema.org structured data for better SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "<?php echo htmlspecialchars($scam['scam_type']); ?>",
        "description": "<?php echo htmlspecialchars(truncate($scam['message_content'], 200)); ?>",
        "datePublished": "<?php echo date('c', strtotime($scam['date_submitted'])); ?>",
        "author": {
            "@type": "Organization",
            "name": "Scam-Datenbank"
        }
    }
    </script>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-button">← Zurück zur Übersicht</a>

        <!-- Detail Header -->
        <header class="detail-header">
            <h1><?php echo htmlspecialchars($scam['scam_type']); ?></h1>
            <div class="meta">
                📅 Gemeldet am: <?php echo formatDate($scam['date_submitted']); ?>
                <?php if (!empty($scam['date_received'])): ?>
                | 📨 Empfangen am: <?php echo formatDate($scam['date_received']); ?>
                <?php endif; ?>
            </div>
        </header>

        <!-- Content Grid -->
        <div class="detail-grid">
            <!-- Left Column: Message -->
            <div>
                <article class="detail-box">
                    <h3>💬 Nachrichteninhalt</h3>
                    <div class="message-content" itemprop="text">
                        <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit; margin: 0;"><?php echo h($scam['message_content']); ?></pre>
                    </div>
                </article>
            
                <?php if (!empty($scam['notes'])): ?>
                <!-- Internal Notes / Commentary -->
                <div class="detail-box">
                    <h3>💭 Kommentar</h3>
                    <div class="internal-notes">
                        <pre style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit; margin: 0;"><?php echo h($scam['notes']); ?></pre>
                    </div>
                </div>
                
                <?php endif; ?>

                <?php if (!empty($scam['categories'])): ?>
                <div class="detail-box">
                    <h3>🏷️ Kategorien</h3>
                    <div class="category-tags">
                        <?php foreach ($scam['categories'] as $cat): ?>
                        <span class="category-tag"><?php echo htmlspecialchars($cat['name']); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>


            </div>

            <!-- Right Column: Contact Details -->
            <div>
                <div class="detail-box">
                    <h3>📞 Kontaktdaten der Betrüger</h3>
                    
                    <?php if (!empty($scam['emails']) || !empty($scam['names']) || !empty($scam['phones'])): ?>
                    <ul class="contact-list">
                        <?php if (!empty($scam['emails'])): ?>
                        <li>
                            <strong>📧 Email-Adressen:</strong>
                            <?php foreach ($scam['emails'] as $email): ?>
                                <div style="margin-top: 5px;">
                                    <?php echo htmlspecialchars($email['email_address']); ?>
                                </div>
                            <?php endforeach; ?>
                        </li>
                        <?php endif; ?>
                        
                        <?php if (!empty($scam['names'])): ?>
                        <li>
                            <strong>👤 Verwendete Namen:</strong>
                            <?php foreach ($scam['names'] as $name): ?>
                                <div style="margin-top: 5px;">
                                    <?php echo htmlspecialchars($name['name']); ?>
                                </div>
                            <?php endforeach; ?>
                        </li>
                        <?php endif; ?>
                        
                        <?php if (!empty($scam['phones'])): ?>
                        <li>
                            <strong>📞 Telefonnummern:</strong>
                            <?php foreach ($scam['phones'] as $phone): ?>
                                <div style="margin-top: 5px;">
                                    <?php echo htmlspecialchars($phone['phone_number']); ?>
                                </div>
                            <?php endforeach; ?>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <?php else: ?>
                    <p style="color: #999; text-align: center; padding: 20px;">
                        Keine Kontaktdaten dokumentiert
                    </p>
                    <?php endif; ?>
                </div>

                <!-- Additional Info -->
                <div class="detail-box">
                    <h3>ℹ️ Weitere Informationen</h3>
                    <ul class="contact-list">
                        <li>
                            <strong>Sprache:</strong>
                            <?php 
                            $languages = [
                                'de' => '🇩🇪 Deutsch',
                                'en' => '🇬🇧 Englisch',
                                'fr' => '🇫🇷 Französisch',
                                'es' => '🇪🇸 Spanisch',
                                'other' => '🌍 Andere'
                            ];
                            echo htmlspecialchars($languages[$scam['language']] ?? $scam['language']);
                            ?>
                        </li>
                        <li>
                            <strong>In Datenbank seit:</strong>
                            <?php echo formatDate($scam['date_submitted']); ?>
                        </li>
                        <li>
                            <strong>Scam-ID:</strong>
                            #<?php echo $scam['id']; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

<?php require_once 'includes/public-footer.php'; ?>