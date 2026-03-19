<?php
$amount = $_POST['amount'] ?? null;
$months = $_POST['months'] ?? null;
$interest = $_POST['interest'] ?? null;

$errors = [];
$result = null;
$totalAmount = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($amount === null || $amount === '') {
        $errors[] = 'Nie podano kwoty kredytu.';
    } elseif (!is_numeric($amount) || $amount <= 0) {
        $errors[] = 'Kwota kredytu musi być liczbą większą od zera.';
    }

    if ($months === null || $months === '') {
        $errors[] = 'Nie podano okresu kredytowania.';
    } elseif (!is_numeric($months) || $months <= 0) {
        $errors[] = 'Okres musi być liczbą całkowitą większą od zera.';
    }

    if ($interest === null || $interest === '') {
        $errors[] = 'Nie wybrano oprocentowania z listy.';
    } elseif (!is_numeric($interest) || $interest < 0) {
        $errors[] = 'Oprocentowanie musi być liczbą nieujemną.';
    }

    if (empty($errors)) {
        $amount = floatval($amount);
        $months = intval($months);
        $interest = floatval($interest);

        if ($interest == 0) {
            $result = $amount / $months;
        } else {
            $monthlyInterestRate = ($interest / 100) / 12;
            $result = $amount * $monthlyInterestRate / (1 - pow(1 + $monthlyInterestRate, -$months));
        }
        
        $result = round($result, 2);
        $totalAmount = $result * $months;
    }
}

include 'view.php';
