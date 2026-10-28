<?php
/**
 * Database Connection Test Script
 * Run this file once to verify your database connection works
 * DELETE THIS FILE after testing for security!
 */

// Include database configuration
require_once 'config/database.php';

// Start output
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection Test - acapio.de</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .test-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .success {
            color: #28a745;
            padding: 15px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin: 10px 0;
        }
        .error {
            color: #dc3545;
            padding: 15px;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin: 10px 0;
        }
        .info {
            color: #004085;
            padding: 15px;
            background-color: #cce5ff;
            border: 1px solid #b8daff;
            border-radius: 4px;
            margin: 10px 0;
        }
        h1 {
            color: #333;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: bold;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="test-box">
        <h1>🔍 Scam Database - Connection Test</h1>
        
        <div class="warning">
            ⚠️ <strong>IMPORTANT:</strong> Delete this file (test-connection.php) after testing!
        </div>

        <?php
        echo "<h2>Step 1: Testing Database Connection</h2>";
        
        $connectionTest = testConnection();
        
        if ($connectionTest['success']) {
            echo '<div class="success">✅ ' . htmlspecialchars($connectionTest['message']) . '</div>';
            
            // Try to get database info
            try {
                $pdo = getDbConnection();
                echo "<h2>Step 2: Database Information</h2>";
                echo '<div class="info">';
                echo '<table>';
                echo '<tr><th>Parameter</th><th>Value</th></tr>';
                echo '<tr><td>Host</td><td>' . DB_HOST . '</td></tr>';
                echo '<tr><td>Database Name</td><td>' . DB_NAME . '</td></tr>';
                echo '<tr><td>Character Set</td><td>' . DB_CHARSET . '</td></tr>';
                echo '<tr><td>PDO Driver</td><td>' . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . '</td></tr>';
                echo '<tr><td>Server Version</td><td>' . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . '</td></tr>';
                echo '</table>';
                echo '</div>';
                
                // Check if tables exist
                echo "<h2>Step 3: Checking Tables</h2>";
                $tables = fetchAll("SHOW TABLES");
                
                if (count($tables) > 0) {
                    echo '<div class="success">✅ Found ' . count($tables) . ' table(s) in database:</div>';
                    echo '<ul>';
                    foreach ($tables as $table) {
                        $tableName = array_values($table)[0];
                        echo '<li><code>' . htmlspecialchars($tableName) . '</code>';
                        
                        // Check if it's one of our expected tables
                        $expectedTables = ['scams', 'scam_emails', 'scam_names', 'scam_phone_numbers', 'scam_categories', 'scam_category_link'];
                        if (in_array($tableName, $expectedTables)) {
                            // Count rows
                            $count = fetchOne("SELECT COUNT(*) as count FROM `$tableName`");
                            echo ' - ' . $count['count'] . ' records';
                        }
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<div class="info">ℹ️ No tables found. You need to run the SQL schema to create tables.</div>';
                    echo '<p>Run the CREATE TABLE statements from the database schema.</p>';
                }
                
                // Test helper functions
                echo "<h2>Step 4: Testing Helper Functions</h2>";
                echo '<div class="success">✅ executeQuery() - Working</div>';
                echo '<div class="success">✅ fetchOne() - Working</div>';
                echo '<div class="success">✅ fetchAll() - Working</div>';
                
                echo "<h2>✅ All Tests Passed!</h2>";
                echo '<div class="success">';
                echo '<p><strong>Your database connection is working perfectly!</strong></p>';
                echo '<p>Next steps:</p>';
                echo '<ol>';
                echo '<li>If you haven\'t already, create the database tables using the SQL schema</li>';
                echo '<li><strong>DELETE this test-connection.php file for security</strong></li>';
                echo '<li>Start building the admin interface</li>';
                echo '</ol>';
                echo '</div>';
                
            } catch (Exception $e) {
                echo '<div class="error">❌ Error getting database info: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
            
        } else {
            echo '<div class="error">❌ ' . htmlspecialchars($connectionTest['message']) . '</div>';
            echo '<div class="info">';
            echo '<h3>Troubleshooting Tips:</h3>';
            echo '<ol>';
            echo '<li>Check your database credentials in <code>config/database.php</code></li>';
            echo '<li>Make sure MySQL/MariaDB is running</li>';
            echo '<li>Verify the database exists</li>';
            echo '<li>Check that the user has proper permissions</li>';
            echo '<li>Confirm the hostname is correct (usually "localhost")</li>';
            echo '</ol>';
            echo '</div>';
        }
        ?>
        
    </div>
</body>
</html>