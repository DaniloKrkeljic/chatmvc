<?php

  class Chats extends Controller{
    public function __construct(){
      if(!isLoggedIn()){
        redrect('users/login');
      }

      $this->chatModel = $this->model('Chat');
      $this->userModel = $this->model('User');
    }

    public function index(){
      $messages = $this->chatModel->readMessages();

      $data = [
        'messages' => $messages
      ];

      $this->view('chat/index', $data);
    }

    public function addMessage(){
      if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $userId = $this->userModel->findUserByUsername($_POST['username'],true);

        $data = [
          'message' => $_POST['message'],
          'username' => $_POST['username'],
          'user_id' => $userId->id
        ];

        if($this->chatModel->addMessage($data)){
          redirect('chats');
        } else {
          die('Error');
          redirect('pages/index');
        }
      }
    }
  }