<?php

    include("../crud/Connection.php");
    include("../crud/user.php");
    $user = new User();

    $value = "";

    if ($_GET['logout']==true) {
      $user->logout();
    }

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Livros</title>
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../crud/crud.js"></script>
  </head>

  <body>

    <!-- Menu -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand">Livros DTE</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="../crud/index.php">Livros</a></li>
          <li><a href="../public/insert.php">Cadastrar Livro</a></li>
          <li><a href="../public/signin.php">Cadastrar Usuário</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../public/login.php"><span class="glyphicon glyphicon-log-in"></span><?php echo " Olá, " .$_SESSION['user']; ?></a></li>
          <li><a href="../crud/index.php?logout=true"><span class="glyphicon glyphicon-user"></span> Log out</a></li>
        </ul>
      </div>
    </nav>

    <!-- <input id="toInsert" value="Cadastrar Livro" type="submit"> -->

    <table class="table table-bordered text-center">
    <th class="text-center"><a id = "sortByTitle" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Título</a></th>
    <th class="text-center"><a id = "sortByAuthor" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Autor</a></th>
    <th class="text-center"><a id = "sortByOwner" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Dono</a></th>
    <th class="text-center"><a id = "sortByDescription" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Descrição</a></th>
    <th></th>

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
       <td><button type='submit'><span class='glyphicon glyphicon-trash'></span></button></td>
       </tr>";
    }

?>
  </table>

  </body>

</html>