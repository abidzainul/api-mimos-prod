<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Customer_wsp extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_customer_wsp', 'customer_wsp');
    }
  	
    public function getByCustomers_post(){

        $ids    = $this->input->post("customernos");
        $data   = null;

        if($ids != null){
            $data = $this->customer_wsp->getByListCustomer($ids);
        }
        
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