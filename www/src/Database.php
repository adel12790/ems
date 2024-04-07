<?php

class Database
{
  private string $host;
  private string $name;
  private string $user;
  private string $password;

  public function __construct(

  ) {
    $this->host = getenv('DB_HOST');
    $this->name = getenv('DB_DATABASE');
    $this->user = getenv('DB_USER');
    $this->password = getenv('DB_PASSWORD');
  }

  public function getConnection(): PDO
  {
    $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

    return new PDO($dsn, $this->user, $this->password, [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_STRINGIFY_FETCHES => false
    ]);
  }
}
