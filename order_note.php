<?php
require_once('core/db.php');

$req = "SELECT * FROM avis ORDER BY note DESC";
$stmt = $pdo->query($req);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<table class="table">
        <thead>
            <tr>
                <th scope="col">nom</th>
                <th scope="col">avis</th>
                <th scope="col">note</th>
                <th scope="col">date <a href="order_date.php">desc</a></th>
                <th scope="col">isActive</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $val) {
                echo '<tr>';
                echo '<th>' . $val['name'] . '</th>';
                echo '<td>' . $val['opinion'] . '</td>';
                echo '<td>' . $val['note'] . '</td>';
                echo '<td>' . $val['createdAt'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>