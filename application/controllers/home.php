<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('links_model');
        $this->load->model('users_model');
        $loggedin = ($this->users_model->checkLogin() !== false);
        $this->load->view('header', array('loggedin' => $loggedin, 'tab' => 'home'));
        $this->load->view('homepage', array('loggedin' => $loggedin, 'links' => $this->links_model->getLinks()));
        $this->load->view('footer');
    }

}
