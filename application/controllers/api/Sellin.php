<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Sellin extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_sellin', 'sellin');
    }
  	
    public function getByDate_get(){

        $userid	= $this->input->get("userid");
        $tgl 	= $this->input->get("tgl");
        $data = $this->sellin->getByDate($userid, $tgl);
        
        if($userid == null || $tgl == null){
            $response['status'] = FALSE;
            $response['message'] = "Gagal mendapatkan data";
            $this->response($response);
            exit;
        }

        if($data){
            $response['status'] = TRUE;
            $response['length'] = count($data);
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $data;
        }

        if(empty($data)){
            $response['status'] = TRUE;
            $response['message'] = "Data tidak ditemukan";
            $response['data'] = null;
        }

        $this->response($response);

    }

    public function getById_get($id)
    {
        $data = $this->sellin->getById($id);
        
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
        $data['userid'] = $this->post('userid');
        $data['sellinno'] = $this->post('sellinno');
        $data['customerno'] = $this->post('customerno');
        $data['sellindate'] = $this->post('sellindate');
        $data['regionid'] = $this->post('regionid');
        $data['salesofficeid'] = $this->post('salesofficeid');
        $data['salesgroupid'] = $this->post('salesgroupid');
        $data['salesdistrictid'] = $this->post('salesdistrictid');
        $data['cycle'] = $this->post('cycle');
        $data['week'] = $this->post('week');
        $data['year'] = $this->post('year');
        $data['amount'] = $this->post('amount');
        $data['notes'] = $this->post('notes');

        $data['createdby'] = $this->post('userid');
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->sellin->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->sellin->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->sellin->insert($data);
        //     $result = $this->sellin->getById($id);
        // }
        // INSERT
        $id = $this->sellin->insert($data);
        $result = $this->sellin->getById($id);

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
        $data['userid'] = $this->put('userid');
        $data['sellinno'] = $this->put('sellinno');
        $data['customerno'] = $this->put('customerno');
        $data['sellindate'] = $this->put('sellindate');
        $data['regionid'] = $this->put('regionid');
        $data['salesofficeid'] = $this->put('salesofficeid');
        $data['salesgroupid'] = $this->put('salesgroupid');
        $data['salesdistrictid'] = $this->put('salesdistrictid');
        $data['cycle'] = $this->put('cycle');
        $data['week'] = $this->put('week');
        $data['year'] = $this->put('year');
        $data['amount'] = $this->put('amount');
        $data['notes'] = $this->put('notes');

        $data['updatedby'] = $this->put('userid');
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->sellin->update($id, $data);

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
        $data = $this->sellin->delete($id);

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
        $data = $this->sellin->delete_flag($id);

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