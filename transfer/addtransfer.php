<!-- 
    Name: Mohammed Ibrahim
    date: 29/7/2023
    interface front end transfer\addtransfer.php
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
    <title>Transfer</title>
</head>

<body>
    <div class="main">

        <div class="left">
            <img src="../Icon/outlined-96.png" alt="My picure">
            <br>
            <h1><strong>Transfer</strong></h1>
        </div>
        <i>Track expenses and manage your financial life with us</h5>
            <br><br>
            <h3>Transfer Between Categories</h3>


            <?php include("../include/connect.php");
            $id = $_SESSION['id'];

            $sql = "SELECT category_name,amount FROM `categories` WHERE user_id='$id' ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $categories = array_column($rows, 'category_name');
            $tansfer = array_column($rows, 'amount');
            // print_r($categories);
            // print_r($tansfer);
            ?>


            <form action="addtransfer_post.php" method="POST">


                <label>Transfer from:</label><select class=ss name="category1" search>
                    <option selected <?php echo isset($category1) ? '' : 'disabled' ?>>
                        <?php echo isset($category1) ? $category1 : "Choose category" ?>
                    </option>
                    <?php for ($i = 0; $i < count($categories); $i++) { ?>
                    <option value="<?php echo $categories[$i] ?>">
                        <?php echo $categories[$i] . '    /tansfer:' . $tansfer[$i] ?>
                    </option>
                    <?php } ?>
                </select> <br>
                <?php
                if (isset($err_category1)) {
                    echo $err_category1;
                }
                ?>

                <label>Transfer to:</label><select class=ss name="category2" search>
                    <option selected <?php echo isset($category2) ? '' : 'disabled' ?>>
                        <?php echo isset($category2) ? $category2 : "Choose category" ?>
                    </option>
                    <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category ?>"><?php echo $category ?></option>
                    <?php } ?>
                </select> <br>
                <?php
                if (isset($err_category2)) {
                    echo $err_category2;
                }
                ?>


                <label>Transfer amount:</label><input type="number" name="amount" placeholder="amount"
                    value="<?php if (isset($amount)) echo $amount ?>"><br>
                <?php
                if (isset($err_amount)) {
                    echo $err_amount;
                }
                ?>

                <label>Notes:</label><input type="text" name="notes" placeholder="Notes or Comments"
                    value="<?php if (isset($notes)) echo $notes ?>"><br>

                <button type=" submit" name="sbmt">Transfer</button>
                <br>
                <a class=aa href="transfer.php">transfer</a>
            </form>
            <br>

    </div>
</body>

</html>