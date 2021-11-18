<?php
require_once('core/db.php');
if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $zipcode = htmlspecialchars($_POST['zipcode']);
    $check = "SELECT * FROM users WHERE email=:email";
    $stmt = $pdo->prepare($check);
    $stmt->execute([':email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
        $req = "INSERT INTO users (lastname, firstname, email, password, address,city, zipcode) VALUES ( :lastname, :firstname, :email, :password, :address, :city, :zipcode)";
        $statement = $pdo->prepare($req);
        $statement->execute([':lastname' => $lastname, ':firstname' => $firstname, ':email' => $email, ':password' => $password,':address' => $address, ':city' => $city, ':zipcode' => $zipcode]);
    }
}

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
    <form method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="firstname" id="firstname">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom</label>
            <input type="text" class="form-control" name="lastname" id="lastname">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" name="address" id="address">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">ville</label>
            <input type="text" class="form-control" name="city" id="city">
        </div>
        <div class="mb-3">
            <label for="zipcode" class="form-label">Code postal</label>
            <input type="text" class="form-control" name="zipcode" id="zipcode">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <button class="btn btn-primary">Connexion</button>
    </form>
</body>

</html>