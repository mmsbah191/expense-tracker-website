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
    <title>Categories</title>
</head>

<body>
    <div class="main">

        <div class="left">
            <img src="../Icon/outlined-96.png" alt="My picure">
            <br>
            <h1><strong>Categories</strong></h1>
        </div>
        <i>Track expenses and manage your financial life with us</h5>
            <br><br>
            <h3>Delete Categories</h3>




            <?php include("../include/connect.php");
                $id = $_SESSION['id'];

            $sql = "SELECT category_name FROM `categories` WHERE user_id='$id' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $categories = array_column($rows, 'category_name');
            ?>

            <form action="deletecategories_post.php" method="POST">
                <select class=ss name="name" search>
                    <option selected disabled>
                        <?php if (isset($name)) echo $name;
                        else echo "Choose category" ?>
                    </option>
                    <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category ?>"><?php echo $category ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="delete">Delete category</button>
                <?php
                if (isset($err_name)) {
                    echo $err_name;
                }
                ?>
            </form>

            <br>
            <a class=aa href="categories.php">Categories</a>

    </div>
</body>

</html>