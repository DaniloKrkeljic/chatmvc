<?php

  class User{
    private $db;

    public function __construct(){
      $this->db = new Database();
    }

    public function register($username, $password){
      $password = password_hash($password, PASSWORD_DEFAULT);

      $this->db->query("INSERT INTO users (`username`,`password`) VALUES (:username,:password);");
      $this->db->bind(':username', $username);
      $this->db->bind(':password', $password);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function login($username, $password){
      $this->db->query("SELECT * FROM users WHERE username=:username");
      $this->db->bind(':username', $username);
      $row = $this->db->single();

      $hashed_password = $row->password;

      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    public function findUserByUsername($username, $info = null){
      $this->db->query("SELECT * FROM users WHERE username=:username");
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      if($info) {
        return $row;
      }

      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
  }