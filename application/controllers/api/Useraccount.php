<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Useraccount extends REST_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_Rest_Api');
    $this->load->model('Model_User');
    //$this->load->model('PersonM');
  }
public function getUser_post(){
$email = $this->get('Email_User');
		if ($email === null) {
			$data_user = $this->Model_Rest_Api->Get_All_User();
		}else{
			$data_user = $this->Model_Rest_Api->Get_All_User($email);
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
                    'message' =>'Email = '.$email . ' tidak ditemukan',
                    'data' => $data_user
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

		}
  	}
	public function index_get()
	{
		$email = $this->get('userid');
		if ($email === null) {
			$data_user = $this->Model_User->Get_All_User();
		}else{
			$data_user = $this->Model_User->Get_User_By_UserID($email);
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
                    'message' =>'Email = '.$email . ' tidak ditemukan',
                    'data' => $data_user
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

		}
	}
public function DeleteUser_post()
  	{
  		$id = $this->post('id');
  		$data =  array(
            '0' => array('Id_User' => $id, 'Email_User' => '-', 'Nama_User' => '-'),
            );
		if ($id === null) {
			 $this->response([
                    'status' => FALSE,
                    'message' =>'Paramater ID null',
                    'data' => $data
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if ($this->Model_Rest_Api->Delete_user($id)>0 ){
				$this->response([
                    'status' => TRUE,
                     'message' =>'ID User " '.$id . ' " Sukses terhapus',
                    'data' => $data
                ], REST_Controller::HTTP_OK);

			}else{
				 $this->response([
                    'status' => FALSE,
                    'message' =>'ID User = '.$id . ' tidak ditemukan',
                    'data' => $data
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
			 
		}
  	}
	public function index_delete()
	{
		$id = $this->delete('id');
		if ($id === null) {
			 $this->response([
                    'status' => FALSE,
                    'message' =>'Paramater ID null',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			if ($this->Model_Rest_Api->Delete_user($id)>0 ){
				$this->response([
                    'status' => TRUE,
                     'message' =>'ID User " '.$id . ' " Sukses terhapus',
                    'data' => 'sudah terhapus'
                ], REST_Controller::HTTP_OK);

			}else{
				 $this->response([
                    'status' => FALSE,
                    'message' =>'ID User = '.$id . ' tidak ditemukan',
                    'data' => 'Tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
			 
		}
	}
	public function index_post()
	{
		$Email = $this->post('Email_User');
		$Nama = $this->post('Nama_User');
		$Pass = $this->post('Password_User');

		if ($Email === null || $Nama === null || $Pass === null){
			$this->response([
                    'status' => FALSE,
                    'message' =>'Paramater Email,Password atau Nama null',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			//---
			if(empty($Nama) || empty($Email)|| empty($Pass)){
				$this->response([
                    'status' => FALSE,
                    'message' =>'Email,Password atau Nama  tidak boleh kosong',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);

			} else{
				// cari apakah email sudah ada
				$data_user = $this->Model_Rest_Api->Get_User_By_Email($Email);
				if ($data_user){
					$this->response([
                    	'status' => FALSE,
                    	'message' =>'Email " '.$Email . ' " sudah terecord',
                    	'data' => ''
                	], REST_Controller::HTTP_BAD_REQUEST);
				}else{
					$data =[
						'Nama_User'=> $this->post('Nama_User'),
						'Email_User'=> $this->post('Email_User'),
						'Password_User'=> $this->post('Password_User'),
					];
					if ( $this ->Model_Rest_Api->Insert_data_user($data)>0){
						$this->response([
		                    'status' => TRUE,
		                     'message' =>'Email User " '.$Email .' " sukses terinsert',
		                    'data' => 'sukses terinsert'
		                ], REST_Controller::HTTP_CREATED);
					}else{
						$this->response([
                    'status' => FALSE,
                    'message' =>'Email = '.$Email . ' Gagal terinsert',
                    'data' => 'Gagal Terinsert'
                ], REST_Controller::HTTP_BAD_REQUEST);
					}
				}
				//--
				}
		}
		
	}
	public function index_put()
	{
		$Email = $this->put('Email_User');
		$Nama = $this->put('Nama_User');
		$id = $this->put('Id_User');

		if ($Email === null || $Nama === null || $id === null){
			$this->response([
                    'status' => FALSE,
                    'message' =>'Paramater ID,Email atau Nama null',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			$data_user = $this->Model_Rest_Api->Get_All_User($id);
			if ($data_user){
				$data =[
						'Nama_User'=>$Nama,
						'Email_User'=> $Email,
						'Id_User' => $id
					];
					if ( $this ->Model_Rest_Api->Update_User($data,$id)>0){
						$this->response([
		                    'status' => TRUE,
		                     'message' =>'Email User = '.$Email,
		                    'data' => 'sukses terupdate'
		                ], REST_Controller::HTTP_OK);

					}else{
						$this->response([
		                    'status' => FALSE,
		                    'message' =>'Email = '.$Email . ' Gagal terupdate',
		                    'data' => ''
		                ], REST_Controller::HTTP_BAD_REQUEST);
					}
			}else{
				 $this->response([
                    'status' => FALSE,
                    'message' =>'ID User = '.$id . ' tidak ditemukan',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
			}

		}

	}
}
