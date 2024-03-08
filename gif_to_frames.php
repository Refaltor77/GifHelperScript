<?php

$inputsFolder = "./inputs/";
$outputsFolder = "./outputs/";

if (!file_exists($outputsFolder)) {
    mkdir($outputsFolder, 0777, true);
}

$files = scandir($inputsFolder);

foreach ($files as $file) {
    $inputFilePath = $inputsFolder . $file;

    if (is_file($inputFilePath) && pathinfo($file, PATHINFO_EXTENSION) === 'gif') {
        $outputGifFolder = $outputsFolder . 'gif_' . pathinfo($file, PATHINFO_FILENAME) . '/';

        if (!file_exists($outputGifFolder)) {
            mkdir($outputGifFolder, 0777, true);
        }

        $gif = new Imagick($inputFilePath);

        foreach ($gif as $frame) {
            $frame->setImageFormat('png');
            $outputFilePath = $outputGifFolder . $frame->getFilename() . '.png';
            $frame->writeImage($outputFilePath);
        }

        $gif->clear();
        $gif->destroy();
    }
}

echo "Conversion des GIF en PNG terminée.";
?>
