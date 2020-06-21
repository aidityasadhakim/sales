<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Returmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'returns';
    var $table_sale = 'sales';
    var $table_detail_sale = 'sale_details';

    public function getAllData()
    {
        $this->db->select('r.id, r.sale_id, r.note, r.transaction_date, s.code as s_code, s.id as s_id');
        $this->db->where('r.deleted_at', null);
        $this->db->from('sales as s');
        $this->db->join('returns as r', 's.id = r.sale_id');
        $this->db->order_by('r.id', 'desc');
        $this->db->where('r.deleted_at', null);
        $query = $this->db->get();
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

    public function getAllDataSales()
    {
        $this->db->select('s.id, s.code, s.transaction_date, c.name as c_name, c.id as c_id');
        $this->db->from('sales as s');
        $this->db->join('customers as c', 'c.id = s.customer_id');
        $this->db->order_by('s.id', 'desc');
        $this->db->where('s.deleted_at', null);
        $this->db->where('s.type', 'sale');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataSalesById($id='')
    {
        $this->db->select('*, s.id as s_id, c.name as c_name, m.name as m_name');
        $this->db->where('s.deleted_at', null);
        $this->db->where('s.type', 'sale');
        $this->db->from('sales as s');
        $this->db->join('customers as c', 'c.id = s.customer_id');
        $this->db->join('payment_methods as m', 'm.id = s.method_id');
        $query = $this->db->get($this->table_sale);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        else {
            return array();
        }
    }


    public function getDataDetailSalesByIdTrans($id)
    {
        $this->db->where('sale_id', $id);
        $this->db->join('items as i', 'i.id = sale_details.item_id');
        $query = $this->db->get($this->table_detail_sale);
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
        return $this->db->insert_id();
    }

    public function updateData($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

    public function updateDataSale($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        $this->db->update($this->table_sale,$data);
    }

    public function deleteData($id)
    {
        $data = array('deleted_at' => date('Y-m-d H:i:s'));
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

}

/* End of file Returmodel.php */
/* Location: ./application/models/Returmodel.php */
 ?>