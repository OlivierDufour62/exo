<?php
require_once('core/db.php');
$select = "SELECT * FROM avis INNER JOIN users ON avis.id_user = users.id";
$stmt = $pdo->query($select);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['action']) && $_GET['action'] == 'update_status') {
    $newStatus = ($_GET['is_active'] === 'on') ? false : true;
    $update = "UPDATE avis SET isActive = :status  WHERE id=:id";
    $stmt = $pdo->prepare($update);
    $stmt->execute([':id' => (int)$_GET['id'], ':status' => $newStatus]);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">nom</th>
                <th scope="col">email</th>
                <th scope="col">avis</th>
                <th scope="col">note<a href="order_note.php">desc</a></th>
                <th scope="col">date <a href="order_date.php">desc</a></th>
                <th scope="col">Masquer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $val) {
                $active = ($val['isActive']) ? 'Activer' : 'Désactiver';
                $is_active = ($val['isActive']) ? 'on' : 'off';
                echo '<tr>';
                echo '<th>' . $val['name'] . '</th>';
                echo '<td>' . $val['email'] . '</td>';
                echo '<td>' . $val['opinion'] . '</td>';
                echo '<td>' . $val['note'] . '</td>';
                echo '<td>' . $val['createdAt'] . '</td>';
                echo '<td><a href=opinion.php?id=' . $val['id'] . '&action=update_status&is_active=' . $is_active . '>' . $active . '</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <div>
        <a href="disconnect.php">Déconnexion</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>