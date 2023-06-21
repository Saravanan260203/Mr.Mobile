<?php include_once "../include/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <style>
      label{
        font-weight: bolder;
      }
    </style>
     <!--Bootstrap Css-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/9e6d3f1177.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container p-3">
        <h1 class="text-center mb-4">Edit Products</h1>
        <?php
if(count($errors)> 0){
    foreach($errors as $error){
        echo "<div class='alert alert-danger text-center'>$error</div>";
    }
}
    if(isset($_POST['editbtn'])){
        $id=$_POST['edit_id'];

    $sql="SELECT * FROM products WHERE product_id =$id";
    $content=mysqli_query($con,$sql);

    foreach($content as $row){
?>
    <form action="code.php" method="post" enctype="multipart/form-data">
  <div class="form-group mb-4">
  <input type="hidden" name="edit_id" value="<?php echo $row['product_id'] ?>">
    <label for="formGroupExampleInput">Product Name</label>
    <input type="text" class="form-control"  name="product_name"  value="<?php echo $row['product_name'] ?>" placeholder="Enter Product Name" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Product Description</label>
    <input type="text" class="form-control" name="product_desc"  value="<?php echo $row['product_desc'] ?>" placeholder="Enter Product Description" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Product Keyword</label>
    <input type="text" class="form-control" name="product_keyword"  value="<?php echo $row['product_keywords'] ?>" placeholder="Enter Product keyword" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Category Name</label>
    <input type="text" class="form-control" name="category_name"   value="<?php echo $row['category_name'] ?>" placeholder="Enter Category Name" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Brand Name</label>
    <input type="text" class="form-control" name="brand_name"  value="<?php echo $row['brand_name'] ?>" placeholder="Enter Brand Name" required>
  </div>
  <div class="form-group mb-4">
    <label for="formGroupExampleInput2">Change Product Image</label>
    <input type="file" class="form-control" name="image1"  value="<?php echo $row['main_image'] ?>" >
  </div>
<div class="form-group mb-4">
    <label for="formGroupExampleInput2">Product Price</label>
    <input type="number" class="form-control" name="product_price"  value="<?php echo $row['product_price'] ?>" placeholder="Enter Product Price" required>
  </div>
  <a href="admin_index.php" class="btn bg-danger mb-5">Cancel</a>
  <input type="submit" value="Save Changes" class="btn bg-info mb-5" name="update_product">
</form>
<?php
    }}
    ?>
    </div>
    
</body>
</html>