<?php 

  class Chat {
    private $db;


    public function __construct(){
      $this->db = new Database();
    }

    public function readMessages(){
      $this->db->query("SELECT * FROM messages");
      $row = $this->db->resultSet();
      
      $cipher = 'aes-256-cbc';

      $filenameKey = 'F:\xampp\htdocs\chatmvc\app\helpers\sifra.txt';
      $filenameIv = 'F:\xampp\htdocs\chatmvc\app\helpers\iv.txt';

      $fileKey = fopen($filenameKey, 'r');
      $fileIv = fopen($filenameIv, 'r');

      $filesizeKey = filesize($filenameKey);
      $filesizeIv = filesize($filenameIv);

      $key = hex2bin(fread($fileKey, $filesizeKey));
      $iv = hex2bin(fread($fileIv, $filesizeIv));

      fclose($fileKey);
      fclose($fileIv);


      for ($i = 0; $i<sizeof($row,1); $i++){
        $encrypted_message =  $row[$i]->text;
        try {
          $plaintext_message = openssl_decrypt($encrypted_message, $cipher, $key, $options = 0, $iv);
        } catch(Exception $e){
          die($e->getMessage());
        }
        $row[$i]->text = $plaintext_message;
        
      }
      
      return $row;
    }


    public function addMessage($data){

      $plaintext = $data['message'];
      $cipher = 'aes-256-cbc';
      $filenameKey = 'F:\xampp\htdocs\chatmvc\app\helpers\sifra.txt';
      $filenameIv = 'F:\xampp\htdocs\chatmvc\app\helpers\iv.txt';

      $fileKey = fopen($filenameKey, 'r');
      $fileIv = fopen($filenameIv, 'r');

      if ($fileIv == false || $fileIv == false ){
        die('Error opening files');
      } else {
        $filesizeKey = filesize($filenameKey);
        $filesizeIv = filesize($filenameIv);

        $key = hex2bin(fread($fileKey, $filesizeKey));
        $iv = hex2bin(fread($fileIv, $filesizeIv));

      }

      fclose($fileKey);
      fclose($fileIv);

      if(in_array($cipher, openssl_get_cipher_methods())){
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options = 0, $iv );
      }


      $this->db->query("INSERT INTO chats (`text`,`user_id`) VALUES (:text,:user_id);");

      $this->db->bind(':text', $ciphertext);
      $this->db->bind(':user_id', $data['user_id']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }