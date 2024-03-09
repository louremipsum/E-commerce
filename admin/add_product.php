<?php

SESSION_START();

if(isset($_SESSION['auth']))
{
   if($_SESSION['auth']!=1)
   {
       header("location:login.php");
   }
}
else
{
   header("location:login.php");
}
 include'header.php';
 include'lib/connection.php';
 $result=null;
 if (isset($_POST['submit'])) 
 {   
     $invoiceNum=$_POST['invoiceNum'];
     $vendorName=$_POST['vendorName'];
     $dateOfPurchase=$_POST['date_of_purchase'];
     $names=$_POST['name'];
     $descriptions=$_POST['description'];
     $quantities=$_POST['quantity'];
     $prices=$_POST['price'];
     $filenames = $_FILES["uploadfile"]["name"];
 
     $values = [];
 
     foreach($names as $key => $name) {
         $description = $descriptions[$key];
         $quantity = $quantities[$key];
         $price = $prices[$key];
         $filename = $filenames[$key];
 
         $values[] = "('$invoiceNum', '$vendorName', '$dateOfPurchase', '$name', '$description', $quantity, $price, '$filename')";
 
         $tempname = $_FILES["uploadfile"]["tmp_name"][$key];   
         $folder = "product_img/".$filename;
         move_uploaded_file($tempname, $folder);
     }
 
     $values = implode(", ", $values);
     $insertSql = "INSERT INTO product(invoiceNum, vendorName, date_of_purchase, name, description, quantity, price, imgname) VALUES $values";
 
     if ($conn -> query ($insertSql)) 
     {
         $result="<h2>*******Data insert success*******</h2>";
     }
     else
     {
      die($conn -> error);
     }
 } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    function addProduct() {
        var container = document.getElementById('productContainer');
        var productCard = document.createElement('div');
        productCard.className = 'productCard';
        productCard.innerHTML = `
                <div class="card p-3 mt-3">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Product Name</label>
                        <input type="text" name="name[]" class="form-control" id="exampleInputName" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputDescription" class="form-label">Description</label>
                        <input type="text" name="description[]" class="form-control" id="exampleInputDescription" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputQuantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity[]" class="form-control" id="exampleInputQuantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPrice" class="form-label">Price</label>
                        <input type="Number" name="price[]" class="form-control" id="exampleInputPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="uploadfile" class="form-label">Image</label>
                        <input type="file" name="uploadfile[]" required />
                    </div>
                    <button type="button" onclick="removeProduct(this)" class="btn btn-danger">Remove Product</button>
                </div>
            `;
        container.appendChild(productCard);
    }

    function removeProduct(button) {
        var productCard = button.parentNode;
        productCard.remove();
    }
    </script>
</head>

<body>
    <div class="container">
        <?php echo $result;?>
        <h4 class="mt-5">Add Product</h4>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputInvoiceNum" class="form-label">Invoice Number</label>
                <input type="text" name="invoiceNum" class="form-control" id="exampleInputInvoiceNum" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputVendorName" class="form-label">Vendor Name</label>
                <input type="text" name="vendorName" class="form-control" id="exampleInputVendorName" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputDateOfPurchase" class="form-label">Date of Purchase</label>
                <input type="date" name="date_of_purchase" class="form-control" id="exampleInputDateOfPurchase"
                    required>
            </div>
            <div id="productContainer">
                <div class="card p-3">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Product Name</label>
                        <input type="text" name="name[]" class="form-control" id="exampleInputName" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputDescription" class="form-label">Description</label>
                        <input type="text" name="description[]" class="form-control" id="exampleInputDescription">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputQuantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity[]" class="form-control" id="exampleInputQuantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPrice" class="form-label">Price</label>
                        <input type="Number" name="price[]" class="form-control" id="exampleInputPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="uploadfile" class="form-label">Image</label>
                        <input type="file" name="uploadfile[]" required />
                    </div>
                </div>
            </div>
            <button type="button" onclick="addProduct()" class="btn btn-secondary mt-5">Add Product</button>
            <button type="submit" name="submit" class="btn btn-primary mt-5">Submit</button>
        </form>
    </div>
</body>

</html>