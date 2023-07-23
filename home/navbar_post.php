 <!-- Name: Mohammed Ibrahim
 date: 11/6/2023 

-->

 <?php
    // include("../include/data.php");
    if (isset($_POST['Signout'])) {
        session_unset();
        session_reset();
        header('location: ../register.php');
        exit();
    }


    if (isset($_POST['Logout'])) {
        session_unset();
        session_reset();
        header('location: ../index.php');
        echo "<script>window.close();</script>";
        exit();
    }


    if (isset($_POST['Profile'])) {
        header('location: profile.php');
        exit();
    }

    if (isset($_POST['Sitting'])) {
        header('location: Sitting.php');
        exit();
    }

    session_destroy();

    ?>