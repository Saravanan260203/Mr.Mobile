<?php include "../include/connect.php";

session_start();
$errors=array();
    //get ip address function

    if (!function_exists('getIPAddress')) {
        function getIPAddress() {
            //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
    }  
//whether ip is from the proxy  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
 }  
//whether ip is from the remote address  
else{  
         $ip = $_SERVER['REMOTE_ADDR'];  
 }  
 return $ip; 
        }
    }
      $user_ip = getIPAddress(); 


//for signup page
 if(isset($_POST['signup'])){

    $username = mysqli_real_escape_string($con, $_POST['inputusername']);
    $useremail = mysqli_real_escape_string($con, $_POST['inputemail']);
    $userpassword = mysqli_real_escape_string($con, $_POST['pwd']);
    $cnfrmpassword = mysqli_real_escape_string($con, $_POST['cpwd']);

    

     
    $_SESSION['pass']=$userpassword;

    $hash= password_hash($userpassword, PASSWORD_DEFAULT);
    

    if(!filter_var($useremail,FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Invalid email!");
    }
    if(strlen($userpassword) < 8 ){
        array_push($errors,"Password must be atleast 8 characters Long!");
    }
    if($userpassword !== $cnfrmpassword){
        array_push($errors,"Password Doesn't match!");
    }
    $emailcheck = "SELECT * FROM users WHERE user_email = '$useremail'";
    $res = mysqli_query($con, $emailcheck);
    $rowcount=mysqli_num_rows($res);
    if($rowcount > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    
if(count($errors) === 0){



  

   
    
    $otp=rand(999999,111111);
    $status="not verified";
    $sql="INSERT INTO `users`(`user_name`, `user_email`, `user_password`,`user_ipaddress`,`otp`, `status`)
VALUES ('$username','$useremail','$hash','$user_ip','$otp','$status')";
$result=mysqli_query($con, $sql);
if(($result)){
echo "<div class='alert alert-success'>You are Registered Successfully!</div>";

////////////////////////////////////////////PHP-MAILER///////////////////////////////////////////////////////////////////

require '../PHPMailer/PHPMailerAutoload.php';


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '9919020025@klu.ac.in';                 // SMTP username
$mail->Password = 'Saran100';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('9919020025@klu.ac.in', 'Mr.Mobile');
$mail->addAddress($useremail);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Email verification code';
$mail->Body    = 'Your OTP is: '.$otp;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $info="We have Send an OTP-$useremail";
    $_SESSION['info'] = $info;
    $_SESSION['registered']='yes';
    header('location: mailotp.php');
    exit();
}


/////////////////////////////////////////////////PHP-MAILER//////////////////////////////////////////////////////////////////

}else{
    echo "<div class='alert alert-danger'>'Failed while sending code!'</div>";

}}

  }





//if user click email otp verification code submit button
if(isset($_POST['check_otp'])){
   
    $userotp = mysqli_real_escape_string($con, $_POST['email_otp']);
    $checkotp = "SELECT * FROM users WHERE otp = $userotp";
    $otpresult = mysqli_query($con, $checkotp);
    if(mysqli_num_rows($otpresult) > 0){ //mysqli_num_rows($otpresult) return 1 if the otp entered by user and otp inside the database
        $fetch_data = mysqli_fetch_assoc($otpresult);
        $fetch_otp = $fetch_data['otp'];//$fetch_code returns the data stored in otp of database
        $fetch_name=$fetch_data['user_name'];
        $_SESSION['useremail']=$fetch_data['user_email'];
        $useremail = $fetch_data['user_email'];//$useremail returns the data stored in user_email of database
        $otp = 0;
        $status = "verified";
        $updatedb = "UPDATE users SET otp = $otp, status = '$status' WHERE otp = $fetch_otp";
        $update = mysqli_query($con, $updatedb);
        if($update){
            
            $_SESSION['name']=$fetch_name;
            //selecting cart items
            $select_cart_item="SELECT * FROM `cart_details` WHERE ip_address ='$user_ip'";
            $result_cart=mysqli_query($con,$select_cart_item);
            $row_count=mysqli_num_rows($result_cart);
            if($row_count>0){
                $_SESSION['username']=$name;
                echo "<script>alert('You have items in your Cart!')</script>";
                echo "<script>window.open('checkout.php','_self')</script>";
            }
            else{
                echo "<script>window.open('index.php','_self')</script>";
            }


           // header('location: user_home.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code!";
        }
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}


//if loginbutton clicked


if(isset($_POST['login'])){

    if($_POST['loginemail']=== "admin@gmail.com"  && $_POST['loginpassword']=== "admin@123")
    {
        
        $_SESSION['admin']='yes';//by using this we cant access till the user put the email and password correct,eventhough by changing url
        header('location: ../admin_area/admin_index.php');

    }
    else{
        $useremail=mysqli_real_escape_string($con,$_POST['loginemail']);
    $userpassword=mysqli_real_escape_string($con,$_POST['loginpassword']);
    $emailcheck="SELECT * FROM users WHERE user_email = '$useremail' ";
    $res=mysqli_query($con,$emailcheck);

    
    if(mysqli_num_rows($res)>0){
       $fetch_data=mysqli_fetch_assoc($res);
       $fetch_password=$fetch_data['user_password'];
       $name=$fetch_data['user_name'];
       $user_address=$fetch_data['user_address'];
       $user_id=$fetch_data['user_id'];

       $_SESSION['username']=$name;
       $_SESSION['user_address']=$user_address;
       $_SESSION['user_id']=$user_id;

       if(password_verify($userpassword,$fetch_password)){
           $status=$fetch_data['status'];
           if($status == 'verified'){
            $_SESSION['user']='yes';

            //cart item

    $select_query_cart="SELECT * FROM `cart_details` WHERE user_id ='$user_id'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);

            if($row_count_cart == 0){
                $_SESSION['username']=$name;
                $_SESSION['user_address']=$user_address;
                $_SESSION['user_id']=$user_id;
                header('location: index.php');
            }
            else{
                $_SESSION['username']=$name;
                $_SESSION['user_address']=$user_address;
                $_SESSION['user_id']=$user_id;
                header('location: index.php');
            }
           }
           else{        
            $info= "It's look like you haven't still verify your email - $useremail";
            $_SESSION['info']=$info;
            header("location: mailotp.php");
           }
       }
       else{
        array_push($errors, "Incorrect email or password!");
       }

    }
    else{
        array_push($errors, "It's look like you're not yet a member! Click on the bottom link to signup.");
    }



    }
}

//for password otp check
if(isset($_POST['checkotp'])){
    $checkotp=mysqli_real_escape_string($con,$_POST['otp']);
    $sql="SELECT * FROM users WHERE otp ='$checkotp'";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){

        $fetch_data = mysqli_fetch_assoc($res);//this fetching of email is done and used in changing password form
        $useremail = $fetch_data['user_email'];
        $_SESSION['email'] = $useremail;

        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: changepass.php');
        exit();
    }
    else{
        array_push($errors,"Incorrect OTP!");
    }
}


//if user update profile pic

if(isset($_POST['updateprofilepic'])){

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = '../user_profile/'.$update_image;
 
    if(!empty($update_image)){
       if($update_image_size > 2000000){
          $message[] = 'image is too large';
       }else{
        $username=$_SESSION['username'];
          $image_update_query = mysqli_query($con, "UPDATE `users` SET user_profilepic = '$update_image'
           WHERE user_name = '$username'") or die('query failed');
          if($image_update_query){
             move_uploaded_file($update_image_tmp_name, $update_image_folder);
          }
          array_push($errors,"Image updated succssfully!");
       }
    }
 
 }

 //to delete product in admin panel

 if(isset($_POST['deleteproduct'])){

    $id=$_POST['delete'];
    $sql="DELETE FROM products WHERE product_id='$id'";
    $res=mysqli_query($con,$sql);
    if($res){
        $errors=" Product Data Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: ../admin_area/admin_index.php?message=' . urlencode($errors));
        exit();
    }
    else{
        $errors="Data not  Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: admin_index.php?message=' . urlencode($errors));
    exit();

    }
}

//to delete userdata in admin panel

if(isset($_POST['deleteuser'])){

    $id=$_POST['delete'];
    $sql="DELETE FROM users WHERE user_id='$id'";
    $res=mysqli_query($con,$sql);
    if($res){
        $errors="User Data Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: ../admin_area/admin_index.php?message=' . urlencode($errors));
        exit();
    }
    else{
        $errors=" User Data not  Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: admin_index.php?message=' . urlencode($errors));
    exit();

    }
}

//to delete brand in admin panel

if(isset($_POST['deletebrand'])){

    $id=$_POST['delete'];
    $sql="DELETE FROM brand WHERE brand_id='$id'";
    $res=mysqli_query($con,$sql);
    if($res){
        $errors="Brand Data Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: ../admin_area/admin_index.php?message=' . urlencode($errors));
        exit();
    }
    else{
        $errors="Brand Data not  Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: admin_index.php?message=' . urlencode($errors));
    exit();

    }
}

//to delete Category in admin panel

if(isset($_POST['deletecategory'])){

    $id=$_POST['delete'];
    $sql="DELETE FROM category WHERE category_id='$id'";
    $res=mysqli_query($con,$sql);
    if($res){
        $errors="Category Data Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: ../admin_area/admin_index.php?message=' . urlencode($errors));
        exit();
    }
    else{
        $errors="Category Data not  Deleted";
        header('location: ../admin_area/admin_index.php');
        header('location: admin_index.php?message=' . urlencode($errors));
    exit();

    }
}


//if user update address

if(isset($_POST['submit_user_address'])){

    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $userid=$_POST['userid'];
    $user_update_query = mysqli_query($con, "UPDATE `users` SET user_address = '$user_address' ,
    user_contact = '$user_contact' WHERE user_id = '$userid'");
    header('location: placeorder.php');

}


?>