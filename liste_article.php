<?php
require_once('core/db.php');

$select = "SELECT * FROM articles";
$stmt = $pdo->query($select);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);
// foreach ($result as $val) {
//     echo '<div>';
//     echo '<p>' . $val['name'] . '</p>';
//     echo '<p>' . $val['content'] . '</p>';
//     echo '<a href="article.php?id=' . $val['id'] . '>voir article</a>';
//     echo '</div>';
// }
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

        <?php

        foreach ($result as $val) {
            echo '<div>';
            echo '<p>' . $val['name'] . '</p>';
            echo '<p>' . $val['content'] . '</p>';
            echo '<a href="article.php?id=' . $val['id'] . '>voir article</a>';
            echo '</div>';
        }
        ?>

    <a href="disconnect.php">Déconnexion</a>

</body>

</html>