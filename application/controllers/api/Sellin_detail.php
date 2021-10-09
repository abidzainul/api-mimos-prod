<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Sellin_detail extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_sellin_detail', 'sellin_detail');
    }
  	
    public function getByHead_get(){

        $ids 	= $this->input->get("sellin_ids");
        $data = $this->sellin_detail->getByHead($ids);
        
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

        $ids 	= $this->input->post("sellin_ids");
        $data   = null;

        if($ids != null){
            $data = $this->sellin_detail->getByHead($ids);
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
        $data = $this->sellin_detail->getById($id);
        
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

        $data['sellinid'] = $this->post('sellinid');
        $data['materialid'] = $this->post('materialid');
        $data['bal'] = $this->post('bal');
        $data['slof'] = $this->post('slof');
        $data['pac'] = $this->post('pac');
        $data['qty'] = $this->post('qty');
        $data['qtyintrodeal'] = $this->post('qtyintrodeal');
        $data['price'] = $this->post('price');
        $data['sellinvalue'] = $this->post('sellinvalue');

        $data['createdby'] = $userid;
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->sellin_detail->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->sellin_detail->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->sellin_detail->insert($data);
        //     $result = $this->sellin_detail->getById($id);
        // }

        $exist = $this->sellin_detail->cekIsExist(
            $data['sellinid'], 
            $data['materialid']
        );

        $result;
        if($exist != null){
            // UPDATE
            $this->sellin_detail->update($exist->id, $data);
            $result = $this->sellin_detail->getById($exist->id);
        }else{
            // INSERT
            $id = $this->sellin_detail->insert($data);
            $result = $this->sellin_detail->getById($id);
        }

        // INSERT
        // $id = $this->sellin_detail->insert($data);
        // $result = $this->sellin_detail->getById($id);

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

        $data['sellinid'] = $this->put('sellinid');
        $data['materialid'] = $this->put('materialid');
        $data['bal'] = $this->put('bal');
        $data['slof'] = $this->put('slof');
        $data['pac'] = $this->put('pac');
        $data['qty'] = $this->put('qty');
        $data['qtyintrodeal'] = $this->put('qtyintrodeal');
        $data['price'] = $this->put('price');
        $data['sellinvalue'] = $this->put('sellinvalue');

        $data['updatedby'] = $userid;
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->sellin_detail->update($id, $data);

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
        $data = $this->sellin_detail->delete($id);

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
        $data = $this->sellin_detail->delete_flag($id);

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