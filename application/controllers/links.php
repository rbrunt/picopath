<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($name) {
        $this->load->model('links_model');
        $link   = $this->links_model->getLinkByName($name);
        if($link === FALSE) {
            show_404 ();
        } else {
            redirect($link->url);
        }
    }

}
