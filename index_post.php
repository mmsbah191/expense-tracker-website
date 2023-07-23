<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
backend login file

*/ -->

<?php
session_start();


include("include/connect.php");
include("include/functions.php");


first:
if (isset($_POST['sbmt'])) {

    // Validate input
    $username = strtolower(stripcslashes($_POST['username']));
    $password = stripcslashes($_POST['password']);

    //remove sql queries and scribts htmlentities
    $username = sanitize($conn, $username);
    $password = sanitize($conn,$password);
    $md5_pass = md5($password);


  
    
    if (isset($_POST['keep'])) {
        $keep = (int)(stripcslashes($_POST['keep']));
        if ($keep == 1) {
            setcookie('username', $_POST['username'], time() + 3600, '/');
            setcookie('password', $_POST['password'], time() + 3600, '/');
        }
    }



 

    username:
    if (empty($username)) {
        $err_username = "<p id='error'>Please insert username</p>";
    }

    if (empty($password)) {
        $err_password = "<p id='error' >please insert password</p><br/>";
    }

    //Check if the username is not already existing
    $check_username = "SELECT id  FROM `users` WHERE username = '$username' or email = '$username' limit 1";
    $check_result = mysqli_query($conn, $check_username);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows == 0) { //if var==0 username not exixts 
        $err_password = "<p id='error'>Not Fuond username or wrong password1</p>";
    } //end if username



    mid:
    if (isset($err_username) or isset($err_password)) {
        include_once("index.php");//login page
    } else {
        $sql = "SELECT id,username,password,email FROM `users` 
        WHERE (username = '$username'  or email = '$username' )
         and (md5_pass='$md5_pass' or password='$password') limit 1"; // password='$password' for doctor
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        // $num_rows=mysqli_num_rows($result); 
        mysqli_close($conn);
        // print_r($num_rows);
        if ($row == 0) { //if var==0 username not exists  or password not matching maen no rows returned
            $err_password = "<p id='error'>Not Fuond username or wrong password2</p>";
            include_once("index.php");
        } elseif (($row['username'] === $username or $row['email'] === $username) and $row['password'] === $password) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            setcookie('id', $row['id']); //
            header("location:home/home.php"); //home page
            exit();
        } else {
            $err_password = "<p id='error'>Not Fuond username or wrong password3</p>";
            include_once("index.php");
        }
    } //end mid
} //end first if
session_destroy();
?>