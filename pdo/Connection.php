<?php

  session_start();

class Connection
{
  private $host;
  private $database;
  private $user;
  private $password;
  private $connection;


  public function __construct($host, $database, $user, $password)
  {

    $this->host = $host;
    $this->database = $database;
    $this->user = $user;
    $this->password = $password;

    $dsn = 'mysql:dbname='.$this->database.';host='.$this->host;
    $this->connection = new PDO($dsn, $this->user, $this->password);
  }

  public function getPDO()
  {
    return $this->connection;
  }
}
