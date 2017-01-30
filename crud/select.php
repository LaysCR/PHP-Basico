<!DOCTYPE html>
<html>

  <head>
    <title>Livros</title>
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
  </head>

  <body>

    <table>
      <th>Title</th>
      <th>Author</th>
      <th>Owner</th>
      <th>Description</th>

<?php

  require_once('../pdo/Connection.php');

  $connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");
  $pdo = $connection->getPDO();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = ("SELECT title, author, owner, description FROM livro ORDER BY title");
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
       echo "<tr><td>{$row['title']}</td>
       <td>{$row['author']}</td>
       <td>{$row['owner']}</td>
       <td>{$row['description']}</td></tr>";
    }

?>
  </table>

  </body>

</html>
