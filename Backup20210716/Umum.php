<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Umum extends REST_Controller{
	public function __construct()
  	{
    	parent::__construct();
    	$this->load->model('Model_Umum');
  	}
  	
  	public function lookup_post(){
      $userid = $this->post('userid');
  		$data =  array(
            '0' => array( 'lookupid' => '-', 'lookupkey' => '-', 'lookupvalue' => '-', 'lookupdesc' => '-'),
            );
  		$result = $this->Model_Umum->getLookup($userid);
		if($result){
			$this->response([
				'status' => TRUE,
				'message' =>'Data ready',
		    'data' => $result
		    ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
        'status' => FALSE,
        'message' =>'Data Tidak Ada',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
		}
  	}

    public function lookupMax_post(){
      $userid = $this->post('userid');
      $data =  array(
            '0' => array( 'posmtypeid' => '-', 'materialgroupid' => '-', 'qtymax' => '-'),
            );
      $result = $this->Model_Umum->getLookupMax($userid);
    if($result){
      $this->response([
        'status' => TRUE,
        'message' =>'Data ready',
        'data' => $result
        ], REST_Controller::HTTP_OK);
    }else{
      $this->response([
        'status' => FALSE,
        'message' =>'Data Tidak Ada',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
    }

}