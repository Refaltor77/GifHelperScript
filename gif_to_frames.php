<?php
$inputsFolder = "./inputs/";
$outputsFolder = "./outputs/";

ini_set('memory_limit', '256M');

if (!file_exists($outputsFolder)) {
    mkdir($outputsFolder, 0777, true);
}

$gifFile = $inputsFolder . "test.gif";
$gif = imagecreatefromgif($gifFile);

if ($gif === false) {
    die("Erreur lors de la lecture du fichier GIF.");
}

$frameCount = imagegif($gif);
for ($i = 0; $i < $frameCount; $i++) {
    $frame = imagecreatefromgif($gifFile);

    $outputFile = $outputsFolder . "frame_" . $i . ".png";
    imagepng($frame, $outputFile);

    imagedestroy($frame);
}

imagedestroy($gif);

echo "Conversion terminée.";
?>
