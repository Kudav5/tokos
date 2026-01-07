<?php
require 'config.php';

use Midtrans\Notification;

try {
    $notif = new Notification();

    $transaction = $notif->transaction_status;
    $type = $notif->payment_type;
    $order_id = $notif->order_id;
    $fraud = $notif->fraud_status;

    if ($transaction == 'capture') {
        if ($type == 'credit_card') {
            if ($fraud == 'challenge') {
                // Update database to 'challenge'
            } else {
                // Update database to 'success'
            }
        }
    } else if ($transaction == 'settlement') {
        // Update database to 'settlement'
    } else if ($transaction == 'pending') {
        // Update database to 'pending'
    } else if ($transaction == 'deny') {
        // Update database to 'deny'
    } else if ($transaction == 'expire') {
        // Update database to 'expire'
    } else if ($transaction == 'cancel') {
        // Update database to 'cancel'
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
