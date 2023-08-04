<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    interface home\addexpense.php
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
            <h3>Add Expense</h3>

            <?php include("../include/connect.php");
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


            <form action="addexpense_post.php" method="POST">

                <input type="text" name="title" placeholder="Expense_name"
                    value="<?php if (isset($title)) echo $title ?>"><br>
                <?php
                if (isset($err_title)) {
                    echo $err_title;
                }
                ?>
                <label for="">categories</label><select class="ss" name="category" search>
                    <option value="<?php echo isset($category) ? $category : ''; ?>"
                        <?php echo empty($category) ? 'disabled' : 'selected'; ?>>
                        <?php echo isset($category) ? $category : 'Choose category'; ?>
                    </option>
                    <?php foreach ($categories as $cate) : ?>
                    <option value="<?php echo $cate; ?>"><?php echo $cate; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo isset($err_category) ? $err_category : ''; ?>


                <label for="">payment methods</label><select class="ss" name="payment" search>
                    <option value="<?php echo isset($payment) ? $payment : ''; ?>"
                        <?php echo empty($payment) ? 'disabled' : 'selected'; ?>>
                        <?php echo isset($payment) ? $payment : 'Choose payment'; ?>
                    </option>
                    <?php foreach ($payments as $pmt) : ?>
                    <option value="<?php echo $pmt; ?>"><?php echo $pmt; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php echo isset($err_payment) ? $err_payment : ''; ?>
                <br>
                <!-- <p> <select class=ss name="type" value="expensedkk">
                    <option value="expense" selected>add expense</option>
                </select></p>
                <?php
                if (isset($err_type)) {
                    echo $err_type;
                }
                ?> -->



                <input type="number" name="amount" placeholder="Price"
                    value="<?php if (isset($amount)) echo $amount ?>"><br>
                <?php
                if (isset($err_amount)) {
                    echo $err_amount;
                }
                ?>


                <input type="date" name="date" placeholder="expense_date if empty take today date"
                    value="<?php if (isset($date)) echo $date;
                                                                                                            else echo date('Y-m-d'); ?>"><br>
                <?php
                if (isset($err_date)) {
                    echo $err_date;
                }
                ?>

                <input type="text" name="bill" placeholder="bill or recipt or picture or pdf"
                    value="<?php if (isset($bill)) echo $bill ?>"><br>
                <?php
                if (isset($err_bill)) {
                    echo $err_bill;
                }
                ?>

                <input type="text" name="notes" placeholder="Notes or Comments"
                    value="<?php if (isset($notes)) echo $notes ?>"><br>


                <button type=" submit" name="sbmt">Add </button>
                <br>
                <a class=aa href="expense.php">Expense</a>
            </form>
            <br>

    </div>
</body>

</html>