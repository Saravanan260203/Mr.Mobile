<?php
include_once "../include/connect.php";



$_SESSION['user_id'] = $userid;
if (isset($_POST['edit_user_details'])) {

    
    $userid=$_POST['userid'];
    $email=$_POST['edit_email'];
    $address=$_POST['edit_address'];
    $contact=$_POST['edit_contact'];


    $updateuser="UPDATE users SET user_email='$email',
  user_address='$address',user_contact='$contact' WHERE user_id='$userid' ";

  $update_user_result=mysqli_query($con,$updateuser);
     if ($update_user_result) {
        array_push($errors,"Updated Successfully!");
    } else {
        array_push($errors,"Updation Error!");

    }


}

if(isset($_POST['changepass'])){
    $newPassword=$_POST['newpass'];
            $hash=password_hash($newPassword,PASSWORD_DEFAULT);
            $sql="UPDATE users SET user_password='$hash' WHERE user_id='$userid' ";
            $res=mysqli_query($con,$sql);

            if($res){
                array_push($errors,'Password Changed Successfully!');
            }
            else{
                array_push($errors,'Password Changed Successfully!');
            }
        }
?>

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .head {
            background-color: #563d7c;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            flex-basis: 30%;
            margin-right: 10px;
            font-weight: bold;
        }
        .form-group input {
            flex-basis: 70%;
        }

    #changePasswordContainer {
        display: flex;
        align-items: center;
        padding-bottom: 8%;
    }

    #changePasswordBtn {
        margin-left: 6.5%;
        margin-bottom: 7%;
    }

    #passwordInputContainer {
        width: 500px;
        display: flex;
        align-items: center;
        margin-left: 50px;
    }

    #newpass {
        margin-right: 10px;
        margin-bottom: 12%;
        
    }

    #newPassword {
        flex: 1;
        margin-right: 20px;
        margin-bottom: 20px;
    }
    @media (max-width: 768px) {
    #newpass {
        margin-bottom: 20%;
    }
}
</style>

</head>

<body>
    <h2 class="p-3">Edit Account</h2>
    <?php
    if(count($errors)> 0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger' style='width:90%; margin-left:5%;'>$error</div>";
        }
    }
    
    $_SESSION['user_id'] = $userid;
    $select_order = "SELECT * FROM `users` WHERE user_id ='$userid'";
    $select = mysqli_query($con, $select_order);
    $result = mysqli_fetch_assoc($select);
    $rowdata = mysqli_num_rows($select);
    if ($rowdata > 0) {
        $username = $result['user_name'];
        $useremail = $result['user_email'];
        $userpassword = $result['user_password'];
        $useraddress = $result['user_address'];
        $usercontact = $result['user_contact'];
        $userreg_date = $result['reg_date'];
    ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb-4">
            <input type="hidden" value="<?php echo $_SESSION['user_id']?>" name="userid">
                <label for="formGroupExampleInput2">Registered Email:</label>
                <input type="text" class="form-control" name="edit_email" value="<?php echo $useremail ?>" placeholder="em@il" required>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Address:</label>
                <input type="text" class="form-control" name="edit_address" value="<?php echo $useraddress ?>" placeholder="Address" autocomplete="off" required>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Contact Number:</label>
                <input type="text" class="form-control" name="edit_contact" value="<?php echo $usercontact ?>" autocomplete="off" placeholder="Contact" required>
            </div>
            <div class="form-group mb-4">
                <label for="formGroupExampleInput2">Registered Date:</label>
                <input type="text" class="form-control" value="<?php echo $userreg_date ?>" placeholder="yyyy/mm/dd" readonly>
            </div>
           
             <a href="user_home.php" class="btn bg-danger mb-5">Cancel</a>
            <input type="submit" value="Edit Details" class="btn bg-info mb-5" name="edit_user_details">
        </form>

        <div id="changePasswordContainer">
    <button id="changePasswordBtn" class="btn btn-danger ml-5" onclick="showPasswordInput()">Change Password</button>
    <div id="passwordInputContainer" style="display: none;">
        <label id="newpass" for="newPassword">New Password:</label>
        <div class="input-group w-50">
            <form action="" method="post">
            <input type="text" class="form-control" id="newPassword" name="newpass" required></input>
            <input type="submit" class="btn btn-success" name="changepass" value="Save"></input>
            </form>
        </div>
    </div>
</div>

    <?php
    } else {
        echo "<div class='alert alert-danger text-center mt-5'>Something Went Wrong!</div>";
    }
    ?>





    <script>
        function showPasswordInput() {
            var passwordInputContainer = document.getElementById("passwordInputContainer");
            passwordInputContainer.style.display = "flex";
        }
    </script>

</body>

</html>
