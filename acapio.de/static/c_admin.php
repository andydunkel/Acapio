<?php
session_start();
require 'config.php';

$conn = new mysqli($host, $user, $pass, $db);

// Admin Credentials
$admin_user = "schneuse"; // Change this
$admin_pass = "schneusenbiber1#"; // Change this

// Handle Login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        echo "<p class='error-message'>Falsche Anmeldeinformationen!</p>";
    }
}

// Check if Logged In
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        .login-form {
            max-width: 350px;
            margin: 100px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
        }
        .login-form h2 {
            margin-bottom: 20px;
            font-size: 22px;
            color: #333;
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #444;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s;
            outline: none;
        }
        .form-group input:focus {
            border-color: #007BFF;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="post" class="login-form">
        <h2>🔐 Admin Login</h2>
        <div class="form-group">
            <label for="username">Benutzername</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Passwort</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" name="login">🔑 Anmelden</button>
    </form>
</body>
</html>
<?php
    exit();
}

// Delete Comment
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $id = $_POST['comment_id'];
    $conn->query("DELETE FROM comments WHERE id = $id");
}

// Fetch Comments
$result = $conn->query("SELECT * FROM comments ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #f4f4f4;
        }
        
        h1 {
            text-align: center;
        }

        .comment-box {
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
            color: #007BFF;
        }

        .comment-text {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .comment-info {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .comment-actions {
            margin-top: 10px;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: red;
            color: white;
        }

        .logout-btn {
            display: block;
            margin: 20px auto;
            background-color: #555;
            color: white;
            padding: 10px;
        }

        .login-form {
            max-width: 300px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-form input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Admin Panel – Kommentare</h1>

    <?php while ($comment = $result->fetch_assoc()): ?>    
        <div class="comment-box">
            <div class="comment-header">
                <span><?= htmlspecialchars($comment['name']) ?></span>
                <span><?= $comment['created_at'] ?></span>
            </div>
            <p class="comment-text"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            
            <div class="comment-info">
                <strong>E-Mail:</strong> 
                    <?php                     
                        echo htmlspecialchars($comment['email']); 
                    ?>
                <br>

                <strong>Post:</strong> 
                <a href="<?= htmlspecialchars($comment['post_id']) ?>" target="_blank">
                    <?= htmlspecialchars($comment['post_id']) ?>
                </a><br>

                <strong>IP:</strong> 
                <a href="https://www.whois.com/whois/<?= htmlspecialchars($comment['ip_address']) ?>" target="_blank">
                    <?= htmlspecialchars($comment['ip_address']) ?>
                </a>
            </div>

            <form method="post" class="comment-actions">
                <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                <button type="submit" name="delete">Löschen</button>
            </form>
        </div>
    <?php endwhile; ?>

    <form method="post" action="logout.php">
        <button type="submit" name="logout" class="logout-btn">Abmelden</button>
    </form>

</body>
</html>
