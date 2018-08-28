<?php

class Users extends Controller
{
    private $auth;

    public function __construct()
    {
        $this->auth = $this->library('Auth');
    }

    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process data
            $data = [
                'name' => trim($_POST['name']),
                'email' => $_POST['email'],
                'pass' => $_POST['pass'],
                'pass_cf' => $_POST['pass_cf'],
                'err' => []
            ];

            if(empty($data['name'])) {
                $data['err']['name'] = 'The field name is required';
            }

            if(empty($data['email'])) {
                $data['err']['email'] = 'The field email is required';
            } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['err']['email'] = 'Email invalidate';
            }

            if(empty($data['pass'])) {
                $data['err']['pass'] = 'The field password is required';
            }

            if(empty($data['pass_cf'])) {
                $data['err']['pass_cf'] = 'The field password confrim is required';
            }

            if(!empty($data['err'])) {
                $this->view('users.register', $data);
            } else {

                $user['name'] = $data['name'];
                $user['email'] = $data['email'];
                $user['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

                if($this->auth->register($user)) {
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

            }

        } else {
            $this->view('users.register');
        }

    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => $_POST['email'],
                'pass' => $_POST['pass'],
                'err' => []
            ];

            if (empty($data['email'])) {
                $data['err']['email'] = 'The field email is required';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['err']['email'] = 'Email invalidate';
            } else if(empty($this->auth->findByEmail($data['email']))) {
                $data['err']['email'] = 'Email not exist';
            }

            if(!empty($data['err'])) {
                $this->view('users.login', $data);
            } else {
                if ($this->auth->login($data['email'], $data['pass'])) {
                    set_flash('success', '<div class="alert alert-success">You login successfully</div>');
                    redirect('/');
                } else {
                    $data['err']['pass'] = 'Incorrect Password';
                    $this->view('users.login', $data);
                }
            }


        } else {
            $this->view('users.login');
        }
    }

    public function logout() {
        session_destroy();
        redirect('/');
    }

}