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
}
.img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.checkbox-label{
    margin-left: 5px;
}
@media screen and (max-width:1028px){
.cont1{
    margin-top: 12%;
    margin-bottom: 12%;
}


}
    
    </style>
</head>
<body>
    <div class="container  text-center cont1">
    <div class="card text-center shadow-lg bg-white rounded ">
        <div class="row">
            <div class="col-lg-6 col-sm-12 ">
            <img src="../images/deleivery.jpg" alt="" class="img">
            </div>
            <div class="col-lg-6 col-sm-12 p-0">
                
                <div class="card-header">
    <h1>Create Account</h1>
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
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" name="inputusername" type="text" placeholder="Enter your first name" />
                            <label for="inputUsername">Username</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="inputemail" type="email" placeholder="name@example.com" />
                    <label for="inputEmail">Email address</label>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" name="pwd" id="pwd" type="password" placeholder="Create a password" />
                            <label for="id_password">Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-0 mb-md-0 p-0">
                            <input class="form-control" name="cpwd" id="cpwd" type="password" placeholder="Confirm password" />
                            <label for="inputPasswordConfirm">Confirm Password</label>
                        </div>
                    </div>
                </div>
                <div class="container d-flex">
                <input type="checkbox" onclick="showpass()" class="d-flex">
                            <label for="showPassword" class="checkbox-label">Show Password</label>
                </div>
               
                <div class="mt-4 mb-0">
                <div class="d-grid"><input type="submit" value="Create Account" class="btn btn-primary btn-block" name="signup">
                </div>
                </div>
            </form>
  </div>
  <div class="card-footer text-muted">
    <a href="login.php">Have an Account?Go to Login</a>
  </div>

            </div>

        </div>
 
</div>

    </div>

    <script>
        function showpass(){
            var x=document.getElementById('pwd');
            var y=document.getElementById('cpwd');
            if(x.type =='password' && y.type =='password' ){
                x.type='text';
                y.type='text';
            }
            else{
                x.type='password';
                y.type='password';
            }
        }
    </script>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>