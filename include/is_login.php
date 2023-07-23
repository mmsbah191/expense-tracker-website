<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['id']) or !isset($_SESSION['username'])) {
// if (count($_SESSION) == 0)
header('location:../index.php');
exit();
}