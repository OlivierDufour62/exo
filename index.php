<?php 
require_once('core/db.php');
session_start();
if(!isset($_SESSION)){
    header('Location: connection.php');
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

<body class="container-fluid">
    <?php
    if (isset($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
        $content = htmlspecialchars($_POST['content']);
        $id_user = $_SESSION['id'];
        $insert = "INSERT INTO articles(name, content, id_user) VALUES (:name, :content, :id_user)";
        $stmt = $pdo->prepare($insert);
        $stmt->execute([':name' => $name, ':content' => $content,':id_user' => $id_user]);
    }
    
    ?>
    <div class="d-flex justify-content-center">
        <form method="POST" class="col-6 row">
            <div class="mb-3">
                <label for="name" class="form-label">titre</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <textarea name="content" id="" cols="30" rows="10"></textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div>
        <?php 
        // foreach($result as $val){
        //     echo '<div>';
        //     echo '<p>' . $val['name'] . '</p>';
        //     echo '<p>' . $val['content'] . '</p>';
        //     echo '</div>';
        // }
        ?>
    </div>
    <a href="liste_article.php">liste article</a>
    <a href="disconnect.php">Déconnexion</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>