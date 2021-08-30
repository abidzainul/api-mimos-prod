<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Trial extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_trial', 'trial');
    }
  	
    public function getByDate_get(){

        $userid	= $this->input->get("userid");
        $tgl 	= $this->input->get("tgl");
        $data = $this->trial->getByDate($userid, $tgl);
        
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
        $data = $this->trial->getById($id);
        
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
        $data['id']=$this->post('id');
        $data['userid']=$this->post('userid');
        $data['trialdate']=$this->post('trialdate');
        $data['trialtype']=$this->post('trialtype');
        $data['location']=$this->post('location');
        $data['name']=$this->post('name');
        $data['phone']=$this->post('phone');
        $data['age']=$this->post('age');
        $data['materialid']=$this->post('materialid');
        $data['qty']=$this->post('qty');
        $data['price']=$this->post('price');
        $data['amount']=$this->post('amount');
        $data['competitorbrandid']=$this->post('competitorbrandid');
        $data['knowing']=$this->post('knowing');
        $data['taste']=$this->post('taste');
        $data['packaging']=$this->post('packaging');
        $data['outletname']=$this->post('outletname');
        $data['outletaddress']=$this->post('outletaddress');
        $data['notes']=$this->post('notes');

        $data['createdby'] = $this->post('userid');
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->trial->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->trial->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->trial->insert($data);
        //     $result = $this->trial->getById($id);
        // }
        // INSERT
        $id = $this->trial->insert($data);
        $result = $this->trial->getById($id);

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
        $data['id']=$this->put('id');
        $data['userid']=$this->put('userid');
        $data['trialdate']=$this->put('trialdate');
        $data['trialtype']=$this->put('trialtype');
        $data['location']=$this->put('location');
        $data['name']=$this->put('name');
        $data['phone']=$this->put('phone');
        $data['age']=$this->put('age');
        $data['materialid']=$this->put('materialid');
        $data['qty']=$this->put('qty');
        $data['price']=$this->put('price');
        $data['amount']=$this->put('amount');
        $data['competitorbrandid']=$this->put('competitorbrandid');
        $data['knowing']=$this->put('knowing');
        $data['taste']=$this->put('taste');
        $data['packaging']=$this->put('packaging');
        $data['outletname']=$this->put('outletname');
        $data['outletaddress']=$this->put('outletaddress');
        $data['notes']=$this->put('notes');

        $data['updatedby'] = $this->put('userid');
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->trial->update($id, $data);

        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal mengupdate data";

        if($id){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil mengupdate data";
            $response['data'] = $result;
        }

        $this->response($response);
    }

    public function delete_delete()
    {
        $id = $this->delete('id');
        $data = $this->trial->delete($id);

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
        $data = $this->trial->delete_flag($id);

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