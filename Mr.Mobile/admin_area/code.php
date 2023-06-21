<?php 
include_once "../include/connect.php";
session_start();

//to edit products
if(isset($_POST['update_product'])){
      
  $id=$_POST['edit_id'];
  $product_name=$_POST['product_name'];
  $product_desc=$_POST['product_desc'];
  $product_keyword=$_POST['product_keyword'];
  $cat_name=$_POST['category_name'];
  $brand_name=$_POST['brand_name'];
  $price=$_POST['product_price'];

  //accessing image
  $image1=$_FILES['image1']['name'];

  //img tmp name

  $temname_img1=$_FILES['image1']['tmp_name'];

  if($image1==''){

    $update="UPDATE products SET product_name='$product_name' ,product_desc='$product_desc',
  product_keywords='$product_keyword',category_name='$cat_name',brand_name='$brand_name',
   product_price='$price' 
   WHERE product_id='$id' ";

  $updateresult=mysqli_query($con,$update);

  if ($updateresult) {
    $errors = "Product Updated Successfully!";
    header('location: admin_index.php?message=' . urlencode($errors));
    exit();
  }
else{
    $errors = "Product Updation Error!";
    header('location: admin_index.php?message=' . urlencode($errors));
    exit();
}

}
else{
    move_uploaded_file($temname_img1,"./product_images/".$image1);
  
  $update="UPDATE products SET product_name='$product_name' ,product_desc='$product_desc',
  product_keywords='$product_keyword',category_name='$cat_name',brand_name='$brand_name',main_image='$image1' ,
   product_price='$price' 
   WHERE product_id='$id' ";

  $updateresult=mysqli_query($con,$update);

  if($updateresult){
     
      header('location: admin_index.php');
      array_push($errors,"Product Updated Successfully!");
  }
  else{
      header('location: admin_index.php');
      array_push($errors,"Product Updation Error!");

  }
}}


//edit btn in brand admin
if (isset($_POST['update_brand'])) {
  $id = $_POST['edit_id'];
  $brand_name = $_POST['brand_name'];

  // Get the old brand name from the brand table
  $select_old_brand = "SELECT brand_name FROM brand WHERE brand_id = '$id'";
  $old_brand_result = mysqli_query($con, $select_old_brand);
  $old_brand_row = mysqli_fetch_assoc($old_brand_result);
  $old_brand_name = $old_brand_row['brand_name'];

  // Update the brand name in the brand table
  $update_brand = "UPDATE brand SET brand_name = '$brand_name' WHERE brand_id = '$id'";
  $update_brand_result = mysqli_query($con, $update_brand);

  // Update the brand name in the products table for the matching brand name
  $update_products = "UPDATE products SET brand_name = '$brand_name' WHERE brand_name = '$old_brand_name'";
  $update_products_result = mysqli_query($con, $update_products);

  if ($update_brand_result && $update_products_result) {
    $message = "Brand Updated Successfully!";
    header('location: admin_index.php?message=' . urlencode($message));
    exit();
  } else {
    $message = "Brand Updation Error!";
    header('location: admin_index.php?message=' . urlencode($message));
    exit();
  }
}


//edit btn in category admin
if (isset($_POST['update_category'])) {
  $id = $_POST['edit_id'];
  $category_name = $_POST['category_name'];

  // Get the old brand name from the brand table
  $select_old_category = "SELECT category_name FROM category WHERE category_id = '$id'";
  $old_cat_result = mysqli_query($con, $select_old_category);
  $old_cat_row = mysqli_fetch_assoc($old_cat_result);
  $old_category_name = $old_cat_row['category_name'];

  // Update the brand name in the brand table
  $update_category = "UPDATE category SET category_name = '$category_name' WHERE category_id = '$id'";
  $update_cat_result = mysqli_query($con, $update_category);

  // Update the brand name in the products table for the matching brand name
  $update_products = "UPDATE products SET category_name = '$category_name' WHERE category_name = '$old_category_name'";
  $update_products_result = mysqli_query($con, $update_products);

  if ($update_cat_result && $update_products_result) {
    $message = "Category Updated Successfully!";
    header('location: admin_index.php?message=' . urlencode($message));
    exit();
  } else {
    $message = "Category Updation Error!";
    header('location: admin_index.php?message=' . urlencode($message));
    exit();
  }
}
?>