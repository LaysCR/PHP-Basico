<?php

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    <!-- Table -->
    <table id="table" class="table table-bordered text-center">
    <th class="text-center"><a id = "sortByTitle" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Título</a></th>
    <th class="text-center"><a id = "sortByAuthor" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Autor</a></th>
    <th class="text-center"><a id = "sortByOwner" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Dono</a></th>
    <th class="text-center"><a id = "sortByDescription" href='../crud/index.php?order=<?php echo isset($_GET['order'])?!$_GET['order']:1; ?>'>
    Descrição</a></th>

<?php

    if($user->is_loggedin()!=""){echo "<th></th><th></th>";}

    $connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");
    $pdo = $connection->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $value = $_COOKIE['value'];
    if ($value == ""){$value = 'title';}
    $isAsc = isset($_GET['order'])? (bool) $_GET['order']: 1;

    $sql = ("SELECT id, title, author, owner, description FROM livro ORDER BY $value ".($isAsc?"ASC":"DESC"));
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
      if($user->is_loggedin()!=""){

       echo "<tr>
       <td id='$id[$index]' class='id'>{$row['id']}</td>
       <td>{$row['title']}</td>
       <td>{$row['author']}</td>
       <td>{$row['owner']}</td>
       <td>{$row['description']}</td>
       <td><a class='update btn' href='#' type='submit' title='Atualizar'><span class='glyphicon glyphicon-pencil'></span></a></td>
       <td>
       <form method='post'>
       <input class='teste' type='hidden' value=".$row['id'].">
       <a class='delete btn' href='#' title='Deletar' type='submit'><span class='glyphicon glyphicon-trash'></span></a></td>
       </form>
       </tr>";

     }
     else {
       echo "<tr>
       <td>{$row['title']}</td>
       <td>{$row['author']}</td>
       <td>{$row['owner']}</td><
       <td>{$row['description']}</td>";
     }
    }

?>
  </table>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Cadastrar Livro</h4>
        </div>
        <div class="modal-body">
          <!-- Form -->
        <form id="form-insert">
          <!-- <div class="form-group"> -->
            <label for="recipient-name" class="control-label">Nome:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Título do livro" required><br>
            <label for="recipient-name" class="control-label">Autor:</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Autor do livro" required><br>
            <!-- Select List -->
            <div class="form-group">
              <label for="sel1">Editora:</label>
               <select class="form-control" id="sel1">
                 <option value="" selected disabled>Selecione uma editora</option>
                 <?php

                  $sql2 = ("SELECT name FROM editora ORDER BY ASC");
                  $stmt2 = $pdo->prepare($sql2);
                  $stmt2->execute();
                  $list= $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    foreach($list as $opt){
                      echo "<option>{$opt['name']}</option>";
                    }
                 ?>
               </select>
              </div>
            <label for="recipient-name" class="control-label">Dono:</label>
            <input type="text" class="form-control" id="owner" name="owner" placeholder="Proprietário do livro" required><br>
          <!-- </div> -->
          <!-- <div class="form-group"> -->
            <label for="message-text" class="control-label">Descrição:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Breve descrição do livro"></textarea>
            <br>
          <!-- </div> -->
          <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal" id="form-close">Cancelar</button>
            <button type="submit" class="btn" id="form-submit">Cadastrar</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  </body>

</html>
