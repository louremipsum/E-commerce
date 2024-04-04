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
$total_price = 0;
if(isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Query to retrieve transaction details and associated products
    $query = "SELECT t.order_id, o.quantity, o.subtotal, p.name, p.imgname, p.vendorName, ord.total_price 
    FROM transaction t 
    JOIN order_items o ON t.order_id = o.order_id 
    JOIN product p ON o.product_id = p.id 
    JOIN orders ord ON t.order_id = ord.order_id
    WHERE t.order_id = '$order_id'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orderItems[] = [
                'quantity' => $row['quantity'],
                'subtotal' => $row['subtotal'],
                'item_name' => $row['name'],
                'imgname' => $row['imgname'],
                'vendorName' => $row['vendorName']
            ];
            $total_price = $row['total_price'];
        }
    }
}
if(isset($_POST['back_to_transaction'])) {
    header("location: transaction.php");
    exit(); 
}
?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<div class="container mt-5">
    <form method="post">
        <button type="submit" class="btn btn-primary" name="back_to_transaction">Back</button>
    </form>
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
                    <td><img src="product_img/<?php echo $item['imgname']; ?>" alt="<?php echo $item['item_name']; ?>"
                            class="img-thumbnail" style="width: 100px;">
                    </td>
                    <td><?php echo $item['vendorName']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['subtotal']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total Price(with tax):</strong></td>
                    <td><?php echo $total_price; ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    </form>
</div>