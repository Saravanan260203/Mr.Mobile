<?php 
include_once "../include/connect.php";




if(isset($_POST['insert_brands'])){

    $brand_name=$_POST['brand_name'];
  
  
    $check = "SELECT * FROM `brand` WHERE brand_name = '$brand_name'";
      $check_res = mysqli_query($con, $check);
      $rowcount=mysqli_num_rows($check_res);
      if($rowcount > 0){
        array_push($errors,"Brand that you have entered is already exist!");
      }
      else{
        $sql="INSERT INTO `brand`(`brand_name`) VALUES ('$brand_name')";
      $res=mysqli_query($con,$sql);
      if($res){
        array_push($errors,"Brand Added successfully!");
      }}
  
    }

?>

        

<h2 class="text-center">Insert Brands</h2>
<?php
if(count($errors)> 0){
    foreach($errors as $error){
        echo "<div class='alert alert-danger text-center'>$error</div>";
    }
}
?>
<form action="" method="post">
<div class="input-group w-90 mb-3">
  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" name="brand_name" class="form-control" placeholder="Insert Brands" required aria-label="Username" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2 m-auto">
<input type="submit" value="Insert Brands" class="bg-info p-2 my-3 border-0" name=insert_brands>
</div>
</form>