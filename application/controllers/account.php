<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$this->load->model('links_model');
                $loggedin = ($this->users_model->checkLogin() !== false);
		$this->load->view('header', array('loggedin' => $loggedin, 'tab' => 'account'));
		$this->load->view('homepage', array('links' => $this->links_model->getLinks()));
		$this->load->view('footer');
	}

}
