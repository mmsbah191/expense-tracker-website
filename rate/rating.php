<!-- 
    Name: Mohammed Ibrahim
    date: 29/7/2023
    main page for rating
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
                    <li data="Rating"><a href="add_update_rating.php">Rating</a></li>
                    <li data="Show all Rating"><a href="showrating.php">Show rating</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <?php include('../include/footer.html'); ?>

</body>

</html>