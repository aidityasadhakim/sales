<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Facility extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Facilitymodel', 'facility');
        isLogin();

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Manajemen Fasilitas';
        $data['page'] = 'facility';
        $data['facilities'] = $this->facility->getAllData();
        $this->load->view('facilities/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');

            $data = array('name'  => $name);            

            $this->facility->insertData($data);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('facility');
        }
        else {
            $data['title'] = 'Tambah Data Fasilitas';
            $data['page']  = 'facility';
            $this->load->view('facilities/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->facility->getDataById($id);
        if ($this->input->post('submit')) {

            $name = $this->input->post('name');

            $dataUpdate = array('name'  => $name); 
            

            $this->facility->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('facility');
        }
        else {
            $data['title'] = 'Ubah Data Fasilitas';
            $data['page']  = 'facility';
            $this->load->view('facilities/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->facility->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('facility');
    }

}

/* End of file Facility.php */
/* Location: ./application/controllers/Facility.php */

 ?>