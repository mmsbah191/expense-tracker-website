<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
login file
*/ -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Log in</title>
</head>

<body>
    <div class="main">
        <?php include('include/logoname.html') ?>

        <br><br>
        <h3>login</h3>
        <form action="index_post.php" class="form" method="post">

            <!-- <?php
                    // if (isset($err_data) and !isset($err_username) and !isset($err_password))
                    //     echo $err_data;
                    // 
                    ?> -->
            <input type="text" name="username" placeholder="username or email or phone"
                value="<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username'];
                                                                                                elseif (isset($username)) echo $username ?>"><br>
            <?php
            if (isset($err_username))
                echo $err_username;
            ?>
            <input type="password" name="password" placeholder="password"
                value="<?php if (isset($_COOKIE['password']))
                                                                                        echo $_COOKIE['password'];
                                                                                    elseif (isset($password)) echo $password ?>">
            <br>
            <?php
            if (isset($err_password) and !empty($username))
                echo $err_password;
            ?>
            <label style="color:black"><input type="checkbox" name='keep' id=keep value=1>keep me signed in</label>
            <div class=btn>
                <button type="submit" name="sbmt">Login Now</button><br>

                <a href="reset.php">Forgot password?</a>
            </div>
        </form>
        <br>
        <h5>If you do not have an account, <a href="register.php">Creat an account</a></h5>
    </div>
</body>

</html>