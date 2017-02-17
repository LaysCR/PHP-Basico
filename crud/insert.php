<?php

session_start();
require_once('../pdo/Connection.php');

$connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");
$pdo = $connection->getPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$title = $_POST['title'];
$author = $_POST['author'];
$idPublisher = $_POST['publisher'];
$owner = $_POST['owner'];
$description = $_POST['description'];

$sql = $pdo->prepare("INSERT INTO livro (title, author, idPublisher, owner, description)
                      VALUES (:name, :author, :idPublisher, :owner, :description)");
    $sql->bindParam(':title', $title);
    $sql->bindParam(':author', $author);
    $sql->bindParam(':idPublisher', $idPublisher);
    $sql->bindParam(':owner', $owner);
    $sql->bindParam(':description', $description);
      $sql->execute();

$query = $pdo->prepare("SELECT name FROM editora WHERE idPublisher=$idPublisher");
    $query->execute();
    $publisher = $query->fetch();

    $id = $pdo->lastInsertId();
    $json = [ 'title'=>$title, 'author'=>$author, 'publisher'=>$publisher['name'], 'owner'=>$owner, 'description'=>$description ];
    $data = (Object) $json;

    header("Content-type: application/json");
    echo json_encode($data);
?>
