<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
  //path=../home/profile.php
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
    <title>profile</title>
</head>

<body>
    <div class="main">

        <div class="left">
            <img src="../Icon/outlined-96.png" alt="My picure">
            <br>
            <h1><strong>Profile Expense Tracker</strong></h1>
        </div>
        <i>Track expenses and manage your financial life with us</h5>
            <br><br>
            <h3>Edit profile</h3>


            <form action="profile_post.php" method="POST">


                <?php
                include('../include/data.php');
                ?>
                <label>name:</label><input type="text" name="nm" placeholder="name" value="<?php echo $name ?>"><br>
                <?php
                if (isset($err_nm)) {
                    echo $err_nm;
                }
                ?>

                <label>username:</label><input type=" text" name="usrnm" placeholder="username"
                    value="<?php echo $username ?>"><br>
                <?php
                if (isset($err_usrnm)) {
                    echo $err_usrnm;
                }
                ?>

                <label>phone:</label><input type=" number" name="phn" placeholder="phone"
                    value="<?php echo $phone ?>"><br>
                <?php
                if (isset($err_phn)) {
                    echo $err_phn;
                }
                ?>

                <label>email:</label><input type=" email" name="eml" placeholder="email"
                    value="<?php echo $email ?>"><br>
                <?php
                if (isset($err_eml)) {
                    echo $err_eml;
                }
                ?>

                <label>age:</label><input type="number" name="ag" placeholder="age" value="<?php echo $age ?>"><br>
                <?php
                if (isset($err_ag)) {
                    echo $err_ag;
                }
                ?>

                <button type=" submit" name="sbmt">Save change</button>
                <br>
                <a class=aa href="profile.php">reset</a>
                <a class=aa href="home.php">Home</a>

            </form>
            <br>
            <h5>Do you want change sitting account? <a href="sitting.php">Sitting</a> </h5>

    </div>
</body>

</html>