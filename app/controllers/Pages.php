<?php

  class Pages extends Controller{
    public function __construct(){

    }

    public function index(){
      $data=[];

      if (isLoggedIn()){
        // redirect('pages/chat');
      }

      $this->view('pages/index' ,$data);
    }
  }