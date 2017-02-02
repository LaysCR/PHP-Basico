<!DOCTYPE html>
<html>

  <head>
    <title>Livros</title>
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../crud/crud.js"></script>
    <?php $value = ""; ?>
  </head>

  <body>

    <table>
    <th><a id = "sortByTitle" href='../crud/select.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Título</a></th>
    <th><a id = "sortByAuthor" href='../crud/select.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Autor</a></th>
    <th><a id = "sortByOwner" href='../crud/select.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Dono</a></th>
    <th><a id = "sortByDescription" href='../crud/select.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Descrição</a></th>

<?php

  require_once('../pdo/Connection.php');

  $connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");
  $pdo = $connection->getPDO();
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $value = $_COOKIE['value'];
  if ($value == ""){$value = 'title';}
  $isAsc = isset($_GET['order'])? (bool) $_GET['order']: 1;

  $sql = ("SELECT title, author, owner, description FROM livro ORDER BY $value ".($isAsc?"ASC":"DESC"));
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
       echo "<tr>
       <td>{$row['title']}</td>
       <td>{$row['author']}</td>
       <td>{$row['owner']}</td><
       <td>{$row['description']}</td>
       </tr>";
    }

?>
  </table>

  <input id="toInsert" value="Cadastrar Livro" type="submit">

  </body>

</html>
