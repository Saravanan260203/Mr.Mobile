<?Php include_once "../include/connect.php";
include_once "controller.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr.Mobile</title>
    <!--AOS Css-->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
     <!--Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="style.css">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/9e6d3f1177.js" crossorigin="anonymous"></script>
</head>
<body>

    <!--navbar-->
<div class="container-fluid p-0">
<nav class="navbar navbar-expand-lg navbar-light ">
  <div class="container-fluid">
    <img src="../images/Mr.Mobile.png" alt="logo" id="logo">
    <a class="navbar-brand navlink" href="index.php">Mr.Mobile</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link navlink" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link navlink" href="index.php?get_all_products">Products</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--second nav-->
<nav class="navbar navbar-expand-lg bg-secondary p-0">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        if(!isset($_SESSION['username'])){
          
            echo "<li class='nav-item'>
            <a class='nav-link navlink' href=''>Welcome Guest</a>
          </li>";
        }else{
          
            echo "<li class='nav-item'>
            <a class='nav-link navlink' href=''>Welcome ".$_SESSION['username']."</a>
          </li>";
  
        }
        if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link navlink' href='login.php'>Login</a>
          </li>";
        }else{
            echo "<li class='nav-item'>
            <a class='nav-link navlink' href='../logout/logout.php'>Logout</a>
          </li>";

        }
        ?>
    </div>
</nav>
</div>


<!--Display payment if user logged in ,else go to login -->

<div class="container-fluid pt-5">
    <?php //if user not loggedin
    if(!isset($_SESSION['username'])){?>
    

<div class="container  text-center cont1 p-0">
    <div class="card text-center shadow-lg bg-white rounded ">
        <div class="row">
            <div class="col-lg-12 col-sm-12 p-0">
                
                <div class="card-header">
    <h1>Login to Checkout</h1>
    <?php 
    if(count($errors)> 0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    ?>
  </div>
  <div class="card-body">
  <form action="" method="post">
                <div class="form-floating mb-3">
                    <input class="form-control" name="loginemail" type="email" placeholder="name@example.com" />
                    <label for="inputEmail">Email address</label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" name="loginpassword" id="pwd" type="password" placeholder="Create a password" />
                            <label for="id_password">Password</label>
                        </div>
                    </div>
                </div>
                <div class="container d-flex">
                <input type="checkbox" onclick="showpass()" class="d-flex">
                            <label for="showPassword" class="checkbox-label">Show Password</label>
                </div>
               
                <div class="mt-4 mb-0">
                <div class="d-grid"><input type="submit" value="Login" class="btn btn-primary btn-block" name="login">
                </div>
                </div>
            </form>
  </div>
  <div class="card-footer text-muted">
    <a href="register.php">Doesn't have an Account?Go to Register</a>
  </div>

            </div>

        </div>
 
</div>

    </div>
    <?php
}

    else{
        include('payment.php');
    }
    ?>
</div>




<script>
        function showpass(){
            var x=document.getElementById('pwd');
      
            if(x.type =='password' ){
                x.type='text';
            }
            else{
                x.type='password';
                
            }
        }
    </script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <!--AOS js-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
</body>
</html>