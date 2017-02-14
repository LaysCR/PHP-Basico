<?php

    // session_start();
    include("../pdo/Connection.php");
    include("../crud/user.php");
    $user = new User();

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
          <li><a class="btn" href="../crud/index.php">Livros</a></li>
          <?php
          if($user->is_loggedin()!=""){
              // echo '<li><a href="../public/insert.php">Cadastrar Livro</a></li>';
              echo '<li><a class="btn" href="#" data-toggle="modal" data-target="#exampleModal">Cadastrar Livro</a></li>';
          }
          ?>
          <li><a class="btn" href="../public/signin.php">Cadastrar Usuário</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php
            if($user->is_loggedin()!="") {
              echo "<a class='btn' href='#'><span class='glyphicon glyphicon-log-in'></span> Olá, " .$_SESSION['user'];
            }
            else {
              echo "<a class='btn' href='../public/login.php'><span class='glyphicon glyphicon-log-in'></span> Log in";
            }
            ?></a></li>
            <?php
            if($user->is_loggedin()!=""){
                echo '<li><a class="btn" href="../crud/index.php?logout=true"><span class="glyphicon glyphicon-user"></span> Log out</a></li>';
            }
            ?>
        </ul>
      </div>
    </nav>
    <!-- Form -->
    <div id = "signin-form">
      <h2>Cadastro de Usuário</h2>
      <form method="post">
        <p>Usuário: </p>
        <input id="uname" type="text" name="user" placeholder="Nome do usuário" required>
        <p>Email: </p>
        <input id="email" type="text" name="email" placeholder="E-mail" required>
        <p>Senha: </p>
        <input id="password" type="password" name="password" placeholder="Senha" required>
        <br><br>
        <?php
        if(isset($_POST['btn-signin'])) {
          $uname = $_POST['user'];
          $email = $_POST['email'];
          $password = $_POST['password'];

          if($user->register($uname,$email,$password)) {
            $user->redirect('../public/login.php');
          }
          else {
            if (isset($_SESSION['error'])) {
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            }
          }
        }
        ?>
        <input id="btn-signin" type="submit" name="btn-signin" value="Cadastrar">
      </form>
    </div>

    </body>

</html>
