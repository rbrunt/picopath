<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getUser($userid) {
        $user = $this->db->query("SELECT * FROM users WHERE userid = " . $this->db->escape($userid));
        return ($user->num_rows() > 0) ? $user->row() : false;
    }

    public function getUserByEmail($email) {
        $user = $this->db->query("SELECT * FROM users WHERE email LIKE " . $this->db->escape($email));
        return ($user->num_rows() > 0) ? $user->row() : false;
    }

    public function logIn($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user === false) return false;
        if (md5($password . $user->salt) != $user->password) return false;
        $lastLogin = date('Y-m-d H:i:s');
        $this->session->set_userdata('loggedin', true);
        $this->session->set_userdata('userid',   $user->userid);
        $this->session->set_userdata('hash',     md5($lastLogin . $user->salt));
        $this->db->query("UPDATE users SET last_login = '$lastLogin' WHERE userid = $user->userid LIMIT 1");
        return true;
    }

    public function logOut() {
        $this->session->unset_userdata('loggedin');
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('hash');
    }

    public function checkLogin() {
        //check if they have a session
        if (!$this->session->userdata('loggedin')) return false;
        //get the user record
        $user = $this->getUser($this->session->userdata('userid'));
        //check if they exist
        if ($user === false) return false;
        //check if the session hash matches up with the database data
        if (md5($user->last_login . $user->salt) != $this->session->userdata('hash')) return false;
        //return userid
        return $user;
    }

    public function addUser($email, $password) {
        $email    = $this->db->escape($email);
        $salt     = md5(mt_rand(0, mt_getrandmax()));
        $password = md5($password . $salt);
        $this->db->query("INSERT INTO users SET email = $email, password = '$password', salt = '$salt', ip = '" . $_SERVER['REMOTE_ADDR'] . "'");
        return $this->db->insert_id();
    }

    public function updateUser($userid, $email, $password) {
        $userid   = $this->db->escape($userid);
        $email    = $this->db->escape($email);
        $salt     = md5(mt_rand(0, mt_getrandmax()));
        $password = md5($password . $salt);
        $this->db->query("UPDATE users SET email = $email, password = '$password', salt = '$salt' WHERE userid = $userid LIMIT 1");
        return $this->db->affected_rows();
    }

    public function removeUser($userid) {
        $userid = $this->db->escape($userid);
        $this->db->query("DELETE FROM users WHERE userid = $userid LIMIT 1");
        return $this->db->affected_rows();
    }

}
