 <!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
*/ -->
 <?php
  //data for users

  include("../include/is_login.php");

  // include('../include/data.php');
  include("../include/connect.php");
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $id = $_SESSION['id'];
  $sql = "SELECT name,username,phone,email,age,avatar FROM users
 WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $name = $row['name'];
  $username = $row['username'];
  $phone = $row['phone'];
  $email = $row['email'];
  $age = $row['age'];
  $img = $row['avatar'];
  $k = null;
  ?>