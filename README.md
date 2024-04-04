# E-commerce Website

This is a simple e-commerce website built with PHP. It allows users to browse products, add them to a shopping cart, and make purchases. The website also includes an admin panel for managing products and orders.

## Features

- Product browsing
- Shopping cart
- Order placement
- Admin panel for managing products and orders

## File Structure

- `header.php`: Contains the header section of the website, including the navigation bar.
- `index.php`: The homepage of the website, displaying all available products.
- `admin/header.php`: Contains the header section of the admin panel, including the navigation bar.
- `admin/confirm_transaction.php`: Allows the admin to confirm transactions by entering the proof of payment.
- `admin/transaction.php`: Displays all transaction orders placed on the website.
- `admin/add_product.php`: Add multiple products according to the vendor.
- `admin/all_product.php`: Displays all products in the DB with row highlighting for those products whose quantity is 0.

## Setup

1. Clone the repository.
2. Set up a local server environment (like XAMPP or MAMP).
3. Import the database file into your MySQL server.
4. Update the `lib/connection.php` file with your MySQL server credentials.

```php
<?php 

$host = "localhost";
$user = "<your username>";
$pass = "<your password>";
$db   ="<DB name in MySQL>";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn -> connect_error) 
{
   die($conn -> error);
}
else
{
   //echo "database connected";
}

?>
```

Open the project in your browser.

## Usage

- As a user, you can browse products, add them to your cart, and place an order.
- As an admin, you can add new products, view all products, confirm transactions, and view all orders.

## Dependencies

- PHP
- MySQL
- Bootstrap
