<?php

  class User{
    private $db;

    public function __construct(){
      $this->db = new Database();
    }

    public function register($data){
      // $this->db->query("INSERT INTO users (username,password) VALUES (:username,:password);");
      
    }

    public function login($data){
      $this->db->query("SELECT * FROM users WHERE id=:id");
      $this->db->bind(':id', $data['id']);

      return $this->db->single();
    }

    public function findUserByUsername($username){
      $this->db->query("SELECT * FROM users WHERE username=:username");
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      if($this->stmt->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
  }