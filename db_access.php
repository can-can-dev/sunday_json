<?php

  require_once './vendor/autoload.php';
  
  $dotenv = Dotenv\Dotenv::create(__DIR__);
  $dotenv->load();
 

  class db_access {
    private $dbh;

    private function conection(){
      // ドライバ呼び出しを使用して MySQL データベースに接続します
      $dsn = sprintf('mysql:dbname=%s;host=%s', $_ENV['DB_DATABASE'], $_ENV['DB_HOST']);
      $user = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASSWORD'];
      
      try {
        $this->dbh = new PDO($dsn, $user, $password);
        echo "接続成功\n";
      } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
        exit();
      }
    }

    public function access_check(){
      $this->conection();
      exit();
    }

    public function query_execute($sql){
      $this->conection();

      $prepare = $this->dbh->prepare($sql);
      $prepare->execute();
      $result = $prepare->fetchAll(PDO::FETCH_ASSOC);

      return $result;
    }
  }
