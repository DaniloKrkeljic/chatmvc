<?php 

  class Chat {
    private $db;

    public function __construct(){
      $this->db = new Database();
    }

    public function readMessages(){
      $this->db->query("SELECT * FROM messages");
      return $this->db->resultSet();
    }
  }