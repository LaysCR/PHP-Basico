<?php

    //Connect to database
    require_once('../pdo/Connection.php');

    $connection = new Connection("127.0.0.1" , "Emprestimos", "root", "abcdefgh");
    $pdo = $connection->getPDO();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Login
    $sql = prepare("SELECT * FROM usuario WHERE user=:uname OR email=:email LIMIT 1");
    $sql->execute(array(':user'=>$uname, ':email'=>$email));
    $userRow=$sql->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0) {
       if(password_verify($password, $userRow['user_pass'])) {
            $_SESSION['user_session'] = $userRow['user_id'];
            session_start();
            header("Location: ../crud/index.php");
            return true;
         }
         else {
            $_SESSION["user-pass"] = '<div id="message">Usuário ou senha incorretos.</div>';
            return false;
         }
      }
   
?>
