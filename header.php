<!DOCTYPE html>
<html>

<head>
    <title>Fashion</title>
    <meta charset="UTF-8">
    <meta name="description" content="test">
    <meta name="keywords" content="HTML, CSS, BOOTSTRAP">
    <meta name="author" content="Anik">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!--font-family: 'Raleway', sans-serif;-->
    <link rel="favicon" type="text/css" href="#favicon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    </div>
    <!--header end--->
    <?php 
  SESSION_START();
  include "lib/connection.php";
?>
    <!--nav start--->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5 ">
        <div class="container">

            <div class="navbar-collapse p-1" id="navbarSupportedContent">
                <div class="d-flex align-items-center">
                    <!-- Home link -->
                    <a class="navbar-brand mr-3" href="/E-commerce/index.php">Home</a>

                    <!-- Search form -->
                    <form class="form-inline mr-auto" action="search_results.php" method="get">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                            name="search"
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button class="btn btn-outline-dark" type="submit"><img src="img/search.png"></button>
                    </form>
                </div>


                <a href="cart.php" class="btn btn-primary ml-auto">View Cart</a>
                <a href="/E-commerce/admin/login.php" class="btn btn-primary ml-auto">Admin</a>
            </div>
        </div>
    </nav>


    <!--nav end--->