<?php
include("../include/connect.php");


include_once("../include/functions.php");



if (isset($_POST['upload']) and isset($_POST['name'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];
    $name = data_validition($conn, $_POST['name']);
    // echo $name;
    // echo $id;
    $sql = "SELECT category_id,category_name,type,budget,notes FROM `categories` WHERE category_name='$name' and user_id=$id limit 1";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    if ($rows) {
        // echo '<br>num: ' . mysqli_num_rows($result);
        $category_id = $rows['category_id'];
        $name = $rows['category_name'];
        $type = $rows['type'];
        $amount = $rows['budget'];
        $notes = $rows['notes'];
        $err_name = null;
        include_once('updatecategories.php');
    } else { // If the value is manipulated in the html code with browser
        $err_name = "<p id='error'>Please enter your name then upload data</p>";
        include_once('updatecategories.php');
    }
} else {
    $err_name = "<p id='error'>Please enter category name then upload data</p>";
    include_once('updatecategories.php');
}