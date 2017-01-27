<?php

require_once('../pdo/Connection.php');

$connection = new Connection("127.0.0.1", "teste", "root", "abcdefgh");

$pdo = $connection->getPDO();

var_dump($pdo);
