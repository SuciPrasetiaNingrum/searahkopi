<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <p>Order ID: <?= $transaction_details['order_id']; ?></p>
    <p>Product: <?= $order['product_name']; ?></p>
    <p>Total Amount: Rp <?= number_format($gross_amount); ?></p>
    <button id="pay-button">Pay!</button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            snap.pay('<?= $snapToken; ?>', {
                onSuccess: function(result){
                    console.log(result);
                    window.location.href = 'payment_status.php?status=success&order_id=<?= $transaction_details['order_id']; ?>';
                },
                onPending: function(result){
                    console.log(result);
                    window.location.href = 'payment_status.php?status=pending&order_id=<?= $transaction_details['order_id']; ?>';
                },
                onError: function(result){
                    console.log(result);
                    window.location.href = 'payment_status.php?status=error&order_id=<?= $transaction_details['order_id']; ?>';
                },
                onClose: function(){
                    console.log('customer closed the popup without finishing the payment');
                }
            });
        });
    </script>
</body>
</html>