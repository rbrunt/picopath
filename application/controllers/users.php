<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function home($register = FALSE) {
        $user   = $this->users_model->checkLogin();
        if($user === FALSE) redirect ('users/loginform/');
        $this->load->view('header', array('tab' => 'account'));
        $this->load->view('user_home', array('email' => $user->email, 'register' => $register));
        $this->load->view('footer');
    }

    public function login() {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $success    = $this->users_model->logIn($email, $password);
        redirect($success ? 'users/home/' : 'users/loginform/'.$email.'/');
    }
    
    public function loginform($email = ''){
        $user   = $this->users_model->checkLogin();
        if($user !== FALSE) redirect ('users/home/');
        $this->load->view('header', array('tab' => 'account'));
        $this->load->view('login', array('email' => $email));
        $this->load->view('footer');
    }
    
    public function register() {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $success    = FALSE;
        if($email != NULL && strpos($email,'@')!== FALSE && strlen($password)>5){
            $success    = $this->users_model->addUser($email, $password);
            if($success){
                $this->users_model->logIn($email, $password);
            }
        }
        redirect($success ? 'users/home/register/' : 'users/registerform/'.$email.'/');
    }
    
    public function registerform($email = ''){
        $user   = $this->users_model->checkLogin();
        if($user !== FALSE) redirect ('users/home/');
        $this->load->view('header', array('tab' => 'account'));
        $this->load->view('register', array('email' => $email));
        $this->load->view('footer');
    }
}
