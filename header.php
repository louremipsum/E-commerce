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

    <!--header start--->
    <!-- <header>          WORKING IN PROG
        <div class="container h-50">
            <div class="header-top ">

               <div class="row h-50">
                    <div class="col-md-12 text-center">
                        <a href=""><img src="img\logo.png"></a>
                    </div>
                </div> 

            </div>
        </div>
    </header> 
    <div class="line"> -->


    </div>
    <!--header end--->
    <?php 
  SESSION_START();
  include "lib/connection.php";
//   $id=$_SESSION['userid'];
//  $sql = "SELECT * FROM cart where userid='$id'";
//  $result = $conn -> query ($sql);
?>
    <!--nav start--->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-5 ">
    <div class="container">
        <!-- FOR RESPONSIVE -->
        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="navbar-collapse p-1" id="navbarSupportedContent">
            <div class="d-flex align-items-center">
                <!-- Home link -->
                <a class="navbar-brand mr-3" href="/E-commerce/index.php">Home</a>

                <!-- Search form -->
                <form class="form-inline mr-auto" action="search_results.php" method="post">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <!-- Add name attribute to the search input field -->
                    <button class="btn btn-outline-dark" type="submit"><img src="img/search.png"></button>
                </form>
            </div>

            <!-- View Cart button -->
            <a href="cart.php" class="btn btn-primary ml-auto">View Cart</a>
        </div>
    </div>
</nav>


    <!--nav end--->