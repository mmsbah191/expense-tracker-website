<!-- 
    Name: Mohammed Ibrahim
    date: 22/7/2023
   interface home\showexpense.php
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tables.css">

    <title>Show</title>
</head>

<body>
    <div class="top" align=center>
        <h2>Expenses Show</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>expense_id</th>
                <th>category_name</th>
                <th>payment_name</th>
                <th>title</th>
                <th>amount</th>
                <th>expense_date</th>
                <!-- <th>bill</th> -->
                <!-- for pictyre later -->
                <th>notes</th>
                <th>created_at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("../include/is_login.php");
            include("../include/connect.php");
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $id = $_SESSION['id'];

            $sql = "SELECT * FROM `expenses` INNER JOIN categories ON expenses.category_id = categories.category_id
            WHERE categories.user_id = $id ";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_all($result);

            $count = 1;
            foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <!-- <td><?php echo $row[6]; ?></td> -->
                <td><?php echo $row[7]; ?></td>
                <td><?php echo $row[8]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>