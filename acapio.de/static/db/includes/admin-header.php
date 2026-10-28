<?php
/**
 * Admin Header Include
 * acapio.de Scam Database
 */

// Include dependencies
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Set page title default if not set
if (!isset($pageTitle)) {
    $pageTitle = 'Admin';
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($pageTitle); ?> - Scam Database</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo isset($pageIcon) ? $pageIcon . ' ' : ''; ?><?php echo h($pageTitle); ?></h1>
            <nav class="nav-links">
                <a href="index.php">Dashboard</a>
                <a href="add-scam.php">➕ Neuer Scam</a>
                <a href="list-scams.php">📋 Alle Scams</a>
                <a href="../public/index.php" target="_blank">🔍 Zur Suche</a>
            </nav>
        </header>