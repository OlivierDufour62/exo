<?php
require_once('core/db.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['password']);
    $req = 'SELECT * FROM users WHERE email=:email';
    $statement = $pdo->prepare($req);
    var_dump($statement);
    $statement->execute([':email' => $email]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    var_dump($result);
    if (is_countable($result) && count($result) > 0) {
        if (password_verify($pwd, $result['password'])) {
            session_start();
            $_SESSION['id'] = $result['id'];
            $_SESSION['email'] = $result['email'];
            header('Location: index.php');
        }
    } else {
        echo "Email ou Mot de passe invalide";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Connexion</title>
</head>

<body>
    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <input type="hidden" name="token" class="form-control" id="token">
        <button class="btn btn-primary">Connexion</button>
    </form>
    <a href="inscription.php">inscription</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>