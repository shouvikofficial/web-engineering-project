<?php
include "connection.php";

$sql = "SELECT * FROM students";
$run = mysqli_query($con, $sql);

if(mysqli_num_rows($run) > 0) {



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <?php while($row = mysqli_fetch_array($run)) { ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['password'] ?></td>
                </tr>
                <?php } ?>
        </table>
        <?php } ?>
    </div>
    
</body>
</html>