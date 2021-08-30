<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Person extends REST_Controller
{
	public function __construct()
  	{
    	parent::__construct();
    	$this->load->model('Model_Person');
  	}

  	public function getPerson_post()
  	{
  		$Name = $this->post('name');
  		$IDUser = $this->post('id');
		if ($IDUser === null) {
			if ($Name === null){
				$data_user = $this->Model_Person->Get_Person_Like();
			}else{
				$data_user = $this->Model_Person->Get_Person_Like($Name);
			}
			
		}else{
			$data_user = $this->Model_Person->Get_Person($IDUser);
		}
		if ($data_user){
			//$this->response($data_user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			$this->response([
                    'status' => TRUE,
                    'message' =>'User di temukan',
                    'data' => $data_user
                ], REST_Controller::HTTP_OK); 

		}else{
			 $this->response([
                    'status' => FALSE,
                    'message' =>'Person tidak ditemukan',
                    'data' => $data_user
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

		}	
  	}

  	public function insertdata_post()
	{
		$Name = $this->post('Name');
		$Address = $this->post('Address');
		$Phone = $this->post('Phone');
	}
}
?>