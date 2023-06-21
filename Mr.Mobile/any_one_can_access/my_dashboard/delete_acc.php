<?php
include_once "../include/connect.php";

function delete_user($userid, $con) {
    $_SESSION['user_id'] = $userid;
    $delete = "DELETE FROM `users` WHERE user_id='$userid'";
    $res = mysqli_query($con, $delete);

    $delete_cart="DELETE FROM `cart_details` WHERE user_id='$userid'";
    $del_cart=mysqli_query($con,$delete_cart);

    if ($res) {
        // User deletion successful
        session_destroy(); // Destroy the session
        echo "<script>window.open('index.php','_self')</script>";
         // Redirect to index.php
        exit; // Terminate script execution after redirection
    } else {
        // User deletion failed
        echo "User deletion failed.";
    }
}

if (!isset($_SESSION['user'])) {
    // User is not logged in, redirect to login page
    echo "<script>window.open('login.php','_self')</script>";
    exit; // Terminate script execution after redirection
}

if (isset($_POST['confirm'])) {
    $userid = $_SESSION['user_id']; // Provide the user ID here
    delete_user($userid, $con);
}
if(isset($_POST['cancel'])){
 echo "<script>window.open('user_home.php','_self')</script>";
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <style>
        .head {
            background-color: #563d7c;
        }
    </style>
</head>
<body>
    <h2 style="margin-top: 5%;">Click Confirm to Delete Account</h2>
    <form method="POST">
        <div>
            <button class="btn btn-success m-4 w-50" name="cancel">Cancel</button>
            <button class="btn btn-danger m-4 w-50" name="confirm">Confirm</button>
        </div>
    </form>
</body>
</html>
