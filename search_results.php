<?php
include'header.php';
include'lib/connection.php';
// Check if the form is submitted and the search field is not empty
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['search'])) {
    // Retrieve search query from the form input
    $search_query = $_POST['search'];

    // Perform a database query to search for items by product name
    // Replace "your_table_name" with your actual database table name
    $query = "SELECT * FROM product WHERE name LIKE '%$search_query%'";
    
    // Execute the query and fetch results
    $result = mysqli_query($conn, $query);

    // Check if there are any matching results
    if (mysqli_num_rows($result) > 0) {
        // Output the matching results
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
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
    </style>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card h-100">
                <img class="card-img-top" src="admin/product_img/<?php echo $row['imgname']; ?>" alt="Card image cap">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo $row["name"] ?></h5>
                    <p class="card-text"><?php echo $row["description"] ?></p>
                    <p class="card-text">Price: $<?php echo $row["Price"] ?></p>
                    <form method="post" action="add_to_cart.php">
                        <input type="hidden" name="product_image" value="admin/product_img/<?php echo $row['imgname']; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="product_price" value="Price: &#x20b9;<?php echo $row['Price']; ?>">
                        <input type="hidden" name="product_quantity" value="<?php echo $row['quantity']; ?>">
                        <input type="submit" class="btn btn-primary mt-auto" value="Add to Cart" name="add_to_cart">
                    </form>
                </div>
            </div>
        </div>
    </div>
            <?php 
        }
    } else {
        echo "No results found.";
    }
} else {
    // Display a message if the search field is empty
    echo "Please enter a search query.";
}

// Close database connection
mysqli_close($conn);
?>
