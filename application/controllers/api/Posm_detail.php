<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Posm_detail extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_posm_detail', 'posm_detail');
    }
  	
    public function getByHead_get(){

        $ids 	= $this->input->get("posm_ids");
        
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

        $ids    = $this->input->post("posm_ids");
        $data   = null;

        if($ids != null){
            $data = $this->posm_detail->getByHead($ids);
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
        $data = $this->posm_detail->getById($id);
        
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

        $data['posmid'] = $this->post('posmid');
        $data['posmtypeid'] = $this->post('posmtypeid');
        $data['materialgroupid'] = $this->post('materialgroupid');
        $data['status'] = $this->post('status');
        $data['qty'] = $this->post('qty');
        $data['condition'] = $this->post('condition');
        $data['notes'] = $this->post('notes');

        $data['createdby'] = $userid;
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->posm_detail->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->posm_detail->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->posm_detail->insert($data);
        //     $result = $this->posm_detail->getById($id);
        // }

        $exist = $this->posm_detail->cekIsExist(
            $data['posmid'], 
            $data['posmtypeid'], 
            $data['materialgroupid']
        );

        $result;
        if($exist != null){
            // UPDATE
            $this->posm_detail->update($exist->id, $data);
            $result = $this->posm_detail->getById($exist->id);
        }else{
            // INSERT
            $id = $this->posm_detail->insert($data);
            $result = $this->posm_detail->getById($id);
        }
        // INSERT
        // $id = $this->posm_detail->insert($data);
        // $result = $this->posm_detail->getById($id);

        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal menyimpan data";

        if($result != null){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil menyimpan data";
            $response['data'] = $result;
        }

        $this->response($response);
    }
  
    public function update_put(){
        $userid = $this->input->get_request_header('user');

        $data['posmid'] = $this->put('posmid');
        $data['posmtypeid'] = $this->put('posmtypeid');
        $data['materialgroupid'] = $this->put('materialgroupid');
        $data['status'] = $this->put('status');
        $data['qty'] = $this->put('qty');
        $data['condition'] = $this->put('condition');
        $data['notes'] = $this->put('notes');

        $data['updatedby'] = $userid;
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->posm_detail->update($id, $data);

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
        $data = $this->posm_detail->delete($id);

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
        $data = $this->posm_detail->delete_flag($id);

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