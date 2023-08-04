<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
    
-->
<?php
include("../include/connect.php");
// include_once("../include/functions.php");



if (isset($_POST['delete']) and isset($_POST['name'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id = $_SESSION['id'];;
    $name = $_POST['name'];
    // echo $name;
    // echo $id;
    $sql = "DELETE expenses FROM expenses
    INNER JOIN categories ON expenses.category_id = categories.category_id
        INNER JOIN payment_account ON expenses.payment_id = payment_account.payment_id
        WHERE categories.user_id = $id AND payment_account.user_id =$id and title='$name'";

    $result = mysqli_query($conn, $sql);
    // print_r($result);
    include_once('expense.php');
} else {
    $err_name = "<p id='error'>Please enter expense name then  enter delete</p>";
    include_once('deleteexpense.php');
}