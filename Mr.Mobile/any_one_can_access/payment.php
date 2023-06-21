<?Php include_once "../include/connect.php";
 include "controller.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
         .upi{
    height: 100%;
    width: 100%;
    transition: 0.3s;

 }
 .upi:hover{
    transform: scale(1.10);
    border-radius: 10%;
 }


    </style>
   
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
    <?php
    //to access user id
    $user_ip=getIPAddress();
    $get_user="SELECT * FROM `users` WHERE user_ipaddress ='$user_ip'";
    $result=mysqli_query($con,$get_user);
    $run_query=mysqli_fetch_assoc($result);
   // $user_id=$run_query['user_id'];
    //$_SESSION['user_id']=$user_id;
    ?>


    <div class="container">
        <h1 class="text-center text-info">Payment Options</h1>
        <div class="row text-center align-items-center p-5">
            <div class="col-md-6 p-3">
                    <a href="order.php?user_id_num=<?php echo $_SESSION['user_id'] //on controller line173?>">
                        <img class="upi" src="../images/upi.jpg" alt="Upi">
                    </a>
            </div>
            <div class="col-md-6 p-3">
            <a href="order.php?user_id=<?php echo $_SESSION['user_id'] //on controller line173?>" class="btn btn-primary">Cash on Delivery</a>
            </div>
        </div>
    </div>
















<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
 <!--AOS js-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
</body>
</html>