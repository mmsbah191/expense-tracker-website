<!-- 
    Name: Mohammed Ibrahim
    date: 29/7/2023
    main page for transfer
-->
<?php
include_once('../include/is_login.php');
include('../include/head.html');
?>

<body>
    <?php include('../include/navbar.php'); ?>

    <div class="main" style="  align-items: start;">
        <div class="left">
            <nav>
                <ul>
                    <li data="transfer"><a href="addtransfer.php">transfer between categories</a></li>
                    <li data="Show a trnsfr"><a href="showtransfer.php">Show transfer</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <?php include('../include/footer.html'); ?>


</body>

</html>