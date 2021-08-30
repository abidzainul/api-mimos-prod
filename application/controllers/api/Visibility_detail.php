<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Visibility_detail extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_visibility_detail', 'visibility_detail');
    }
  	
    public function getByHead_get(){

        $ids 	= $this->input->get("visibility_ids");
        $data = $this->visibility_detail->getByHead($ids);
        
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
  	
    public function getByHead_post(){

        $ids 	= $this->input->post("visibility_ids");
        $data   = null;

        if($ids != null){
            $data = $this->visibility_detail->getByHead($ids);
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
        $data = $this->visibility_detail->getById($id);
        
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

        $data['visibilityid'] = $this->post('visibilityid');
        $data['materialid'] = $this->post('materialid');
        $data['pac'] = $this->post('pac');

        $data['createdby'] = $userid;
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->visibility_detail->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->visibility_detail->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->visibility_detail->insert($data);
        //     $result = $this->visibility_detail->getById($id);
        // }
        // INSERT
        $id = $this->visibility_detail->insert($data);
        $result = $this->visibility_detail->getById($id);

        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal menyimpan data";

        if($id){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil menyimpan data";
            $response['data'] = $result;
        }

        $this->response($response);
    }
  
    public function update_put(){
        $userid = $this->input->get_request_header('user');

        $data['visibilityid'] = $this->put('visibilityid');
        $data['materialid'] = $this->put('materialid');
        $data['pac'] = $this->put('pac');

        $data['updatedby'] = $userid;
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->visibility_detail->update($id, $data);

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
        $data = $this->visibility_detail->delete($id);

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
        $data = $this->visibility_detail->delete_flag($id);

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