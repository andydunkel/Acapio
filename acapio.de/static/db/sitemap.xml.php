<?php
/**
 * XML Sitemap Generator
 * acapio.de - Scam Database
 */

header('Content-Type: application/xml; charset=utf-8');

require_once 'config/database.php';

// Base URL - ANPASSEN!
$baseUrl = 'https://acapio.de/db';


// Get database connection
$pdo = getDbConnection();

// Output XML header
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

// 1. Homepage (höchste Priorität)
echo "  <url>\n";
echo "    <loc>" . htmlspecialchars($baseUrl . '/index.php') . "</loc>\n";
echo "    <changefreq>daily</changefreq>\n";
echo "    <priority>1.0</priority>\n";
echo "  </url>\n";

// 2. Alle genehmigten Scam-Detailseiten
try {
    $stmt = $pdo->prepare("
        SELECT id, date_submitted, updated_at 
        FROM scams 
        WHERE status = 'approved' 
        ORDER BY date_submitted DESC
    ");
    $stmt->execute();
    
    while ($scam = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Nehme das neueste Datum (entweder updated_at oder date_submitted)
        $lastmod = !empty($scam['updated_at']) ? $scam['updated_at'] : $scam['date_submitted'];
        $lastmodFormatted = date('Y-m-d', strtotime($lastmod));
        
        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($baseUrl . '/scam.php?id=' . $scam['id']) . "</loc>\n";
        echo "    <lastmod>" . $lastmodFormatted . "</lastmod>\n";
        echo "    <changefreq>monthly</changefreq>\n";
        echo "    <priority>0.8</priority>\n";
        echo "  </url>\n";
    }
    
} catch (Exception $e) {
    // Bei Fehler trotzdem valides XML ausgeben
    error_log("Sitemap generation error: " . $e->getMessage());
}

echo '</urlset>';
?>