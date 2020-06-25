<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportmodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table_item = 'items';
    var $table_stock = 'stock_mutations';
    var $table_sale = 'sales';
    var $table_purchase = 'purchases';

    public function getAllItems($value='')
    {
        $this->db->order_by('name', 'asc');
        $this->db->where('deleted_at', null);
        $query = $this->db->get($this->table_item);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataStockByPeriod($start_date, $end_date, $item_id)
    {
        $this->db->order_by('id', 'asc');
        $this->db->where('deleted_at', null);
        $this->db->where('item_id', $item_id);
        $this->db->where('DATE(created_at) >=', $start_date);
        $this->db->where('DATE(created_at) <=', $end_date);
        $query = $this->db->get($this->table_stock);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataCashSaleByPeriod($start_date, $end_date, $method)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('deleted_at', null);
        $this->db->where('is_cash', 1);
        $this->db->where('status', 2);
        if ($method != 0) {
            $this->db->where('method_id', $method);
        }
        $this->db->where('DATE(transaction_date) >=', $start_date);
        $this->db->where('DATE(transaction_date) <=', $end_date);
        $query = $this->db->get($this->table_sale);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataCashPurchaseByPeriod($start_date, $end_date, $method)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('deleted_at', null);
        $this->db->where('is_cash', 1);
        $this->db->where('status', 2);
        if ($method != 0) {
            $this->db->where('method_id', $method);
        }
        $this->db->where('DATE(transaction_date) >=', $start_date);
        $this->db->where('DATE(transaction_date) <=', $end_date);
        $query = $this->db->get($this->table_purchase);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataSalesByPeriod($start_date, $end_date)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('deleted_at', null);
        $this->db->where('status', 2);
        $this->db->where('DATE(transaction_date) >=', $start_date);
        $this->db->where('DATE(transaction_date) <=', $end_date);
        $query = $this->db->get($this->table_sale);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function getDataPurchasesByPeriod($start_date, $end_date)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('deleted_at', null);
        $this->db->where('status', 2);
        $this->db->where('DATE(transaction_date) >=', $start_date);
        $this->db->where('DATE(transaction_date) <=', $end_date);
        $query = $this->db->get($this->table_purchase);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

}

/* End of file Customermodel.php */
/* Location: ./application/models/Customermodel.php */
 ?>