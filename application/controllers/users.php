<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function home($register = FALSE) {
        //If not loggedin show loginform
        $user   = $this->users_model->checkLogin();
        if($user === FALSE) redirect ('users/loginform/');
        //Else show user home
        $loggedin = ($this->users_model->checkLogin() !== false);
        $this->load->view('header', array('loggedin' => $loggedin, 'tab' => 'account'));
        $this->load->model('links_model');
        $this->load->model('hits_model');
        $links  = $this->links_model->getLinksByUser($user->userid);
        $linksarray = array();
        if ($links !== false) {
            foreach ($links->result() as $link) {
                $linksarray[] = array(
                    'name' => $link->name,
                    'url'  => $link->url,
                    'hits' => $this->hits_model->hitCount($link->linkid),
                );
            }
        }
        $this->load->view('user_home', array('email' => $user->email, 'links' => $linksarray, 'register' => $register));
        $this->load->view('link_form', array('loggedin' => $loggedin));
        $this->load->view('footer');
    }

    public function login() {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $success    = $this->users_model->logIn($email, $password);
        redirect($success ? 'users/home/' : 'users/loginform/'.$email.'/');
    }
    
    public function loginform($email = ''){
        //If already loggedin redirect to user home
        $user   = $this->users_model->checkLogin();
        if($user !== FALSE) redirect ('users/home/');
        $loggedin = ($this->users_model->checkLogin() !== false);
        $this->load->view('header', array('loggedin' => $loggedin, 'tab' => 'account'));
        $this->load->view('login', array('email' => $email));
        $this->load->view('footer');
    }
    
    public function logout(){
        $this->users_model->logOut();
        redirect('/');
    }

    public function register() {
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $success    = FALSE;
        //Check email has an '@' and password is more than 5 chars.
        if(strpos($email,'@')!== FALSE && strlen($password)>5){
            $success    = $this->users_model->addUser($email, $password);
            //Login on success
            if($success){
                $this->users_model->logIn($email, $password);
            }
        }
        //On success go to user home with a register message... otherwise go to register form with the email prefilled.
        redirect($success ? 'users/home/register/' : 'users/registerform/'.$email.'/');
    }
    
    public function registerform($email = ''){
        //If already loggedin redirect to user home
        $user   = $this->users_model->checkLogin();
        if($user !== FALSE) redirect ('users/home/');
        $loggedin = ($this->users_model->checkLogin() !== false);
        $this->load->view('header', array('loggedin' => $loggedin, 'tab' => 'account'));
        $this->load->view('register', array('email' => $email));
        $this->load->view('footer');
    }
    
    public function submitlink(){
        $loggedin = ($this->users_model->checkLogin() !== false);
        $this->load->view('header', array('loggedin' => $loggedin, 'tab' => 'account'));
        $this->load->view('link_form', array('loggedin' => $loggedin));
        $this->load->view('footer');
    }
}
