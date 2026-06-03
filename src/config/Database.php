<?php

namespace App\Config;
use PDO;

class Database
{

  private string $host;
  private string $db;
  private string $user;
  private string $pass;
  private ?PDO $conn = null;

  public function __construct()
  {
    $this->host = $host ?? $_ENV['DB_HOST'];
    $this->db = $db ?? $_ENV['DB_NAME'];
    $this->user = $user ?? $_ENV['DB_USER'];
    $this->pass = $pass ?? $_ENV['DB_PASSWORD'];
  }

  public function getConnection(): PDO
  {
    if ($this->conn !== null)
      return $this->conn;
    
    $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
    $this->conn = new PDO($dsn, $this->user, $this->pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $this->conn;
  }
}