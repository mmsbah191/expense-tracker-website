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
        <h2>Expense Report</h2>
        <p>Category: <?php echo $date_from; ?></p>
        <p>Payment methods: <?php echo $date_to; ?></p>
        <p>Date from: <?php echo $date_from; ?></p>
        <p>Date to: <?php echo $date_to; ?></p>
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
            // print_r($rows);
            include("../include/is_login.php");
            for ($i = 0; $i < count($rows); $i++) {
                // echo $rows[$i][1].'<br>';
                $temp = $rows[$i][1];
                $sql = "SELECT category_name FROM `categories` WHERE category_id='$temp' ";
                $result = mysqli_query($conn, $sql);
                $res = mysqli_fetch_assoc($result);
                $rows[$i][1] = $res['category_name'];
                // print_r($rows[$i][1]);
            }

            $i = 0;
            foreach ($rows as $row) {
                $sql = "SELECT payment_name FROM `payment_account` WHERE  payment_id='$row[2]' ";
                $result = mysqli_query($conn, $sql);
                $res = mysqli_fetch_assoc($result);
                $rows[$i++][2] = $res['payment_name'];
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
                <!-- <td><?php echo $row[6]; ?></td> -->
                <td><?php echo $row[7]; ?></td>
                <td><?php echo $row[8]; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>