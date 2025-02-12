<?php
include 'logger.php'; // Log the visit

// Output a transparent 1x1 PNG pixel
header("Content-Type: image/png");  

// Create a 1x1 transparent image
$img = imagecreatetruecolor(1, 1);
$transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
imagefill($img, 0, 0, $transparent);
imagesavealpha($img, true);

// Send the image to the browser
imagepng($img);
imagedestroy($img);
?>
