<?php

session_start();
require_once('../pdo/Connection.php');

$connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");
$pdo = $connection->getPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$title = $_POST['title'];
$author = $_POST['author'];
$owner = $_POST['owner'];
$description = $_POST['description'];

$sql = $pdo->prepare("INSERT INTO livro (title, author, owner, description)
    VALUES (:title, :author, :owner, :description)");
    $sql->bindParam(':title', $title);
    $sql->bindParam(':author', $author);
    $sql->bindParam(':owner', $owner);
    $sql->bindParam(':description', $description);
$sql->execute();

  // $_SESSION["message"] = '<div id="message">Cadastrado com sucesso! <span class="glyphicon glyphicon-ok"></span></div>';

  // sleep(1.5);
  // header('Location: ../public/insert.php');
  // exit();

?>
