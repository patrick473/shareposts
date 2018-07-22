<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('user');
    }
    public function register()
    {
        $passwordlength = 8;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
            ];
            //validate rules

            if (empty($data['name'])) {
                $data['name_error'] = 'please fill in your name.';
            }
            if (empty($data['email'])) {
                $data['email_error'] = 'please fill in your email.';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'email has already been taken.';

            }
            if (empty($data['password'])) {
                $data['password_error'] = 'please fill in a password.';
            } elseif (strlen($data['password']) < $passwordlength) {
                $data['password_error'] = 'password needs to be at least ' . $passwordlength . ' characters.';
            }

            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'please confirm your password.';
            } elseif ($data['confirm_password'] != $data['password']) {
                $data['confirm_password_error'] = 'passwords need to be the same.';
            }

            //end of validation
            if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                //hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered you can now log in.');
                    redirect('users/login');
                } else {
                    die('register failed');
                }

            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => '',
               
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
                'combination_error' => ''
               

            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'please enter your email.';
            }
            if (empty($data['password'])) {
                $data['password_error'] = 'please enter your password.';
            }
        
            if (empty($data['email_error']) && empty($data['password_error'])) {
                $loggedInUser = $this->userModel->login($data['email'],$data['password']);
                if($loggedInUser){
                   $this->userModel->createUserSession($loggedInUser);
                   redirect('posts/index');
                }
                else{
                    $data['combination_error'] = 'Email and password combination is not recognized.';
                    $data['password'] = '';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [

                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',

            ];

            $this->view('users/login', $data);
        }
    }
    
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_password']);
        session_destroy();
        redirect('users/login');
    }
}
