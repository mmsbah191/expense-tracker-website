<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
-->
<?php

include("../include/connect.php");
include_once("../include/functions.php");
// include('../include/data.php');



if (isset($_POST['sbmt']) and isset($_POST['category_id'])) {
    $name = data_validition($conn, $_POST['name']);
    $old_name = data_validition($conn, $_POST['old_name']);
    $type = data_validition($conn, $_POST['type']);
    $amount = data_validition($conn, $_POST['amount']);
    $notes = data_validition($conn, $_POST['notes']);

    $category_id = $_POST['category_id'];
    $date = date('Y-m-d H:i:s');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];
    $types = array('Expense', 'Income');
    // print_r($id);



    if (empty($name) or strlen($name) == 0) {
        $err_newname = "<p id='error'>Please enter choose your category</p>";
    } else {
        $sql = "SELECT * FROM `categories` WHERE category_name='$name' limit 1";
        $check_result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($check_result);
        print_r($num_rows);
        if ($num_rows != 0 and $old_name !== $name) {
            $err_newname = "<p id='error'>$name already exists, Please enter other category name</p>";
        }
    }

    if (empty($amount) or $amount === 0) {
        $err_amount = "<p id='error'>Please enter your budget</p>";
    } elseif (!is_numeric($amount)) {
        $err_amount = "<p id='error'>Please enter numbers only</p>";
    }

    if (!in_array($type, $types)) {
        $err_type = "<p id='error'>Please choose type</p>";
    }

    if (isset($err_newname) or isset($err_amount) or isset($err_type)) {
        include_once('updatecategories.php');
        exit();
    } else {


        $sql = "SELECT amount FROM `categories` WHERE category_id='$category_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_amount = $rows['budget'] + $amount;


        $sql = "UPDATE `categories` SET `category_name`='$name',`budget`='$stay_amount',`amount`='$amount',
        `type` = '$type', `notes` = '$notes', `updated_at` = '$date' WHERE `user_id` = '$id' and category_id='$category_id'";
        mysqli_query($conn, $sql);
        echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
        header('location:categories.php');
        exit();
    }
} else {
    $err_name = "<p id='error'>Please enter upload your category first</p>";
    include_once('updatecategories.php');
    exit();
}