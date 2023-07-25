<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ReturReceipts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Salemodel', 'sale');
        $this->load->model('Customermodel', 'customer');
        $this->load->model('PaymentMethodmodel', 'method');
        $this->load->model('Itemmodel', 'item');
        $this->load->model('Papermodel', 'paper');
    }

    public function index($offset = 0)
    {
        $data['title'] = 'Nota Retur Jakarta';
        $data['page'] = 'Nota Retur Jakarta';
        $this->load->view('retur_receipts/view', $data);
    }

    public function getDataProduct()
    {
        $id = $this->input->post('id');
        $row = $this->item->getDataById($id);
        $stock = $this->item->getAvailableStock($id);
        $price = $row['buyPrice'];
        $data = array('price' => $price, 'stock' => $stock);
        echo json_encode($data);
    }

    function getDataTable()
    {
        $list = $this->sale->getDataTablesReturToSupplier();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d F Y', strtotime($field['transaction_date']));
            $row[] = '<a href="' . base_url('sale/detail/' . $field['id']) . '" target="_blank">' . $field['customer_name'] . '</a>';
            $row[] = 'Rp. ' . number_format($field['total']);
            $row[] = ($field['is_cash'] == 1) ? 'Lunas' : 'Utang';
            $row[] = getDataColumn('payment_methods', 'id', $field['method_id'], 'name');
            $row[] = $field['note'];
            if ($field['is_cash'] == 0) {
                $button_pay = '<a href="' . base_url('sale/pay/' . $field['id']) . '" class="btn btn-warning">Bayar</a>';
            } else {
                $button_pay = '';
            }
            $row[] = '<div class="btn-group">
                            ' . $button_pay . '
                            <a href="' . base_url('sale/cetak/' . $field['id']) . '" class="btn btn-default">Cetak</a>
                            <a href="' . base_url('sale/update/' . $field['id']) . '" class="btn btn-success">Ubah</a>
                            <a href="' . base_url('sale/delete/' . $field['id']) . '" class="btn btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
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

    public function add()
    {
        if ($this->input->post('submit')) {
            $transaction_date = $this->input->post('transaction_date');
            // var_dump($this->input->post('customer_id'));
            // die($this->input->post('customer_id'));
            $customer_id = $this->input->post('customer_id');
            $customer_name = getDataColumn('customers', 'id', $customer_id, 'name');
            $is_customer = 1;

            if ($this->input->post('is_ecommerce') != null) {
                $ecommerce = $this->input->post('ecommerce');
            } else {
                $ecommerce = null;
            }

            $note = $this->input->post('note');
            $method_id = $this->input->post('method_id');

            $item_ids = $this->input->post('item_ids');
            $price = $this->input->post('price');
            $qty = $this->input->post('qty');

            $is_cash = ($this->input->post('is_cash') != null) ? $this->input->post('is_cash') : 1;
            $total = $this->input->post('total');
            $cash = $this->input->post('cash');
            $changes = $this->input->post('changes');


            $dataInsert = array(
                'transaction_date' => $transaction_date,
                'is_customer'  => $is_customer,
                'customer_id'  => $customer_id,
                'customer_name'  => $customer_name,
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
                'qty'  => $qty,
                'ecommerce' => $ecommerce,
            );

            $result = $this->sale->insertData($dataInsert);
            if ($result['msg'] == 'success') {
                if ($this->input->post('is_ecommerce') != null) {
                    $this->sale->updateDataSalesById($result['trans_id'], array('code' => 'ECOM' . $result['trans_id']));
                } else {
                    $this->sale->updateDataSalesById($result['trans_id'], array('code' => 'IHS' . $result['trans_id']));
                }
                $this->session->set_flashdata(
                    'msg',
                    "Data berhasil ditambah!"
                );
                redirect('returreceipts');
            } else {
                $this->session->set_flashdata('error', 'Data gagal ditambah! Stok tidak cukup.');
                redirect('returreceipts');
            }
        } else {
            $data['title'] = 'Tambah Data Penjualan';
            $data['page']  = 'master';
            $data['customers'] = $this->customer->getAllData();
            $data['methods'] = $this->method->getAllData();
            // $data['items'] = $this->sale->getAllItems();
            $this->load->view('retur_receipts/insert', $data);
        }
    }
}
