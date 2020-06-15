<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliermodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'suppliers';

    public function getAllData()
    {
        $this->db->order_by('name', 'asc');
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
        $this->db->where('id', $id);
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
        return $this->db->insert_id();
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

}

/* End of file Suppliermodel.php */
/* Location: ./application/models/Suppliermodel.php */
 ?>