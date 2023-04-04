<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class SupplyHistorymodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    var $table = 'supply_history';
    
    public function insertData($data)
    {
        // $this->db->trans_begin();
        $this->db->insert($this->table,$data);
        $idx = $this->db->insert_id();
        return $this->db->affected_rows();
        // $this->db->trans_commit();
    }

    public function getDataByItemId($id)
    {
        $this->db->order_by('transaction_date','desc');
        $this->db->where('warehouse_id', $id);
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
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }
}

/* End of file ServiceHistorymodel.php */
/* Location: ./application/models/ServiceHistorymodel.php */

 ?>