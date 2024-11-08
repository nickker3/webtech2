<?php
// includes/class-autoload.inc.php

spl_autoload_register(function ($className) {
    // Absoluut pad naar de klassenmappen vanaf de locatie van dit bestand
    $paths = [__DIR__ . '../classes', __DIR__ . '../controllers', __DIR__ . '../models'];
    $extension = '.class.php';
    $fullPath = $paths . $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }
});




//    foreach ($paths as $path) {
//        $fullPath = $path . $className . $extension;
//        if (file_exists($fullPath)) {
//            require_once $fullPath;
//            return;
//        }
//    }

    // Log een fout als de klasse niet wordt gevonden (optioneel)
//    error_log("Autoload error: Kon klasse $className niet vinden in de opgegeven paden.");
//});
