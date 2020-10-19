<?php

class admin_model extends CI_Model
{

    public function getAllUser()
    {
        return $this->db->get('user')->result_array();
    }

    public function history($id)
    {
        $this->db->select('*');
        $this->db->from('user_history');
        $this->db->join('order_masuk', 'user_history.id_history = order_masuk.id_order');
        $this->db->join('user', 'user_history.id_userr = user.id_user');
        // $query = $this->db->get($id);
        // return $query->result();
        // return $this->db->get_where('user',['id_user' => $id])->row_array();
    }
    function logged_id()
    {
        return $this->session->admin('id');
        
    }
    public function countAllCustomer()
    {
        return $this->db->get('customer')->num_rows();
    }
}