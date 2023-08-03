<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
The name file is expressive
*/ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>register</title>
</head>

<body>
    <div class="main">

        <?php include('include/logoname.html') ?>

        <br><br>
        <h3>Register</h3>


        <form action="register_post.php" method="POST">

            <input type="text" name="name" placeholder="name" value="<?php if (isset($name)) echo $name ?>"><br>
            <?php
            if (isset($err_name)) {
                echo $err_name;
            }
            ?>
            <input type="text" name="username" placeholder="username"
                value="<?php if (isset($username)) echo $username ?>"><br>
            <?php
            if (isset($err_username)) {
                echo $err_username;
            }
            ?>
            <input type="number" name="phone" placeholder="phone" value="<?php if (isset($phone)) echo $phone ?>"><br>
            <?php
            if (isset($err_phone)) {
                echo $err_phone;
            }
            ?>
            <input type="email" name="email" placeholder="email" value="<?php if (isset($email)) echo $email ?>"><br>
            <?php
            if (isset($err_email)) {
                echo $err_email;
            }
            ?>
            <input type="password" name="password" placeholder="password"
                value="<?php if (isset($password)) echo $password ?>"><br>
            <?php
            if (isset($err_password)) {
                echo $err_password;
            }
            ?>
            <button type="submit" name="sbmt">Register</button>
            <!-- <input type="submit" name="sbmt" value="Register"> -->
        </form>
        <br>
        <h5>Do you have account? <a href="index.php">Log now</a> </h5>

    </div>
</body>

</html>