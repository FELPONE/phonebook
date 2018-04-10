<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * User_model class.
 *
 * @extends CI_Model
 */
class User_model extends CI_Model
{
    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

        parent::__construct();

    }

    /**
     * Create user.
     *
     * @access public
     * @param string $username
     * @param string $email
     * @param strinh $password
     * @return bool 
     */
    public function create_user($username, $email, $password)
    {

        $data = array(
            'username'   => $username,
            'email'      => $email,
            'password'   => $this->hash_password($password),
            'created_at' => date('Y-m-j H:i:s'),
        );

        return $this->db->insert('user', $data);

    }

    /**
     * Resolve user login
     *
     * @access public
     * @param string $username
     * @param string $password
     * @return bool 
     */
    public function resolve_user_login($username, $password)
    {

        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password');

        return $this->verify_password_hash($password, $hash);

    }

    /**
     * Ged user id by username function.
     *
     * @access public
     * @param string $username
     * @return int 
     */
    public function get_user_id_from_username($username)
    {

        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('username', $username);
        return $this->db->get()->row('id');

    }

    /**
     * Get user by id.
     *
     * @access public
     * @param int $user_id
     * @return object 
     */
    public function get_user($user_id)
    {

        $this->db->from('user');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();

    }

    /**
     *  Get all users.
     *
     * @access public
     * @return array
     */
    public function getUsers()
    {
        $query = $this->db->get('user');
        
        return $query->result_array();
    }

    /**
     * Hash password.
     *
     * @access private
     * @param string $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    private function hash_password($password)
    {

        return password_hash($password, PASSWORD_DEFAULT);

    }

    /**
     * Verify password hash function.
     *
     * @access private
     * @param string $password
     * @param string $hash
     * @return bool
     */
    private function verify_password_hash($password, $hash)
    {

        return password_verify($password, $hash);

    }

}
