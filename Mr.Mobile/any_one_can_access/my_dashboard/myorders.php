<?php 
include_once "../include/connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .head{
background-color: #563d7c;
}
    </style>
</head>
<body>
    <h2>My Orders</h2>
    <?php
    $_SESSION['user_id']=$userid;
    $select_order="SELECT * FROM `user_orders` WHERE user_id ='$userid'";
    $select = mysqli_query($con,$select_order);
    $rowdata=mysqli_num_rows($select);
    if($rowdata>0){
        $counter=1; //for serial number
        while($result=mysqli_fetch_assoc($select))
           {
            ?>
            <div class="l-5">
                <h6>order no.<?php echo $counter; ?></h6>
            <table class="table table-bordered">
                <thead class="text-light head">
                    <th>S.no</th>
                    <th>Invoice Number</th>
                    <th>Amount Due</th>
                    <th>Total Products</th>
                    <th>Order Date</th>
                    <th>Payment</th>
                </thead>
                <tbody>
            <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $result['invoice_number']; ?></td>
        <td><?php echo $result['amount_due']; ?></td>
        <td><?php echo $result['total_products'];?></td>
        <td><?php echo $result['order_date']; ?></td>
        <td><?php echo $result['order_status']; ?></td>
        </tr>
                </tbody>
            </table>
            </div>
        <?php
        $counter++;
           }}
    else{
        echo "<div class='alert alert-danger text-center mt-5'>No Orders Yet!</div>";
    }





?>

</body>
</html>