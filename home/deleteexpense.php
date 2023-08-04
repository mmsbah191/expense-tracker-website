<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    interface home\deleteexpense.php
-->

<?php include("../include/is_login.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Expenses</title>
</head>

<body>
    <div class="main">

        <div class="left">
            <img src="../Icon/outlined-96.png" alt="My picure">
            <br>
            <h1><strong>Expenses</strong></h1>
        </div>
        <i>Track expenses and manage your financial life with us</h5>
            <br><br>
            <h3>Delete Expenses</h3>




            <?php include("../include/connect.php");
            include("../include/functions.php");
            $id = $_SESSION['id'];

            $sql = "SELECT title FROM `expenses` 
              INNER JOIN categories ON expenses.category_id = categories.category_id
                      INNER JOIN payment_account ON expenses.payment_id = payment_account.payment_id
        WHERE categories.user_id = $id AND payment_account.user_id =$id and categories.type ='expense'";

            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $expenses = array_column($rows, 'title');
            // print_r($expenses)
            ?>

            <form action="deleteexpense_post.php" method="POST">
                <select class=ss name="name" search>
                    <option selected disabled>
                        <?php if (isset($name)) echo $name;
                        else echo "Choose expense" ?>
                    </option>
                    <?php foreach ($expenses as $expense) { ?>
                    <option value="<?php echo $expense ?>"><?php echo $expense ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="delete">delete</button>
                <?php
                if (isset($err_name)) {
                    echo $err_name;
                }
                ?>
            </form>

            <br>
            <a class=aa href="expense.php">Return</a>

    </div>
</body>

</html>