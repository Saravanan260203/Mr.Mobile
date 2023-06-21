<?php

include_once "../include/connect.php";

$paymentId = $_POST['razorpay_payment_id'];
$amount = $_POST['totalAmount'];
$no_of_products=$_POST['no_of_products'];
$userId = $_POST['user_id'];
$paidDate = date('Y-m-d H:i:s');

// Prepare the SQL statement for inserting payment details
$stmt = mysqli_prepare($con, "INSERT INTO payments (payment_id, user_id, amount, paid_date) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sdis", $paymentId, $userId, $amount, $paidDate);

// Execute the prepared statement for inserting payment details
if (mysqli_stmt_execute($stmt)) {
    // Payment details insertion successful

    // Delete cart_details data for the user_id
    $deleteStmt = mysqli_prepare($con, "DELETE FROM cart_details WHERE user_id = ?");
    mysqli_stmt_bind_param($deleteStmt, "i", $userId);
    mysqli_stmt_execute($deleteStmt);

    // Close the delete statement
    mysqli_stmt_close($deleteStmt);

     // Insert order details into user_orders table
     $invoiceNumber =mt_rand(); // Generate or retrieve the invoice number
     $totalProducts = $no_of_products; // Calculate the total number of products
     $orderStatus = 'PAID'; // Set the initial order status
 
     $orderStmt = mysqli_prepare($con, "INSERT INTO user_orders (user_id, amount_due, invoice_number, total_products, order_status) VALUES (?, ?, ?, ?, ?)");
     mysqli_stmt_bind_param($orderStmt, "iiiis", $userId, $amount, $invoiceNumber, $totalProducts, $orderStatus);
     mysqli_stmt_execute($orderStmt);
     mysqli_stmt_close($orderStmt);

    $arr = array('msg' => 'Payment successfully credited', 'status' => true);
    echo json_encode($arr);
} else {
    // Payment details insertion failed
    $arr = array('msg' => 'Failed to store payment data', 'status' => false);
    echo json_encode($arr);
}

// Close the insert statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($con);
?>