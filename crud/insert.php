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
    $id = $_POST['tags'];
    $id = json_decode( "$id", true);

    $sql = $pdo->prepare("INSERT INTO livro (title, author, idPublisher, owner, description)
                      VALUES (:title, :author, :idPublisher, :owner, :description)");
    $sql->bindValue(':title', $title, PDO::PARAM_STR);
    $sql->bindValue(':author', $author, PDO::PARAM_STR);
    $sql->bindValue(':idPublisher', $idPublisher, PDO::PARAM_INT);
    $sql->bindValue(':owner', $owner, PDO::PARAM_STR);
    $sql->bindValue(':description', $description, PDO::PARAM_STR);

    $sql->execute();

    $idLivro = $pdo->lastInsertId();

    $query = $pdo->prepare("SELECT name FROM editora WHERE idPublisher=$idPublisher");
    $query->execute();
    $publisher = $query->fetch(PDO::FETCH_ASSOC);

// insert tag
      $sql = $pdo->prepare("INSERT INTO livro_tags (idLivro, idTag) VALUES (:idLivro, :idTag)");
      $sql->bindParam(':idLivro', $idLivro);

      foreach ($id as $idTag) {
        $sql->bindParam(':idTag', $idTag);

        $sql->execute();
      }
      // --

      $tags = [];
    foreach ($id as $idTag) {

      $query = $pdo->prepare("SELECT nameTag FROM tags WHERE idTag=$idTag");
      $query->execute();
      $tag = $query->fetch(PDO::FETCH_ASSOC);
      $tags[] = $tag['nameTag'];

    }

    $json = [ 'title'=>$title, 'author'=>$author, 'publisher'=>$publisher['name'], 'owner'=>$owner, 'description'=>$description,
              'idLivro'=>$idLivro, 'tags'=>$tags ];
    $data = (Object) $json;

    header("Content-type: application/json");
    echo json_encode($data);
?>
