<?php

require_once('../pdo/Connection.php');

$connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");

$pdo = $connection->getPDO();

$title = $_POST['title'];
$author = $_POST['author'];
$owner = $_POST['owner'];
$description = $_POST['description'];

$pdo->exec("INSERT INTO livro (title, author, owner, description)
    VALUES ('$title', '$author', '$owner', '$description')");
