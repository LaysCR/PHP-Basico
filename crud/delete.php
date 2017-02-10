<?php

    include("../crud/user.php");
    $user = new USER();

    $id = $_POST['id'];

    if ($user->delete($id)) {
      $user->redirect('../crud/index.php');
    }
?>
