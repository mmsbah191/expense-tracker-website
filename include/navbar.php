<!-- /* Name: Mohammed Ibrahim
date: 11/6/2023
*/ -->
<?php
require_once 'connect.php';

// Retrieve the user's avatar from the database based on their ID
$id = $_COOKIE['id'];
$sql = "SELECT avatar FROM users WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$img = '';
if ($row = mysqli_fetch_assoc($result)) {
    $img = $row['avatar'];
}

// Start the grid container
?>
<div class="grid">
    <!-- Top section -->
    <div class="left">
        <a href="../home/home.php">
            <img class="pp" src="../Icon/outlined-96.png" alt="My picture">
        </a>
        <br>
        <a class="aa" href="../home/home.php">Expense Tracker</a>
    </div>
    <div class="middle1">
        <nav>
            <li><a href="../home/expense.php">Expenses</a></li>
            <li><a href="../home/income.php">Incomes</a></li>
            <li><a href="../home/Categories.php">Categories</a></li>
            <li data="Transfer"><a href="../transfer/transfer.php">Transfer</a></li>
            <li><a href="../rate/rating.php">Rating</a></li>
        </nav>
    </div>
    <div class="right">
        <!-- User profile section -->
        <a id="imgr" href="../home/upload.php">
            <img id="img3" class="pp" src="../Icon/<?php echo $img ?>" alt="My profile">
        </a>
        <br>
        <a href="../home/profile.php">
            <p class="pp"><?php echo $_SESSION['username'] ?></p>
        </a>
        <div class="btna">
            <form action="../home/navbar_post.php" method="post">
                <button class="aa" name="Profile">Profile</button>
                <button class="aa" name="Sitting">Settings</button>
                <br>
                <button class="aa" name="Signout">Sign out</button>
                <button class="aa" name="Logout">Log out</button>
                <!-- <a href="logout.php">Logout</a> -->
            </form>
        </div>
    </div>
</div>