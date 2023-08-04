<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
-->
<?php

include("../include/connect.php");
include_once("../include/functions.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = $_SESSION['id'];

if (isset($_POST['search'])) {
    $category = data_validition($conn, $_POST['category']);
    // print_r($category . '<br>');

    $payment = data_validition($conn, $_POST['payment']);
    // print_r($payment . '<br>');

    if (strlen((int)$_POST['date_from']) == 4 and strlen($_POST['date_from']) == 10)
        $date_from = data_validition($conn, $_POST['date_from']);
    else $err_date_from = "<p id='error' >sorry not valid date, return enter currect date</p>";

    if (strlen((int)$_POST['date_to']) == 4 and strlen($_POST['date_to']) == 10)
        $date_to = data_validition($conn, $_POST['date_to']);
    else $err_date_from = "<p id='error' >sorry not valid date, return enter currect date</p>";

    //date edit big form year then month then days
    // $date1=explode('-',$date_from);

    if (isset($err_date_from) or isset($err_date_to)) {
        include_once('searchexpense.php');
        exit();
    } else {
        if ((int)$category !== 1) {
            $sql = "SELECT category_id FROM `categories`
         WHERE user_id='$id' and category_name='$category' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($result);
            $category_id = $rows['category_id'];
            // print_r($category_id);
        }

        if ((int)$payment !== 1) {
            $sql = "SELECT payment_id FROM `payment_account` WHERE user_id='$id' and payment_name='$payment' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($result);
            $payment_id = $rows['payment_id'];
            // print_r($payment_id);
            // echo '<br>';
        }

        //if all category and all payments
        if ((int)$category === 1 and (int)$payment === 1) {
            $sql = "SELECT * FROM expenses WHERE expense_date BETWEEN '$date_from' and '$date_to'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result);
            // print_r($rows);
            include_once('showexpense_search.php');
        } //here 
        elseif ((int)$category !== 1 and (int)$payment !== 1) {
            $sql = "SELECT * FROM expenses WHERE category_id='$category_id' and  payment_id='$payment_id' and expense_date BETWEEN '$date_from' and '$date_to'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result);
            // print_r($rows);          
            include_once('showexpense_search.php');
        } elseif ((int)$category !== 1) {
            $sql = "SELECT * FROM expenses WHERE category_id='$category_id' and expense_date BETWEEN '$date_from' and '$date_to'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result);
            include_once('showexpense_search.php');
        } elseif ((int)$payment !== 1) {
            $sql = "SELECT * FROM expenses WHERE  payment_id='$payment_id' and expense_date BETWEEN '$date_from' and '$date_to'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result);
            // print_r($rows);
            $array = $rows;
            include_once('showexpense_search.php');
        }
    }
} else {
    include_once('searchexpense.php');
}