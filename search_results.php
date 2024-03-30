<?php
include 'header.php';
include 'lib/connection.php';

// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve product details from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $product_max_quantity = $_POST['product_max_quantity'];
    // Initialize or retrieve the cart from session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if product already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Update the quantity
        $_SESSION['cart'][$product_id]['quantity'] += $product_quantity;
    } else {
        // Add the product to the cart
        $_SESSION['cart'][$product_id] = array(
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $product_quantity,
            'image' => $product_image,
            'max_quantity' => $product_max_quantity 
        );
    }

    // Provide some feedback to the user (optional)
    
}

// Check if the form is submitted and the search field is not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['search'])) {
    // Retrieve search query from the form input
    $search_query = $_POST['search'];

    // Perform a database query to search for items by product name
    $query = "SELECT * FROM product WHERE name LIKE '%$search_query%'";

    // Execute the query
    $result = mysqli_query($conn, $query);

        }
    else {
       
        header('Location: index.php');
        echo "<script>alert('Product added to cart!');</script>";
        exit();
    }



// Close database connection
mysqli_close($conn);
?>
<section>
<style>
    .card {
        height: 500px;
        margin: 1rem;
        width: 100%;
    }

    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    </style>
<div class="container">
        <div class="row">
            <?php
        if (mysqli_num_rows($result) > 0) {
            // Output the matching results
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-4 col-sm-6 col-12">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="card h-100">
                        <img class="card-img-top" src="admin/product_img/<?php echo $row['imgname']; ?>"
                            alt="Card image cap">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo $row["name"] ?></h5>
                            <p class="card-text"><?php echo $row["description"] ?></p>
                            <p class="card-text">Price: ₹<?php echo $row["Price"] ?></p>
                            <input type="hidden" name="product_image"
                                value="admin/product_img/<?php echo $row['imgname']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                            <input type="hidden" name="product_max_quantity" value="<?php echo $row['quantity']; ?>">

                            <?php if (isset($_SESSION['cart'][$row['id']])): ?>
                            <div class="d-flex mb-4" style="max-width: 300px"
                                id="quantity_component_<?php echo $row['id']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-primary px-3 me-2"
                                    name="decrement_quantity">-</button>
                                <input type="text" name="product_quantity"
                                    value="<?php echo isset($_SESSION['cart'][$row['id']]) ? $_SESSION['cart'][$row['id']]['quantity'] : ''; ?>">
                                <button type="submit" class="btn btn-primary px-3 me-2"
                                    name="increment_quantity">+</button>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="product_quantity" value="1">
                            <input type="submit" class="btn btn-primary mt-auto" value="Add to Cart"
                                id="add_to_cart_<?php echo $row['id']; ?>" name="add_to_cart">
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
            <?php 
          }
        } else {
          echo "No products found.";
        }
        ?>
        </div>
    </div>
</section>
