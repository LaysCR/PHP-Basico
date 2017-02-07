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
        echo "Dados incorretos.";
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
    <!-- Form -->
    <div id = "login-form">
      <h2>Login</h2>
      <form method="post">
        <p>Usuário: </p>
        <input id="uname_email" type="text" name="uname_email" placeholder="Nome ou E-mail">
        <p>Senha: </p>
        <input id="password" type="password" name="password" placeholder="Senha">
        <br><br>

        <input id="btn-login" type="submit" name="btn-login" value="Logar">
      </form>
    </div>

    <!-- <input id="toSelect" value="Livros Cadastrados" type="submit"> -->

    </body>

</html>
