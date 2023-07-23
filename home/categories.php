<!-- 
    Name: Mohammed Ibrahim
    date: 11/6/2023
    
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

    <!-- <br>
    <?php
    include("../include/connect.php");
    $id = $_SESSION['id'];
    $sql = "SELECT category_name,type,amount FROM `categories` 
        WHERE 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    print_r($row);
    foreach ($row as $a) {
        echo "<h1>$a</i>";
    }
    ?> -->


    <?php include('../include/footer.html'); ?>


</body>

</html>