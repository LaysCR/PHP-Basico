<?php

    include("../pdo/Connection.php");
    include("../crud/user.php");
    $user = new User();

    if($user->is_loggedin()!="") {
      $user->redirect('../crud/index.php');
    }

    if(isset($_POST['btn-login'])) {
      $uname = $_POST['uname_email'];
      $umail = $_POST['uname_email'];
      $upass = $_POST['password'];

      if($user->login($uname,$umail,$upass)) {
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
    <script type="text/javascript" src="../crud/crud.js"></script>
  </head>

  <body>

    <div id = "login-form">
      <h2>Login</h2>
      <form method="post">
        <p>Usuário: </p>
        <input id="uname_email" type="text" name="uname_email" placeholder="Nome ou E-mail">
        <p>Senha: </p>
        <input id="password" type="text" name="password" placeholder="Senha">
        <br><br>
        <?php
        if (isset($_SESSION['user-pass'])) {
          echo $_SESSION['user-pass'];
          unset($_SESSION['user-pass']);
        }
        ?>
        <input id="btn-login" value="Logar" type="submit">
      </form>
    </div>

    <input id="toSelect" value="Livros Cadastrados" type="submit">

    </body>

</html>
