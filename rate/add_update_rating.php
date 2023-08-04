<!-- 
    Name: Mohammed Ibrahim
    date: 29/7/2023
    interface fornt end rate\add_update_rating.php
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
    <title>Rating</title>
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


            <?php include("../include/connect.php");
            $id = $_SESSION['id'];

            $sql = "SELECT rate,comment FROM `rating` WHERE user_id='$id' ";
            $result = mysqli_query($conn, $sql);
            $nums_rows = mysqli_num_rows($result);
            if ($nums_rows === 0) {
                echo '<h3>Add Rating</h3>';
            } else {
                echo '<h3>Updating Rating</h3>';
                $rows = mysqli_fetch_assoc($result);
                $rating = $rows['rate'];
                $comment = $rows['comment'];
            }
            // echo $nums_rows;
            // print_r($rows['comment']);
            ?>


            <form action="add_update_rating_post.php" method="POST">
                <input class='kk' type="text" name=nums_rows value=<?php echo $nums_rows; ?>>
                <label>Rating Expense Tracker wep site:</label><select class=ss name="rating" search>
                    <?php for ($i = 1; $i <= 5; $i++) {
                        echo "<option selected value=$i>$i</option>";
                    }
                    echo !isset($rating) ? '' : "<option selected value=$rating>$rating</option>";
                    ?> </select>
                <br>
                <?php
                if (isset($err_rating)) {
                    echo $err_rating;
                }
                ?>


                <label>Comment:</label>
                <textarea required name="comment" id="" cols="30" rows="10"
                    placeholder="Comment require"><?php echo !isset($comment) ?
                                                                                                                '' : $comment ?></textarea>
                <br>
                <?php
                if (isset($err_comment)) {
                    echo $err_comment;
                }
                ?> <button type=" submit" name="sbmt">Rating</button>
                <br>
                <a class=aa href="rating.php">return</a>
            </form>
            <br>

    </div>
</body>

</html>