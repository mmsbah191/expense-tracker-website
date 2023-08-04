<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
*/ -->
<?php

include("../include/connect.php");
include_once("../include/functions.php");
include('../include/data.php');


if (isset($_POST['sbmt'])) {//need sitting

    $psswrd = stripcslashes($_POST['psswrd']);
    $psswrd = sanitize($conn, $psswrd);

    $newpss1 = stripcslashes($_POST['newpss1']);
    $newpss1 = sanitize($conn, $psswrd);

    $newpss2 = stripcslashes($_POST['newpss2']);
    $newpss2 = sanitize($conn, $psswrd);

    if (session_status() == PHP_SESSION_NONE
    ) {
        session_start();
    }
    $id = $_SESSION['id'];
    
    if ($newpss1 != $newpss2) {
        $err_psswrd = "<p id='error'>Not matching password</p>";
        $err = 1;
        include("sitting.php");
        exit();
    } else {
        $sql = "SELECT * FROM `users` 
        WHERE id = '$id' and password='$psswrd' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        // print_r($row);
        if ($row == 0) { //if var==0 username not exists  or password not matching maen no rows returned
            $err_psswrd = "<p id='error'>wrong password</p>";
            $err = 1;
            include("sitting.php");
            exit();
        } else {
            if (empty($psswrd)) {
                $err_psswrd = "<p id='error' >please enter password</p><br/>";
                $err = 1;
            } elseif (strlen($psswrd) < 10) {
                $err_psswrd = "<p id='error'>The password must contain at least 10-14 characters.</p>";
                $err = 1;
            } elseif (strlen($psswrd) > 14) {
                $err_psswrd = "<p id='error'>The password must contain at max 10-14 characters.</p>";
                $err = 1;
            } elseif (!valid_password($psswrd)) {
                $err_psswrd = "<p id='error'>lowercase, uppercase, digits(0-9), and at least one unique character (e.g.,
                +/$#@%^&*<> ). </p>";
                $err = 1;
            } else {
                $sql = "UPDATE `users` SET  `password` = '$newpss1' WHERE `users`.`id`='$id';";
                mysqli_query($conn, $sql);
                setcookie('password', $newpss1, time() + 3600, '/');
            }
        }

        if (isset($err)) {
            include("sitting.php");
            exit();
        } elseif (isset($sql)) {
            $time = date('Y-m-d H:i:s');
            $sql = "UPDATE `users` SET  `updated_at` = '$time' WHERE `users`.`id`='$id';";
            mysqli_query($conn, $sql);
            echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
            include('home.php');
            exit();
        }
    }
}else
    include("sitting.php");