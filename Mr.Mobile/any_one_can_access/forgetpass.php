<?php include "../include/connect.php";
include "controller.php";

//forget password


if(isset($_POST['submit'])){
    
    $email=$_POST['checkemail'];

    $sql="SELECT * FROM users WHERE user_email='$email'";
    $res=mysqli_query($con,$sql);
    if(mysqli_num_rows($res)>0){
        $otp=rand(999999,111111);
        $insert_otp = "UPDATE users SET otp = '$otp' WHERE user_email = '$email' ";
        $res=mysqli_query($con,$insert_otp);
        if($res){
            $info = "We've sent a password reset otp to your email - $email";
            $_SESSION['info'] = $info;
            $_SESSION['email'] = $email;
                

                
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
$mail->addAddress($email);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Password Reset Code';
$mail->Body    = 'Your password reset code is: '.$otp;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $info = "We've sent a password reset otp to your email - $email";
    $_SESSION['info'] = $info;
    $_SESSION['email'] = $email;
    header('location: passwordotp.php');
}


/////////////////////////////////////////////////PHP-MAILER////////////////////////////////////////////////////////
}else{
            array_push($errors,"Failed while sending code!");
        }
     }
     else{
        array_push($errors,"Enter Registered Email Address!");
     }
}





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
.form-control{
    margin-left: 1.5%;
    width: 95%;
    
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
    <h1>Password Recovery</h1>
    <?php 
    if(count($errors)> 0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    ?>
  </div>
  <div class="card-body">
  <div class="small mb-3 text-muted">Enter your Registered Email address and we will send you a OTP to reset your password.</div>
        <form method="post">
            <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" type="email" placeholder="Enter Email" name="checkemail" required>
                <label for="inputEmail">Email address</label>
            </div>
            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                <a class="small" href="login.php">Return to login</a>
                <input type="submit" name="submit" class="btn btn-primary" value="Reset Password">
            </div>
        </form>
    </div>
  </div>
  <div class="card-footer text-muted">
    <a href="register.php">Doesn't have an Account?Go to Register</a>
  </div>

            </div>

        </div>
 
</div>


    </div>


    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>