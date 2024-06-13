<?php
require_once 'config.php';

if (isset($_GET['status']) && isset($_GET['order_id'])) {
    $status = $_GET['status'];
    $order_id = $_GET['order_id'];
    
    // Tentukan status transaksi
    $transaction_status = 0;
    if ($status == 'success') {
        $transaction_status = 1;
    }

    // Perbarui status transaksi di database
    $sql = "UPDATE transactions SET status = :status WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':status' => $transaction_status, ':order_id' => $order_id]);

    echo "<h2>Payment Status: $status</h2>";
    echo "<p>Order ID: $order_id</p>";
} else {
    echo "<h2>Invalid Request</h2>";
}
?>