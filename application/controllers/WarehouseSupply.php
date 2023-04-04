<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class WarehouseSupply extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Itemmodel', 'item');
        $this->load->model('WarehouseSupplymodel', 'warehouse_supply');
        $this->load->model('SupplyHistorymodel', 'supply_history');
        $this->load->model('Customermodel', 'customer');
        $this->load->model('PaymentMethodmodel', 'method');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Manajemen Stok';
        $data['page'] = 'warehousesupply';
        $this->load->view('warehouse_supply/view', $data);
    }

    function getDataTable()
    {
        $list = $this->warehouse_supply->getDataTables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('warehousesupply/history/'.$field['id']).'">'.$field['name'].'</a>';
            $row[] = $field['stock_inside'];
            $row[] = $field['note'];
            $row[] = '<div class="btn-group">
                            <a href="'.base_url('warehousesupply/add/increase/'.$field['id']).'" class="btn btn-primary">Masuk</a>
                            <a href="'.base_url('warehousesupply/add/decrease/'.$field['id']).'" class="btn btn-warning">Keluar</a>
                            <a href="'.base_url('warehousesupply/delete/'.$field['id']).'" class="btn btn-danger">Hapus</a>
                          </div>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->warehouse_supply->countAll(),
            "recordsFiltered" => $this->warehouse_supply->countFiltered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function history($warehouse_id)
    {
        $data['history'] = $this->supply_history->getDataByItemId($warehouse_id);
        $item_id = $this->warehouse_supply->getDataById($warehouse_id)['item_id'];
        $data['item_id'] = $item_id;
        $this->load->view('history/supply_history',$data);
    }

    // Add a new item
    public function add($type, $warehouse_id)
    {
        if ($this->input->post('submit')) {

            $amount = $this->input->post('amount');
            $note = $this->input->post('note');
            
            $dataHistoryInsert = array(
                "warehouse_id" => $warehouse_id,
                "qty" => $amount,
                "status" => $type,
                "keterangan" => $note,
                "transaction_date" => date('Y-m-d H:i:s')
            );

            if ($type == 'increase') {
                $result = $this->warehouse_supply->increaseStock($warehouse_id,$amount);
                $this->supply_history->insertData($dataHistoryInsert);
                if ($result['msg'] == 'success') {
                    $this->session->set_flashdata('msg', 'Stok Berhasil Ditambah!');
                    redirect('warehousesupply');
                }
                else {
                    $this->session->set_flashdata('error', 'Stok Gagal Ditambah!');
                    redirect('warehousesupply');
                }
            }
            else {
                $result = $this->warehouse_supply->decreaseStock($warehouse_id,$amount);
                $this->supply_history->insertData($dataHistoryInsert);
                if ($result['msg'] == 'success') {
                    $this->session->set_flashdata('msg', 'Stok berhasil dikurangkan!');
                    redirect('warehousesupply');
                }
                else {
                    $this->session->set_flashdata('error', 'Stok gagal dikurangkan!');
                    redirect('warehousesupply');
                }
            }
            
        }
        else {
            if ($type == 'increase') {
                $data['title'] = 'Tambah Stok Dalam';
            }
            else {
                $data['title'] = 'Kurangi Stok Dalam';
            }
            $data['page']  = 'master';
            $data['type'] = $type;
            $item_id = $this->warehouse_supply->getDataById($warehouse_id)['item_id'];
            $data['item_id'] = $item_id;
            $this->load->view('warehouse_supply/insert_stock',$data);
        }
    }

    public function addItem(){
        if ($this->input->post('submit')) {
            $transaction_date = $this->input->post('transaction_date');
            // $note = $this->input->post('note');
            $item_ids = $this->input->post('item_ids');
            $qty = $this->input->post('qty');

            $dataInsert = array('transaction_date' => $transaction_date,
                        'item_ids'  => $item_ids,
                        'qty'  => $qty
                        );            

            $result = $this->warehouse_supply->insertItem($dataInsert);
            if ($result['msg'] == 'success') {
                $this->session->set_flashdata('msg', "Data berhasil ditambah!");
                redirect('warehousesupply');
            }
            else if($result['msg'] == 'fail') {
                $this->session->set_flashdata('error', 'Data gagal ditambah!');
                redirect('warehousesupply');   
            } else {
                $this->session->set_flashdata('error', 'Data Sudah Ada!');
                redirect('warehousesupply');   
            }
        }
        else {
            $data['title'] = 'Tambah Data Stok Dalam';
            $data['page']  = 'master';
            $data['customers'] = $this->customer->getAllData();
            $data['methods'] = $this->method->getAllData();
            // $data['items'] = $this->sale->getAllItems();
            $this->load->view('warehouse_supply/insert',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->warehouse_supply->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('warehousesupply');
    }

    public function getDataProduct()
    {
        $id = $this->input->post('id');
        $is_customer = $this->input->post('is_customer');
        $row = $this->item->getDataById($id);
        $stock = $this->item->getAvailableStock($id);
        if ($is_customer == 0) {
            // $percentage = getDataColumn('percentages', 'label', 'harga-umum', 'amount');
            // $price = $row['salePrice'] + (($row['salePrice']*$percentage)/100);
            $price = $row['salePrice'];
        }
        else {
            $price = $row['salePrice'];
        }
        $data = array('price' => $price, 'stock' => $stock);
        echo json_encode($data);
    }
}

/* End of file WarehouseSupply.php */
/* Location: ./application/controllers/WarehouseSupply.php */

 ?>