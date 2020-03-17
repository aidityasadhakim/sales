<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ratemodel', 'rate');
        isLogin();
    }

    // List and update
    public function index()
    {
        if ($this->input->post('submit')) {

            $id = $this->input->post('id');
            $amount = $this->input->post('amount');

            foreach ($id as $key => $value) {
                $dataUpdate = array('amount' => $amount[$key]);            

                $this->rate->updateData($value, $dataUpdate);
            }
            $this->session->set_flashdata('msg', 'Data berhasil diubah!');
            redirect('rate');
        }
        else {
            $data['title'] = 'Pengaturan Data Tarif';
            $data['page']  = 'rate';
            $data['rates']  = $this->rate->getAllData();
            $this->load->view('rates/update',$data);
        }
    }

}

/* End of file Rate.php */
/* Location: ./application/controllers/Rate.php */

 ?>