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
$sql = "SELECT * FROM transaction";
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
    <!-- commit change -->
    <div class="container pendingbody">
        <h5>Transaction</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Proof of Payment </th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Status </th>
                </tr>
            </thead>
            <tbody>
                <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>

                    <td><?php echo $row["order_id"] ?></td>
                    <td><?php echo $row["transaction_date"] ?></td>
                    <td><?php echo $row["proof_of_payment"] ?></td>
                    <td><?php echo $row["phone_number"] ?></td>
                    <td><?php echo $row["status"] ?></td>
                    <td>
                                <!-- Button to view transaction details -->
                                <form action="transaction_details.php" method="GET">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                    <button type="submit">View Details</button>
                                </form>
                            </td>                
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