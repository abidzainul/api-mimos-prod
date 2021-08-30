<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller
{
	// construct
  	public function __construct()
  	{
    	parent::__construct();
    	$this->load->model('Model_Login');
    	$this->load->model('Model_User');
  	}
  	public function index_post()
	{
		$user_id = $this->post('UserID');
		$pass = $this->post('Password');
		// samakan dengan model user difluter
		// $data = array();
		// $data["Email_User"] = "-";
		// $data["Nama_User"] = "-";
		$data =  array(
            '0' => array('userid' => '-', 'username' => '-', 'userroleid' => '-', 'rolename' => '-', 'salesofficeid' => '-', 'salesgroupid' => '-', 'salesdistrictid' => '-', 'regionid' => '-'),
            );
	
		if ($user_id === null || $pass === null) {
			$this->response([
                    'status' => FALSE,
                    'message' =>'Identitas pengguna atau password null',
                    'data' => $data
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if(empty($pass) || empty($user_id)){
				$this->response([
                    'status' => FALSE,
                    'message' =>'Identitas pengguna atau password Kosong',
                    'data' => $data
                ], REST_Controller::HTTP_BAD_REQUEST);
			}else{
				// cek apakah ada user dgn email 
				$data_user = $this->Model_User->Get_User_By_UserID($user_id);
				if ($data_user){
					// cek password dan email
					$user = $this->Model_Login->Get_User_Login($user_id,$pass);
					if($user){
						$this->response([
		                    'status' => TRUE,
		                     'message' =>'ID User = '.$user_id,
		                    'data' => $user
		                ], REST_Controller::HTTP_OK);
					}else{
						$this->response([
                    'status' => FALSE,
                    'message' =>'Password salah',
                    'data' => $data
                ], REST_Controller::HTTP_BAD_REQUEST);
					}
				}else{
					$this->response([
                    'status' => FALSE,
                    'message' =>'Identitas pengguna tidak ada',
                    'data' => $data
                ], REST_Controller::HTTP_BAD_REQUEST);
				}
			}

		}
	}
}