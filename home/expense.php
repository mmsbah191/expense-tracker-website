<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
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
                    <li data="Add a expense"><a href="addexpense.php">Add a expense</a></li>
                    <li data="Edit a expense"><a href="updateexpense.php">Edit a expense</a></li>
                    <li data="Delete a expense"><a href="deleteexpense.php">delete a expense</a></li>
                    <li data="Search a expenses"><a href="searchexpense.php">Search a expense</a></li>
                    <li data="Show a expenses"><a href="showexpense.php">Show a expense</a></li>
                    <!-- <li data="Payment Methods"><a href=""></a></li> -->
                </ul>
            </nav>
        </div>
    </div>

    <?php include('../include/footer.html'); ?>


</body>

</html>