<!-- /* Name: Mohammed Ibrahim
date: 21/7/2023
  back end home\deletecategories_post.php
*/ -->
<?php
include("../include/connect.php");
include_once("../include/functions.php");



if (isset($_POST['delete']) and isset($_POST['name'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];

    $name = data_validition($conn, $_POST['name']);
    // echo $name;
    // echo $id;
    $sql = "DELETE FROM `categories` WHERE `category_name`='$name' and `user_id` = $id limit 1";
    $result = mysqli_query($conn, $sql);
    // print_r($result);
    include_once('categories.php');
} else {
    $err_name = "<p id='error'>Please enter category name then  enter delete</p>";
    include_once('deletecategories.php');
}