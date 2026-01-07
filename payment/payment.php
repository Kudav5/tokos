<?php
require 'config.php';

use Midtrans\Snap;
use Midtrans\Transaction;

$orderId = 'order-'.time();
$grossAmount = 200000; // Total payment amount in IDR

$params = [
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => $grossAmount,
    ],
    'customer_details' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@example.com',
        'phone' => '081234567890',
    ],
];

try {
    $snapToken = Snap::getSnapToken($params);
    echo "Snap Token: " . $snapToken;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
