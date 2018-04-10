<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Contact_model class.
 *
 * @extends CI_Model
 */
class Contact_model extends CI_Model
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
     *  Get all contacts.
     *
     * @access public
     * @param int $limit
     * @param int $start
     * @param string $search
     * @return array
     */
    public function getContacts($limit, $start, $search)
    {

        $this->db->limit($limit, $start);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('phone_number', $search);
            $this->db->or_like('created_at', $search);
            $this->db->or_like('note', $search);
            $this->db->group_end();
        }

        $this->db->where('user_id', $_SESSION['user_id']);

        $query = $this->db->get('contact');
        
        return $query->result_array();

    }

     /**
     *  Get a contact.
     *
     * @access public
     * @param int $id
     * @return array
     */
    public function getContactById($id)
    {

        $this->db->where('id', $id);
        $this->db->where('user_id', $_SESSION['user_id']);

        $query = $this->db->get('contact');

        return $query->row_array();
    }

    /**
     * Insert a contact.
     *
     * @access public
     * @param array $data
     * @return bool 
     */
    public function insert($data)
    {

        return $this->db->insert('contact', $data);

    }

    /**
     * Update a contact.
     *
     * @access public
     * @param array $data
     * @param int $id
     * @return bool 
     */
    public function update($data, $id)
    {

        return $this->db->update('contact', $data, array('id' => $id));

    }

     /**
     * Delete a contact.
     *
     * @access public
     * @param int $id
     * @return bool 
     */
    public function delete($id)
    {

        return $this->db->delete('contact', array('id' => $id));
    }

    /**
     * Count total contact
     *
     * @access public
     * @param string $search
     * @return int 
     */
    public function get_total($search)
    {

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('phone_number', $search);
            $this->db->or_like('created_at', $search);
            $this->db->or_like('note', $search);
            $this->db->group_end();
        }
        $this->db->where('user_id', $_SESSION['user_id']);
        return $this->db->count_all_results("contact");
    }

    /**
     * Search session variable handler
     *
     * @access public
     * @param string $searchterm
     * @return string
     */
    public function searchterm_handler($searchterm)
    {

        if ($searchterm) {

            $this->session->set_userdata('searchterm', $searchterm);

            return $searchterm;

        } elseif ($this->session->userdata('searchterm')) {

            $searchterm = $this->session->userdata('searchterm');
            
            return $searchterm;
        } else {

            $searchterm = "";
            return $searchterm;
        }
    }

}
