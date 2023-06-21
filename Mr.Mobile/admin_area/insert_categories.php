<?php
include_once "../include/connect.php";

if(isset($_POST['insert_categories'])){

    

    $category_name=$_POST['cat_name'];

    $check = "SELECT * FROM `category` WHERE category_name = '$category_name'";
    $check_res = mysqli_query($con, $check);
    $rowcount=mysqli_num_rows($check_res);
    if($rowcount > 0){
      array_push($errors,"Category that you have entered is already exist!");
    }
    else{
        $sql="INSERT INTO `category`(`category_name`) VALUES ('$category_name')";
    $res=mysqli_query($con,$sql);

    if($res){
      array_push($errors,"Category Added succesfully!");
    }

    }
    
    
}
?>
<h2 class="text-center">Insert Categories</h2>
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
  <input type="text" class="form-control" name="cat_name" placeholder="Insert categories" aria-label="Username" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2 m-auto">
    <input type="submit" value="Insert Categories" class="bg-info p-2 my-3 border-0" name=insert_categories>
</div>
</form>
