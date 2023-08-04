<!-- 
    Name: Mohammed Ibrahim
    date: 29/7/2023
    showrating.php
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
        <a href="rating.php">Rating</a>
    </div>

    <table>
        <thead>
            <tr>
                <th></th>
                <th>name</th>
                <!-- <th>username</th> -->
                <th>rate</th>
                <th>comment</th>
                <th>created at</th>
                <th>updated at</th>
            </tr>
        </thead>

        <?php
        include("../include/is_login.php");
        include_once("../include/connect.php");

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM `rating`";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_all($result);
        // print_r($rows);
        ?>
        <tbody>
            <?php
            // for ($i = 0; $i < count($rows); $i++) {
            //     print_r($rows[$i]);
            //     echo $id;
            //     $sql = "SELECT name,username FROM `users`
            //         INNER JOIN rating ON users.id = rating.user_id
            //         WHERE rating.user_id = '$id' ";
            //     $result = mysqli_query($conn, $sql);
            //     $res = mysqli_fetch_assoc($result);
            //     $rows[$i][0] = $res['name'];
            //     $rows[$i][1] = $res['username'];
            // }

            $count = 1;
            foreach ($rows as $row) : ?>
            <tr>
                <td><?php echo $count++; ?></td>
                <!-- <td><?php echo $row[0]; ?></td>-->
                <td><?php echo $row[1]; ?></td>
                <!-- <td><?php echo $row[2] ?></td> -->
                <td><?php echo $row[3] . ' stars';; ?></td>
                <td><?php echo $row[4]; ?></td>
                <td><?php echo $row[5]; ?></td>
                <td><?php echo $row[6]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>