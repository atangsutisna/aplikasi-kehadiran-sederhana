<?php


class Role_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function find_all() 
    {
        $query = $this->db->get('roles');
        return $query->result();
    }
    
    public function insert($data) 
    {
        $this->db->set($data);
        $this->db->insert('roles');
    }
    
    public function update($id, $data) 
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('roles');
    }
    
    public function find_all_by_role($role) 
    {
        $this->db->where('role', $role);
        $result = $this->db->get('roles');
        return $result->result();
    }
    
    public function delete($id)
    {
        $this->db->delete('roles', array('id' => $id));
    }
    
}
?>