<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MegaCloud – Dashboard</title>
  <link rel="stylesheet" href="design.css">
</head>
<body>
  <main class="wrap">
    <section class="panel right" style="max-width:600px;margin:auto;text-align:center;">
      <h2>✅ Logged in</h2>
      <p>Welcome to <strong>MegaCloud</strong></p>
      <p>User: <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong></p>

      <a href="logout.php" class="link" style="margin-top:20px;display:inline-block;">
        Log out
      </a>
    </section>
  </main>
</body>
</html>
