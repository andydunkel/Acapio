<?php
// index.php
// lege "vorlage.png" in den gleichen ordner.
// optional: lege "DejaVuSans.ttf" daneben (oder passe FONT_FILE unten an).

declare(strict_types=1);

const TEMPLATE_FILE = __DIR__ . '/vorlage.png';
const FONT_FILE     = __DIR__ . '/DejaVuSans.ttf'; // alternativ: __DIR__ . '/arial.ttf'

// --- positions-config (pixel) für DEIN screenshot (844x376) ---
// wenn deine vorlage andere größe hat: werte anpassen.
$POS = [
    'name'   => ['x' => 28,  'y' => 100,  'maxW' => 520, 'size' => 20],
    'iban'   => ['x' => 28,  'y' => 125, 'maxW' => 520, 'size' => 14],
    'amount' => ['x' => 690, 'y' => 112, 'maxW' => 140, 'size' => 22], // rechts
    'date'   => ['x' => 245, 'y' => 220, 'maxW' => 220, 'size' => 12],
    'purpose'=> ['x' => 245, 'y' => 273, 'maxW' => 360, 'size' => 12],
    'recv'   => ['x' => 245, 'y' => 337, 'maxW' => 520, 'size' => 12],
];

// farben (rgb)
$COLOR = [
    'white' => [235,235,235],
];

// -------- helper: textbreite messen + auto-fit in maxW ----------
function textWidth(string $text, int $size, string $font): int {
    $box = imagettfbbox($size, 0, $font, $text);
    return (int)abs($box[2] - $box[0]);
}

function fitFontSize(string $text, int $startSize, int $maxW, string $font, int $minSize = 10): int {
    $size = $startSize;
    while ($size > $minSize && textWidth($text, $size, $font) > $maxW) {
        $size--;
    }
    return $size;
}

function drawText($im, string $text, int $x, int $y, int $size, int $maxW, string $font, int $color): void {
    $text = trim($text);
    if ($text === '') return;

    // simple einzeilig + auto-fit
    $size = fitFontSize($text, $size, $maxW, $font);
    imagettftext($im, $size, 0, $x, $y, $color, $font, $text);
}

// -------- render wenn formular abgeschickt ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!file_exists(TEMPLATE_FILE)) {
        http_response_code(500);
        echo "template fehlt: " . htmlspecialchars(TEMPLATE_FILE);
        exit;
    }
    if (!function_exists('imagecreatefrompng') || !function_exists('imagettftext')) {
        http_response_code(500);
        echo "php-gd / freetype fehlt (imagecreatefrompng/imagettftext).";
        exit;
    }
    if (!file_exists(FONT_FILE)) {
        http_response_code(500);
        echo "font fehlt: " . htmlspecialchars(FONT_FILE) . " (lege eine .ttf daneben oder passe FONT_FILE an)";
        exit;
    }

    $name   = (string)($_POST['name'] ?? '');
    $iban   = (string)($_POST['iban'] ?? '');
    $date   = (string)($_POST['date'] ?? '');
    $purpose= (string)($_POST['purpose'] ?? '');
    $recv   = (string)($_POST['recv'] ?? '');
    $amount = (string)($_POST['amount'] ?? '');

    $im = imagecreatefrompng(TEMPLATE_FILE);
    imagesavealpha($im, true);

    $c = $COLOR['white'];
    $white = imagecolorallocate($im, $c[0], $c[1], $c[2]);

    // texte zeichnen
    drawText($im, $name,    $POS['name']['x'],    $POS['name']['y'],    $POS['name']['size'],    $POS['name']['maxW'],    FONT_FILE, $white);
    drawText($im, $iban,    $POS['iban']['x'],    $POS['iban']['y'],    $POS['iban']['size'],    $POS['iban']['maxW'],    FONT_FILE, $white);
    drawText($im, $amount,  $POS['amount']['x'],  $POS['amount']['y'],  $POS['amount']['size'],  $POS['amount']['maxW'],  FONT_FILE, $white);
    drawText($im, $date,    $POS['date']['x'],    $POS['date']['y'],    $POS['date']['size'],    $POS['date']['maxW'],    FONT_FILE, $white);
    drawText($im, $purpose, $POS['purpose']['x'], $POS['purpose']['y'], $POS['purpose']['size'], $POS['purpose']['maxW'], FONT_FILE, $white);
    drawText($im, $recv,    $POS['recv']['x'],    $POS['recv']['y'],    $POS['recv']['size'],    $POS['recv']['maxW'],    FONT_FILE, $white);

    // ausgabe als png (download)
    header('Content-Type: image/png');
    header('Content-Disposition: inline; filename="umsatz.png"');
    imagepng($im);
    imagedestroy($im);
    exit;
}

// -------- formular ----------
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>vorlage beschriften</title>
  <style>
    body{font-family:system-ui,Segoe UI,Arial;max-width:900px;margin:20px auto;padding:0 12px}
    label{display:block;margin-top:10px;font-weight:600}
    input{width:100%;padding:10px;border:1px solid #bbb;border-radius:8px}
    button{margin-top:14px;padding:12px 14px;border:0;border-radius:10px;cursor:pointer}
    .hint{color:#555;font-size:14px;margin-top:10px}
  </style>
</head>
<body>
  <h2>bild mit text füllen</h2>
  <form method="post">
    <label>name</label>
    <input name="name" value="Max Muster">

    <label>bankverbindung (iban)</label>
    <input name="iban" value="LT963131110180051036">

    <label>buchungsdatum</label>
    <input name="date" value="<?= date('d.m.Y') ?>">

    <label>verwendungszweck</label>
    <input name="purpose" value="Lecker Bierchen">

    <label>empfänger</label>
    <input name="recv" value="LT963131110180051036">

    <label>betrag</label>
    <input name="amount" value="-300,00 EUR">

    <button type="submit">bild erzeugen</button>
  </form>
</body>
</html>
