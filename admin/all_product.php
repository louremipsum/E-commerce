<?php
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
 include'header.php';
 include'lib/connection.php';

 $vendorSql = "SELECT DISTINCT vendorName FROM product";
 $vendorResult = $conn -> query ($vendorSql);
 
 $vendorFilter = isset($_POST['vendor']) ? $_POST['vendor'] : '';
 
 if ($vendorFilter == '' || $vendorFilter == 'All') {
     $sql = "SELECT * FROM product";
 } else {
     $sql = "SELECT * FROM product WHERE vendorName = '$vendorFilter'";
 }
 
 $result = $conn -> query ($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pending_orders.css">

</head>

<body>

    <div class="container pendingbody">
        <h5>All Product</h5>
        <form method="post">
            <label for="vendorSelect">Choose Vendor:</label>
            <select id="vendorSelect" name="vendor" onchange="this.form.submit()">
                <option value="All">All</option>
                <?php
                if (mysqli_num_rows($vendorResult) > 0) {
                    while($row = mysqli_fetch_assoc($vendorResult)) {
                        $selected = ($vendorFilter == $row['vendorName']) ? 'selected' : '';
                        echo "<option value=\"{$row['vendorName']}\" $selected>{$row['vendorName']}</option>";
                    }
                }
                ?>
            </select>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date of Purchase</th>
                    <th scope="col">Invoice Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><img src="product_img/<?php echo $row['imgname']; ?>" style="width:50px;"></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td><?php echo $row['date_of_purchase']; ?></td>
                    <td><?php echo $row['invoiceNum']; ?></td>
                </tr>
                <?php 
                }
            } 
            else 
                echo "0 results";
            ?>
            </tbody>
        </table>
    </div>

</body>

</html>