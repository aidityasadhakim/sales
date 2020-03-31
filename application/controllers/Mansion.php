<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mansion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mansionmodel', 'mans');
        isLogin();
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Manajemen Mansion';
        $data['page'] = 'mansion';
        $data['mansions'] = $this->mans->getAllData();
        $this->load->view('mansions/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $code = $this->input->post('code');
            $type = $this->input->post('type');
            $blok = $this->input->post('blok');
            $owner = $this->input->post('owner');
            $area = $this->input->post('area');
            $water = $this->input->post('water');
            $date_used = $this->input->post('date_used');


            $dataInsert = array('code' => $code,
                        'type'  => $type,
                        'blok'  => $blok,
                        'owner'  => $owner,
                        'area'  => $area,
                        'water_used'  => $water,
                        'date_used'  => $date_used
                        );            

            $this->mans->insertData($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('mansion');
        }
        else {
            $data['title'] = 'Tambah Data Mansion';
            $data['page']  = 'mansion';
            $this->load->view('mansions/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->mans->getDataById($id);
        if ($this->input->post('submit')) {

            $code = $this->input->post('code');
            $type = $this->input->post('type');
            $blok = $this->input->post('blok');
            $owner = $this->input->post('owner');
            $area = $this->input->post('area');
            $water = $this->input->post('water');
            $date_used = $this->input->post('date_used');


            $dataUpdate = array('code' => $code,
                        'type'  => $type,
                        'blok'  => $blok,
                        'owner'  => $owner,
                        'area'  => $area,
                        'water_used'  => $water,
                        'date_used'  => $date_used
                        );  
            

            $this->mans->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('mansion');
        }
        else {
            $data['title'] = 'Ubah Data Mansion';
            $data['page']  = 'mansion';
            $this->load->view('mansions/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->mans->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('mansion');
    }
}

/* End of file Mansion.php */
/* Location: ./application/controllers/Mansion.php */

 ?>