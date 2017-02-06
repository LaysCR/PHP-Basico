<?php

    include("../pdo/Connection.php");
    include("../crud/user.php");
    $user = new User();

    if($user->is_loggedin()!="") {
      $user->redirect('../crud/index.php');
    }

    if(isset($_POST['btn-signin'])) {
      $uname = $_POST['user'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if($user->register($uname,$email,$password)) {
        $user->redirect('../crud/index.php');
      }
    }

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../crud/crud.js"></script>
  </head>

  <body>

    <div id = "signin-form">
      <h2>Cadastro de Usuário</h2>
      <form method="post">
        <p>Usuário: </p>
        <input id="uname" type="text" name="user" placeholder="Nome do usuário">
        <p>Email: </p>
        <input id="email" type="text" name="email" placeholder="E-mail">
        <p>Senha: </p>
        <input id="password" type="text" name="password" placeholder="Senha">
        <br><br>
        <input id="btn-signin" value="Cadastrar" type="submit">
      </form>
    </div>

    <input id="toSelect" value="Livros Cadastrados" type="submit">

    </body>

</html>
