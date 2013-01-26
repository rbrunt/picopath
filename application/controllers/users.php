<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function login() {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $success    = $this->users_model->logIn($email, $password);
        redirect($success ? 'users/home/' : 'users/loginform/'.$email.'/');
    }
    
    public function loginform($email = ''){
        $this->load->view('header', array('tab' => 'account'));
        $this->load->view('login', array('email' => $email));
        $this->load->view('footer');
    }
}
