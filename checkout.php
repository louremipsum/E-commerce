<?php
include 'header.php';
include 'lib/connection.php';

$total_price = isset($_SESSION['totalPrice']) ? $_SESSION['totalPrice'] : 0;
$paymentSuccess = false;

if (isset($_POST['pay'])) {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];

    // Insert into Orders table
    $sql = "INSERT INTO orders (phone_number, order_date, total_price) VALUES ('$phone_number', NOW(), $total_price)";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Insert into Order Items table
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $quantity = $product['quantity'];
            $subtotal = $product['price'] * $quantity;

             // Insert into order_items
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES ($order_id, $product_id, $quantity, $subtotal)";
            $conn->query($sql);
            
            // Decrease the quantity of the product in the products table
            $sql = "UPDATE product SET quantity = quantity - $quantity WHERE id = $product_id";
            $conn->query($sql);
        }

        // Insert into Transactions table
        $proof_of_payment = uniqid() . bin2hex(random_bytes(10)); // Generate a unique ID for proof of payment
        $sql = "INSERT INTO transaction (order_id, transaction_date, proof_of_payment, phone_number, status) VALUES ($order_id, NOW(), '$proof_of_payment', '$phone_number', 'Pending')";
        $conn->query($sql);

        // Clear the cart
        $_SESSION['cart'] = array();
        $paymentSuccess = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="my-4">Checkout</h2>
        <?php if ($paymentSuccess): ?>
        <div class="alert alert-success">
            <strong>Order placed successfully!</strong> Your proof of payment is
            <strong><?php echo $proof_of_payment; ?></strong>. Please show this proof of payment to the store to collect
            your order. Thank you for shopping with us!
        </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" pattern="[0-9]{10}"
                    required>
                <small id="phoneHelp" class="form-text text-muted">Enter a valid 10-digit phone number.</small>
            </div>
            <div class="form-group">
                <label for="total_amount">Total amount:</label>
                <input type="text" class="form-control" id="total_amount" value="<?php echo $total_price; ?>" readonly>
            </div>
            <button type="submit" name="pay" class="btn btn-primary">Pay</button>
        </form>
    </div>
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>