<?php

  class User{
    private $db;

    public function __construct(){
      $this->db = new Database();
    }

    public function register($data){
      // $this->db->query("INSERT INTO users (username,password) VALUES (:username,:password);");
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

    public function findUserByUsername($username){
      $this->db->query("SELECT * FROM users WHERE username=:username");
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }
  }