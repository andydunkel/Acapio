<?php
/**
 * Database Configuration
 * Scam Database Project - acapio.de
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'd0455b87');
define('DB_USER', 'd0455b87');
define('DB_PASS', 'wjERyzbRNvAuVNUWJ2MJ');
define('DB_CHARSET', 'utf8mb4');

// Create database connection
function getDbConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => true,
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log error securely, don't expose to users
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }
    
    return $pdo;
}

// Test connection function (for setup/debugging only)
function testConnection() {
    try {
        $pdo = getDbConnection();
        return [
            'success' => true,
            'message' => 'Database connection successful!'
        ];
    } catch (Exception $e) {
        return [
            'success' => false,
            'message' => 'Connection failed: ' . $e->getMessage()
        ];
    }
}

// Helper function to execute queries safely
function executeQuery($sql, $params = []) {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log("Query execution failed: " . $e->getMessage());
        throw $e;
    }
}

// Helper function to get single row
function fetchOne($sql, $params = []) {
    $stmt = executeQuery($sql, $params);
    return $stmt->fetch();
}

// Helper function to get multiple rows
function fetchAll($sql, $params = []) {
    $stmt = executeQuery($sql, $params);
    return $stmt->fetchAll();
}

// Helper function to get last inserted ID
function getLastInsertId() {
    $pdo = getDbConnection();
    return $pdo->lastInsertId();
}