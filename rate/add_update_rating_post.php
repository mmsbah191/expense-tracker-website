<?php
/* Name: Mohammed Ibrahim
    date: 29/7/2023
back end add_update_rating
*/ 

include_once('../include/connect.php');
include_once("../include/functions.php");

//user
if (isset($_POST['sbmt'])) {
    $arr = [1, 2, 3, 4, 5];
    $rating = (int)data_validition($conn, $_POST['rating']);

    if (!in_array($rating, $arr)) {
        $err_rating = "<p id=error>plaese choose rating from 1 t 5</p>";
    }

    $comment =trim(data_validition($conn, $_POST['comment'])); //only true code  
    // echo $comment;
    
    if (empty($comment) or strlen($comment)===0) {
        $err_comment = "<p id=error>plaese enter Comment</p>";
    }

    if (isset($err_rating) or isset($err_comment)) {
        include_once("add_update_rating.php");
        exit();
    } else {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['id'];
        $date = date('Y-m-d H:i:s');
        $nums_rows=$_POST['nums_rows'];
       
        if ($nums_rows == 0) {
            $sql="select name from users where id='$id'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($result);
            $name=$rows['name'];
            $sql= "INSERT INTO `rating` (`rating_id`,`name`, `user_id`, `rate`, `comment`, `created_at`, `updated_at`) 
            VALUES (NULL,'$name', '$id', '$rating', '$comment', '$date', '$date')";
        } else {
            $sql = "UPDATE `rating` SET `rate` = '$rating', `comment` = '$comment', `updated_at` = '$date' WHERE user_id='$id'";
        }
        mysqli_query($conn, $sql);
        header("location:showrating.php");
        exit();
    }
} else {
    include_once("add_update_rating.php");
    exit();
}