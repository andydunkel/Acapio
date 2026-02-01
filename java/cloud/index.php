<?php
session_start();

// Optional: if already logged in, go directly to dashboard
if (!empty($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

// ---- Simple access logger for stats.log ----
$logFile = __DIR__ . '/stats.log';
$ts = date('Y-m-d H:i:s');

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!empty($_SERVER['HTTP_CF_CONNECTING_IP']) && filter_var($_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $candidate = trim($parts[0]);
    if (filter_var($candidate, FILTER_VALIDATE_IP)) {
        $ip = $candidate;
    }
}

$ua   = $_SERVER['HTTP_USER_AGENT'] ?? '-';
$path = $_SERVER['REQUEST_URI'] ?? '-';
$ref  = $_SERVER['HTTP_REFERER'] ?? '-';

$line = $ts . "\t" . $ip . "\t" . $ua . "\t" . $path . "\t" . $ref . "\t" . "index.php" . PHP_EOL;
@file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MegaCloud – Login</title>
  <meta name="description" content="MegaCloud – private file cloud. Login placeholder." />
  <link rel="stylesheet" href="design.css">
</head>

<body>
  <div class="blob b1"></div>
  <div class="blob b2"></div>
  <div class="blob b3"></div>

  <main class="wrap">
    <section class="shell">
      <!-- Left / Info panel -->
      <div class="panel left">
        <div>
          <div class="brand">
            <div class="logo" aria-hidden="true"></div>
            <div>
              <h1>MegaCloud</h1>
              <p>Your encrypted file cloud</p>
            </div>
          </div>

          <div class="hero">
            <h2>Store files securely. Access them anywhere.</h2>
            <p>All data is encrypted.</p>

            <div class="bullets">
              <div class="bullet">
                <div class="dot"></div>
                <div>
                  <strong>Upload & Download</strong>
                  <span>Upload data with ease.</span>
                </div>
              </div>
              <div class="bullet">
                <div class="dot" style="background: linear-gradient(180deg, var(--accent1), rgba(110,168,255,.35));
                                       box-shadow: 0 0 0 4px rgba(110,168,255,.12);"></div>
                <div>
                  <strong>Folders & Sharing</strong>
                  <span>Links, expiration dates, permissions (read/write) — fully flexible.</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="footer">
          <span class="pill"><span class="status" aria-hidden="true"></span> Status: Downloads limited</span>
          <span class="pill">v1.1</span>
        </div>
      </div>

      <!-- Right / Login panel -->
      <div class="panel right">
        <div>
          <h3>Login</h3>
          <p class="sub">Sign in to access your files.</p>

          <?php if (!empty($_GET['error'])): ?>
            <div class="toast show" style="background:rgba(251,113,133,.12);border-color:rgba(251,113,133,.25);">
              ❌ Wrong email or password
            </div>
          <?php endif; ?>

          <form id="loginForm" action="login.php" method="post" novalidate>
            <label>
              Email
              <input class="input" type="email" name="email" placeholder="name@domain.tld" autocomplete="username" />
            </label>

            <label>
              Password
              <input class="input" type="password" name="password" placeholder="••••••••" autocomplete="current-password" />
            </label>

            <div class="row">
              <label class="checkbox">
                <input type="checkbox" name="remember" />
                Stay signed in
              </label>
              <a class="link" href="#" aria-label="Forgot password (placeholder)">Forgot password?</a>
            </div>

            <button class="btn" type="submit">Sign In</button>

            <p class="tiny">
              © <span id="year"></span> MegaCloud · Private Cloud Software
            </p>
          </form>
        </div>
      </div>
    </section>
  </main>

  <script>
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
