<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Salemodel', 'sale');
        $this->load->model('Customermodel', 'customer');
        $this->load->model('PaymentMethodmodel', 'method');
        $this->load->model('Itemmodel', 'item');
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Nota Penjualan';
        $data['page'] = 'sales';
        $this->load->view('sales/view', $data);
    }

    function getDataTable()
    {
        $list = $this->sale->getDataTables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d F Y', strtotime($field['transaction_date']));
            $row[] = $field['c_name'];
            $row[] = 'Rp. '.number_format($field['total']);
            $row[] = ($field['is_cash'] == 1) ? 'Lunas' : 'Utang';
            $row[] = $field['m_name'];
            $row[] = $field['note'];
            $row[] = '<div class="btn-group">
                            <a href="'.base_url('sale/update/'.$field['s_id']).'" class="btn btn-success">Ubah</a>
                            <a href="'.base_url('sale/delete/'.$field['s_id']).'" class="btn btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                          </div>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sale->countAll(),
            "recordsFiltered" => $this->sale->countFiltered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            $customer_id = $this->input->post('customer_id');
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
                        'customer_id'  => $customer_id,
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

            $result = $this->sale->insertData($dataInsert);
            if ($result['msg'] == 'success') {
                $this->sale->updateDataSalesById($result['trans_id'], array('code' => 'IHS'.$result['trans_id']));
                $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
                redirect('sale');
            }
            else {
                $this->session->set_flashdata('error', 'Data gagal ditambah! Stok tidak cukup.');
                redirect('sale');   
            }
        }
        else {
            $data['title'] = 'Tambah Data Penjualan';
            $data['page']  = 'master';
            $data['customers'] = $this->customer->getAllData();
            $data['methods'] = $this->method->getAllData();
            $data['items'] = $this->sale->getAllItems();
            $this->load->view('sales/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->sale->getDataById($id);
        $data['details'] = $this->sale->getDataDetailByIdTrans($id);
        if ($this->input->post('submit')) {

            $transaction_date = $this->input->post('transaction_date');
            $customer_id = $this->input->post('customer_id');
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
                        'customer_id'  => $customer_id,
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

            $result = $this->sale->updateData($id, $dataUpdate);
            if ($result['msg'] == 'success') {
                $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                redirect('sale');
            }
            else {
                $this->session->set_flashdata('error', 'Data gagal diubah! Stok tidak cukup.');
                redirect('sale');   
            }
        }
        else {
            $data['title'] = 'Ubah Data Penjualan';
            $data['page']  = 'master';
            $data['customers'] = $this->customer->getAllData();
            $data['methods'] = $this->method->getAllData();
            $data['items'] = $this->sale->getAllItems();
            $this->load->view('sales/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->sale->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('sale');
    }

    public function getDataProduct()
    {
        $id = $this->input->post('id');
        $row = $this->item->getDataById($id);
        $data = array('price' => $row['salePrice'], 'stock' => $row['stock']);
        echo json_encode($data);
    }
}

/* End of file Sale.php */
/* Location: ./application/controllers/Sale.php */

 ?>