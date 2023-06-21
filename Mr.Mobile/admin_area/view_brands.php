<?php 

include_once "../include/connect.php";
include "../any_one_can_access/controller.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> 
</head>
<body>
    <div class="container">
<table class="table table-bordered text-center">
        <thead>
        <tr>
            <th>ID</th>
            <th>Brand Name</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
    //for admin page
          $sql="SELECT * FROM brand";
           $data=mysqli_query($con,$sql);
           if(mysqli_num_rows($data)>0)
           {
           while($result=mysqli_fetch_assoc($data))
           {
            ?>
            <tr>
        <td> <?php echo $result['brand_id']; ?></td>
        <td><?php echo $result['brand_name']; ?></td>
        <td>
          <form action="edit_brands.php" method="post">
            <input type="hidden" name="edit_id" value="<?php echo $result['brand_id']; ?>">
            <button type="submit" name="editbrand" class="btn btn-primary">EDIT</button>
                </form>
        </td>
        <td>
          <form action="" method="post">
                <input type="hidden" name="delete" value="<?php echo $result['brand_id']; ?>">
                <button type="submit" name="deletebrand" class="btn btn-danger">DELETE</button>
                </form>
        </td>
        </tr>
           
        <?php
           }
        }
        else{
            echo "NO RECORDS FOUND!";
        }
        ?>
        </tbody>
     </table>
     </div>

 
</body>
</html>
    