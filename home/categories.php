<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
   interface home\categories.php
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
                    <li data="Add a categories"><a href="addcategories.php">Add a category</a></li>
                    <li data="Edit a categories"><a href="updatecategories.php">Edit a category</a></li>
                    <li data="Delete a categories"><a href="deletecategories.php">delete a category</a></li>
                    <li data="Show a categories"><a href="showcategories.php">Show a category</a></li>
                    <!-- <li data="Payment Methods"><a href=""></a></li> -->
                </ul>
            </nav>
        </div>
    </div>


    <?php include('../include/footer.html'); ?>


</body>

</html>