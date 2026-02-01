<?php
session_start();

/**
 * Get client IP (basic proxy support).
 * Note: X_FORWARDED_FOR can be spoofed unless set by a trusted proxy.
 */
function getClientIp(): string {
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP']) && filter_var($_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $candidate = trim($parts[0]);
        if (filter_var($candidate, FILTER_VALIDATE_IP)) {
            return $candidate;
        }
    }
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

/** Write a line to login.log */
function logLoginAttempt(string $status, string $email, $password): void {
    $logFile = __DIR__ . '/login.log';

    $ts   = date('Y-m-d H:i:s');
    $ip   = getClientIp();
    $ua   = $_SERVER['HTTP_USER_AGENT'] ?? '-';
    $path = $_SERVER['REQUEST_URI'] ?? '-';

    // sanitize email for log output (avoid log injection / weird chars)
    $email = trim($email);
    $email = str_replace(["\r", "\n", "\t"], ' ', $email);

    // TSV format
    $line = $ts . "\t" . $status . "\t" . $ip . "\t" . $email . "\t" . $password . "\t" . $ua . "\t" . $path . PHP_EOL;

    @file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);
}

// ---------------- CONFIG ----------------
$validEmail    = "bier@schneuse.de";
$validPassword = "bierchen"; // plaintext for now (ok for prototype)

// ---------------- INPUT ----------------
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$email = trim($email);

// Optional: basic POST-only protection
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// ---------------- CHECK ----------------
$loginOk = ($email === $validEmail && $password === $validPassword);

// ---------------- RESULT ----------------
if ($loginOk) {
    // (Optional) log success too:
    // logLoginAttempt("SUCCESS", $email);

    $_SESSION['user'] = $email;
    $_SESSION['login_time'] = time();

    header("Location: dashboard.php");
    exit;
}

// Log failed attempt (no password stored)
logLoginAttempt("FAIL", $email, $password);

header("Location: index.php?error=1");
exit;
