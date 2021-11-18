<?php
try{
    $pdo = new PDO('sqlite:'.'testifort.db');
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
} catch(Exception $e) {
    echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
    die();
}


$pdo->query("CREATE TABLE IF NOT EXISTS users ( 
    id              INTEGER         PRIMARY KEY AUTOINCREMENT,
    lastname        VARCHAR(255),
    firstname       VARCHAR(255),
    email           VARCHAR(255),
    password        VARCHAR(255),
    address         VARCHAR(255),
    city            VARCHAR(255),
    zipcode         VARCHAR(255),
    role            VARCHAR(255) DEFAULT user,
    createdAt       DATETIME DEFAULT CURRENT_DATE
);");

$pdo->query("CREATE TABLE IF NOT EXISTS articles ( 
    id              INTEGER         PRIMARY KEY AUTOINCREMENT,
    name            VARCHAR(255),
    content         VARCHAR(255),
    createdAt       DATETIME DEFAULT CURRENT_DATE,
    isActive        BOOLEAN DEFAULT FALSE,
    id_user         INT,
    FOREIGN KEY (id_user) REFERENCES Users(id)
);");

$pdo->query("CREATE TABLE IF NOT EXISTS avis ( 
    id              INTEGER         PRIMARY KEY AUTOINCREMENT,
    name            VARCHAR(255),
    opinion         VARCHAR(255),
    note            INT(5),
    createdAt       DATETIME DEFAULT CURRENT_DATE,
    isActive        BOOLEAN DEFAULT FALSE,
    id_user         INT,
    id_article      INT,
    FOREIGN KEY (id_user) REFERENCES Users(id),
    FOREIGN KEY (id_article) REFERENCES Articles(id)
);");
