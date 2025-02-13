<?php
// Get the full domain and script directory dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$domain = $_SERVER['HTTP_HOST'];
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = rtrim($scriptDir, '/');

// Falls eine ID übergeben wird, nutzen wir sie
$identifier = isset($_GET['o']) ? $_GET['o'] : "test123";

// Construct the full pixel URL with "o" parameter
$pixelUrl = "$protocol://$domain$scriptDir/tracking_pixel.php?o=" . urlencode($identifier);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pixel Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            color: #007bff;
        }
        .pixel-code {
            background: #eee;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            display: block;
            margin-top: 10px;
            word-wrap: break-word;
        }
        .copy-btn {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .copy-btn:hover {
            background-color: #218838;
        }
        .notice {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
    <script>
        function copyToClipboard() {
            let pixelCode = document.getElementById("pixelCode");
            navigator.clipboard.writeText(pixelCode.innerText).then(function() {
                alert("Pixel code copied to clipboard!");
            }, function(err) {
                alert("Failed to copy text.");
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Tracking Pixel</h1>
        <p>Copy and paste the following HTML code into your email or website:</p>
        <div class="pixel-code" id="pixelCode">
            &lt;img src="<?php echo htmlspecialchars($pixelUrl, ENT_QUOTES, 'UTF-8'); ?>" width="1" height="1" alt=""&gt;
        </div>
        <button class="copy-btn" onclick="copyToClipboard()">Copy Pixel Code</button>
        <p class="notice">Dieses Pixel wird IP-Adressen, User-Agents und Referrer-Informationen loggen.</p>
    </div>
</body>
</html>
