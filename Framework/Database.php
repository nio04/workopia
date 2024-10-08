<?php

namespace Framework;

use PDO;
use PDOException;
use PDOStatement;
use Exception;

class Database {
  public $conn;

  /**
   * constructior for database class
   * 
   * @param array $config
   */
  public function __construct($config) {
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";

    $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    try {
      $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
    } catch (PDOException $e) {
      throw new Exception('Database connection fail' . $e->getMessage());
    }
  }

  /**
   * query the database
   * 
   * @param string $query
   * @return PDOStatement
   * @throws PDOException
   */
  public function query($query, $params = []) {
    try {
      $sth = $this->conn->prepare($query);

      // bind named params
      foreach ($params as $param => $value) {
        $sth->bindValue(":" . $param, $value);
      }

      $sth->execute();
      return $sth;
    } catch (PDOException $e) {
      throw new Exception('query execute fail. ' . $e->getMessage());
    }
  }
}
