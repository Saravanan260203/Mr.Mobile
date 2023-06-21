<?php include "../include/connect.php";
include "controller.php";
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

@media screen and (max-width:1028px){
.cont1{
    margin-top: 12%;
    margin-bottom: 12%;
    width: 100%;
}}



    </style>
</head>
<body>
    <div class="container  text-center cont1 ">
    <div class="card text-center shadow-lg bg-white rounded ">
        <div class="row">
            <div class="col-lg-12 col-sm-12 p-0">
                
                <div class="card-header">
    <h1>Enter Recovery OTP</h1>
    <?php 
    if(count($errors)> 0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    ?>
  </div>
  <div class="card-body">
  <div class="small mb-3 text-muted"><?php echo $_SESSION['info'] ?></div>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" type="number" name="otp" placeholder="Enter OTP" required>
                <label for="inputEmail">Enter Recovery OTP</label>
            </div>
            <input type="submit" class="btn btn-primary w-50" value="submit" name="checkotp">
        </form>
    </div>
  </div>


            </div>

        </div>
 
</div>


    </div>


    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>