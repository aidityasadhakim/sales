<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Itemmodel', 'item');
    }

    // List all your items
    public function index( $offset = 0 )
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
            $row[] = $field->stock;
            $row[] = '<strong>Harga Jual: </strong> Rp. '.number_format($field->salePrice).'<br><strong>Harga Beli: </strong> Rp. '.number_format($field->buyPrice);
            $row[] = ucfirst($field->type);
            $row[] = $field->note;
            $row[] = '<div class="btn-group">
                            <a href="'.base_url('item/update/'.$field->id).'" class="btn btn-success">Ubah</a>
                            <a href="'.base_url('item/delete/'.$field->id).'" class="btn btn-danger" onclick="return confirm(\'Yakin hapus?\')">Hapus</a>
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
            $buyPrice = $this->input->post('buyPrice');
            $stockMin = $this->input->post('stockMin');
            $type = $this->input->post('type');
            $note = $this->input->post('note');


            $dataInsert = array('slug' => $slug,
                        'code'  => '-',
                        'name'  => $name,
                        'stock'  => 0,
                        'stockMin'  => $stockMin,
                        'buyPrice' => $buyPrice,
                        'salePrice' => $salePrice,
                        'type'  => $type,
                        'note'  => $note
                        );            

            $this->item->insertData($dataInsert);
            $this->item->updateData($id, array('code' => 'ITM'.$id));
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('item');
        }
        else {
            $data['title'] = 'Tambah Data Barang';
            $data['page']  = 'master';
            $this->load->view('items/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->item->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');
            $slug = str_replace(' ', '', strtolower($name));
            $salePrice = $this->input->post('salePrice');
            $buyPrice = $this->input->post('buyPrice');
            $stockMin = $this->input->post('stockMin');
            $type = $this->input->post('type');
            $note = $this->input->post('note');


            $dataUpdate = array('slug' => $slug,
                        'name'  => $name,
                        'stockMin'  => $stockMin,
                        'buyPrice' => $buyPrice,
                        'salePrice' => $salePrice,
                        'type'  => $type,
                        'note'  => $note
                        );   
            

            $this->item->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('item');
        }
        else {
            $data['title'] = 'Ubah Data Barang';
            $data['page']  = 'master';
            $this->load->view('items/update', $data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->item->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('item');
    }
}

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */

 ?>