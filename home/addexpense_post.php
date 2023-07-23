<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
The name file is expressive
*/ -->
<?php

include("../include/connect.php");
include("../include/functions.php");


if (isset($_POST['sbmt'])) {



    if (empty($_POST['title'])) {
        $err_title = "<p id='error'>Please enter expense name</p>";
    } else {
        $title = data_validition($conn, $_POST['title']);
    }


    if (!isset($_POST['category'])) {
        $err_category = "<p id='error'>Please choose category</span>";
    } else {
        $category = data_validition($conn, $_POST['category']);
    }

    if (!isset($_POST['payment'])) {
        $err_payment = "<p id='error'>Please choose payment</p>";
    } else {
        $payment = data_validition($conn, $_POST['payment']);
    }

    if (empty($_POST['amount'])) {
        $err_amount = "<p id='error'>Please enter price</p>";
    } else {
        $amount = data_validition($conn, $_POST['amount']);
    }
    if (isset($_POST['date']))
        $date = data_validition($conn, $_POST['date']);
    else $err_date = 'err_date';

    if (isset($_POST['bill']))
        $bill = data_validition($conn, $_POST['bill']);
    else $err_bill = 'err_bill';



    if (isset($_POST['notes']))
        $notes = data_validition($conn, $_POST['notes']);



    $time = date('Y-m-d H:i:s');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];
        // print_r($id);
    $types = array('Expense', 'Income');
    // print_r($id);


    if (isset($err_title) or isset($err_amount) or isset($err_category) or isset($err_payment) or isset($err_date) or isset($err_bill)) {
        include_once('addexpense.php');
        exit();
    } else {
        $sql = "SELECT category_id FROM `categories`
         WHERE user_id='$id' and category_name='$category' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $category_id = $rows['category_id'];

        $sql = "SELECT amount FROM `categories` WHERE category_id='$category_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_amount = $rows['amount'] - $amount;

        if($stay_amount>=0){
            $sql = "UPDATE `categories` SET `amount` = '$stay_amount' WHERE `categories`.`category_id` = '$category_id' ";
            mysqli_query($conn, $sql);
        }else{
            $err_amount = "<p id='error'>Please update category</span>";
            $_POST['upload']=1;
            $_POST['name']= $category;
            include_once('updatecategories_select.php');
            exit();
        }
        
        $sql = "SELECT payment_id FROM `payment_account` WHERE user_id='$id' and payment_name='$payment' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $payment_id = $rows['payment_id'];

        $sql = "SELECT balance FROM `payment_account` WHERE user_id='$id' and payment_id='$payment_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_balance = $rows['balance'] - $amount;

        

        if ($stay_balance >= 0) {
            $sql = "UPDATE `payment_account` SET `balance` = '$stay_balance' WHERE `payment_account`.`payment_id` = '$payment_id' ";
            mysqli_query($conn, $sql);
        } else {
            $err_payment = "<p id='error'>Please choose another payment methods</p>";
            include_once('addexpense.php');
            exit();
        }

        $sql = "INSERT INTO `expenses` (`expense_id`, `category_id`, `payment_id`, `title`, `amount`, `expense_date`, `bill`, `notes`, `created_at`) VALUES (NULL, '$category_id', '$payment_id', '$title', '$amount', '$date', '$bill', '$notes', '$time')";
        mysqli_query($conn, $sql);

        echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
        header('location:expense.php');
        exit();
    }
} else {
    include_once('addexpense.php');
    exit();
}