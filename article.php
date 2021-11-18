<?php
require_once('core/db.php');
session_start();
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

<body class="container-fluid">
    <?php
    require_once('core/db.php');

    $select = "SELECT * FROM articles WHERE id =" . (int)$_GET['id'];
    $stmt = $pdo->query($select);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $val) {
        echo '<div>';
        echo '<p>' . $val['name'] . '</p>';
        echo '<p>' . $val['content'] . '</p>';
        echo '</div>';
    }

    if (isset($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        $opinion = htmlspecialchars($_POST['content']);
        $note = htmlspecialchars($_POST['note']);
        $id_user = $_SESSION['id'];
        $insert = "INSERT INTO avis(name, opinion, note, id_user, id_article) VALUES (:name, :opinion, :note, :id_user, :id_article)";
        $stmt = $pdo->prepare($insert);
        $stmt->execute([':name' => $name, ':opinion' => $opinion, ':note' => $note, ':id_user' => $id_user, ':id_article' => (int)$_GET['id']]);
    }
    ?>
    <div class="d-flex justify-content-center">
        <form method="POST" class="col-6 row">
            <div class="mb-3">
                <label for="name" class="form-label">titre</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Avis</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">note</label>
                <input type="number" name="note" class="form-control" id="note">
                <p>/5</p>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
    <a href="opinion.php">liste d'avis</a>
    <a href="disconnect.php">Déconnexion</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>