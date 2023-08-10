<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Itemmodel', 'item');
        $this->load->model('WarehouseSupplymodel', 'warehouse_supply');
    }

    // List all your items
    public function index($offset = 0)
    {
        $data['title'] = 'Master Barang';
        $data['page'] = 'master';
        $this->load->view('items/view', $data);
    }

    function getDataTable()
    {
        $list = $this->item->getDataTables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->name;
            $row[] = getStockAvailable($field->id);

            // $percentage = getDataColumn('percentages', 'label', 'harga-umum', 'amount');
            // $price_general = $field->salePrice + (($field->salePrice*$percentage)/100);
            $price_general = $field->salePriceNon;
            if ($this->session->userdata('level') == 1) {
                $highBuyPrice = getLatestPrice($field->id);
                $row[] = '<a href="' . base_url('item/stock/' . $field->id) . '">Rp. ' . number_format($highBuyPrice) . '</a>';
            }
            $row[] = 'Rp. ' . number_format($field->salePrice);
            $row[] = 'Rp. ' . number_format($price_general);
            $row[] = ucfirst($field->type);
            $row[] = $field->note;
            if ($this->session->userdata('level') == 1) {
                $button_stock = '<a href="' . base_url('stock/index/' . $field->id) . '" class="btn btn-warning">Stok</a>';
                $button_edit_delete = '<a href="' . base_url('item/update/' . $field->id) . '" class="btn btn-success">Ubah</a>
                            <a href="' . base_url('item/delete/' . $field->id) . '" class="btn btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>';
            } elseif ($this->session->userdata('level') == 2) {
                $button_stock = '';
                $button_edit_delete = '<a href="' . base_url('item/update/' . $field->id) . '" class="btn btn-success">Ubah</a>';
            } else {
                $button_stock = '';
                $button_edit_delete = '<a href="' . base_url('item/update/' . $field->id) . '" class="btn btn-success">Ubah</a>';
            }
            $row[] = '<div class="btn-group">
                            ' . $button_stock . '                            
                            ' . $button_edit_delete . '                            
                          </div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->item->countAll(),
            "recordsFiltered" => $this->item->countFiltered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $slug = str_replace(' ', '', strtolower($name));
            $salePrice = $this->input->post('salePrice');
            $salePriceNon = $this->input->post('salePriceNon');
            $buyPrice = $this->input->post('buyPrice');
            $stockMin = $this->input->post('stockMin');
            $type = $this->input->post('type');
            $note = $this->input->post('note');


            $dataInsert = array(
                'slug' => $slug,
                'code'  => '-',
                'name'  => $name,
                'stock'  => 0,
                'stockMin'  => $stockMin,
                'buyPrice' => $buyPrice,
                'salePrice' => $salePrice,
                'salePriceNon' => $salePriceNon,
                'type'  => $type,
                'note'  => $note
            );

            $id = $this->item->insertData($dataInsert);
            $this->item->updateData($id, array('code' => 'ITM' . $id));
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('item');
        } else {
            $data['title'] = 'Tambah Data Barang';
            $data['page']  = 'master';
            $this->load->view('items/insert', $data);
        }
    }

    //Update one item
    public function update($id = NULL)
    {
        $data['row'] = $this->item->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $slug = str_replace(' ', '', strtolower($name));
            $salePrice = $this->input->post('salePrice');
            $salePriceNon = $this->input->post('salePriceNon');
            $buyPrice = $this->input->post('buyPrice');
            $stockMin = $this->input->post('stockMin');
            $type = $this->input->post('type');
            $note = $this->input->post('note');


            $dataUpdate = array(
                'slug' => $slug,
                'name'  => $name,
                'stockMin'  => $stockMin,
                'buyPrice' => $buyPrice,
                'salePrice' => $salePrice,
                'salePriceNon' => $salePriceNon,
                'type'  => $type,
                'note'  => $note
            );


            $this->item->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('item');
        } else {
            $data['title'] = 'Ubah Data Barang';
            $data['page']  = 'master';
            $this->load->view('items/update', $data);
        }
    }

    //Delete one item
    public function delete($id = NULL)
    {
        $this->item->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('item');
    }

    public function stock($item_id)
    {
        $data['title'] = 'Stok Barang';
        $data['page']  = 'master';
        $data['row'] = $this->item->getDataById($item_id);
        $data['stocks'] = $this->item->getStocks($item_id);
        $this->load->view('items/stock', $data);
    }

    public function getDataProduct()
    {
        $id = $this->input->post('id');
        $row = $this->item->getDataById($id);
        echo json_encode($row);
    }

    public function bulkUpdate()
    {
        if ($this->input->post('submit')) {
            $transaction_date = $this->input->post('transaction_date');
            $price = $this->input->post('price');
            $price_non = $this->input->post('price_non');
            $status = $this->input->post('status');
            $data = array(
                "transaction_date" => $transaction_date,
                "price" => $price,
                "price_non" => $price_non,
                "status" => $status
            );

            if ($this->input->post('is_all') != null) {
                $result = $this->item->changeBulkData($data);
            } else {
                $item_ids = $this->input->post('item_ids');
                $data['item_ids'] = $item_ids;
                $result = $this->item->changeBulkData($data);
            }

            if (isset($result['msg'])) {
                $this->session->set_flashdata('msg', 'Data berhasil diubah!');
                redirect('item');
            } else {
                $this->session->set_flashdata('error', $result['error']);
                redirect('item');
            }
        }
        $data['title'] = 'Ubah Data Item';
        $data['page']  = 'master';
        $this->load->view('items/bulk_update', $data);
    }
}

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */
