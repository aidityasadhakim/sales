<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Salemodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'sales';
    var $table_detail = 'sale_details';
    var $table_customer = 'customers';
    var $table_item = 'items';
    var $table_payment = 'payment_methods';
    var $table_claim = 'claim_paids';
    var $column_order = array(null, 'transaction_date', 'customer_id', 'code', 'total', 'cash', 'changes', 'method_id', 'is_cash', 'status', 'type', 'note');
    var $column_search = array('s.code', 'c.name');
    var $order = array('s.id' => 'desc');

    private function _getDatatablesQuery()
    {
        $this->db->select('*, s.id as s_id, c.name as c_name');
        $this->db->where('s.deleted_at', null);
        $this->db->where('s.type', 'sale');
        $this->db->from('sales as s');
        $this->db->join('customers as c', 'c.id = s.customer_id');
 
        $i = 0;
     
        foreach ($this->column_search as $item)
        {
            if($_POST['search']['value'])
            {
                 
                if($i===0)
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function getDataTables()
    {
        $this->_getDatatablesQuery();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }
 
    function countFiltered()
    {
        $this->_getDatatablesQuery();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function countAll()
    {
        $this->db->where('deleted_at', null);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAllItems()
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

    public function getDataDetailByIdTrans($id)
    {
        $this->db->where('sale_id', $id);
        $this->db->join('items as i', 'i.id = sale_details.item_id');
        $query = $this->db->get($this->table_detail);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function insertData($data)
    {
        $this->db->trans_begin();
        $dataInsert = array('transaction_date' => $data['transaction_date'],
                        'customer_id'  => $data['customer_id'],
                        'code'  => '-',
                        'total'  => $data['total'],
                        'cash'  => $data['cash'],
                        'changes' => $data['changes'],
                        'method_id' => $data['method_id'],
                        'is_cash'  => $data['is_cash'],
                        'status' => 2,
                        'type' => 'sale',
                        'note' => $data['note'],
                        'user_id' => $this->session->userdata('id'),
                        'created_at' => date('Y-m-d H:i:s')
                        ); 
        $this->db->insert($this->table,$dataInsert);
        $idx = $this->db->insert_id();

        foreach ($data['item_ids'] as $key => $value) {
            $dataInsertDetail = array('sale_id' => $idx,
                                    'item_id' => $value,
                                    'qty' => $data['qty'][$key],
                                    'price' => $data['price'][$key]
                                    );
            $this->db->insert($this->table_detail, $dataInsertDetail);
            $dataInsertMutation = array('transaction_id' => $idx,
                                    'item_id' => $value,
                                    'amount' => '-'.$data['qty'][$key],
                                    'type' => 'sale',
                                    'created_at' => date('Y-m-d H:i:s')
                                    );
            $this->db->insert('stock_mutations', $dataInsertMutation);

            $res = $this->decreaseStock($value, $data['qty'][$key]);

            if ($res == 0) {
                $this->db->trans_rollback();
                return array('msg' => 'fail');
            }
        }
        $this->db->trans_commit();
        return array('msg' => 'success', 'trans_id' => $idx);
    }

    public function decreaseStock($item_id = '', $qty)
    {
        $this->db->set('stock', 'stock - '.$qty, FALSE);
        $this->db->where('id', $item_id);
        $this->db->where('stock >=', $qty);
        $this->db->update($this->table_item);
        return $this->db->affected_rows();
    }

    public function increaseStock($item_id = '', $qty)
    {
        $this->db->set('stock', 'stock + '.$qty, FALSE);
        $this->db->where('id', $item_id);
        $this->db->update($this->table_item);
    }

    public function updateData($id, $data)
    {
        $this->db->trans_begin();
        $dataUpdate = array('transaction_date' => $data['transaction_date'],
                        'customer_id'  => $data['customer_id'],
                        'code'  => '-',
                        'total'  => $data['total'],
                        'cash'  => $data['cash'],
                        'changes' => $data['changes'],
                        'method_id' => $data['method_id'],
                        'is_cash'  => $data['is_cash'],
                        'status' => 2,
                        'type' => 'sale',
                        'note' => $data['note'],
                        'user_id' => $this->session->userdata('id'),
                        'updated_at' => date('Y-m-d H:i:s')
                        ); 
        $this->db->where('id', $id);
        $this->db->update($this->table, $dataUpdate);

        $this->db->where('sale_id', $id);
        $this->db->delete($this->table_detail);

        $this->db->where('transaction_id', $id);
        $this->db->where('type', 'sale');
        $this->db->delete('stock_mutations');

        foreach ($data['item_ids'] as $key => $value) {
            $dataInsertDetail = array('sale_id' => $id,
                                    'item_id' => $value,
                                    'qty' => $data['qty'][$key],
                                    'price' => $data['price'][$key]
                                    );
            $this->db->insert($this->table_detail, $dataInsertDetail);
            $dataInsertMutation = array('transaction_id' => $id,
                                    'item_id' => $value,
                                    'amount' => '-'.$data['qty'][$key],
                                    'type' => 'sale',
                                    'created_at' => date('Y-m-d H:i:s')
                                    );
            $this->db->insert('stock_mutations', $dataInsertMutation);

            $res = $this->decreaseStock($value, $data['qty'][$key]);

            if ($res == 0) {
                $this->db->trans_rollback();
                return array('msg' => 'fail');
            }
        }
        $this->db->trans_commit();
        return array('msg' => 'success');
    }

    public function updateDataSalesById($id, $data)
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

        $this->db->where('sale_id', $id);
        $this->db->delete($this->table_detail);

        $this->db->where('transaction_id', $id);
        $this->db->where('type', 'sale');
        $this->db->delete('stock_mutations');
    }

    public function insertDataPay($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table_claim, $data);
    }

}

/* End of file Salemodel.php */
/* Location: ./application/models/Salemodel.php */
 ?>