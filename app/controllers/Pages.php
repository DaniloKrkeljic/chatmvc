<?php

  class Pages extends Controller{
    public function __construct(){

    }

    public function index(){
      if(isLoggedIn()){
        redirect('chats');
      }

      $data=[];


    
      $this->view('pages/index' ,$data);
    }
  }