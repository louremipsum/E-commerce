<?php
// Include the header
include 'header.php';
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
                                        $totalPrice += $product['price'] * $product['quantity'];
                                            echo '<div class="row">';
                                            echo '<div class="col-lg-3 col-md-12 mb-4 mb-lg-0">';
                                            echo '<div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">';
                                            echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="w-100" alt="Blue Jeans Jacket">';
                                            echo '<a href="#!">';
                                            echo '<div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>';
                                            echo '</a>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo ' <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">';
                                            echo '<p><strong>' . $product['name'] . '</strong></p>';
                                            echo ' <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">';
                                            echo '<i class="fas fa-trash"></i>';
                                            echo '</button>';
                                            echo '</div>';
                                            echo '<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">';
                                            echo '<div class="d-flex mb-4" style="max-width: 300px">';
                                            echo '<button class="btn btn-primary px-3 me-2" onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown()">';
                                            echo '<i class="fas fa-minus"></i>';
                                            echo '</button>';
                                            echo '<div class="form-outline">';
                                            echo '<input id="form1" min="0" name="quantity" value="'. $product['quantity'] .'" type="number" class="form-control" />';
                                            echo '</div>';
                                            echo '<button class="btn btn-primary px-3 ms-2" onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp()">';
                                            echo '<i class="fas fa-plus"></i>';
                                            echo '</button>';
                                            echo ' </button>';
                                            echo ' </div>';
                                            echo '  <p class="text-start text-md-center">';
                                            echo '<strong>₹'. $product['price'] .'</strong>';
                                            echo '  </p>';
                                            echo ' </div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo ' </div>';
                                            echo '';
                                    }
                            }
                            
                            ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h5 class="mb-0">Summary</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                            Products
                                            <span>$<?php echo $totalPrice; ?></span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Shipping
                                            <span>Gratis</span>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total amount</strong>
                                                <strong>
                                                    <p class="mb-0">(including VAT)</p>
                                                </strong>
                                            </div>
                                            <span><strong>$53.98</strong></span>
                                        </li>
                                    </ul>

                                    <button type="button" class="btn btn-primary btn-lg btn-block">
                                        Go to checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</section>