<?php 
  
  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function index(){
      $data = [];

      $this->view('users/login');
    }

    public function register(){
      $this->view('users/register');
    }

    public function login(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'username_err' => '',
          'password_err' => ''
        ];

        if($this->userModel->findUserByUsername($data['username'])){
          // User found
        } else {
          $data['username_err'] = 'Username not registered.';
        }

        if (empty($data['name_err']) && empty($data['password_err'])){
          $loggedInUser = $this->userModel->login($data['username'], $data['password']);

          if($loggedInUser){
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Populate view with errors
          $this->view('users/login', $data);
        }
      } else {
        $data = [];

        $this->view('users/login');
      }
      
    }


    public function createUserSession($user){
      $_SESSION['username'] = $user->username;
      $_SESSION['user_id'] = $user->id;
    }

    public function logout(){
      unset($_SESSION['username']);
      unset($_SESSION['user_id']);

      session_destroy();
    }
  }