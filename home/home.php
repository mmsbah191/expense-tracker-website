<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
-->

<?php


include_once('../include/is_login.php');
// لمنع الدخول الغير مصرح به في الجلسة من متصفح أخر وتعمدت عكس الشرط لإظهار امكانية الكتابة ب بي اتش بي بين اتش تي ام ال  

//head
include('../include/head.html');

?>

<body>
    <?php include('../include/navbar.php'); ?>

    <div class="main">
        <div class="left">
            <nav>
                <ul>
                    <li data="Add an expense"><a href="expense.php">Expenses</a></li>
                    <li data="Add an income"><a href="Income.php">Income</a></li>
                    <li data="Add an categories"><a href="categories.php">Categories</a></li>
                    <li data="Transfer"><a href="../transfer/transfer.php">Transfer</a></li>
                    <li data="Payment Methods"><a href="Payment_accounts.php">Payment Methods</a></li>
                </ul>
            </nav>
        </div>
    </div>


    <?php include('../include/footer.html'); ?>


</body>

</html>