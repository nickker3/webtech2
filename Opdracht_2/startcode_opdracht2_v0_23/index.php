<?php

declare(strict_types = 1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

// Helper function to format the date
function formatDate($date) {
    setlocale(LC_TIME, 'nl_NL.UTF-8');
    $timestamp = strtotime($date);

    // Check if strtotime was successful
    if ($timestamp !== false) {
        return strftime('%e %B %Y', $timestamp);
    } else {
        return $date; // Return the original date string if conversion fails
    }
}

// Helper function to format amount with color
function formatAmount($amount) {
    $color = $amount < 0 ? 'red' : 'green';
    return "<span style='color: {$color};'>" . number_format($amount, 2, ',', '.') . "</span>";
}

// Function to read and display the transaction file data
function displayFileData($filePath) {
    $totalIncome = 0;
    $totalExpenses = 0;
    $transactions = [];

    if (($handle = fopen($filePath, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $date = formatDate($data[0]);
            $checksum = $data[1];
            $description = $data[2];
            $amount = (float)$data[3];
            
            if ($amount < 0) {
                $totalExpenses += $amount;
            } else {
                $totalIncome += $amount;
            }
            
            $transactions[] = [
                'date' => $date,
                'description' => $description,
                'amount' => $amount
            ];
        }
        fclose($handle);
    }

    // Display the transactions in a table
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Datum</th><th>Beschrijving</th><th>Bedrag</th></tr></thead>";
    echo "<tbody>";
    foreach ($transactions as $transaction) {
        echo "<tr>";
        echo "<td>{$transaction['date']}</td>";
        echo "<td>{$transaction['description']}</td>";
        echo "<td>" . formatAmount($transaction['amount']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Display totals
    echo "<h4>Totaal inkomen: " . formatAmount($totalIncome) . "</h4>";
    echo "<h4>Totaal uitgaven: " . formatAmount($totalExpenses) . "</h4>";
    echo "<h4>Netto totaal: " . formatAmount($totalIncome + $totalExpenses) . "</h4>";
}

// If a file is selected, display its data
if (isset($_GET['file'])) {
    $filePath = FILES_PATH . basename($_GET['file']);
    if (file_exists($filePath)) {
        displayFileData($filePath);
    } else {
        echo "<p>Bestand niet gevonden.</p>";
    }
} else {
    // Display the list of files in FILES_PATH
    $files = scandir(FILES_PATH);
    echo "<h3>Beschikbare bestanden:</h3>";
    echo "<ul>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<li><a href='?file=" . urlencode($file) . "'>{$file}</a></li>";
        }
    }
    echo "</ul>";
}

?>

<!-- Include Bootstrap CSS for styling -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
