<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
-->
<?php
include("../include/connect.php");
include_once("../include/functions.php");
// $expense_id=null;

if (isset($_POST['upload']) and isset($_POST['title'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];
    $title = data_validition($conn, $_POST['title']);

    $sql = "SELECT expenses.* FROM `expenses` 
INNER JOIN categories ON expenses.category_id = categories.category_id
        INNER JOIN payment_account ON expenses.payment_id = payment_account.payment_id
        WHERE categories.user_id = $id AND payment_account.user_id =$id and expenses.title='$title' limit 1";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    // print_r($rows);

    if ($rows) {
        $expense_id = $rows['expense_id'];
        $category_id = $rows['category_id'];
        $payment_id = $rows['payment_id'];
        // $data = $rows['expense_data'];
        $bill = $rows['bill'];
        $amount = $rows['amount'];
        $notes = $rows['notes'];

        $sql = "SELECT category_name FROM `categories` WHERE category_id='$category_id'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $category = $rows['category_name'];
        // print_r($category);


        $sql = "SELECT payment_name FROM `payment_account` WHERE payment_id='$payment_id'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $payment = $rows['payment_name'];
        // print_r($payment);
        include_once('updateexpense.php');
    } else { // If the value is manipulated in the html code with browser
        $err_title = "<p id='error'>Please choose expense then upload data</p>";
        include_once('updateexpense.php');
    }
} else {
    $err_title = "<p id='error'>Please choose expense then upload data</p>";
    include_once('updateexpense.php');
}