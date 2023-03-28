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
            $row[] = '<a href="'.base_url('warehousesupply/history/'.$field['item_id']).'">'.$field['name'].'</a>';
            $row[] = $field['stockInside'];
            $row[] = $field['note'];
            $row[] = '<div class="btn-group">
                            <a href="'.base_url('warehousesupply/add/increase/'.$field['item_id']).'" class="btn btn-success">Masuk</a>
                            <a href="'.base_url('warehousesupply/add/decrease/'.$field['item_id']).'" class="btn btn-danger">Keluar</a>
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

    public function history($item_id)
    {
        $data['history'] = $this->supply_history->getDataByItemId($item_id);
        $data['item_id'] = $item_id;
        $this->load->view('history/supply_history',$data);
    }

    // Add a new item
    public function add($type, $item_id)
    {
        if ($this->input->post('submit')) {

            $amount = $this->input->post('amount');
            $note = $this->input->post('note');
            
            $dataHistoryInsert = array(
                "item_id" => $item_id,
                "qty" => $amount,
                "status" => $type,
                "keterangan" => $note,
                "transaction_date" => date('Y-m-d H:i:s')
            );

            if ($type == 'increase') {
                $this->warehouse_supply->increaseStock($item_id,$amount);
                $this->supply_history->insertData($dataHistoryInsert);
                $this->session->set_flashdata('msg', 'Stok berhasil ditambah!');
                redirect('warehousesupply');
            }
            else {
                $result = $this->warehouse_supply->decreaseStock($item_id,$amount);
                $this->supply_history->insertData($dataHistoryInsert);
                if ($result['msg'] == 'fail') {
                    $this->session->set_flashdata('error', 'Stok gagal dikurangkan!');
                    redirect('warehousesupply');
                }
                else {
                    $this->session->set_flashdata('msg', 'Stok berhasil dikurangkan!');
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
            $data['item_id'] = $item_id;
            $this->load->view('warehouse_supply/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->service->getDataById($id);
        $data['details'] = $this->service->getDataDetailByIdTrans($id);
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            if ($this->input->post('is_customer') != 0) {
                $customer_id = $this->input->post('customer_id');
                $customer_name = getDataColumn('customers', 'id', $customer_id, 'name');
                $is_customer = 1;
            }
            else {
                $customer_id = null;
                $customer_name = $this->input->post('customer_name');
                $is_customer = 0;
            }
            $note = $this->input->post('note');
            $method_id = $this->input->post('method_id');
            $type_service = ($this->input->post('type_service') != null) ? $this->input->post('type_service') : 'hardware';

            $item_ids = ($this->input->post('item_ids')[0] == '') ? null : $this->input->post('item_ids');
            $price = $this->input->post('price');
            $qty = $this->input->post('qty');

            $is_cash = ($this->input->post('is_cash') != null) ? $this->input->post('is_cash') : 1;
            $payment_at = ($this->input->post('is_cash') != null) ? null : date('Y-m-d H:i:s');
            $total = $this->input->post('total');
            $cash = $this->input->post('cash');
            $changes = $this->input->post('changes');


            $dataUpdate = array('transaction_date' => $transaction_date,
                        'is_customer'  => $is_customer,
                        'customer_id'  => $customer_id,
                        'customer_name'  => $customer_name,
                        'total'  => $total,
                        'cash'  => $cash,
                        'changes' => $changes,
                        'method_id' => $method_id,
                        'type_service' => $type_service,
                        'is_cash'  => $is_cash,
                        'payment_at'  => $payment_at,
                        'item_ids'  => $item_ids,
                        'price'  => $price,
                        'status' => 2,
                        'type' => 'service',
                        'note' => $note,
                        'qty'  => $qty
                        );            

            $result = $this->service->updateData($id, $dataUpdate);
            if ($result['msg'] == 'success') {
                $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                redirect('service');
            }
            else {
                $this->session->set_flashdata('error', 'Data gagal diubah! Stok tidak cukup.');
                redirect('service');   
            }
        }
        else {
            $data['title'] = 'Ubah Data Servis';
            $data['page']  = 'master';
            $data['customers'] = $this->customer->getAllData();
            $data['methods'] = $this->method->getAllData();
            $data['items'] = $this->service->getAllItems();
            $this->load->view('services/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->service->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('service');
    }

    public function detail($id = '', $type = '')
    {
        $data['title'] = 'Detail Data Servis';
        $data['page']  = 'master';
        $data['row'] = $this->service->getDataById($id);
        $data['details'] = $this->service->getDataDetailByIdTrans($id);
        $data['history'] = $this->service_history->getDataByReceiptId($id);
        if ($type == 'teknisi') {
            $this->load->view('services/detail-teknisi',$data);
        }
        else {
            $this->load->view('services/detail',$data);
        }
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

    public function pay($id = '')
    {
        $data['row'] = $this->service->getDataById($id);
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            $method_id = $this->input->post('method_id');
            $total = $this->input->post('total');
            $cash = $this->input->post('cash');
            $changes = $this->input->post('changes');


            $dataUpdate = array(
                        'cash'  => $cash,
                        'changes' => $changes,
                        'method_id' => $method_id,
                        'payment_at' => date('Y-m-d H:i:s'),
                        'is_cash'  => 1
                        );            

            $this->service->updateDataServicesById($id, $dataUpdate);

            $dataInsert = array('transaction_date' => $transaction_date, 
                        'sale_id' => $id,
                        'amount' => $cash,
                        'paid_by' => $this->session->userdata('id')
                        );

            $this->service->insertDataPay($dataInsert);
            $dataHistory = $this->service_receipts->getDataById($id);
            $this->addHistory($dataHistory,'Lunas');
            
            $this->session->set_flashdata('msg', 'Pembayaran Berhasil!');
            redirect('service');
        }
        else {
            $data['title'] = 'Pembayaran Piutang '.$data['row']['code'];
            $data['page']  = 'master';
            $data['methods'] = $this->method->getAllData();
            $this->load->view('services/pay',$data);
        }
    }

    public function addHistory($data = NULL, $status)
    {
        $dataInsert = array(
            'receipt_id' => $data['receipt_id'],
            'transaction_date' => date('Y-m-d H:i:s'),
            'name'  => $data['name'],
            'phone' => $data['phone'],
            'tipe_hp' => $data['tipe_hp'],
            'kerusakan' => $data['kerusakan'],
            'kelengkapan' => $data['kelengkapan'],
            'keterangan' => $data['keterangan'],
            'penerima' => $data['penerima'],
            'status' => $status
        );

        $this->service_history->insertData($dataInsert);
    }

    public function cetak($id = null)
    {
        $data['info'] = $this->paper->getDataDefault();
        $data['row'] = $this->service->getDataById($id);
        $data['details'] = $this->service->getDataDetailByIdTrans($id);
        $this->load->view('services/print', $data);
    }

    public function getAllItems()
    {
        $keyword = $this->input->post('term');
        $page = $this->input->post('page');
        $uid = $this->input->post('uid');
        $resultCount = 25;
        $offset = ($page - 1) * $resultCount;
        $endCount = $offset + $resultCount;

        $items = $this->service->searchItems($keyword, $offset, $endCount, $uid);

        $count = count($this->service->searchItems($keyword, $offset, $endCount, $uid));

        $morePages = $endCount <= $count;
        $data = [];
        foreach ($items as $key => $value) {
            $stock = $this->item->getAvailableStock($value['id']);
            if ($stock > 0) {
                $dataColumn['text'] = $value['name'];
                $dataColumn['id'] = $value['id'];
                $data[] = $dataColumn;
            }
        }
        echo json_encode(['results' => $data, 'pagination' => array('more' => $morePages)]);
    }
}

/* End of file WarehouseSupply.php */
/* Location: ./application/controllers/WarehouseSupply.php */

 ?>