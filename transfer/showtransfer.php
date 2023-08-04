<!-- 
    Name: Mohammed Ibrahim
    date: 29/7/2023
   showtransfer.php
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
        <h2>Transfers Report</h2>
        <p>Today date: <?php echo  date('y-m-d h:i:s') ?></p>
        <a href="../home\home.php">Home</a>
        <a href="transfer.php">tarnsfer</a>
    </div>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>tarnsfer from category</th>
                <th>tarnsfer to</th>
                <th>amount</th>
                <th>notes</th>
                <th>tarnsfer at</th>
            </tr>
        </thead>

        <?php
        include("../include/is_login.php");
        include_once("../include/connect.php");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM `transfer`
                INNER JOIN categories ON transfer.category_from_id = categories.category_id
            WHERE categories.user_id = $id ";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result);
        ?>
        <tbody>
            <?php
            for ($i = 0; $i < count($rows); $i++) {
                // print_r($rows[$i]);
                // echo $rows[$i][1].'<br>';
                $temp = $rows[$i][1];
                $sql = "SELECT category_name FROM `categories` WHERE
                 category_id='$temp' ";
                $result = mysqli_query($conn, $sql);
                $res = mysqli_fetch_assoc($result);
                $rows[$i][1] = $res['category_name'];

                $temp = $rows[$i][2];
                $sql = "SELECT category_name FROM `categories` WHERE
                 category_id='$temp' ";
                $result = mysqli_query($conn, $sql);
                $res = mysqli_fetch_assoc($result);
                $rows[$i][2] = $res['category_name'];
                // print_r($rows[$i][2]);
            }

            $count = 1;
            foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php echo $row[3]; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>