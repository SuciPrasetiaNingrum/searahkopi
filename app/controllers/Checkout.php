<?php
require_once 'config/config.php';

// Ambil data pesanan dari database
$sql = "
SELECT ordered.id as order_id, user.name as customer_name, user.email as customer_email, user.phone as customer_phone, menu.nama_menu as product_name, menu.harga as price, ordered.amount
FROM ordered
JOIN user ON ordered.id_user = user.id
JOIN menu ON ordered.id_menu = menu.id
LIMIT 1";
$stmt = $pdo->query($sql);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("No order found!");
}

$id_order = $order['order_id'];
$gross_amount = $order['price'] * $order['amount'];
$customer_name = $order['customer_name'];
$customer_email = $order['customer_email'];
$customer_phone = $order['customer_phone'];

$transaction_details = [
    'order_id' => uniqid(),
    'gross_amount' => $gross_amount,
];

$customer_details = [
    'first_name' => explode(" ", $customer_name)[0],
    'last_name' => explode(" ", $customer_name)[1],
    'email' => $customer_email,
    'phone' => $customer_phone,
];

$transaction = [
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
];

$snapToken = \Midtrans\Snap::getSnapToken($transaction);

// Simpan data transaksi ke database
$sql = "INSERT INTO transaction (id_order, status) VALUES (:id_order, 0)";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id_order' => $id_order]);
?>

