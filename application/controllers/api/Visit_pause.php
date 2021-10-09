<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Visit_pause extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_visit_pause', 'model');
    }
  	
    public function getByHead_get(){

        $ids 	= $this->input->get("visit_ids");
        $data = $this->model->getByHead($ids);
        
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
  	
    public function getByHead_post(){

        $ids 	= $this->input->post("visit_ids");
        $data   = null;

        if($ids != null){
            $data = $this->model->getByHead($ids);
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

    public function getById_get($id)
    {
        $data = $this->model->getById($id);
        
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
  
    public function add_post(){
        $userid = $this->input->get_request_header('user');
        $data['visitid'] = $this->post('visitid');
        if($this->post('starttime') != null)
            $data['starttime'] = $this->post('starttime');
        if($this->post('stoptime') != null)
            $data['stoptime'] = $this->post('stoptime');

        $data['active'] = '0';
        $data['createdby'] = $userid;
        $data['createdon'] = date('Y-m-d H:i:s');
        $data['createdms'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->model->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->model->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->model->insert($data);
        //     $result = $this->model->getById($id);
        // }
        // INSERT
        $id = $this->model->insert($data);
        $result = $this->model->getById($id);

        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal menyimpan data";

        if($result){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil menyimpan data";
            $response['data'] = $result;
        }

        $this->response($response);
    }
  
    public function update_put(){
        $userid = $this->input->get_request_header('user');
        $data['visitid'] = $this->put('visitid');
        if($this->put('starttime') != null)
            $data['starttime'] = $this->put('starttime');
        if($this->put('stoptime') != null)
            $data['stoptime'] = $this->put('stoptime');

        $data['updatedby'] = $userid;
        $data['updatedon'] = date('Y-m-d H:i:s');
        $data['updatedms'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->model->update($id, $data);

        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal mengupdate data";

        if($result){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil mengupdate data";
            $response['data'] = $result;
        }

        $this->response($response);
    }

    public function delete_delete()
    {
        $id = $this->delete('id');
        $data = $this->model->delete($id);

        // Response
        $response['status'] = false;
        $response['message'] = "Gagal menghapus data";

        if($data){
            $response['status'] = true;
            $response['message'] = "Berhasil menghapus data";
            $response['data'] = $data;
        }

        $this->response($response);
    }

    public function delete_flag_delete()
    {
        $id = $this->delete('id');
        $data = $this->model->delete_flag($id);

        // Response
        $response['status'] = false;
        $response['message'] = "Gagal menghapus data";

        if($data){
            $response['status'] = true;
            $response['message'] = "Berhasil menghapus data";
            $response['data'] = $data;
        }

        $this->response($response);
    }

}