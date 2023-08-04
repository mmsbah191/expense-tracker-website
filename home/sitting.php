<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
*/ -->


<?php include("../include/is_login.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Sitting</title>
</head>

<body>
    <div class="main">

        <div class="left">
            <img src="../Icon/outlined-96.png" alt="My picure">
            <br>
            <h1><strong>Sitting Expense Tracker</strong></h1>
        </div>
        <i>Track expenses and manage your financial life with us</h5>
            <br><br>
            <h3>Sitting Account</h3>



            <form action="sitting_post.php" method="POST">




                <input name="psswrd" type="password" placeholder="password"><br>
                <?php

                ?>
                <input name="newpss1" type="text" placeholder="new password"><br>
                <?php

                ?>
                <input name="newpss2" type="text" placeholder="again type new password"><br>
                <?php
                if (isset($err_psswrd)) {
                    echo $err_psswrd;
                }
                ?>

                <button type=" submit" name="sbmt">Change password</button>
                <br>
                <a class=aa href="sitting.php">Reset</a>
                <a class=aa href="home.php">Home</a>

            </form>
            <br>
            <h5>Do you want change Profile data? <a href="profile.php">Profile</a> </h5>

    </div>
</body>

</html>