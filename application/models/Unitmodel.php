<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unitmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'rooms';
    var $table_tower = 'towers';
    var $table_owner = 'owners';
    var $table_facility = 'unit_facilities';
    var $table_photo = 'unit_images';

    public function getAllData($type = null)
    {
        $this->db->order_by('id', 'desc');
        if ($type != null) {
            $this->db->where('type', $type);
        }
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

    public function getDataByType($type)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('type', $type);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
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

    public function getTowers()
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('parent_id', 0);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_tower);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getFloorsByParentId($parent_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_tower);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getOwnersByType($type)
    {
        $this->db->order_by('name', 'asc');
        $this->db->where('type', $type);
        $this->db->where('status', 1);
        $query = $this->db->get($this->table_owner);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function addFacilities($data)
    {
        $this->db->insert($this->table_facility,$data);
    }

    public function removeFacilities($id)
    {
        $this->db->where('unit_id',$id);
        $this->db->delete($this->table_facility);
    }

    public function getAllPhotoByUnitId($unit_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('unit_id', $unit_id);
        $query = $this->db->get($this->table_photo);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getPhotoById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table_photo);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return array();
        }
    }

    public function insertDataPhoto($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table_photo,$data);
    }

    public function updateDataPhoto($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        $this->db->update($this->table_photo,$data);
    }

    public function deleteDataPhoto($id)
    {
        $this->db->where('id',$id);
        $this->db->delete($this->table_photo);
    }

}

/* End of file Unitmodel.php */
/* Location: ./application/models/backend/Unitmodel.php */
 ?>