<?php

declare(strict_types=1);

$transactions = [
    [
        "id" => 1,
        "date" => "2026-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" => "2026-02-10",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
    [
        "id" => 3,
        "date" => "2026-03-10",
        "amount" => 200.00,
        "description" => "Online shopping",
        "merchant" => "Amazon",
    ],
];

function calculateTotalAmount(array $transactions): float
{
    $total = 0;

    foreach ($transactions as $transaction) {
        $total += $transaction["amount"];
    }

    return $total;
}

/* поиск по описанию */

function findTransactionByDescription(string $descriptionPart): array
{
    global $transactions;

    $result = [];

    foreach ($transactions as $transaction) {
        if (stripos($transaction["description"], $descriptionPart) !== false) {
            $result[] = $transaction;
        }
    }

    return $result;
}

function findTransactionById(int $id): ?array
{
    global $transactions;

    foreach ($transactions as $transaction) {
        if ($transaction["id"] === $id) {
            return $transaction;
        }
    }

    return null;
}

function findTransactionByIdFilter(int $id): ?array
{
    global $transactions;

    $result = array_filter($transactions, function ($transaction) use ($id) {
        return $transaction["id"] === $id;
    });

    return $result ? array_values($result)[0] : null;
}

/* дни с момента транзакции */

function daysSinceTransaction(string $date): int
{
    $transactionDate = new DateTime($date);
    $today = new DateTime();

    $diff = $today->diff($transactionDate);

    return abs($diff->days);
}

/* добавление транзакции */

function addTransaction(
    int $id,
    string $date,
    float $amount,
    string $description,
    string $merchant
): void {
    global $transactions;

    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}

/* пример добавления */

addTransaction(4, "2026-11-01", 50.25, "Taxi ride", "Uber");


/* сортировка по дате */

usort($transactions, function ($a, $b) {
    return strtotime($a["date"]) <=> strtotime($b["date"]);
});

/* сортировка по сумме (убывание) */

usort($transactions, function ($a, $b) {
    return $b["amount"] <=> $a["amount"];
});

?>

<!DOCTYPE html>
<html>
<head>
<title>Bank Transactions</title>
</head>

<body>

<h2>Список транзакций</h2>

<table border="1" cellpadding="5">

<thead>
<tr>
<th>ID</th>
<th>Date</th>
<th>Amount</th>
<th>Description</th>
<th>Merchant</th>
<th>Days since</th>
</tr>
</thead>

<tbody>

<?php foreach ($transactions as $transaction): ?>

<tr>
<td><?= $transaction["id"] ?></td>
<td><?= $transaction["date"] ?></td>
<td><?= $transaction["amount"] ?></td>
<td><?= $transaction["description"] ?></td>
<td><?= $transaction["merchant"] ?></td>
<td><?= daysSinceTransaction($transaction["date"]) ?></td>
</tr>

<?php endforeach; ?>

<tr>
<td colspan="2"><b>Total</b></td>
<td colspan="4">
<b><?= calculateTotalAmount($transactions) ?></b>
</td>
</tr>

</tbody>

</table>

</body>
</html>