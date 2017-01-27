<?php

require_once('../pdo/Connection.php');

$connection = new Connection("127.0.0.1", "Emprestimos", "root", "abcdefgh");

$pdo = $connection->getPDO();
