<?php

    include("../pdo/Connection.php");
    include("../crud/user.php");
    $user = new User();

    if($user->is_loggedin()=="") {
      $user->redirect('../crud/index.php');
    }

?>
<!DOCTYPE html>
<html>

  <head>
    <title>Cadastro de livros</title>
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../crud/crud.js"></script>
    <script src="../public/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../public/sweetalert-master/dist/sweetalert.css">
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
          <?php
          if($user->is_loggedin()!=""){
              echo '<li><a href="../public/insert.php">Cadastrar Livro</a></li>';
          }
          ?>
          <li><a href="../public/signin.php">Cadastrar Usuário</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php
            if($user->is_loggedin()!="") {
              echo "<a href='#'><span class='glyphicon glyphicon-log-in'></span> Olá, " .$_SESSION['user'];
            }
            else {
              echo "<a href='../public/login.php'><span class='glyphicon glyphicon-log-in'></span> Log in";
            }
            ?></a></li>
            <?php
            if($user->is_loggedin()!=""){
                echo '<li><a href="../crud/index.php?logout=true"><span class="glyphicon glyphicon-user"></span> Log out</a></li>';
            }
            ?>
        </ul>
      </div>
    </nav>
    <!-- Form -->
    <div id = "insert-form">
      <h2>Cadastrar livro</h2>
      <form method="post" action="../crud/insert.php">
        <p>Título: </p>
        <input id="title" type="text" name="title" placeholder="Título do livro" required>
        <p>Autor: </p>
        <input id="author" type="text" name="author" placeholder="Autor do livro" required>
        <br>
        <p>Dono: </p>
        <input id="owner" type="text" name="owner" placeholder="Nome do dono" required>
        <br>
        <p>Descrição: </p>
        <input id="description" type="text" name="description" placeholder="Descrição" required>
        <br><br>
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
        ?>
        <input id="button" value="Cadastrar" type="submit">
      </form>
    </div>


    </body>

</html>
