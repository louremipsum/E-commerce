<?php
include 'header.php';
SESSION_START();

if(isset($_SESSION['auth']))
{
   if($_SESSION['auth']!=1)
   {
       header("location:login.php");
   }
}
else
{
   header("location:login.php");
}

include 'lib/connection.php';

$transactionStatus = '';
$proofOfPayment = '';
$orderItems = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $proofOfPayment = $_POST['proof_of_payment'];

    if (isset($_POST['confirm'])) {
        $sql = "UPDATE transaction SET status = 'FULFILLED' WHERE proof_of_payment = '$proofOfPayment'";
        $conn->query($sql);
    } elseif (isset($_POST['cancel'])) {
        $sql = "UPDATE transaction SET status = 'CANCELED' WHERE proof_of_payment = '$proofOfPayment'";
        $conn->query($sql);
    }

    $sql = "SELECT status FROM transaction WHERE proof_of_payment = '$proofOfPayment'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $transactionStatus = $result->fetch_assoc()['status'];
    } else {
        $transactionStatus = 'No transaction found with this proof of payment.';
    }
    $sql = "SELECT t.status, o.quantity, o.subtotal, p.name, p.imgname, p.vendorName 
    FROM transaction t 
    JOIN order_items o ON t.order_id = o.order_id 
    JOIN product p ON o.product_id = p.id 
    WHERE t.proof_of_payment = '$proofOfPayment'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    $transactionStatus = $row['status'];
    $orderItems[] = [
        'quantity' => $row['quantity'],
        'subtotal' => $row['subtotal'],
        'item_name' => $row['name'],
        'imgname' => $row['imgname'],
        'vendorName' => $row['vendorName']
    ];
}
} else {
$transactionStatus = 'No transaction found with this proof of payment.';
}
}
?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<div class="container mt-5">
    <form method="post">
        <div class="form-group">
            <label for="proof_of_payment" class="font-weight-bold">Proof of Payment:</label>
            <input type="text" class="form-control form-control-lg" id="proof_of_payment" name="proof_of_payment"
                value="<?php echo $proofOfPayment; ?>">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Search</button>
        <div class="table-responsive">
            <table class="table table-striped mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Item Name</th>
                        <th>Image</th>
                        <th>Vendor Name</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                    <tr>
                        <td><?php echo $item['item_name']; ?></td>
                        <td><img src="product_img/<?php echo $item['imgname']; ?>"
                                alt="<?php echo $item['item_name']; ?>" class="img-thumbnail" style="width: 100px;">
                        </td>
                        <td><?php echo $item['vendorName']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['subtotal']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="mt-3">Status: <?php echo $transactionStatus; ?></p>
        <?php if ($transactionStatus !== '' && $transactionStatus !== 'No transaction found with this proof of payment.' && $transactionStatus !== 'FULFILLED' && $transactionStatus !== 'CANCELED'): ?>
        <button type="submit" name="confirm" class="btn btn-success">Confirm</button>
        <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
        <?php endif; ?>
    </form>
</div>