<?php
/* Name: Mohammed Ibrahim
date: 29/7/2023
back end transfer\addtransfer_post.php
*/ 
include_once('../include/connect.php');
include_once("../include/functions.php");





if (isset($_POST['sbmt'])) {

    if (!isset($_POST['category1'])) {
        $err_category1 = "<p id=error>plaese choose sender category</p>";
    } else $category1 = data_validition($conn, $_POST['category1']);

    if (!isset($_POST['category2'])) {
        $err_category2 = "<p id=error>plaese choose sender category</p>";
    } else $category2 = data_validition($conn, $_POST['category2']);

    if(isset($category1) and isset($category2) and $category1 === $category2){
        $err_category2 = "<p id=error>plaese choose diffirent category</p>";
    }

    $amount = (int)data_validition($conn, $_POST['amount']);
    if ($amount == 0) {
        $err_amount = "<p id=error>plaese Enter  amount</p>";
    }

    $notes = data_validition($conn, $_POST['notes']); //only true code  


    if (isset($err_category1) or isset($err_category2) or isset($err_amount)) {
        include_once("addtransfer.php");
        exit();
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['id'];

        $sql = "SELECT category_id,amount FROM `categories`
         WHERE user_id='$id' and category_name='$category1'"; //must seperate (category_name='$category2' or category_name='$category1')
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);
        $category_id1 = $rows['category_id'];
        $amount1 = $rows['amount'];
        if ($amount > $amount1) { // if transfer amount bigger than exists in sender amount1 print
            $err_category1 = "<p id=error>value not enuagh in $category1</p>";
            include_once("addtransfer.php");
            exit();
        } else {
            $date = date('Y-m-d H:i:s');
            $new_amount1 = $amount1 - $amount;
            
            $sql1 = "UPDATE `categories` SET `amount` = '$new_amount1', `updated_at` = '$date' WHERE `categories`.`category_id` = '$category_id1'";
            mysqli_query($conn, $sql1);
            
            $sql = "SELECT category_id,amount FROM `categories`
         WHERE user_id='$id' and category_name='$category2'"; //must seperate (category_name='$category2' or category_name='$category1')
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($result);
            $category_id2 = $rows['category_id'];
            $amount2 = $rows['amount'];
            $new_amount2 = $amount2 + $amount;
            
            $sql2 = "UPDATE `categories` SET `amount` = '$new_amount2', `updated_at` = '$date' WHERE `categories`.`category_id` = '$category_id2'";
            mysqli_query($conn, $sql2);

            $sql3 = "INSERT INTO `transfer` (`transfer_id`, `category_from_id`, `category_to_id`, `amount`, `notes`, `created_at`) VALUES (NULL, '$category_id1', '$category_id2', '$amount', '$notes', '$date')";
            mysqli_query($conn, $sql3);

            header("location:showtransfer.php");
            exit();
        }
    }
} else {
    include_once("addtransfer.php");
    exit();
}