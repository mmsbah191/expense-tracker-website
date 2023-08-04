<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
-->
<?php

include("../include/connect.php");
include_once("../include/functions.php");


if (isset($_POST['sbmt']) and isset($_POST['expense_id'])) {

    if (!empty($_POST['title']) and strlen($_POST['title']) != 0) {
        $title = data_validition($conn, $_POST['title']);
    } else {
        $err_new_title = "<p id='error'>Please enter expense name</p>";
    }

    if (!isset($_POST['category'])) {
        $err_category = "<p id='error'>Please choose category</span>";
    } else {
        $category = data_validition($conn, $_POST['category']);
        $old_category = $_POST['old_category'];
    }

    if (!isset($_POST['payment'])) {
        $err_payment = "<p id='error'>Please choose payment</p>";
    } else {
        $payment = data_validition($conn, $_POST['payment']);
        $old_payment = $_POST['old_payment'];
    }

    if (empty($_POST['amount'])) {
        $err_amount = "<p id='error'>Please enter price</p>";
    } else {
        $amount = data_validition($conn, $_POST['amount']);
        $old_amount = $_POST['old_amount'];
    }
    if (isset($_POST['date']))
        $date = data_validition($conn, $_POST['date']);
    else $err_date = 'err_date';

    if (isset($_POST['bill']) and strlen($_POST['bill']) != 0) {
        $bill = data_validition($conn, $_POST['bill']);
        // for picture
    }

    if (isset($_POST['notes']) and !empty($_POST['notes']))
        $notes = data_validition($conn, $_POST['notes']);


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];
    $time = date('Y-m-d H:i:s');
    $expense_id = $_POST['expense_id'];
    // print_r($id);
    $types = array('Expense', 'Income');
    // print_r($expense_id);


    if (isset($err_new_title) or isset($err_amount) or isset($err_category) or isset($err_payment) or isset($err_date) or isset($err_bill)) {
        include_once('updateexpense.php');
        exit();
    } else {

        // فكرة لو غيرنا حتى الصنف وطريقة الدفع
        //الفكرة بسيطة سوف تجلب الصنف القديم وتتعامل معه بشكل مفرد وهكذا في طريقة الدفع
        $sql = "SELECT category_id FROM `categories` WHERE user_id='$id' and category_name='$old_category' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $category_id = $rows['category_id'];

        $sql = "SELECT amount FROM `categories` WHERE user_id='$id' and category_id='$category_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_amount = $rows['amount'] + $old_amount;

        $sql = "UPDATE `categories` SET `amount` = '$stay_amount' WHERE `categories`.`category_id` = '$category_id' ";
        mysqli_query($conn, $sql);


        $sql = "SELECT category_id FROM `categories` WHERE user_id='$id' and category_name='$category' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $category_id = $rows['category_id'];

        $sql = "SELECT amount FROM `categories` WHERE user_id='$id' and category_id='$category_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_amount = $rows['amount'] - $amount;

        $sql = "UPDATE `categories` SET `amount` = '$stay_amount' WHERE `categories`.`category_id` = '$category_id' ";
        mysqli_query($conn, $sql);



        $sql = "SELECT payment_id FROM `payment_account` WHERE user_id='$id' and payment_name='$old_payment' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $payment_id = $rows['payment_id'];

        $sql = "SELECT balance FROM `payment_account` WHERE user_id='$id' and payment_id='$payment_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_balance = $rows['balance'] + $old_amount;

        $sql = "UPDATE `payment_account` SET `balance` = '$stay_balance' WHERE `payment_account`.`payment_id` = '$payment_id' ";
        mysqli_query($conn, $sql);


        $sql = "SELECT payment_id FROM `payment_account` WHERE user_id='$id' and payment_name='$payment' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $payment_id = $rows['payment_id'];

        $sql = "SELECT balance FROM `payment_account` WHERE user_id='$id' and payment_id='$payment_id' ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $stay_balance = $rows['balance'] - $amount;

        $sql = "UPDATE `payment_account` SET `balance` = '$stay_balance' WHERE `payment_account`.`payment_id` = '$payment_id' ";
        mysqli_query($conn, $sql);


        $sql = " UPDATE `expenses` SET `category_id` = '$category_id', `payment_id` = '$payment_id', `title` = '$title', `amount` = '$amount', `expense_date` = '$date', `bill` = '$bill', `notes` = '$notes' WHERE `expenses`.`expense_id` ='$expense_id'";
        mysqli_query($conn, $sql);
        echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
        header('location:expense.php');
        exit();
    }
} else {
    $err_title = "<p id='error'>Please choose expense then upload data</p>";
    include_once('updateexpense.php');
    exit();
}