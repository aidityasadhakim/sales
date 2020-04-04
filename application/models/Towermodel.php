<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Towermodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'towers';

    public function getAllData()
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('parent_id', 0);
        $this->db->where('deleted_at', null);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataById($id)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return array();
        }
    }

    public function insertData($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table,$data);
    }

    public function updateData($id,$data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

    public function deleteData($id)
    {
        $data = array('deleted_at' => date('Y-m-d H:i:s'));
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

    public function getFloorsByParentId($parent_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('deleted_at', null);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

}

/* End of file Towermodel.php */
/* Location: ./application/models/backend/Towermodel.php */
 ?>