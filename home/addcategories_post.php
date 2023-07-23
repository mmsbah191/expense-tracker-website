<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
The name file is expressive
*/ -->
<?php

include("../include/connect.php");
include("../include/functions.php");



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = $_SESSION['id'];
$date = date('Y-m-d H:i:s');
$types = array('Expense', 'Income');
    // print_r($id);
    
if (isset($_POST['sbmt']) ) {

    $name = data_validition($conn, $_POST['name']);
    $amount = data_validition($conn, $_POST['amount']);
    $notes = data_validition($conn, $_POST['notes']);
    if(isset($_POST['type']))
    $type = data_validition($conn, $_POST['type']);
    else $type=null;

    if (empty($name)) {
        $err_name = "<p id='error'>Please enter your name</p>";
    } else {
        $sql = "SELECT * FROM `categories` 
        WHERE category_name='$name' and user_id='$id' limit 1";
        $check_result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($check_result);
        if ($num_rows != 0) {
            $err_name = "<p id='error'>
            '$name' already exists, Please enter other categry name</p>";
        }
    }

    if (empty($amount) or $amount === 0) {
        $err_amount = "<p id='error'>Please enter your budget</p>";
    } elseif (!is_numeric($amount)) {
        $err_amount = "<p id='error'>Please enter numbers only</p>";
    }
    
    if (!in_array($type, $types) or $type==null) {
        $err_type = "<p id='error'>Please choose method</p>";
    }

    if (isset($err_name) or isset($err_amount) or isset($err_type)) {
        include_once('addcategories.php');
        exit();
    } else {
        $sql = "INSERT INTO `categories` (`category_id`, `user_id`, `category_name`, `type`,`budget`, `amount`, `notes`, `created_at`, `updated_at`) 
    VALUES (NULL, '$id', '$name', '$type', '$amount','$amount', '$notes', '$date', '$date')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
        header('location:categories.php');
        exit();
    }
} else {
        include_once('addcategories.php');
    exit();
}