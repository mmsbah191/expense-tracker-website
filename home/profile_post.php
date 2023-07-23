<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
The name file is expressive
*/ -->
<?php

include("../include/connect.php");
include("../include/functions.php");
 include('../include/data.php');



if (isset($_POST['sbmt'])) {
    //data validition: remove '/' for clean inputs of scribts and suitable data form prepare  
    $nm = ucfirst((stripcslashes(strtolower($_POST['nm']))));
    $usrnm = strtolower(stripcslashes($_POST['usrnm']));
    $eml = strtolower(stripcslashes($_POST['eml']));
    $phn = (int)($_POST['phn']);
    $ag = (int)($_POST['ag']);



    //remove sql queries and scribts
    $nm = sanitize($conn, $nm);
    $usrnm = sanitize($conn, $usrnm);
    $eml = sanitize($conn, $eml);
    $phn = sanitize($conn, $phn);
    $ag = sanitize($conn, $ag);


    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];
        //نحن بحاجة للتحقق من شكل البيانات وصحتها قبل إرسالها لقاعدة البيانات
    if ($name !== $nm) {
        if (empty($nm)) {
            $err_nm = "<p id='error'>Please enter your name</p>";
            $err = 1;
        } elseif (strlen($nm) < 1) {
            $err_nm = "<p id='error'>Name needs to have mimimum of 1 letters</p>";
            $err = 1;
        } elseif (strlen($nm) > 100) {
            $err_nm = "<p id='error'>Name needs to have maximum of 24 letters</p>";
            $err = 1;
        } elseif (contains_digit($nm)) {
            $err_nm = "<p id='error'>Name must not contains digits</p>";
            $err = 1;
        }else{
             $sql = "UPDATE `users` SET  `name` = '$nm' WHERE `users`.`id`='$id';";
        mysqli_query($conn, $sql);
        }
       
    }


    if ($username !== $usrnm) {
        //Check if the username is duplicated
        $check_usrnm = "SELECT * FROM `users` WHERE username = '$usrnm' or username='$username'";
        $check_result = mysqli_query($conn, $check_usrnm);
        $num_rows = mysqli_num_rows($check_result);
        // echo $num_rows;
        if ($num_rows >= 2) {
            $err_usrnm = "<p id='error' >sorry not valid, username already exists</p> ";
            $err = 1;
        } elseif (empty($usrnm)) {
            $err_usrnm = "<p id='error'>Please enter username</p>";
            $err = 1;
        } elseif (strlen($usrnm) < 10) {
            $err_usrnm = "<p id='error'>Username needs to have mimimum of 10 letters</p>";
            $err = 1;
        } elseif (strlen($usrnm) > 15) {
            $err_usrnm = "<p id='error'>Username needs to have maximum of 15 letters</p>";
            $err = 1;
        } elseif (!ctype_alnum($usrnm)) {
            $err_usrnm = "<p id='error'>Username must is letters  digits or both</p>";
            $err = 1;
        } else {
            $sql = "UPDATE `users` SET  `username` = '$usrnm' WHERE `users`.`id`='$id';";
            mysqli_query($conn, $sql);
            $_SESSION['username'] = $usrnm;
            setcookie('username', $usrnm, time() + 3600, '/');
        }
    }



    //need edit
    if ($email !== $eml) {
        $check_eml = "SELECT * FROM `users` WHERE email = '$eml' limit 1";
        $check_result = mysqli_query($conn, $check_eml);
        $num_rows = mysqli_num_rows($check_result);
        // echo "res: " . "$num_rows";
        if ($num_rows!=0) { //if var!=0 username exixts 
            $err_eml = "<p id='error' >sorry not valid, email already exists</p> ";
            $err = 1;
        } elseif (empty($eml)) {
            $err_eml = "<p id='error'>Please enter email</p>";
            $err = 1;
        } elseif (!filter_var($eml, FILTER_VALIDATE_EMAIL)) {
            $err_eml = "<p id='error'>Please enter currect email</p>";
            $err = 1;
        }else{
        $sql = "UPDATE `users` SET  `email` = '$eml' WHERE `users`.`id`='$id';";
        mysqli_query($conn, $sql);
        }
    }





    if ($phone !== $phn) {
        $check_phn = "SELECT * FROM `users` WHERE phone = '$phn' limit 1";
        $check_result = mysqli_query($conn, $check_phn);
        $num_rows = mysqli_num_rows($check_result);
        // echo "res: "."$num_rows";
        if ($num_rows !=0) { 
            $err_phn = "<p id='error' >sorry not valid, phone already exists</p> ";
            $err = 1;
        } elseif (empty($phn)) {
            $err_phn = "<p id='error'>Enter phone number</p>";
            $err = 1;
        } elseif (!ctype_digit($phn)) {
            $err_phn = "<p id='error'>phone not digits</p>";
            $err = 1;
        }else{
        $sql = "UPDATE `users` SET  `phone` = '$phn' WHERE `users`.`id`='$id';";
        mysqli_query($conn, $sql);
        }
    }


    if ($age !== $ag) {
        if (empty($ag)) {
            $err_ag = "<p id='error'>Enter your age</p>";
            $err = 1;
        } elseif (!ctype_digit($phn)) {
            $err_ag = "<p id='error'>age not digits</p>";
            $err = 1;
        }
        $sql = "UPDATE `users` SET  `age` = '$ag' WHERE `users`.`id`='$id';";
        mysqli_query($conn, $sql);
    }





    if (isset($err)) {
        include('profile.php');
        exit();
    } elseif (isset($sql)) {
        $time = date('Y-m-d H:i:s');
        $sql = "UPDATE `users` SET  `updated_at` = '$time' WHERE `users`.`id`='$id';";
        mysqli_query($conn, $sql);
        echo "<script>alert('Successfully registered, log in to start Expense Tracker2')</script>";
        include('home.php');
        exit();
    }
}else{
    include('profile.php');
    exit();
}