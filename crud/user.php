<?php
class USER
{

    function __construct() {
        //Connect to database
        require_once('../pdo/Connection.php');

        $connection = new Connection("127.0.0.1" , "Emprestimos", "root", "abcdefgh");
        $pdo = $connection->getPDO();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function register($uname,$email,$password) {
        //Register user
        // $new_password = password_hash($password, PASSWORD_DEFAULT);

         $sql = ("INSERT INTO usuario(user,email,password) VALUES (:uname, :email, :password)");

         $sql->bindParam(":uname", $uname);
         $sql->bindParam(":email", $email);
         $sql->bindParam(":password", $password);
         $sql->execute();

    }

    public function login($uname,$email,$password) {
        //Login
        $sql = prepare("SELECT * FROM usuario WHERE user=:uname OR email=:email LIMIT 1");
        $sql->bindParam(':uname', $uname);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $password);
        $sql->execute();
        $userRow=$sql->fetch(PDO::FETCH_ASSOC);
        if(count($userRows > 0)) {
           if(password_verify($password, $userRow['password'])) {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else {
                return false;
             }
          }

   }

   public function is_loggedin() {
      //Start session
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }

   public function redirect($url) {
       header("Location: $url");
   }

   public function logout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>
