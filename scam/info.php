<?php
include 'logger.php'; // Include the logging functionality
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Internal Server Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .error-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 48px;
            color: #dc3545;
        }
        p {
            font-size: 18px;
            margin: 20px 0;
        }
        .error-code {
            font-size: 22px;
            font-weight: bold;
            color: #6c757d;
        }
        .reload-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .reload-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>500</h1>
        <p><strong>Internal Server Error</strong></p>
        <p>Oops! Something went wrong on our end.</p>
        <p class="error-code">Error Code: #<?php echo rand(1000, 9999); ?></p>
        <a href="#" class="reload-btn" onclick="location.reload();">Try Again</a>
    </div>
</body>
</html>
