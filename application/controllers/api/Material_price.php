<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Material_price extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_material_price', 'material');
    }
  	
    public function getBySalesOffice_get(){

        $salesofficeid 	= $this->input->get("salesofficeid");
        $data = $this->material->getBySalesOffice($salesofficeid);
        
        if($salesofficeid == null){
            $response['status'] = FALSE;
            $response['message'] = "Gagal mendapatkan data";
            $this->response($response);
            exit;
        }

        if($data){
            $response['status'] = TRUE;
            $response['length'] = count($data);
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $data;
        }

        if(empty($data)){
            $response['status'] = TRUE;
            $response['message'] = "Data tidak ditemukan";
            $response['data'] = null;
        }

        $this->response($response);

    }

    public function getById_get($id)
    {
        $data = $this->material->getById($id);
        
        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal mendapatkan data";

        if($data){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $data;
        }

        $this->response($response);
        
    }

}