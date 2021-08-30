<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Lookup extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_lookup', 'lookup');
    }
  	
    public function getByUser_get(){

        $userid 	= $this->input->get("userid");
        $data = $this->lookup->getByUser($userid);
        
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


}