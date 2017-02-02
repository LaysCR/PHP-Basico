<?php session_start(); ?>
<!DOCTYPE html>
<html>

  <head>
    <title>Cadastro de livros</title>
    <link type="text/css" rel="stylesheet" href="../public/css/stylesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../crud/crud.js"></script>
  </head>

  <body>

    <div id = "insert-form">
      <h2>Cadastrar livro</h2>
      <form method="post" action="../crud/insert.php">
        <p>Título: </p>
        <input id="title" type="text" name="title" placeholder="Título do livro">
        <p>Autor: </p>
        <input id="author" type="text" name="author" placeholder="Autor do livro">
        <br>
        <p>Dono: </p>
        <input id="owner" type="text" name="owner" placeholder="Nome do dono">
        <br>
        <p>Descrição: </p>
        <input id="description" type="text" name="description" placeholder="Descrição">
        <br><br>
        <!-- <div id='message'>Cadastrado com sucesso! <span class="glyphicon glyphicon-ok"></span></div> -->
        <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        }
        ?>
        <input id="button" value="Cadastrar" type="submit">
      </form>
    </div>

    <input id="toSelect" value="Livros Cadastrados" type="submit">

    </body>

</html>
