<?php
// class-autoload.inc.php

spl_autoload_register(function ($className) {
    // Mappen waar klassen zich bevinden
    $paths = ['../classes/', '../controllers/', '../views/']; // Pas deze paden aan volgens je projectstructuur
    $extension = '.class.php';

    foreach ($paths as $path) {
        $fullPath = $path . $className . $extension;
        if (file_exists($fullPath)) {
            require_once $fullPath;
            return;
        }
    }

    // Log een fout als de klasse niet wordt gevonden (optioneel)
    error_log("Autoload error: Kon klasse $className niet vinden in de opgegeven paden.");
});
