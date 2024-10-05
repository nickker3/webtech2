<?php

declare(strict_types = 1);
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

require APP_PATH . 'App.php';

// Check of het bestand is geselecteerd
if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']); // Zorg ervoor dat er geen path traversal mogelijk is
    $filePath = FILES_PATH . $fileName;

    if (file_exists($filePath)) {
        // Haal de transacties van het geselecteerde bestand op
        $transactions = getTransactions($filePath);
    } else {
        die("Het geselecteerde bestand bestaat niet.");
    }
} else {
    die("Geen bestand geselecteerd.");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transacties</title>
    <!-- Bootstrap CSS toevoegen -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Aangepaste styling voor de tabel */
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        table tr th, table tr td {
            padding: 12px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Transacties voor bestand: <?php echo htmlspecialchars($fileName); ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Datum</th>
                <th>Check #</th>
                <th>Beschrijving</th>
                <th>Bedrag</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($transaction[0]); ?></td>
                        <td><?php echo htmlspecialchars($transaction[1]); ?></td>
                        <td><?php echo htmlspecialchars($transaction[2]); ?></td>
                        <td style="color: <?php echo ($transaction[3] >= 0) ? 'green' : 'red'; ?>">
                            <?php echo htmlspecialchars($transaction[3]); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Geen transacties gevonden</td></tr>
            <?php endif; ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3">Totale Inkomsten:</th>
                <td><?php echo number_format(totalIncome([$transactions]), 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th colspan="3">Totale Uitgaven:</th>
                <td><?php echo number_format(totalExpenses([$transactions]), 2, ',', '.'); ?></td>
            </tr>
            <tr>
                <th colspan="3">Netto totaal:</th>
                <?php $netTotal = totalIncome([$transactions]) + totalExpenses([$transactions]); ?>
                <td style="color: <?php echo ($netTotal >= 0) ? 'green' : 'red'; ?>">
                    <?php echo number_format($netTotal, 2, ',', '.'); ?>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- Knop om terug te gaan naar de hoofdpagina -->
    <div class="text-center mt-4">
        <a href="../public/index.php" class="btn btn-primary">Terug naar hoofdpagina</a>
    </div>
</div>

<!-- Bootstrap JS en Popper.js toevoegen -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
