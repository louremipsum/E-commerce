<?php
// Include the header
include 'header.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    switch ($action) {
        case 'delete':
            unset($_SESSION['cart'][$product_id]);
            break;
        case 'increment':
            $_SESSION['cart'][$product_id]['quantity']++;
            break;
        case 'decrement':
            if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
                $_SESSION['cart'][$product_id]['quantity']--;
            }
            break;
    }

    // Redirect to the same page to avoid form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<section class="h-100 gradient-custom">
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Cart - <?php echo count($_SESSION['cart']); ?> items</h5>
                    </div>
                    <div class="card-body">
                        <?php
                            // Check if the cart is empty
                            if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
                                    echo 'Your cart is empty.';
                            } else {
                                $totalPrice = 0;
                                   // Loop through the cart and display the items
                                    foreach ($_SESSION['cart'] as $product_id => $product) {
                                        $totalPrice += (float)$product['price'] * (int)$product['quantity'];
                                        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
                        echo '<div class="row">';
                            echo '<div class="col-lg-3 col-md-12 mb-4 mb-lg-0">';
                                echo '<div class="bg-image hover-overlay hover-zoom ripple rounded"
                                    data-mdb-ripple-color="light">';
                                    echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                        echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="w-100"
                            alt="Blue Jeans Jacket">';
                        echo '<a href="#!">';
                            echo '<div class="mask" style="background-color: rgba(251, 251, 251, 0.2)">
                            </div>';
                            echo '</a>';
                        echo '</div>';
                    echo '
                </div>';
                echo ' <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">';
                    echo '<p><strong>' . $product['name'] . '</strong></p>';
                    echo ' <button class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                        title="Remove item" type="submit" name="action" value="delete">';
                        echo '<i class="fas fa-trash"></i>';
                        echo '</button>';
                    echo '</div>';
                echo '<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">';
                    echo '<div class="d-flex mb-4" style="max-width: 300px">';
                        echo '<button class="btn btn-primary px-3 me-2" type="submit" name="action" value="decrement"' . ($product['quantity'] <= 1 ? ' disabled' : '') . '>';
                        echo '<i class="fas fa-minus"></i>';
                        echo '</button>';
                        echo '<div class="form-outline">';
                        echo '<input id="form1" min="0" name="quantity" value="' . $product['quantity'] . '" readonly type="number" class="form-control" />';
                        echo '</div>';
                        echo '<button class="btn btn-primary px-3 ms-2" type="submit" name="action" value="increment"' . ($product['quantity'] >= $product['max_quantity'] ? ' disabled' : '') . '>';
                        echo '<i class="fas fa-plus"></i>';
                        echo '</button>';
                        echo '</form>';
                        echo '</div>';
                    echo ' <p class="text-start text-md-center">';
                        echo '<strong>₹'. $product['price'] .'</strong>';
                        echo '</p>';
                    echo '</div>';
                echo '
            </div>';
            echo '
        </div>';
        echo '
    </div>';
    }


    ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                            Products
                                            <span>₹<?php echo $totalPrice; ?></span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            GST
                                            <span>₹<?php echo ($totalPrice*0.18); ?></span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total amount</strong>

                                            </div>
                                            <span><strong>₹<?php echo ($totalPrice*1.18); ?></strong></span>
                                        </li>
                                    </ul>

                                    <button type="button" class="btn btn-primary btn-lg btn-block">
                                        Go to checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
</section>