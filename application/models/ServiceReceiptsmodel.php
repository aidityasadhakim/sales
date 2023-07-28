<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ServiceReceiptsmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'service_receipts';
    var $table_service = 'service';

    var $column_order = array(null, 'receipt_id', 'is_customer', 'customer_id', 'customer_name', 'code', 'total', 'cash', 'changes', 'method_id', 'is_cash', 'status', 'type', 'note');
    var $column_search = array('s.customer_name', 's.phone_number', 's.phone_type');
    var $order = array('s.id' => 'desc');

    private function _getDatatablesQuery()
    {
        $this->db->select('*');
        $this->db->where('s.deleted_at', null);
        $this->db->from('service_receipts as s');

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function getDataTables()
    {
        $this->_getDatatablesQuery();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllItems()
    {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get($this->table_item);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getDataById($id)
    {
        $this->db->where('receipt_id', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return array();
        }
    }

    public function insertData($data)
    {
        $this->db->trans_begin();
        try {
            # code...
            $this->db->insert($this->table, $data);
            $idx = $this->db->insert_id();
            $this->db->trans_commit();
            return array('msg' => 'success', 'trans_id' => $idx);
        } catch (\Throwable $e) {
            # code...
            $this->db->trans_rollback();
            return array('msg' => 'fail');
        }
    }

    public function updateDataServiceReceiptsById($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    public function updateData($id, $data)
    {
        $this->db->trans_begin();
        $dataUpdate = array(
            'transaction_date' => $data['transaction_date'],
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

    public function deleteDataById($id)
    {
        # code...
        $this->db->trans_begin();
        try {
            $data = array('deleted_at' => date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $this->db->update($this->table, $data);
            $this->db->trans_commit();
            return array('msg' => 'success');
        } catch (\Throwable $e) {
            $this->db->trans_rollback();
            return array('msg' => 'fail');
        }
    }
}

/* End of file Service_receiptsmodel.php */
/* Location: ./application/models/Service_receiptsmodel.php */