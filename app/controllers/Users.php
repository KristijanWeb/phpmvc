<?php

class Users extends Controller 
{
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() 
    {
        $data = [
            'name' => '',
            'email' => '',
            'username' => '',
            'password' => '',
            'passwordConfirmation' => '',

            'emailError' => '',
            'nameError' => '',
            'usernameError' => '',
            'passwordError' => '',
            'passwordConfirmationError' => '',
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'passwordConfirmation' => trim($_POST['passwordConfirmation']),

                'nameError' => '',
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'passwordConfirmationError' => ''
            ];

            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            // Validate name
            if (empty($data['name'])) {
                $data['nameError'] = 'Ime je obavezno polje.';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email je obavezno polje.';
            }
            else {
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['emailError'] = 'Email zauzet.';
                }
            }

            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Korisnicko ime je obavezno polje.';
            }
            else {
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $data['usernameError'] = 'Korisnicko ime je zauzeto.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
                $data['passwordError'] = 'password je obavezno polje.';
            } 
            elseif(strlen($data['password']) < 6){
                $data['passwordError'] = 'Password must be at least 8 characters';
            } 
            elseif (preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'password mora imati barem jednu numeričku vrijednost.';
            }

            //Validate confirm password
            if (empty($data['passwordConfirmation'])) {
                $data['passwordConfirmationError'] = 'password je obavezno polje.';
            } 
            else {
                if ($data['password'] != $data['passwordConfirmation']) {
                    $data['passwordConfirmationError'] = 'Lozinke se ne podudaraju, pokušaj ponovno.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['nameError']) && empty($data['usernameError']) && empty($data['passwordError']) && empty($data['passwordConfirmationError']) ) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    header('Location: ' . URLROOT . '/users/login');
                } 
                else {
                    die('Nešto nije u redu.');
                }
            }
        }

        $this->view('users/register', $data);
    }

    public function login() 
    {


        $data = [
            'username' => '',
            'password' => '',

            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),

                'usernameError' => '',
                'passwordError' => '',
            ];

            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Upišite Korisnicko ime.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Upišite lozinku.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);

                    header('Location: ' . URLROOT . '/users/profil');
                } 
                else {
                    $data['passwordError'] = 'password ili korisničko ime nisu točni, pokušajte ponovno.';

                    $this->view('users/login', $data);
                }
            }

        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
        }

        $this->view('users/login', $data);
    }

    public function profil()
    {
        if(!isset($_SESSION['username'])){
            header('Location: ' . URLROOT . '/users/login');
        }
        
        $this->view('users/profil');
    }

    public function createUserSession($user) 
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;

        header('Location:' . URLROOT . '/pages/index');
    }

    public function logout() 
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);

        header('Location:' . URLROOT . '/users/login');
    }
}
