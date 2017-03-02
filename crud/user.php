<?php
class USER
{
    private $pdo;

    function __construct() {
        //Connect to database
        require_once('../pdo/Connection.php');

        $connection = new Connection("127.0.0.1" , "Emprestimos", "root", "abcdefgh");
        $this->pdo = $connection->getPDO();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function register($uname,$email,$password) {
        //Register user

        $sql = $this->pdo->prepare("SELECT user,email FROM usuario WHERE user=:uname OR email=:email");
        $sql->bindParam(":uname", $uname);
        $sql->bindParam(":email", $email);
        $sql->execute();

        $row=$sql->fetch(PDO::FETCH_ASSOC);
        if($row['user']==$uname){
            $_SESSION['error'] = '<div id="error">Nome já cadastrado
            <span class="glyphicon glyphicon-exclamation-sign"></span></div>';
            return false;
        }
        else if($row['email']==$email){
          $_SESSION['error'] = '<div id="error">Email já cadastrado
          <span class="glyphicon glyphicon-exclamation-sign"></span></div>';
            return false;
        }
        else {
         $new_password = password_hash($password, PASSWORD_DEFAULT);

         $sql = $this->pdo->prepare("INSERT INTO usuario(user,email,password) VALUES (:user, :email, :password)");

         $sql->bindParam(":user", $uname);
         $sql->bindParam(":email", $email);
         $sql->bindParam(":password", $new_password);
         $sql->execute();

         return true;
       }
    }

    public function login($uname,$email,$password) {
        //Login
        $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE user=:uname OR email=:email");

        $sql->bindParam(':uname', $uname);
        $sql->bindParam(':email', $email);
        $sql->execute();

        $userRow=$sql->fetch(PDO::FETCH_ASSOC);
        if(count($userRows > 0)) {
           if(password_verify($password, $userRow['password'])) {
                $_SESSION['user'] = $userRow['user'];
                session_start();
                return true;
             }
             else {
                $_SESSION["user-pass"] = '<div id="user-pass">Usuário ou senha incorretos
                <span class="glyphicon glyphicon-exclamation-sign"></span></div>';
                return false;
             }
          }

   }

   public function delete($id) {
      //Delete row

      try {
      $sql = $this->pdo->prepare("DELETE FROM livro WHERE id=$id");
      $sql->execute();

      $sql = $this->pdo->prepare("DELETE FROM livro_tags WHERE idLivro=$id");
      $sql->execute();
      }
      catch(PDOException $e) {
          $e->getMessage();
      }
      return true;

   }

   public function is_loggedin() {
      //Start session
      if(isset($_SESSION['user']))
      {
         return true;
      }
   }

   public function redirect($url) {
       header("Location: $url");
   }

   public function logout() {
        session_destroy();
        unset($_SESSION['user']);
        unset($_GET['logout']);
        return true;
   }
}
?>
