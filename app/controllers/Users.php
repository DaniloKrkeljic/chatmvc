<?php 
  
  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function register(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'username_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        if(empty($data['username'])){
          $data['username_err'] = 'Please enter a username';
        }

        if(empty($data['password'])){
          $data['password_err'] = 'Please enter a password';
        }

        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password';
        }

        if($this->userModel->findUserByUsername($data['username'])){
          // User found
          $this->view('users/register', $data);
        } else {
          $data['username_err'] = 'Username not registered.';
        }

        if (empty($data['name_err']) && empty($data['password_err'])){
          $loggedInUser = $this->userModel->login($data['username'], $data['password']);

          if($loggedInUser){
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/register', $data);
          }
        } else {
          // Populate view with errors
          $this->view('users/login', $data);
        }
      } else {
        $data = [
          'username' => '',
          'password' => '',
          'confirm_password' => '',
          'username_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        $this->view('users/register', $data);
      }
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

        if(empty($data['username'])){
          $data['username_err'] = 'Please enter a username';
        }

        if(empty($data['password'])){
          $data['password_err'] = 'Please enter a password';
        }

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
        $data = [
          'username' => '',
          'password' => '',
          'username_err' => '',
          'password_err' => ''
        ];

        $this->view('users/login', $data);
      }
      
    }


    public function createUserSession($user){
      $_SESSION['username'] = $user->username;
      $_SESSION['user_id'] = $user->id;

      redirect('chats');
    }

    public function logout(){
      unset($_SESSION['username']);
      unset($_SESSION['user_id']);

      session_destroy();
      redirect('pages');
    }
  }