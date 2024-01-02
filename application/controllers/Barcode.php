<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barcode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model('Itemmodel', 'item');
        $this->load->model('Operatormodel', 'operator');
    }

    function index()
    {
        $data["title"] = "Scan Barcode";
        $this->load->view('barcode/view', $data);
    }

    function getItemData()
    {
        $jsonArray = json_decode(file_get_contents('php://input'), true);
        $list = $this->item->getDataById($jsonArray['id']);

        $output = array("item" => $list);
        echo json_encode($output);
    }
}
