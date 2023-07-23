<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
  //path=../home/profile.php
*/ -->



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
            <h3>Search Expense</h3>
            <br>

            <?php include("../include/connect.php");
            include("../include/is_login.php");

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $id = $_SESSION['id'];

            $sql = "SELECT category_name FROM `categories` WHERE user_id='$id' and categories.type ='expense' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $categories = array_column($rows, 'category_name');
            // print_r($categories);
            $sql = "SELECT payment_name FROM `payment_account` WHERE user_id='$id' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $payments = array_column($rows, 'payment_name');
            // print_r($payments);
            ?>

            <form action="searchexpense_post.php" method="POST">

                <label>Choose categories</label><select class="ss" name="category" size="1">
                    <option selected value="1">all categories (default)</option>
                    <!-- <option value="all_categories">all categories (default)</option> -->
                    <?php foreach ($categories as $cate) : ?>
                        <option value="<?php echo $cate; ?>"><?php echo $cate; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo isset($err_category) ? $err_category : ''; ?>
                <br>

                <label>Choose payment methods</label><select class="ss" name="payment" size="0">
                    <option selected value="1">all payment methods (default)</option>
                    <!-- <option value="all_payments">all payment methods (default)</option> -->
                    <?php foreach ($payments as $pmt) : ?>
                        <option value="<?php echo $pmt; ?>"><?php echo $pmt; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo isset($err_payment) ? $err_payment : ''; ?>
                <br>

                <?php
                $sql = "SELECT created_at FROM `users` WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $created_at = array_column($rows, 'created_at');
                // print_r(explode(' ',$created_at[0])[0]);
                $created_at = explode(' ', $created_at[0])[0];
                ?>

                <label>expense date from: (default created date)</label><input type="date" name="date_from" placeholder="expense_date if empty take today date" value="<?php if (isset($date_from)) echo $date_from;
                                                                                                                                                                        echo $created_at; ?>"><br>
                <?php
                if (isset($err_date_from)) {
                    echo $err_date_from;
                }
                ?>


                <label>expense date to:(default today date)</label><input type="date" name="date_to" placeholder="expense_date if empty take today date" value="<?php if (isset($date_to)) echo $date_to;
                                                                                                                                                                else echo date('Y-m-d'); ?>"><br>
                <?php
                if (isset($err_date_to)) {
                    echo $err_date_to;
                }
                ?>


                <button type="submit" name="search">Search</button>
                <br>

                <a class=aa href="expense.php">Expense</a>

            </form>
            <br>

    </div>
</body>

</html>