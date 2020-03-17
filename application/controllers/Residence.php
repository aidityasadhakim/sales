<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Residence extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Residencemodel', 'res');
        isLogin();
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Manajemen Apartemen';
        $data['page'] = 'residence';
        $data['residences'] = $this->res->getAllData();
        $this->load->view('residences/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $code = $this->input->post('code');
            $tower = $this->input->post('tower');
            $floor = $this->input->post('floor');
            $blok = $this->input->post('blok');
            $owner = $this->input->post('owner');
            $area = $this->input->post('area');
            $electricity = $this->input->post('electricity');
            $water = $this->input->post('water');
            $date_used = $this->input->post('date_used');


            $dataInsert = array('code' => $code,
                        'tower'  => $tower,
                        'floor'  => $floor,
                        'blok'  => $blok,
                        'owner'  => $owner,
                        'area'  => $area,
                        'electricity_used'  => $electricity,
                        'water_used'  => $water,
                        'date_used'  => $date_used
                        );            

            $this->res->insertData($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('residence');
        }
        else {
            $data['title'] = 'Tambah Data Apartemen';
            $data['page']  = 'residence';
            $this->load->view('residences/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->res->getDataById($id);
        if ($this->input->post('submit')) {

            $code = $this->input->post('code');
            $tower = $this->input->post('tower');
            $floor = $this->input->post('floor');
            $blok = $this->input->post('blok');
            $owner = $this->input->post('owner');
            $area = $this->input->post('area');
            $electricity = $this->input->post('electricity');
            $water = $this->input->post('water');
            $date_used = $this->input->post('date_used');


            $dataUpdate = array('code' => $code,
                        'tower'  => $tower,
                        'floor'  => $floor,
                        'blok'  => $blok,
                        'owner'  => $owner,
                        'area'  => $area,
                        'electricity_used'  => $electricity,
                        'water_used'  => $water,
                        'date_used'  => $date_used
                        );  
            

            $this->res->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('residence');
        }
        else {
            $data['title'] = 'Ubah Data Apartemen';
            $data['page']  = 'residence';
            $this->load->view('residences/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->res->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('residence');
    }
}

/* End of file Residence.php */
/* Location: ./application/controllers/Residence.php */

 ?>