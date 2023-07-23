<?php



include('env.php'); //my data $host, $user, $password, $database

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn)


die("Error " . mysqli_connect_error());
// else
// echo "seccsfully connected";