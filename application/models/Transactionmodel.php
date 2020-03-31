<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactionmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'transactions';

    public function getAllDataByType($type)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('unit_type', $type);
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

    public function getDataUnitByTransId($id, $table)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return array();
        }
    }

    public function getLastMonthBill($type, $id, $month, $year)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('unit_type', $type);
        $this->db->where('unit_id', $id);
        $this->db->where('MONTH(period)', $month);
        $this->db->where('YEAR(period)', $year);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return array();
        }
    }

    public function checkBillExistThisMonth($type, $id, $month, $year)
    {
        $this->db->where('deleted_at', null);
        $this->db->where('unit_type', $type);
        $this->db->where('unit_id', $id);
        $this->db->where('MONTH(period)', $month);
        $this->db->where('YEAR(period)', $year);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function getAllDataByUnitId($type, $unit_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('unit_type', $type);
        $this->db->where('unit_id', $unit_id);
        $this->db->where('deleted_at', null);
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

}

/* End of file Transactionmodel.php */
/* Location: ./application/models/backend/Transactionmodel.php */
 ?>