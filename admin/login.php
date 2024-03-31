<?php 

SESSION_START();

if(isset($_SESSION['auth']))
{
    if($_SESSION['auth']==1)
    {
        header("location:home.php");
    }
}

$loginFailed = false;

include "lib/connection.php";
    if (isset($_POST['submit'])) 
    {
        $email = $_POST['email'];
        $pass = ($_POST['password']);

        $loginquery="SELECT * FROM admin WHERE userid='$email' AND pass='$pass'";
        $loginres = $conn->query($loginquery);

        if ($loginres->num_rows > 0) 
        {

            while ($result=$loginres->fetch_assoc()) 
            {
                $username=$result['userid'];
            }

            $_SESSION['username']=$username;
            $_SESSION['auth']=1;
            header("location:home.php");
        }
        else
        {
            $loginFailed = true;
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary" style="min-height: 100vh; background: #f8f9fa;">
    <div class="container">
        <main class="form-signin w-50 m-auto">
            <h3 class="text-center mb-4">Sign In</h3>
            <?php if ($loginFailed): ?>
            <div class="alert alert-danger" role="alert">
                Access Denied
            </div>
            <?php endif; ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <div class="form-floating mt-4">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="email">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mt-2">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                        name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-group mt-5">
                    <input type="submit" value="Login" class="btn btn-primary w-100 py-2" name="submit">
                </div>
            </form>
            <a class="text-primary text-center d-block mt-3" href="/E-commerce/index.php">Return to Home</a>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>

</body>

</html>