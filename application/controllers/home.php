<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
		$this->load->model('links_model');
		$this->load->view('header', array('Tab' => 'home'));
		$this->load->view('homepage', array('links' => $this->links_model->getLinks()));
		$this->load->view('footer');
	}

}
