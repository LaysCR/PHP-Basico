<?php

    include("../crud/user.php");
    $user = new USER();

    $id = $_POST['id'];
    $user->delete($id);
?>
