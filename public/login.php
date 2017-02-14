<?php

    // session_start();
    include("../pdo/Connection.php");
    include("../crud/user.php");
    $user = new User();

    if(isset($_POST['btn-login'])) {
      $uname = $_POST['uname_email'];
      $email = $_POST['uname_email'];
      $password = $_POST['password'];

      if($user->login($uname,$email,$password)) {
        $user->redirect('../crud/index.php');
      }
      else {
        $error = "Wrong Details !";
      }
    }

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Log in</title>
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
    <div id = "login-form">
      <h2>Login</h2>
      <form method="post">
        <p>Usuário: </p>
        <input id="uname_email" type="text" name="uname_email" placeholder="Nome ou E-mail">
        <p>Senha: </p>
        <input id="password" type="password" name="password" placeholder="Senha">
        <br><br>
        <?php
        if (isset($_SESSION['user-pass'])) {
          echo $_SESSION['user-pass'];
          unset($_SESSION['user-pass']);

        }
        ?>
        <input id="btn-login" type="submit" name="btn-login" value="Logar">
      </form>
    </div>

    </body>

</html>
