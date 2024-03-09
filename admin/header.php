<?php
include'lib/connection.php';
// $sql = "SELECT * FROM orders where status='pending'";
// $result = $conn -> query ($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
</head>

<body>
    <section class="header d-flex justify-content-between align-items-center" id="header">
        <div class="d-flex align-items-center">
            <i class="fas fa-bars fixed" onclick="openside()"></i>
            <div class="line-fixed">Admin Panel</div>
        </div>
        <a href="logout.php" class="btn btn-danger me-5">Logout</a>
    </section>

    <div class="sidenav" id="sidenav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link d" href="Home.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link po" href="transaction.php">Transaction</a>
            </li>
            <li class="nav-item">
                <a class="nav-link ap" href="add_product.php">Add Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link vp" href="all_product.php">All Product</a>
            </li>

            <li class="nav-item">
                <a class="nav-link ao" href="all_orders.php">Order</a>
            </li>
        </ul>
    </div>
    <?php

?>
    <!--js link-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/3b83a3096d.js" crossorigin="anonymous"></script>

</body>

</html>