<?php

  class Database{
    private $dbname = DB_NAME;
    private $dbhost = DB_HOST;
    private $dbpass = DB_PASSWORD;
    private $dbuser = DB_USER;

    private $dbh;
    private $stmt;
    private $err;

    public function __construct(){
      // Set Data Source Name(DSN)
      $dsn = 'mysql:dbname='.$this->dbname.';host='.$this->dbhost;
      $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      try{
        $this->dbh = new PDO($dsn,$this->dbuser,$this->dbpass);
      } catch (PDOException $e){
        $this->err = $e->getMessage();
        echo $this->err;
      }
    }

    public function query($sql){
      $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type=null){
      if(is_null($type)){
        switch(true){
          case is_int($value):
            $type = PDO::PARAM_INT;
          break;
          case is_bool($value):
            $type = PDO::PARAM_BOOL;
          break;
          case is_null($value):
            $type = PDO::PARAM_NULL;
          break;
          default:
            $type = PDO::PARAM_STR;
        }
      }

      $this->stmt->bindValue($param, $valuse, $type);
    }

    public function execute(){
      try{
        $exec = $this->stmt->execute();
        return $exec;
      } catch (PDOExeption $e){
        $this->err = $e->getMessage();
        echo $this->err;
      }
    }

    public function single(){
      $this->execute();
      return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
      return $this->stmt->rowCount();
    }
  }