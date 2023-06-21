<?php
include_once "../include/connect.php";
include "../functions/common_functions.php";
require_once "controller.php";
if(!isset($_SESSION['user'])){ //on line controller 173
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
      .carousel-control-prev, .carousel-control-next{
    background-color:  #7952b3;
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

<!-- Modal -->
<div class="modal fade" id="completeModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body" >
         
      <?php
      $username=$_SESSION['username'];
      $select = mysqli_query($con, "SELECT * FROM `users` WHERE user_name = '$username'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
         $userid=$fetch['user_id'];
         $_SESSION['user_id']=$userid;
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <?php
         if($fetch['user_profilepic'] == ''){
            echo '<img src="../user_profile/default-avatar.png" style=" height: 180px;
            width: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;">';
         }else{
            echo '<img src="../user_profile/'.$fetch['user_profilepic'].'" style=" height: 180px;
            width: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;">';
         }
      ?>
  <div class="form-group my-4">
    <label for="exampleInputPassword1">Profile Pic</label>
    <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
   
  </div>
  <button type="submit" class="btn btn-dark" name="updateprofilepic">Update</button>
  <button type="button" class="btn btn-danger"data-dismiss="modal" >Close</button>
</form>
      </div>
    </div>
  </div>
</div>
          <!-- Nav Bar --><!-- Nav Bar --><!-- Nav Bar --><!-- Nav Bar -->
          
          <nav class="navbar navbar-expand-sm bg-dark">
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation" id="tog">
     <span class="navbar-toggler-icon"></span>
   </button>
   <table>
   <tbody>
      <tr>
         <td>
         <div class="profile">
      <?php
      require_once "controller.php";
      $username=$_SESSION['username'];
         $res = mysqli_query($con, "SELECT * FROM `users` WHERE user_name='$username'") or die('query failed');
         if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
         }
         if($fetch['user_profilepic'] == ''){
            echo "<div data-aos='flip-left' data-aos-duration='2000'>
            <img src='../user_profile/default-avatar.png' style= 'height: 50px;
            width: 50px;
            margin-left:10px;
            margin-right:10px;
            border-radius: 50%;
            object-fit: cover;'>
            </div>";
         }else{
            echo '<div data-aos="flip-left"  data-aos-duration="2000">
            <img src="../user_profile/'.$fetch['user_profilepic'].'" style=" height: 50px;
            width: 50px;
            margin-left:10px;
            margin-right:10px;
            border-radius: 50%;
            object-fit: cover;">
            </div>';
         }
      ?>
   </div>
         </td>
         <td>
         <h1 class="navbar-brand" id="brand">Welcome <?PHP echo $_SESSION['username']; ?></h1> 
         </td>
      </tr>
   </tbody>
</table>
   

   
   <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
   <ul class="navbar-nav ms-auto">
       <li class="nav-item">
       <button type="button" class="btn btn-dark" id="link" data-toggle="modal" data-target="#completeModal1">
       <i class="fa-solid fa-user"></i> Update Profile
            </button>
       </li>
       <li class="nav-item">
        <a class="nav-link" id="link" href="../logout/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
       </li>
       

   </ul> 
   </div>
   </nav>


<!--Simply-->
<div class="text-center p-2">
    <h1>MY Dashboard</h1>
</div>
<!--Product details-->

<div class="container">
    <div class="row text-center">
        <div class="col-md-2 brands p-0">
        <ul class="navbar-nav me-auto text-center">
        <li class="nav-item brand-head">
          <!--brands list!-->
          <a class="nav-link text-light" href=""><h4>Actions</h4></a>
        </li>
        <li class='nav-item'>
       <a class='nav-link navlink' href='index.php'><i class="fa-solid fa-house-user"></i> Go Home</a>
     </li>
        <li class='nav-item'>
       <a class='nav-link navlink' href='user_home.php?myorders'><i class="fa-solid fa-bag-shopping"></i> My Orders</a>
     </li>
     <li class='nav-item'>
       <a class='nav-link navlink' href='user_home.php?personal_info'><i class="fa-solid fa-user-pen"></i> Edit Account</a>
     </li>
     <li class='nav-item'>
       <a class='nav-link navlink' href='user_home.php?delete_acc'><i class="fa-solid fa-user-slash"></i> Delete Account</a>
     </li>
     <li class='nav-item'>
       <a class='nav-link navlink' href='../logout/logout.php'><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
     </li>
        </ul>

        </div>
        <div class="col-md-9">
            <div class="row">
               <?php

               if(count($errors)> 0){
                  foreach($errors as $error){
                     echo "<div class='alert alert-danger' style='width:90%; margin-left:5%;'>$error</div>";
                  }
               }  

               if(isset($_GET['myorders'])){
                  include("./my_dashboard/myorders.php");
               }
               if(isset($_GET['personal_info'])){
                  include("./my_dashboard/edit_acc.php");
               }
               if(isset($_GET['delete_acc'])){
                  include("./my_dashboard/delete_acc.php");
               }
               if (isset($_GET['message'])) {
                  $errors = $_GET['message'];
                  // Display the message in a popup or any desired format
                  echo "<div class='alert alert-danger text-center'>$errors</div>";
              }

               ?>
                
            </div>
        </div>


    </div>

</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
   <!--bootstrap javascript-->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>


 <!--AOS js-->
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
      </script>
</body>
</html>

