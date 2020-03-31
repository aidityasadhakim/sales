<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Unitmodel', 'unit');
        $this->load->model('Ownermodel', 'owner');
        $this->load->model('Facilitymodel', 'facility');
        isLogin();
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['title'] = 'Manajemen Unit';
        $data['page'] = 'unit';
        $data['units'] = $this->unit->getAllData();
        $this->load->view('units/view', $data);
    }

    // Add a new item
    public function add()
    {
        if ($this->input->post('submit')) {

            $floor_id = $this->input->post('floor_id');
            $name = $this->input->post('name');
            $type = $this->input->post('type');
            $owner_id = $this->input->post('owner_id');


            $data = array('tower_id' => $floor_id,
                        'name'  => $name,
                        'type'  => $type,
                        'owner_id'  => $owner_id,
                        'status' => 1
                        );            

            $this->unit->insertData($data);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('unit');
        }
        else {
            $data['title'] = 'Tambah Data Unit';
            $data['page']  = 'unit';
            $data['towers'] = $this->unit->getTowers();
            $data['owners'] = $this->owner->getAllData();
            $this->load->view('units/insert',$data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {
        $data['row'] = $this->unit->getDataById($id);
        if ($this->input->post('submit')) {

            $floor_id = $this->input->post('floor_id');
            $name = $this->input->post('name');
            $type = $this->input->post('type');
            $owner_id = $this->input->post('owner_id');


            $dataUpdate = array('tower_id' => $floor_id,
                        'name'  => $name,
                        'type'  => $type,
                        'owner_id'  => $owner_id,
                        'status' => 1
                        ); 
            

            $this->unit->updateData($id, $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('unit');
        }
        else {
            $data['title'] = 'Ubah Data Unit';
            $data['page']  = 'unit';
            $data['towers'] = $this->unit->getTowers();
            $data['floors'] = $this->unit->getFloorsByParentId(getTowerByFloorId($data['row']['tower_id'], 'id'));
            $data['owners'] = $this->owner->getDataByType($data['row']['type']);
            $this->load->view('units/update',$data);
        }
    }

    //Delete one item
    public function delete( $id = NULL )
    {
        $this->unit->deleteData($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('unit');
    }

    public function getFloor($tower_id = '')
    {
        $parent_id = $tower_id;
        $floors = $this->unit->getFloorsByParentId($parent_id);
        echo '<option value="">---Pilih Lantai---</option>';
        foreach ($floors as $key => $value) {
            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
        }
    }

    public function getOwners()
    {
        $type = $this->input->post('type');
        $owners = $this->unit->getOwnersByType($type);
        echo '<option value="">---Pilih Pengelola---</option>';
        foreach ($owners as $key => $value) {
            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
        }
    }

    // Add facilities
    public function facilities($id = '')
    {
        $data['row'] = $this->unit->getDataById($id);
        if ($this->input->post('submit')) {

            $unit_id = $this->input->post('unit_id');
            $facility_ids = $this->input->post('facility_ids');
            $user_id = $this->session->userdata('id');

            $this->unit->removeFacilities($unit_id);
            foreach ($facility_ids as $key => $value) {
                $dataInsert = array('unit_id' => $unit_id,
                            'facility_id'  => $value,
                            'user_id'  => $user_id
                            );            

                $this->unit->addFacilities($dataInsert);
            }

            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('unit/facilities/'.$data['row']['id']);
        }
        else {
            $data['title'] = 'Tambah Fasilitas Unit';
            $data['page']  = 'unit';
            $data['facilities'] = $this->facility->getAllData();
            $this->load->view('units/facility',$data);
        }
    }

    public function photos($id = '')
    {
        $data['title'] = 'Manajemen Gambar Unit';
        $data['page'] = 'unit';
        $data['row'] = $this->unit->getDataById($id);
        $data['photos'] = $this->unit->getAllPhotoByUnitId($id);
        $this->load->view('units/view_photo', $data);
    }

    public function add_photo($id)
    {
        $data['row'] = $this->unit->getDataById($id);
        if ($this->input->post('submit')) {

            $unit_id = $data['row']['id'];
            $name = $this->input->post('name');

            $config['upload_path'] = './uploads/units/';
            $config['allowed_types'] = 'gif|jpg|png';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload()){
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('unit/add_photo/'.$id);
            }
            else{
                $nama_gambar = $this->upload->data('file_name');
                
                $config_res['image_library'] = 'gd2';
                $config_res['source_image'] = 'uploads/units/'.$nama_gambar;
                $config_res['maintain_ratio'] = TRUE;
                $config_res['width']     = 800;
                
                $this->load->library('image_lib', $config_res); 
                
                $this->image_lib->resize();

                $dataInsert = array('unit_id' => $unit_id,
                        'name'  => $name,
                        'image'  => $nama_gambar
                        );    
            }        

            $this->unit->insertDataPhoto($dataInsert);
            $this->session->set_flashdata('msg', 'Data berhasil ditambah!');
            redirect('unit/photos/'.$id);
        }
        else {
            $data['title'] = 'Tambah Data Gambar Unit';
            $data['page']  = 'unit';
            $this->load->view('units/insert_photo',$data);
        }
    }

    public function update_photo( $id = NULL )
    {
        $data['row'] = $this->unit->getPhotoById($id);
        $data['unit'] = $this->unit->getDataById($data['row']['unit_id']);
        if ($this->input->post('submit')) {

            $unit_id = $data['unit']['id'];
            $name = $this->input->post('name');

            $config['upload_path'] = './uploads/units/';
            $config['allowed_types'] = 'gif|jpg|png';
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload()){
                $dataUpdate = array('name'  => $name);    
            }
            else{
                unlink('./uploads/units/'.$data['row']['image']);
                $nama_gambar = $this->upload->data('file_name');
                
                $config_res['image_library'] = 'gd2';
                $config_res['source_image'] = 'uploads/units/'.$nama_gambar;
                $config_res['maintain_ratio'] = TRUE;
                $config_res['width']     = 800;
                
                $this->load->library('image_lib', $config_res); 
                
                $this->image_lib->resize();

                $dataUpdate = array('name'  => $name, 'image'  => $nama_gambar);    
            } 

            $this->unit->updateDataPhoto($data['row']['id'], $dataUpdate);
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('unit/photos/'.$data['unit']['id']);
        }
        else {
            $data['title'] = 'Ubah Data Gambar Unit';
            $data['page']  = 'unit';
            $this->load->view('units/update_photo',$data);
        }
    }

    //Delete one item
    public function delete_photo( $id = NULL )
    {
        $row = $this->unit->getPhotoById($id);
        unlink('./uploads/units/'.$row['image']);
        $this->unit->deleteDataPhoto($id);
        $this->session->set_flashdata('msg', 'Data berhasil dihapus!');
        redirect('unit');
    }
}

/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */

 ?>