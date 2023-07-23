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
            <h3>Update Categories</h3>




            <?php include("../include/connect.php");
            $id = $_SESSION['id'];

            $sql = "SELECT category_name FROM `categories` WHERE user_id='$id' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $categories = array_column($rows, 'category_name');
            // print_r($categories);
            ?>

            <form action="updatecategories_select.php" method="POST">
                <select class=ss name="name" search>
                    <option selected disabled>
                        <?php echo "Choose category" ?>
                    </option>
                    <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category ?>"><?php echo $category ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="upload">upload</button>
                <?php
                if (isset($err_name)) {
                    echo $err_name;
                }
                ?>
            </form>

            <form action="updatecategories_post.php" method="POST">

                <?php if (isset($category_id)) echo " <input class='kk' name='category_id' type='number'  value='$category_id'>" ?>
                <?php if (isset($name)) echo " <input class='kk' name='old_name' type='text'  value='$name'>" ?>
                <label>category name:</label><input type="text" name="name" placeholder="name"
                    value="<?php if (isset($name)) echo $name ?>"><br>
                <?php
                if (isset($err_newname)) {
                    echo $err_newname;
                }
                ?>

                <label for="">type:</label><select class=ss name="type" value="<?php if (isset($type)) echo $type ?>">
                    <option value="<?php if (isset($type)) echo $type ?>" selected>
                        <?php if (isset($type)) echo $type; ?>
                    </option>
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </select>
                <?php
                if (isset($err_type)) {
                    echo $err_type;
                }
                ?> <br>

                <label for="">amount:</label><input type="number" name="amount" placeholder="amount"
                    value="<?php if (isset($amount)) echo $amount ?>"><br>
                <?php
                if (isset($err_amount)) {
                    echo $err_amount;
                }
                ?>

                <label for="">notes:</label><input type="text" name="notes" placeholder="Notes or Comments"
                    value="<?php if (isset($notes)) echo $notes ?>"><br>


                <button type=" submit" name="sbmt">Update categoty</button>
                <br>
                <a class=aa href="categories.php">Categories</a>

            </form>
            <br>

    </div>
</body>

</html>