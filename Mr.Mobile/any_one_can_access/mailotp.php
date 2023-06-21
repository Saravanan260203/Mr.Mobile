<?php require_once "controller.php";
if(!isset($_SESSION['registered'])){ //on controller line 57
    header("Location: register.php");
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
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
</style>
</head>
<body>
<div class="container text-center cont1 w-50">
    <div class="card shadow-lg bg-white rounded">
                <div class="card-header">
    <h1>Email-OTP Verification</h1>
    <?php 
    if(count($errors)> 0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    ?>
    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>          
                    <?php } ?>
  </div>
  <div class="card-body">
  <form action="" method="post">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control" name="email_otp" type="text" placeholder="Enter your first name" />
                            <label>Enter OTP</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                <div class="d-grid"><input type="submit" value="Submit" class="btn btn-primary btn-block" name="check_otp">
                </div>
                </div>
            </form>
  </div>

            </div>

        </div>
 
</div>

    </div>

       
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>