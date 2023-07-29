<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ServiceReceipts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Servicemodel', 'service');
        $this->load->model('Papermodel', 'paper');
        $this->load->model('Salemodel', 'sale');
        $this->load->model('Customermodel', 'customer');
        $this->load->model('ServiceReceiptsmodel', 'service_receipts');
        $this->load->model('ServiceHistorymodel', 'service_history');
    }

    // List all your items

    public function index($id = NULL)
    {
        $data['title'] = 'Nota Tanda Terima Servis';
        $data['page'] = 'service_receipts';
        $this->load->view('service_receipts/view', $data);
    }

    // Tanda terima
    // public function index($id=NULL)
    // {
    //     $sale_details = $this->sale->getDataById($id);

    //     if ($this->service_receipts->getDataById($id)){
    //         $data['title'] = 'Tanda Terima Servis';
    //         $data['page']  = 'master';
    //         $data['details'] = $this->service_receipts->getDataById($id);
    //         $data['button'] = '<button type="submit" class="btn btn-info btn-success" name="submit" value="add">Update</button>';
    //         $data['cetak'] = '<a href="'.base_url('servicereceipts/cetak/'.$data['details']['receipt_id']).'" class="btn btn-success ">Cetak</a>';
    //         $data['history'] = $this->service_history->getDataByReceiptId($id);
    //         $data['is_cash'] = $sale_details['is_cash'];
    //         if($this->input->post('submit')){
    //             $this->addUpdateHistory($_POST,$id);
    //         }
    //         if($this->input->post('submit')){
    //             $this->update($data['details']['id'],$_POST, $id);
    //         }
    //         $this->load->view('services/tanda_terima',$data);
    //     }
    //     else {

    //         if ($this->input->post('submit')){
    //             $this->add($_POST, $id);
    //         }
    //         $data['title'] = 'Tanda Terima Servis';
    //         $data['page']  = 'master';
    //         $data['details'] = array('receipt_id' => '',
    //                                 'transaction_date' => '',
    //                                 'name'  => $sale_details['customer_name'],
    //                                 'phone' => '',
    //                                 'tipe_hp' => '',
    //                                 'kerusakan' => '',
    //                                 'kelengkapan' => '',
    //                                 'keterangan' => '',
    //                                 'penerima' => ''
    //                                 );
    //         $data['button'] = '<button type="submit" class="btn btn-info btn-submit" name="submit" value="add">Submit</button>';
    //         $data['cetak'] = '';
    //         $data['history'] = $this->service_history->getDataById($id);
    //         $data['is_cash'] = $sale_details['is_cash'];
    //         $this->load->view('services/tanda_terima',$data);
    //     }
    // }

    function getDataTable()
    {
        $list = $this->service_receipts->getDataTables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date('d F Y', strtotime($field['transaction_date']));
            $row[] = '<a href="' . base_url('servicereceipts/detail/' . $field['id']) . '" target="_blank">' . $field['customer_name'] . '</a>';
            $row[] = $field['phone_number'];
            // $row[] = $field['phone_type'];
            $row[] = $field['damage'];
            $row[] = $field['note'];
            if ($field['service_id'] != null) {
                $row[] = '<div class="btn-group">
                                <a href="' . base_url('servicereceipts/cetak/' . $field['id']) . '" class="btn btn-default">Cetak</a>
                                <a href="' . base_url('service/detail/' . $field['service_id']) . '" class="btn btn-default text-sm" target="_blank">Cek Nota Servis</a>
                                <a href="' . base_url('servicereceipts/update/' . $field['id']) . '" class="btn btn-success">Ubah</a>
                                <a href="' . base_url('servicereceipts/delete/' . $field['id']) . '" class="btn btn-danger  " onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                              </div>';
            } else {
                $row[] = '<div class="btn-group">
                                <a href="' . base_url('servicereceipts/cetak/' . $field['id']) . '" class="btn btn-default">Cetak</a>
                                <a href="' . base_url('service/add/' . $field['id']) . '" class="btn btn-warning text-sm">Buat Nota Servis</a>
                                <a href="' . base_url('servicereceipts/update/' . $field['id']) . '" class="btn btn-success">Ubah</a>
                                <a href="' . base_url('servicereceipts/delete/' . $field['id']) . '" class="btn btn-danger  " onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
                              </div>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "data" => $data,
        );
        echo json_encode($output);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {
            $transaction_date = $this->input->post('transaction_date');
            if ($this->input->post('is_customer') != null) {
                $customer_id = $this->input->post('customer_id');
                $customer_name = getDataColumn('customers', 'id', $customer_id, 'name');
                $is_customer = 1;
            } else {
                $customer_id = null;
                $customer_name = $this->input->post('customer_name');
                $is_customer = 0;
            }

            $phone_number = $this->input->post('phone_number');
            $phone_type = $this->input->post('phone_type');
            $damage = $this->input->post('damage');
            $attribute = $this->input->post('attribute');
            $note = $this->input->post('note');
            $recipient = $this->input->post('recipient');


            $data = array(
                'is_customer' => $is_customer,
                'customer_id' => $customer_id,
                'customer_name' => $customer_name,
                'phone_number' => $phone_number,
                'phone_type' => $phone_type,
                'damage' => $damage,
                'attribute' => $attribute,
                'note' => $note,
                'recipient' => $recipient,
                'transaction_date' => $transaction_date,
                'updated_at' => $transaction_date,
            );
            $result = $this->service_receipts->insertData($data);

            if ($result['msg'] == 'success') {
                $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
                redirect('servicereceipts');
            } else {
                $this->session->set_flashdata('error', 'Data gagal ditambah!');
                redirect('servicereceipts');
            }
        } else {
            $data['title'] = 'Tanda Terima Servis';
            $data['page']  = 'master';
            $data['customers'] = $this->customer->getAllData();
            $this->load->view('service_receipts/insert', $data);
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Data Servis';
        $data['page']  = 'master';
        $data['row'] = $this->service_receipts->getDataById($id);
        $this->load->view('service_receipts/detail', $data);
    }

    // Add History when adding detail for the first time
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

    //Update one item
    public function update($id = NULL, $data, $receipt_id)
    {
        $receipt_id = $receipt_id;
        $transaction_date = $this->input->post('transaction_date');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $tipe_hp = $this->input->post('tipe_hp');
        $kerusakan = $this->input->post('kerusakan');
        $kelengkapan = $this->input->post('kelengkapan');
        $keterangan = $this->input->post('note');
        $penerima = $this->input->post('penerima');

        $data = array(
            'receipt_id' => $receipt_id,
            'transaction_date' => $transaction_date,
            'name'  => $name,
            'phone' => $phone,
            'tipe_hp' => $tipe_hp,
            'kerusakan' => $kerusakan,
            'kelengkapan' => $kelengkapan,
            'keterangan' => $keterangan,
            'penerima' => $penerima,
        );

        $result = $this->service_receipts->updateDataServiceReceiptsById($id, $data);
        if ($result['msg'] == 'success') {
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('servicereceipts/index/' . $receipt_id);
        } else {
            $this->session->set_flashdata('error', 'Data gagal diubah! Stok tidak cukup.');
            redirect('servicereceipts/index/' . $receipt_id);
        }
    }

    // Add History when updating
    public function addUpdateHistory($data, $id)
    {
        $transaction_date = $this->input->post('transaction_date');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $tipe_hp = $this->input->post('tipe_hp');
        $kerusakan = $this->input->post('kerusakan');
        $kelengkapan = $this->input->post('kelengkapan');
        $keterangan = $this->input->post('note');
        $penerima = $this->input->post('penerima');

        $dataInsert = array(
            'receipt_id' => $id,
            'transaction_date' => date('Y-m-d H:i:s'),
            'name'  => $name,
            'phone' => $phone,
            'tipe_hp' => $tipe_hp,
            'kerusakan' => $kerusakan,
            'kelengkapan' => $kelengkapan,
            'keterangan' => $keterangan,
            'penerima' => $penerima,
            'status' => 'Update Detail'
        );

        $this->service_history->insertData($dataInsert);
    }

    //Delete one item
    public function delete($id = NULL)
    {
        $result = $this->service_receipts->deleteDataById($id);
        if ($result['msg'] == 'success') {
            $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
            redirect('servicereceipts');
        } else {
            $this->session->set_flashdata('error', 'Data Gagal Dihapus!');
            redirect('servicereceipts');
        }
    }

    public function cetak($id = null)
    {
        $data['info'] = $this->paper->getDataDefault();
        $data['details'] = $this->service_receipts->getDataById($id);
        $this->load->view('service_receipts/print_tanda_terima', $data);
    }

    public function getDataDetailById($id = NULL)
    {
        $output = $this->service_history->getDataById($id);
        $output[0]['transaction_date'] = date('d F Y', strtotime($output[0]['transaction_date']));
        echo json_encode($output[0]);
    }
}

/* End of file ServiceReceipts.php */
/* Location: ./application/controllers/ServiceReceipts.php */