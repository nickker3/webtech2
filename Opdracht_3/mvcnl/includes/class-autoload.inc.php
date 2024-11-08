<?php
// includes/class-autoload.inc.php

spl_autoload_register(function ($className) {
    // Zoekpaden voor klassen
    $paths = [__DIR__ . '/../classes/', __DIR__ . '/../controllers/', __DIR__ . '/../models/'];
    $extension = '.class.php';

    foreach ($paths as $path) {
        $fullPath = $path . $className . $extension;
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }

    // Optionele foutlog voor het niet kunnen vinden van een klasse
    error_log("Autoload error: Kon klasse $className niet vinden in de opgegeven paden.");
});
