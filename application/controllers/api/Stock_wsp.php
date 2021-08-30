<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Stock_wsp extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_stock_wsp', 'stock_wsp');
    }
  	
    public function getBySalesOffice_get(){

        $salesofficeid 	= $this->input->get("salesofficeid");
        $data = $this->stock_wsp->getBySalesOffice($salesofficeid);
        
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

        $ids 	= $this->input->post("stock_ids");
        $data   = null;

        if($ids != null){
            $data = $this->stock_wsp->getByHead($ids);
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
        $data = $this->stock_wsp->getById($id);
        
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

        $data['stockid'] = $this->post('stockid');
        $data['materialid'] = $this->post('materialid');
        $data['bal'] = $this->post('bal');
        $data['slof'] = $this->post('slof');
        $data['pac'] = $this->post('pac');
        $data['qty'] = $this->post('qty');

        $data['createdby'] = $userid;
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->stock_wsp->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->stock_wsp->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->stock_wsp->insert($data);
        //     $result = $this->stock_wsp->getById($id);
        // }
        // INSERT
        $id = $this->stock_wsp->insert($data);
        $result = $this->stock_wsp->getById($id);

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

        $data['stockid'] = $this->put('stockid');
        $data['materialid'] = $this->put('materialid');
        $data['bal'] = $this->put('bal');
        $data['slof'] = $this->put('slof');
        $data['pac'] = $this->put('pac');
        $data['qty'] = $this->put('qty');

        $data['updatedby'] = $userid;
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->stock_wsp->update($id, $data);

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
        $data = $this->stock_wsp->delete($id);

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
        $data = $this->stock_wsp->delete_flag($id);

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