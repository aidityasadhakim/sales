<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Stockmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'stock_mutations';

    public function getStockByItemId($item_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('deleted_at', null);
        $this->db->where('item_id', $item_id);
        $this->db->where('type', 'stock');
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

/* End of file Stockmodel.php */
/* Location: ./application/models/Stockmodel.php */

 ?>