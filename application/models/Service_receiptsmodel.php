<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Service_receiptsmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table_service_receipts = 'service_receipts';
    var $table_service = 'service';

    public function getAllItems()
    {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get($this->table_item);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataById($id)
    {
        $this->db->where('receipt_id', $id);
        $query = $this->db->get($this->table_service_receipts);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return array();
        }
    }

    public function insertData($data)
    {
        $this->db->trans_begin();
        $this->db->insert($this->table_service_receipts,$data);
        $idx = $this->db->insert_id();
        $this->db->trans_commit();
        return array('msg' => 'success', 'trans_id' => $idx);
    }

    public function updateDataServiceReceiptsById($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->table_service_receipts,$data);
    }

    public function updateData($id, $data)
    {
        $this->db->trans_begin();
        $dataUpdate = array('transaction_date' => $data['transaction_date'],
                        'is_customer'  => $data['is_customer'],
                        'customer_id'  => $data['customer_id'],
                        'customer_name'  => $data['customer_name'],
                        'total'  => $data['total'],
                        'cash'  => $data['cash'],
                        'changes' => $data['changes'],
                        'method_id' => $data['method_id'],
                        'type_service' => $data['type_service'],
                        'is_cash'  => $data['is_cash'],
                        'status' => 2,
                        'type' => 'service',
                        'note' => $data['note'],
                        'user_id' => $this->session->userdata('id'),
                        'updated_at' => date('Y-m-d H:i:s')
                        ); 
        $this->db->where('id', $id);
        $this->db->update($this->table, $dataUpdate);
        $this->db->trans_commit();
        return array('msg' => 'success');
    }
}

/* End of file Service_receiptsmodel.php */
/* Location: ./application/models/Service_receiptsmodel.php */
 ?>