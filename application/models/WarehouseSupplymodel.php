<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class WarehouseSupplymodel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    var $table = 'warehouse_supply';
    var $table_item = 'items';
    var $table_supply = 'supply_history';
    
    var $column_order = array(null,'updated_at', 'item_id', 'stock_inside', 'customer_name');
    var $column_search = array('i.name', 'i.note');
    var $order = array('w.id' => 'desc');

    private function _getDatatablesQuery()
    {
        $this->db->select('w.id,w.updated_at,w.item_id, w.stock_inside, i.name, i.stock, i.note, (i.stock - w.stock_inside) as stockOutside');
        $this->db->where('w.deleted_at',null);
        $this->db->from('warehouse_supply as w');
        $this->db->join('items as i','w.item_id = i.id');
 
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
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getAllItems()
    {
        $this->db->order_by('name', 'asc');
        $this->db->where('deleted_at', null);
        $this->db->where('stock >', 0);
        $query = $this->db->get($this->table_item);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        else {
            return array();
        }
    }

    public function searchItems($keyword, $offset, $limit, $uid)
    {
        $this->db->order_by('name', 'asc');
        $this->db->where('deleted_at', null);
        // $this->db->where('stock >', 0);
        $this->db->where_not_in('id', $uid);
        $this->db->like('name', $keyword);
        $query = $this->db->get($this->table_item, $limit, $offset);
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
        $this->db->select('sale_details.id, sale_details.sale_id, sale_details.item_id, sale_details.qty, sale_details.price, i.name, i.stock');
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

    public function decreaseStock($id = '', $qty)
    {
        $this->db->trans_begin();
        $this->db->set('stock_inside', 'stock_inside - '.$qty, FALSE);
        $this->db->set('updated_at', date('Y-m-d'), FALSE);
        $this->db->where('id', $id);
        $this->db->where('stock_inside >=', $qty);
        $this->db->update($this->table);
        if($this->db->affected_rows() > 0){
            $this->db->trans_commit();
            return array("msg" => "success");
        } else {
            $this->db->trans_rollback();
            return array("msg" => "fail");
        }
    }

    public function increaseStock($id = '', $qty)
    {
        // $this->db->set('stock_inside', 'stock_inside + '.$qty, FALSE);
        // $this->db->set('updated_at', date('Y-m-d H:i:s'), FALSE);
        // $this->db->where('id', $item_id);
        $this->db->trans_begin();
        $date = date('Y-m-d H:i:s');
        $query = "
            UPDATE warehouse_supply
            SET stock_inside = stock_inside + ".$qty.", updated_at = "."'".$date."'"."
            WHERE id = ".$id."
        ";
        $this->db->query($query);
        if($this->db->affected_rows() > 0){
            $this->db->trans_commit();
            return array("msg" => "success");
        } else {
            $this->db->trans_rollback();
            return array("error" => "fail");
        }
    }

    public function insertItem($data){
        $this->db->trans_begin();
        foreach ($data['item_ids'] as $key => $value) {
            $this->db->where('item_id',$value);
            $this->db->where('deleted_at',null);
            $checkExist = $this->db->get($this->table)->num_rows();
            if($checkExist == 0 ){
                $dataInsertDetail = array(
                                        'item_id' => $value,
                                        'stock_inside' => $data['qty'][$key],
                                        'updated_at' => $data['transaction_date']
                                        );
                $this->db->insert($this->table, $dataInsertDetail);
                $idx = $this->db->insert_id();

                $dataHistoryInsert = array(
                    "warehouse_id" => $idx,
                    "qty" => $data['qty'][$key],
                    "status" => 'increase',
                    "keterangan" => 'Barang Masuk',
                    "transaction_date" => date('Y-m-d H:i:s')
                );
                $this->db->insert($this->table_supply, $dataHistoryInsert);
                $idx_result = $this->db->insert_id();
                $this->db->where('id',$idx_result);
                $row_supply = $this->db->get($this->table)->num_rows();

                $this->db->where('item_id',$value);
                $row = $this->db->get($this->table)->num_rows();
                if($row == 0 && $row_supply){
                    $this->db->trans_rollback();
                    return array("msg" => "fail");
                }
            } else {
                return array("msg" => "exist");
            }
        }
        $this->db->trans_commit();
        return array("msg" => "success");
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

        if (!empty($data['item_ids'])) {
            $this->db->where('sale_id', $id);
            $this->db->update($this->table_stock, array('sale_id' => null));

            $this->db->where('sale_id', $id);
            $this->db->delete($this->table_detail);

            $this->db->where('transaction_id', $id);
            $this->db->where('type', 'service');
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

                $this->db->where('deleted_at', null);
                $this->db->where('item_id', $value);
                $this->db->where('sale_id IS NULL', null, false);
                $row = $this->db->get($this->table_stock)->num_rows();
                if ($row < $data['qty'][$key]) {
                    $this->db->trans_rollback();
                    return array('msg' => 'fail');
                }
                else {
                    $limit = $data['qty'][$key];
                    $query = "UPDATE stocks SET sale_id='$id'
                                WHERE id IN (
                                    SELECT id FROM (
                                        SELECT id FROM stocks
                                        WHERE sale_id IS NULL
                                        AND
                                        item_id = '$value'
                                        AND
                                        deleted_at IS null
                                        ORDER BY id ASC
                                        LIMIT 0, $limit
                                    ) tmp
                                )";
                    $this->db->query($query);
                    if ($this->db->affected_rows() == 0) {
                        $this->db->trans_rollback();
                        return array('msg' => 'fail');
                    }
                }

                $res = $this->decreaseStock($value, $data['qty'][$key]);

                if ($res == 0) {
                    $this->db->trans_rollback();
                    return array('msg' => 'fail');
                }
            }
        }
        $this->db->trans_commit();
        return array('msg' => 'success');
    }

    public function updateDataServicesById($id, $data)
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

    public function insertDataPay($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table_claim, $data);
    }

}

/* End of file WarehouseSupplymodel.php */
/* Location: ./application/models/WarehouseSupplymodel.php */
 ?>