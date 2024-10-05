<?php

declare(strict_types = 1);

// HIER CODE
function getTransactionFiles(string $dirPath): array
{
    $files = [];
    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }
        $files[] = $dirPath . $file;
    }
    return $files;
}

function getTransactions(string $fileName): array {
    if (!file_exists($fileName)) {
        throw new \Exception('Bestand "' . $fileName . '" bestaat niet.');
    }

    $file = fopen($fileName, 'r');
    $transactions = [];

    // Eerste regel overslaan (header)
    $headers = fgetcsv($file, 0, ";");

    while (($row = fgetcsv($file, 0, ";")) !== false) {
        // Controleer of de rij correct is ingelezen en dat deze het juiste aantal velden heeft
        if (count($row) == 4) {
            // Voeg de rij toe aan transacties
            $transactions[] = $row;
        } else {
            // Debuggen: Toon de fout als een rij niet het juiste aantal velden bevat
            echo "Onverwachte rij: ";
            print_r($row);
        }
    }

    fclose($file);
    return $transactions;
}

function totalIncome(array $transactions): float {
    $totalIncome = 0;

    // Loop door alle transacties
    foreach ($transactions as $transactionSet) {
        foreach ($transactionSet as $transaction) {
            // Zorg ervoor dat het bedrag een geldige numerieke waarde is
            $amount = (float) str_replace(',', '.', $transaction[3]); // Zet komma om naar punt voor getallen
            if ($amount > 0) {
                $totalIncome += $amount; // Tel alleen positieve bedragen bij elkaar op
            }
        }
    }

    return $totalIncome;
}

function totalExpenses(array $transactions): float {
    $totalExpenses = 0;

    // Loop door alle transacties
    foreach ($transactions as $transactionSet) {
        foreach ($transactionSet as $transaction) {
            // Zorg ervoor dat het bedrag een geldige numerieke waarde is
            $amount = (float) str_replace(',', '.', $transaction[3]); // Zet komma om naar punt voor getallen
            if ($amount < 0) {
                $totalExpenses += $amount; // Tel alleen negatieve bedragen bij elkaar op
            }
        }
    }

    return $totalExpenses;
}