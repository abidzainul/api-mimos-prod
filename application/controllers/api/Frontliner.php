<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Frontliner extends REST_Controller{
	public function __construct()
  	{
    	parent::__construct();
    	$this->load->model('Model_Frontliner');
  	}
  	
  public function lookup_post(){
    // echo "TES";exit();
      // $userid = $this->post('userid');
  		$data =  array(
            '0' => array( 'lookupid' => '-', 'lookupkey' => '-', 'lookupvalue' => '-', 'lookupdesc' => '-'),
            );
  		$result = $this->Model_Frontliner->getLookup();
		if($result){
			$this->response([
				'status' => TRUE,
				'message' =>'Data ready',
		    'data' => $result
		    ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
        'status' => FALSE,
        'message' =>'No Data',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
		}
  }
  
  public function brandcompetitor_post(){
    // echo "TES";exit();
    $salesofficeid = $this->post('salesofficeid');
  		$data =  array(
            '0' => array( 'sobid' => '-', 'competitorbrand' => '-', 'soid' => '-', 'materialgroupid' => '-'),
            );
  		$result = $this->Model_Frontliner->getBrandCompetitor($salesofficeid);
		if($result){
			$this->response([
			'status' => TRUE,
			'message' =>'Data ready',
		    'data' => $result
		    ], REST_Controller::HTTP_OK);
		}else{
			$this->response([
        'status' => FALSE,
        'message' =>'No Data',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
		}
  }

}