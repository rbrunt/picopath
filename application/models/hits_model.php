<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hits_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function addHit($linkid) {
        $this->load->model('users_model');
        $user   = $this->users_model->checkLogin();
        $userid = '';
        if($user !== false) $userid = $user->userid;
        $referer = (isset($_SERVER['HTTP_REFERER'])) ? $this->db->escape_str($_SERVER['HTTP_REFERER']) : '';
        $linkid = $this->db->escape($linkid);
        $hit    = $this->db->query("INSERT INTO hits SET linkid=$linkid, userid='$userid', ip=".$this->db->escape($_SERVER['REMOTE_ADDR']).", referrer='$referer', useragent=".$this->db->escape($_SERVER['HTTP_USER_AGENT'])."");
        return ($this->db->insert_id()) ? $this->db->insert_id() : false;
    }
    
    public function hitCount($linkid){
        $hits = $this->db->query("SELECT COUNT(*) AS hits FROM hits WHERE linkid='$linkid'");
        return $hits->row()->hits;
    }
    
    public function hitsDetails($linkid){
        $hits = $this->db->query("SELECT * FROM hits WHERE linkid='$linkid'");
        return ($hits->num_rows() > 0) ? $hits : false;
    }    
}
