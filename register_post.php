<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
The name file is expressive
*/ -->
<?php

include("include/connect.php");
include("include/functions.php");



if (isset($_POST['sbmt'])) {
    //data validition: remove '/' for clean inputs of scribts and suitable data form prepare  
    $name = data_validition($conn,$_POST['name']);
    $username = strtolower(stripcslashes($_POST['username']));
    $password = stripcslashes($_POST['password']); //doctor: for testing  purposes not required for database
    $email = strtolower(stripcslashes($_POST['email']));
    $phone = (int)data_validition($conn,$_POST['phone']);


    $username = sanitize($conn, $username);
    $password = sanitize($conn, $password);
    $email = sanitize($conn, $email);

    $md5_pss = md5($password);

    //نحن بحاجة للتحقق من شكل البيانات وصحتها قبل إرسالها لقاعدة البيانات
    if (empty($name)) {
        $err_name = "<p id='error'>Please enter your name</p>";
        $err = 1;
    } elseif (strlen($name) < 1) {
        $err_name = "<p id='error'>Name needs to have mimimum of 1 letters</p>";
        $err = 1;
    } elseif (strlen($name) > 100) {
        $err_name = "<p id='error'>Name needs to have maximum of 24 letters</p>";
        $err = 1;
    } elseif (contains_digit($name)) {
        $err_name = "<p id='error'>Name must not contains digits</p>";
        $err = 1;
    }

    //Check if the username is duplicated
    $check_username = "SELECT * FROM `users` WHERE username = '$username' ";
    $check_result = mysqli_query($conn, $check_username);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) { //if var!=0 username exixts 
        $err_username = "<p id='error' >sorry not valid, username already exists</p> ";
        $err = 1;
    }


    if (empty($username)) {
        $err_username = "<p id='error'>Please enter username</p>";
        $err = 1;
    } elseif (strlen($username) < 10) {
        $err_username = "<p id='error'>Username needs to have mimimum of 10 letters</p>";
        $err = 1;
    } elseif (strlen($username) > 15) {
        $err_username = "<p id='error'>Username needs to have maximum of 15 letters</p>";
        $err = 1;
    } elseif (!ctype_alnum($username)) {
        $err_username = "<p id='error'>Username must is letters  digits or both</p>";
        $err = 1;
    }




    $check_email = "SELECT * FROM `users` WHERE email = '$email' ";
    $check_result = mysqli_query($conn, $check_email);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) { //if var!=0 username exixts 
        $err_email = "<p id='error' >sorry not valid, email already exists</p> ";
        $err = 1;
    }


    if (empty($email)) {
        $err_email = "<p id='error'>Please enter email</p>";
        $err = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_email = "<p id='error'>Please enter currect email</p>";
        $err = 1;
    }

    $check_phone = "SELECT * FROM `users` WHERE phone = '$phone' ";
    $check_result = mysqli_query($conn, $check_phone);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) { //if var!=0 username exixts 
        $err_phone = "<p id='error' >sorry not valid, phone already exists</p> ";
        $err = 1;
    }


    if (empty($phone) or $phone===0) {
        $err_phone = "<p id='error'>Enter phone number</p>";
        $err = 1;
    } elseif (!ctype_digit($phone)) {
        $err_phone = "<p id='error'>phone not digits</p>";
        $err = 1;
    }

    if (empty($password)) {
        $err_password = "<p id='error' >please enter password</p><br/>";
        $err = 1;
    } elseif (strlen($password) < 10) {
        $err_password = "<p id='error'>The password must contain at least 10-14 characters.</p>";
        $err = 1;
    } elseif (strlen($password) > 14) {
        $err_password = "<p id='error'>The password must contain at max 10-14 characters.</p>";
        $err = 1;
    } elseif (!valid_password($password)) {
        $err_password = "<p id='error'>lowercase, uppercase, digits(0-9), and at least one unique character (e.g.,
        +/$#@%^&*<> ). </p>";
        $err = 1;
    }


    $time = date('Y-m-d H:i:s');

    if (isset($err)) {
        include_once('register.php');
        exit();
    } else {
        $picture = 'male.png';
        if (str_ends_with($name, 'a')) {
            $picture = 'famale.png';
        } //need to add gender next days for default pictureture

        $sql = "INSERT INTO 
        `users` (`id`, `name`, `username`, `age`, `email`,`phone`, `password`, `md5_pass`, `timezone`, `avatar`, `created_at`, `updated_at`) 
        VALUES (NULL, '$name', '$username', NULL, '$email', '$phone', '$password', '$md5_pss', '247','$picture', '$time', '$time')";
        mysqli_query($conn, $sql);
        echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
        include('index.php');
        exit();
    }
}else{
    include_once('register.php');
    exit();
}