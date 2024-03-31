<?php
// Include the header
include 'header.php';
$totalPrice = 0;
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
// Calculate the total price and store it in the session
foreach ($_SESSION['cart'] as $product_id => $product) {
    $totalPrice += (float)$product['price'] * (int)$product['quantity'];
}
$_SESSION['totalPrice'] =($totalPrice*1.18);
?>

<section class="h-100 gradient-custom">
    <div class="container py-5">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Cart - <?= count($_SESSION['cart']); ?> items</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $totalPrice = 0;
                        // Check if the cart is empty
                        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) : ?>
                        Your cart is empty.
                        <?php else: 
                            $totalPrice = 0;
                            // Loop through the cart and display the items
                            foreach ($_SESSION['cart'] as $product_id => $product) :
                                $totalPrice += (float)$product['price'] * (int)$product['quantity']; ?>
                        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                        data-mdb-ripple-color="light">
                                        <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                                        <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>"
                                            class="w-100" alt="Blue Jeans Jacket">
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <p><strong><?= $product['name']; ?></strong></p>
                                    <button class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                        title="Remove item" type="submit" name="action" value="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <div class="d-flex mb-4" style="max-width: 300px">
                                        <button class="btn btn-primary px-3 me-2" type="submit" name="action"
                                            value="decrement" <?= ($product['quantity'] <= 1 ? ' disabled' : ''); ?>>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <div class="form-outline">
                                            <input id="form1" min="0" name="quantity"
                                                value="<?= $product['quantity']; ?>" readonly type="number"
                                                class="form-control" />
                                        </div>
                                        <button class="btn btn-primary px-3 ms-2" type="submit" name="action"
                                            value="increment"
                                            <?= ($product['quantity'] >= $product['max_quantity'] ? ' disabled' : ''); ?>>
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <p class="text-start text-md-center">
                                        <strong>₹<?= $product['price']; ?></strong>
                                    </p>
                                </div>
                            </div>
                        </form>
                        <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
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
                                <span>₹<?= $totalPrice; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                GST
                                <span>₹<?= ($totalPrice*0.18); ?></span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                </div>
                                <span><strong>₹<?= ($totalPrice*1.18); ?></strong></span>
                            </li>
                        </ul>
                        <a href="/E-commerce/checkout.php">
                            <button type="button" class="btn btn-primary btn-lg btn-block"
                                <?= (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) ? 'disabled' : ''; ?>>
                                Go to checkout
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>