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
  }