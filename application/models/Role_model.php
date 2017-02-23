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
    
    public function has_role($role, $module_name)
    {
        $result = $this->db->query('
            SELECT create_action, read_action, update_action, delete_action FROM roles
            WHERE role = ? AND module_name = ?
        ', array($role, $module_name));
       
        return $result->row();
    }
    
    public function update_batch($data) 
    {
        $data_array = array();
        foreach ($data as $row) {
            $updated_item = array(
                'id' => $row->id,
                'create_action' => $row->create_action,
                'read_action' => $row->read_action,
                'update_action' => $row->update_action,
                'delete_action' => $row->delete_action,
            );
            $data_array[] = $updated_item;
        }
        $this->db->update_batch('roles', $data_array, 'id');   
    }
}
?>