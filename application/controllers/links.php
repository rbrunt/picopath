<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('links_model');
    }

    public function index($name = false) {
        if ($name === false) $name = str_replace("/", "", uri_string());
        $link = $this->links_model->getLinkByName($name);
        if($link === FALSE) {
            show_404 ();
        } else {
            $this->load->model('hits_model');
            $this->hits_model->addHit($link->linkid);
            redirect($link->url);
        }
    }
    
    public function addlink() {
        $url    = $this->input->post('url');
        $name   = $this->input->post('name');
        if (
            substr($url, 0, 7) != 'http://'  &&
            substr($url, 0, 8) != 'https://'
        ) die("false");
        $this->load->model('users_model');
        $user = $this->users_model->checkLogin();
        $userid = ($user === false) ? 0 : $user->userid;
        $name = $this->links_model->addLink($url, $userid, $name);
        echo ($name !== false) ? $name : "false";
    }

}
