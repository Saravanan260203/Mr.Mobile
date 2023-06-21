<?php

include_once "../include/connect.php";

//to insert new products

if(isset($_POST['insert_product'])){

  $product_name=$_POST['product_name'];
  $product_desc=$_POST['product_desc'];
  $product_keyword=$_POST['product_keyword'];
  $product_category=$_POST['product_category'];
  $product_brand=$_POST['product_brand'];
  $product_price=$_POST['product_price'];
  $product_status="true";

  //accessing image
  $image1=$_FILES['image1']['name'];
  $image2=$_FILES['image2']['name'];
  $image3=$_FILES['image3']['name'];

  //img tmp name

  $temname_img1=$_FILES['image1']['tmp_name'];
  $temname_img2=$_FILES['image2']['tmp_name'];
  $temname_img3=$_FILES['image3']['tmp_name'];

  if($image1=='' or $image2=="" or $image3==""){

      array_push($errors,"Insert All Image Fields!");
  }
  else{
      move_uploaded_file($temname_img1,"./product_images/".$image1);
      move_uploaded_file($temname_img2,"./product_images/".$image2);
      move_uploaded_file($temname_img3,"./product_images/".$image3);


      $insert_products="INSERT INTO `products` (product_name, product_desc, product_keywords,
      category_name, brand_name, main_image, product_image2, product_image3, product_price, status) 
     VALUES ('$product_name','$product_desc','$product_keyword','$product_category',
     '$product_brand','$image1','$image2','$image3','$product_price','$product_status')";

      $results=mysqli_query($con,$insert_products);

      if($results){
        $errors = "Product Inserted Successfully!";
    header('location: admin_index.php?message=' . urlencode($errors));
    exit();
      }
      else{
        $errors = "Server Down!";
    header('location: admin_index.php?message=' . urlencode($errors));
    exit();
      }
  }




}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
     <!--Bootstrap Css-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--cssfile-->
    <link rel="stylesheet" href="../style.css">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/9e6d3f1177.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container p-3">
        <h1 class="text-center mb-4">Insert Products</h1>
        <?php
if(count($errors)> 0){
    foreach($errors as $error){
        echo "<div class='alert alert-danger text-center'>$error</div>";
    }
}
?>
    <form action="" method="post" enctype="multipart/form-data">
  <div class="form-group mb-4">
    <label for="formGroupExampleInput">Product Title</label>
    <input type="text" class="form-control"  name="product_name" placeholder="Enter Product Title" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Product Description</label>
    <input type="text" class="form-control" name="product_desc"  placeholder="Enter Product Description" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Product Keyword</label>
    <input type="text" class="form-control" name="product_keyword"  placeholder="Enter Product keywords" required>
  </div>
  <div class="form-outline mb-4 w-100 m-auto">
  <select class="form-select" name="product_category">
  <option selected>Select a Category</option>
  <?php
  $select_categories="SELECT * FROM category";
  $res=mysqli_query($con,$select_categories);

  while($rowdata=mysqli_fetch_assoc($res)){
    $categories_name=$rowdata['category_name'];
    $categories_id=$rowdata['category_id'];


    echo"<option value='$categories_name'>$categories_name</option>";

  }
  ?>
  </select>
</div>
<div class="form-outline mb-4 w-100 m-auto">
  <select class="form-select" name="product_brand">
  <option selected>Select a Brand</option>

  <?php

  $select_brands="SELECT * FROM brand";
  $res=mysqli_query($con,$select_brands);

  while($rowdata=mysqli_fetch_assoc($res)){

    $brand_name=$rowdata['brand_name'];
    $brand_id=$rowdata['brand_id'];

    echo"<option value='$brand_name'>$brand_name</option>";
  }

  ?>
  </select>
</div>
<div class="form-outline mb-4 w-100 m-auto">
<label class="form-label" >Product Main Image</label>
    <input type="file" class="form-control" name="image1">
</div>
<div class="form-outline mb-4 w-100 m-auto">
<label class="form-label" >Product Image 2</label>
    <input type="file" class="form-control" name="image2">
</div>
<div class="form-outline mb-4 w-100 m-auto">
<label class="form-label" >Product Image 3</label>
    <input type="file"  class="form-control" name="image3">
</div>
<div class="form-group mb-4">
    <label for="formGroupExampleInput2">Product Price</label>
    <input type="number" class="form-control" name="product_price"  placeholder="Enter Product Price" required>
  </div>

  <input type="submit" value="Insert Product" class="btn bg-info mb-5" name="insert_product">


</form>

    </div>
    
</body>
</html>