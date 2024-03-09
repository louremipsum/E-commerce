<?php
 include'header.php';
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
include'lib/connection.php';
$sql = "SELECT * FROM orders";
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
        <h5>All Orders</h5>
        <table class="table">
            <thead>
                <tr>

                    <th scope="col">Phone Number</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>

                    <td><?php echo $row["phone_number"] ?></td>
                    <td><?php echo $row["order_date"] ?></td>
                    <td><?php echo $row["total_price"] ?></td>
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