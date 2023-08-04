<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
  interface  home\updateexpense.php
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
        <i>Track expenses and manage your financial life with us</i>
        <br><br>
        <h3>Update Expense</h3>

        <?php include("../include/connect.php");
        $id = $_SESSION['id'];

        $sql = "SELECT expenses.title FROM expenses
        INNER JOIN categories ON expenses.category_id = categories.category_id
        INNER JOIN payment_account ON expenses.payment_id = payment_account.payment_id
        WHERE categories.user_id = $id AND payment_account.user_id =$id";

        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $expenses = array_column($rows, 'title');
        // print_r($expenses);
        ?>

        <form action="updateexpense_select.php" method="POST">
            <select class=ss name="title" search>
                <option selected disabled>
                    <?php if (isset($title)) echo "Choose other expense";
                    else echo "Choose expense" ?>
                </option>
                <?php foreach ($expenses as $expense) { ?>
                <option value="<?php echo $expense ?>"><?php echo $expense ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="upload">upload</button>
            <?php
            if (isset($err_title)) {
                echo $err_title;
            }
            ?>
        </form>



        <?php
        $sql = "SELECT category_name FROM `categories` WHERE user_id='$id' ";
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

        <form action="updateexpense_post.php" method="POST">

            <?php if (isset($expense_id)) echo " <input class='kk' name='expense_id' type='number'  value='$expense_id'>" ?>
            <?php if (isset($category)) echo " <input class='kk' name='old_category' type='text'  value='$category'>" ?>
            <?php if (isset($payment)) echo " <input class='kk' name='old_payment' type='text'  value='$payment'>" ?>

            <?php if (isset($amount)) echo " <input class='kk' name='old_amount' type='number'  value='$amount'>" ?>

            <label for="">expense name:</label><input type="text" name="title" placeholder="Expense_name"
                value="<?php if (isset($title)) echo $title ?>"><br>
            <?php
            if (isset($err_new_title)) {
                echo $err_new_title;
            }
            ?>

            <label>category: </label><select class="ss" name="category" search>
                <option selected <?php echo empty($category) ? 'disabled' : ''; ?>>
                    <?php echo isset($category) ? $category : 'Choose category'; ?>
                </option>
                <?php foreach ($categories as $cate) : ?>
                <option value="<?php echo $cate; ?>"><?php echo $cate; ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo isset($err_category) ? $err_category : ''; ?>


            <label>payment: </label><select class="ss" name="payment" search>
                <option selected <?php echo empty($payment) ? 'disabled' : ''; ?>>
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



            <label>amount: </label><input type="number" name="amount" placeholder="Price"
                value="<?php if (isset($amount)) echo $amount ?>"><br>
            <?php
            if (isset($err_amount)) {
                echo $err_amount;
            }
            ?>

            <label>date: </label><input type="date" name="date" placeholder="expense_date if empty take today date"
                value="<?php if (isset($date)) echo $date;
                                                                                                                            else echo date('Y-m-d'); ?>"><br>
            <?php
            if (isset($err_date)) {
                echo $err_date;
            }
            ?>

            <label>bill: </label><input type="text" name="bill" placeholder="bill or recipt or picture or pdf"
                value="<?php if (isset($bill)) echo $bill ?>"><br>
            <?php
            if (isset($err_bill)) {
                echo $err_bill;
            }
            ?>

            <label>notes: </label><input type="text" name="notes" placeholder="Notes or Comments"
                value="<?php if (isset($notes)) echo $notes ?>"><br>


            <button type=" submit" name="sbmt">Update expense</button>
            <br>
            <a class=aa href="expense.php">Expense</a>
        </form>
        <br>

    </div>
</body>

</html>