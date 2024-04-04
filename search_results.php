<?php
include'header.php';
include'lib/connection.php';
// Check if the form is submitted and the search field is not empty
 // Start the session if it's not already started
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // Initialize the cart if it's not already initialized
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_image = $_POST['product_image'];
    $product_max_quantity = $_POST['product_max_quantity'];

    // Add the product to the cart
    $_SESSION['cart'][$product_id] = array(
      'name' => $product_name,
      'price' => $product_price,
      'quantity' => $product_quantity,
      'image' => $product_image,
      'max_quantity' => $product_max_quantity // Get the max quantity from the form
    );
}
  
if (isset($_POST['increment_quantity'])) {
    $product_id = $_POST['product_id'];

    // Increment the quantity if it's less than the max quantity
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity'] < $_SESSION['cart'][$product_id]['max_quantity']) {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    }
}

if (isset($_POST['decrement_quantity'])) {
    $product_id = $_POST['product_id'];

    // Decrement the quantity if it's greater than 1
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity'] >= 1) {
        $_SESSION['cart'][$product_id]['quantity'] -= 1;
    }
    if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity'] == 0) {
        unset($_SESSION['cart'][$product_id]);
    }
}
?>

<!-- <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="search" placeholder="Search for products...">
    <input type="submit" value="Search">
</form> -->

<style>
.card {
    height: 500px;
    margin: 1rem;
    width: 300px;
}

.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.row {
    margin: 0;
}

.col-md-4,
.col-sm-6,
.col-12 {
    padding: 0 15px;
}
</style>
<?php
if (!empty($_REQUEST['search'])) {  
      $search_query = $_GET['search'];
    $query = "SELECT * FROM product WHERE name LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="row">'; 
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
<div class="col-md-4 col-sm-6 col-12">
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">
        <input type="hidden" name="search" value="<?php echo htmlspecialchars($search_query); ?>">
        <div class="card h-100">
            <img class="card-img-top" src="admin/product_img/<?php echo $row['imgname']; ?>" alt="Card image cap">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo $row["name"] ?></h5>
                <p class="card-text"><?php echo $row["description"] ?></p>
                <p class="card-text">Price: ₹<?php echo $row["Price"] ?></p>
                <input type="hidden" name="product_image" value="admin/product_img/<?php echo $row['imgname']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                <input type="hidden" name="product_max_quantity" value="<?php echo $row['quantity']; ?>">

                <?php if ($row['quantity'] > 0): ?>
                <?php if (isset($_SESSION['cart'][$row['id']])): ?>
                <div class="d-flex mb-4" style="max-width: 300px" id="quantity_component_<?php echo $row['id']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-primary px-3 me-2" name="decrement_quantity">-</button>
                    <input type="text" name="product_quantity" readonly
                        value="<?php echo isset($_SESSION['cart'][$row['id']]) ? $_SESSION['cart'][$row['id']]['quantity'] : ''; ?>">
                    <button type="submit" class="btn btn-primary px-3 me-2" name="increment_quantity"
                        <?php echo ($_SESSION['cart'][$row['id']]['quantity'] >= $row['quantity']) ? 'disabled' : ''; ?>>+</button>
                </div>
                <?php else: ?>
                <input type="hidden" name="product_quantity" value="1">
                <input type="submit" class="btn btn-primary mt-auto" value="Add to Cart"
                    id="add_to_cart_<?php echo $row['id']; ?>" name="add_to_cart">
                <?php endif; ?>
                <?php else: ?>
                <button type="button" class="btn btn-primary mt-auto" disabled>Out of Stock</button>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>
<?php
        }
        echo '</div>';
    } else {
        echo "No results found.";
    }
} else {
    echo "Please enter a search query.";
}

mysqli_close($conn);
?>