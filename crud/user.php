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
        $new_password = password_hash($password, PASSWORD_DEFAULT);

         $sql = $this->pdo->prepare("INSERT INTO usuario(user,email,password) VALUES (:user, :email, :password)");

         $sql->bindParam(":user", $uname);
         $sql->bindParam(":email", $email);
         $sql->bindParam(":password", $new_password);
         $sql->execute();

         return true;
    }

    public function login($uname,$email,$password) {
        //Login
        $sql = $this->pdo->prepare("SELECT * FROM usuario WHERE user=:uname OR email=:email LIMIT 1");

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
                return false;
             }
          }

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
