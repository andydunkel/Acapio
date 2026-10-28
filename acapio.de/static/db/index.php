<?php
/**
 * Public Scam Database Search
 * acapio.de
 */

require_once 'config/database.php';
require_once 'includes/functions.php';

// Pagination settings
$itemsPerPage = 25;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Search query
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

// Build filters
$filters = ['status' => 'approved']; // Only show approved scams publicly
if (!empty($searchQuery)) {
    $filters['search'] = $searchQuery;
}

// Get scams and total count
try {
    $scams = getScams($filters, $itemsPerPage, $offset);
    $totalScams = getTotalScams($filters);
    $totalPages = ceil($totalScams / $itemsPerPage);
    
    // Get statistics
    $stats = [
        'total' => fetchOne("SELECT COUNT(*) as count FROM scams WHERE status = 'approved'")['count'],
        'emails' => fetchOne("SELECT COUNT(DISTINCT email_address) as count FROM scam_emails se 
                              JOIN scams s ON se.scam_id = s.id WHERE s.status = 'approved'")['count'],
        'recent' => fetchOne("SELECT COUNT(*) as count FROM scams 
                              WHERE status = 'approved' AND date_submitted >= DATE_SUB(NOW(), INTERVAL 30 DAY)")['count']
    ];
} catch (Exception $e) {
    die("Error loading data: " . $e->getMessage());
}

// SEO Meta
$pageTitle = !empty($searchQuery) 
    ? 'Suche nach "' . htmlspecialchars($searchQuery) . '" - Scam-Datenbank' 
    : 'Scam-Datenbank - Betrüger und Scam-Emails finden';

$pageDescription = !empty($searchQuery)
    ? 'Suchergebnisse für "' . htmlspecialchars($searchQuery) . '" in unserer Scam-Datenbank mit dokumentierten Betrügern.'
    : 'Durchsuchbare Datenbank mit dokumentierten Scam-Emails, Betrüger-Kontakten und Betrugsversuchen. Schützen Sie sich vor Erbschaftsbetrug, Phishing und anderen Scams.';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:type" content="website">

    <link rel=apple-touch-icon sizes=180x180 href=https://acapio.de/icon/apple-touch-icon.png>
    <link rel=icon type=image/png sizes=32x32 href=https://acapio.de/icon/favicon-32x32.png>
    
    <link rel="stylesheet" href="assets/css/public.css">
    <?php include 'includes/public-header.php'; ?>

    <!-- Schema.org structured data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Scam-Datenbank",
        "description": "Datenbank dokumentierter Scam-Emails und Betrüger-Kontakte",
        "url": "<?php echo htmlspecialchars($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>"
    }
    </script>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <h1>🛡️ Acapio.de - Scam-Datenbank</h1>
            <p>Dokumentierte Betrüger und Scam-Emails durchsuchen</p>
        </div>
    </header>

    <div class="container">
        <!-- Search Section -->
        <section class="search-section">
            <form method="GET" action="" class="search-form">
                <input type="text" 
                       name="q" 
                       class="search-input" 
                       placeholder="Email, Name, Telefonnummer oder Stichwort eingeben..." 
                       value="<?php echo htmlspecialchars($searchQuery); ?>"
                       aria-label="Suche in Scam-Datenbank">
                <button type="submit" class="search-button">🔍 Suchen</button>
            </form>
            <div class="search-help">
                💡 Tipp: Geben Sie eine verdächtige Email-Adresse, Namen oder Telefonnummer ein
            </div>
        </section>

        <!-- Statistics -->
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-number"><?php echo number_format($stats['total'], 0, ',', '.'); ?></div>
                <div class="stat-label">Dokumentierte Scams</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo number_format($stats['emails'], 0, ',', '.'); ?></div>
                <div class="stat-label">Email-Adressen</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo number_format($stats['recent'], 0, ',', '.'); ?></div>
                <div class="stat-label">Neue (30 Tage)</div>
            </div>
        </div>

        <!-- Search Results Info -->
        <?php if (!empty($searchQuery)): ?>
        <div class="alert alert-info">
            🔍 Suche nach: <strong>"<?php echo htmlspecialchars($searchQuery); ?>"</strong> 
            - <?php echo $totalScams; ?> Ergebnis<?php echo $totalScams != 1 ? 'se' : ''; ?> gefunden
            <a href="index.php" style="margin-left: 15px; color: #0c5460;">✕ Suche zurücksetzen</a>
        </div>
        <?php endif; ?>

        <!-- Scams Table -->
        <section class="content-section">
            <h2><?php echo !empty($searchQuery) ? 'Suchergebnisse' : 'Aktuelle Scams'; ?></h2>
            
            <?php if (count($scams) > 0): ?>
            <table class="scams-table">
                <thead>
                    <tr>
                        <th style="width: 50%;">Scam-Details</th>
                        <th style="width: 30%;">Kontaktdaten</th>
                        <th style="width: 20%;" class="hide-mobile">Datum</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($scams as $scam): 
                        $isNew = (strtotime($scam['date_submitted']) > strtotime('-7 days'));
                    ?>
                    <tr class="scam-row">
                        <td>
                            <a href="scam.php?id=<?php echo $scam['id']; ?>" class="scam-link">
                                <div class="scam-type">
                                    <?php echo htmlspecialchars($scam['scam_type']); ?>
                                    <?php if ($isNew): ?>
                                    <span class="badge badge-new">NEU</span>
                                    <?php endif; ?>
                                </div>
                                <div class="scam-preview">
                                    <?php echo htmlspecialchars(truncate($scam['message_content'], 150)); ?>
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="scam.php?id=<?php echo $scam['id']; ?>" class="scam-link">
                                <?php if (!empty($scam['emails'])): ?>
                                <div class="scam-contact-item">
                                    📧 <?php echo htmlspecialchars(truncate($scam['emails'], 60)); ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($scam['names'])): ?>
                                <div class="scam-contact-item">
                                    👤 <?php echo htmlspecialchars(truncate($scam['names'], 60)); ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($scam['phones'])): ?>
                                <div class="scam-contact-item">
                                    📞 <?php echo htmlspecialchars(truncate($scam['phones'], 60)); ?>
                                </div>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td class="hide-mobile">
                            <a href="scam.php?id=<?php echo $scam['id']; ?>" class="scam-link">
                                <div class="scam-date"><?php echo formatDate($scam['date_submitted']); ?></div>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <nav class="pagination" role="navigation" aria-label="Seitennavigation">
                <?php if ($currentPage > 1): ?>
                    <a href="?<?php echo !empty($searchQuery) ? 'q=' . urlencode($searchQuery) . '&' : ''; ?>page=<?php echo ($currentPage - 1); ?>" 
                       rel="prev">← Zurück</a>
                <?php endif; ?>
                
                <?php
                $range = 2;
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == 1 || $i == $totalPages || ($i >= $currentPage - $range && $i <= $currentPage + $range)) {
                        if ($i == $currentPage) {
                            echo '<span class="current" aria-current="page">' . $i . '</span>';
                        } else {
                            echo '<a href="?' . (!empty($searchQuery) ? 'q=' . urlencode($searchQuery) . '&' : '') . 'page=' . $i . '">' . $i . '</a>';
                        }
                    } elseif ($i == $currentPage - $range - 1 || $i == $currentPage + $range + 1) {
                        echo '<span>...</span>';
                    }
                }
                ?>
                
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?<?php echo !empty($searchQuery) ? 'q=' . urlencode($searchQuery) . '&' : ''; ?>page=<?php echo ($currentPage + 1); ?>" 
                       rel="next">Weiter →</a>
                <?php endif; ?>
            </nav>
            
            <div class="pagination-info">
                Seite <?php echo $currentPage; ?> von <?php echo $totalPages; ?> 
                (<?php echo number_format($totalScams, 0, ',', '.'); ?> Einträge)
            </div>
            <?php endif; ?>
            
            <?php else: ?>
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <h3>Keine Scams gefunden</h3>
                <p>
                    <?php if (!empty($searchQuery)): ?>
                        Keine Ergebnisse für "<?php echo htmlspecialchars($searchQuery); ?>". 
                        <a href="index.php">Alle Scams anzeigen</a>
                    <?php else: ?>
                        Die Datenbank ist noch leer.
                    <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
        </section>

        <!-- Warning Box -->
        <div class="warning-box">
            <h3>⚠️ Wichtiger Hinweis</h3>
            <p>
                Diese Datenbank dokumentiert gemeldete Scam-Versuche. Die Informationen dienen der Warnung 
                und Aufklärung. Bitte melden Sie verdächtige Kontakte auch bei den zuständigen Behörden.
            </p>
        </div>

<?php require_once 'includes/public-footer.php'; ?>