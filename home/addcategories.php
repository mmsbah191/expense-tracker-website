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
            <h3>Add Categories</h3><br>

            <form action="addcategories_post.php" method="POST">

                <input type="text" name="name" placeholder="category_name"
                    value="<?php if (isset($name)) echo $name; ?>"><br>
                <?php
                if (isset($err_name)) {
                    echo $err_name;
                }
                ?>


                <p><select class=ss name="type">
                        <?php echo !isset($type) ? "<option selected disabled>Type category</option>" :
                            "<option value='$type'>$type</option>";
                        ?>
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
                    </select></p>
                <?php
                if (isset($err_type)) {
                    echo $err_type;
                }
                ?> <input type="number" step="0.01" name="amount" placeholder="Budget"
                    value="<?php if (isset($amount)) echo $amount ?>"><br>
                <?php
                if (isset($err_amount)) {
                    echo $err_amount;
                }
                ?>

                <input type="text" name="notes" placeholder="Notes or Comments"
                    value="<?php if (isset($notes)) echo $notes ?>"><br>


                <button type=" submit" name="sbmt">Add categoty</button>
                <br>
                <a class=aa href="categories.php">Categories</a>

            </form>
            <br>

    </div>
</body>

</html>