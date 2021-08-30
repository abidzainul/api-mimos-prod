<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Master_data extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_master_data', 'master');
    }
  	
    public function getLookupByUser_get(){

        $userid 	= $this->input->get("userid");
        $data = $this->master->getByUser($userid);
        
        if($userid == null){
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
  	
    public function getBrandCompBySalesOffice_get(){

        $salesofficeid 	= $this->input->get("salesofficeid");
        $data = $this->master->getBrandCompetitor($salesofficeid);
        
        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal mendapatkan data";

        if($data){
            $response['status'] = TRUE;
            $response['length'] = count($data);
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $data;
        }

        $this->response($response);

    }


}