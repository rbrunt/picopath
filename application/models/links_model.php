<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getLink($linkid) {
        $link = $this->db->query("SELECT * FROM links WHERE linkid = " . $this->db->escape($linkid));
        return ($link->num_rows() > 0) ? $link->row() : false;
    }

    public function getLinkByName($name) {
        $link = $this->db->query("SELECT * FROM links WHERE name = " . $this->db->escape(strtolower($name)));
        return ($link->num_rows() > 0) ? $link->row() : false;
    }

    public function getLinkByURL($url) {
        $link = $this->db->query("SELECT * FROM links WHERE url = " . $this->db->escape($url));
        return ($link->num_rows() > 0) ? $link->row() : false;
    }

    public function getLinks() {
        $links = $this->db->query("SELECT * FROM links");
        return ($links->num_rows() > 0) ? $links : false;
    }

    public function addLink($url, $userid = 0, $name = "") {
        //If not logged in or no name defined
        if($userid == 0 || $name == "" || $name == false) {
            //check to see if we can reuse an existing link / name
            $existing = $this->getLinkByURL($url);
            if ($existing !== false) return $existing->name;
            //Generate a new name until a unique one found
            while (true) {
                $name      = str_replace(array('=', '+', '/'), '', base64_encode(mt_rand(0, mt_getrandmax())));
                $name      = substr($name, 0, MAX_LINK_SIZE);
                $duplicate = $this->getLinkByName($name);
                if($duplicate === FALSE) break;
            }
        } elseif ($name != "") {
            $duplicate = $this->getLinkByName($name);
            if($duplicate !== FALSE) return false;
        }
        $userid = $this->db->escape($userid);
        $name   = $this->db->escape(strtolower($name));
        $url    = $this->db->escape($url);
        $this->db->query("INSERT INTO links SET userid = $userid, name = $name, url = $url");
        return trim($name, "'");
    }

    public function updateLink($linkid, $userid, $name, $url) {
        $linkid = $this->db->escape($linkid);
        $userid = $this->db->escape($userid);
        $name   = $this->db->escape(strtolower($name));
        $url    = $this->db->escape($url);
        $this->db->query("UPDATE links SET name = $name, url = $url WHERE linkid = $linkid AND userid = $userid LIMIT 1");
        return $this->db->affected_rows();
    }

    public function removeLink($linkid) {
        $linkid = $this->db->escape($linkid);
        $this->db->query("DELETE FROM links WHERE linkid = $linkid LIMIT 1");
        return $this->db->affected_rows();
    }

}
