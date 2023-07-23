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
    <title>upload</title>
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



            <form action="upload_post.php" method="POST" enctype="multipart/form-data">

                <?php
                include('../include/data.php');
                ?>

                <h3>picture profile <?php echo $name ?>"</h3>
                <div>
                    <img width=50% hight=50% src="../Icon/<?php echo $img ?>" alt="My profile">
                    <?php
                    if (isset($err)) {
                        echo $err;
                    }
                    ?>
                </div>

                <input class=aa type="file" name="file" value="اهلا">

                <button type="submit" name="upload">Upload</button>
                <br>
                <a class=aa href="upload.php">Reset</a>
                <a class=aa href="home.php">Home</a>

            </form>
            <br>
            <h5>Do you want change Profile data? <a href="profile.php">Profile</a> </h5>

    </div>
</body>

</html>