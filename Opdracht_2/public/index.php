<?php

declare(strict_types = 1);
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* HIER CODE (zie de instructies op Blackboard) */
require APP_PATH . 'App.php';
$files = getTransactionFiles(FILES_PATH);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactiebestanden</title>
    <!-- Bootstrap CSS toevoegen -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Transactiebestanden</h1>
    <div class="d-flex flex-column align-items-center">
        <?php foreach ($files as $file): ?>
            <a href="../views/transactions.php?file=<?php echo urlencode(basename($file)); ?>" class="btn btn-outline-primary mb-2 w-50">
                <?php echo basename($file); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap JS en Popper.js toevoegen -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
