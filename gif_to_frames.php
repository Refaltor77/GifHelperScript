<?php

$inputsFolder = "./inputs/";
$outputsFolder = "./outputs/";

ini_set('memory_limit', '256M');

if (!file_exists($outputsFolder)) {
    mkdir($outputsFolder, 0777, true);
}

$files = scandir($inputsFolder);

foreach ($files as $file) {
    if ($file != "." && $file != "..") {
        $inputFilePath = $inputsFolder . $file;

        if (is_file($inputFilePath) && pathinfo($file, PATHINFO_EXTENSION) === 'gif') {
            $outputGifFolder = $outputsFolder . 'gif_' . pathinfo($file, PATHINFO_FILENAME) . '/';

            if (!file_exists($outputGifFolder)) {
                mkdir($outputGifFolder, 0777, true);
            }

            try {
                $gif = new Imagick($inputFilePath);

                foreach ($gif as $frame) {
                    $frame->setImageFormat('png');
                    $outputFilePath = $outputGifFolder . $frame->getFilename() . '.png';
                    $frame->writeImage($outputFilePath);
                    $frame->clear();
                    $frame->destroy();
                }

                $gif->clear();
                $gif->destroy();
            } catch (ImagickException $e) {
                echo "Erreur lors de la conversion du fichier $file : " . $e->getMessage() . "\n";
            }
        }
    }
}

echo "Conversion des GIF en PNG terminée.";

?>
