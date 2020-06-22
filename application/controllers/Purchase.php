<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Purchasemodel', 'purchase');
        $this->load->model('Suppliermodel', 'supplier');
        $this->load->model('PaymentMethodmodel', 'method');
        $this->load->model('Itemmodel', 'item');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Nota Pembelian';
        $data['page'] = 'purchase';
        $this->load->view('purchases/view', $data);
    }

    function getDataTable()
    {
        $list = $this->purchase->getDataTables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d F Y', strtotime($field['transaction_date']));
            $row[] = $field['sup_name'];
            $row[] = 'Rp. '.number_format($field['total']);
            $row[] = ($field['is_cash'] == 1) ? 'Lunas' : 'Utang';
            $row[] = $field['m_name'];
            $row[] = $field['note'];
            $row[] = '<div class="btn-group">
                            <a href="'.base_url('purchase/update/'.$field['p_id']).'" class="btn btn-success">Ubah</a>
                            <a href="'.base_url('purchase/delete/'.$field['p_id']).'" class="btn btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                          </div>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->purchase->countAll(),
            "recordsFiltered" => $this->purchase->countFiltered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            $supplier_id = $this->input->post('supplier_id');
            $note = $this->input->post('note');
            $method_id = $this->input->post('method_id');

            $item_ids = $this->input->post('item_ids');
            $price = $this->input->post('price');
            $qty = $this->input->post('qty');

            $is_cash = ($this->input->post('is_cash') != null) ? $this->input->post('is_cash') : 1;
            $total = $this->input->post('total');
            $cash = $this->input->post('cash');
            $changes = $this->input->post('changes');


            $dataInsert = array('transaction_date' => $transaction_date,
                        'supplier_id'  => $supplier_id,
                        'code'  => '-',
                        'total'  => $total,
                        'cash'  => $cash,
                        'changes' => $changes,
                        'method_id' => $method_id,
                        'is_cash'  => $is_cash,
                        'item_ids'  => $item_ids,
                        'price'  => $price,
                        'status' => 2,
                        'type' => 'purchase',
                        'note' => $note,
                        'qty'  => $qty
                        );            

            $result = $this->purchase->insertData($dataInsert);
            if ($result['msg'] == 'success') {
                $this->purchase->updateDataPurchasesById($result['trans_id'], array('code' => 'IHP'.$result['trans_id']));
                $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
                redirect('purchase');
            }
            else {
                $this->session->set_flashdata('error', 'Data gagal ditambah! Stok tidak cukup.');
                redirect('purchase');   
            }
        }
        else {
            $data['title'] = 'Tambah Data Pembelian';
            $data['page']  = 'purchase';
            $data['suppliers'] = $this->supplier->getAllData();
            $data['methods'] = $this->method->getAllData();
            $data['items'] = $this->purchase->getAllItems();
            $this->load->view('purchases/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->purchase->getDataById($id);
        $data['details'] = $this->purchase->getDataDetailByIdTrans($id);
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            $supplier_id = $this->input->post('supplier_id');
            $note = $this->input->post('note');
            $method_id = $this->input->post('method_id');

            $item_ids = $this->input->post('item_ids');
            $price = $this->input->post('price');
            $qty = $this->input->post('qty');

            $is_cash = ($this->input->post('is_cash') != null) ? $this->input->post('is_cash') : 1;
            $total = $this->input->post('total');
            $cash = $this->input->post('cash');
            $changes = $this->input->post('changes');


            $dataUpdate = array('transaction_date' => $transaction_date,
                        'supplier_id'  => $supplier_id,
                        'code'  => '-',
                        'total'  => $total,
                        'cash'  => $cash,
                        'changes' => $changes,
                        'method_id' => $method_id,
                        'is_cash'  => $is_cash,
                        'item_ids'  => $item_ids,
                        'price'  => $price,
                        'status' => 2,
                        'type' => 'sale',
                        'note' => $note,
                        'qty'  => $qty
                        );            

            $result = $this->purchase->updateData($id, $dataUpdate);
            if ($result['msg'] == 'success') {
                $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                redirect('purchase');
            }
            else {
                $this->session->set_flashdata('error', 'Data gagal diubah! Stok tidak cukup.');
                redirect('purchase');   
            }
        }
        else {
            $data['title'] = 'Ubah Data Pembelian';
            $data['page']  = 'purchase';
            $data['suppliers'] = $this->supplier->getAllData();
            $data['methods'] = $this->method->getAllData();
            $data['items'] = $this->purchase->getAllItems();
            $this->load->view('purchases/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->purchase->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('purchase');
    }

    public function getDataProduct()
    {
        $id = $this->input->post('id');
        $row = $this->item->getDataById($id);
        $data = array('price' => $row['buyPrice'], 'stock' => $row['stock']);
        echo json_encode($data);
    }
}

/* End of file Purchase.php */
/* Location: ./application/controllers/Purchase.php */

 ?>