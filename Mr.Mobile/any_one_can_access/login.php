<?php include "controller.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!--Bootstrap Css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--css-->
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-color: #7952b3;
        }
        .cont1{
    margin-top: 8%;
    width: 50%;
}
.img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.checkbox-label{
    margin-left: 5px;
}
.small{
    margin-left: 60%;
}
@media screen and (max-width:1028px){
.cont1{
    margin-top: 12%;
    margin-bottom: 12%;
    width: 100%;
}}
@media (max-width: 768px) {
    .small{
    margin-left: 45%;
}


}
    
    </style>
</head>
<body>
    <div class="container  text-center cont1 ">
    <div class="card text-center shadow-lg bg-white rounded ">
        <div class="row">
            <div class="col-lg-12 col-sm-12 p-0">
                
                <div class="card-header">
    <h1>Login Account</h1>
    <?php 
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
        // Clear the session variable after displaying the message
        unset($_SESSION['success_message']);
    }
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
                            <a class="small" href="forgetpass.php">Forgot Password?</a>
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
</body>
</html>