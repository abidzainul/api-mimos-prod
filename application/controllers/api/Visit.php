<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Visit extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_visit', 'visit');
    }
  	
    public function getByDate_get(){

        $userid	= $this->input->get("userid");
        $tgl 	= $this->input->get("tgl");
        $data = $this->visit->getByDate($userid, $tgl);
        
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
        $data = $this->visit->getById($id);
        
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
        $data['customerno'] = $this->post('customerno');
        $data['visitdate'] = $this->post('visitdate');
        $data['notvisitreason'] = $this->post('notvisitreason');
        $data['notbuyreason'] = $this->post('notbuyreason');
        $data['regionid'] = $this->post('regionid');
        $data['salesofficeid'] = $this->post('salesofficeid');
        $data['salesgroupid'] = $this->post('salesgroupid');
        $data['salesdistrictid'] = $this->post('salesdistrictid');
        if($this->post('checkintime') != null)
            $data['checkintime'] = $this->post('checkintime');
        if($this->post('checkouttime') != null)
            $data['checkouttime'] = $this->post('checkouttime');
        $data['cycle'] = $this->post('cycle');
        $data['week'] = $this->post('week');
        $data['year'] = $this->post('year');

        $data['active'] = $this->post('0');
        $data['createdby'] = $this->post('userid');
        $data['createdon'] = date('Y-m-d H:i:s');

        // $id = $this->post('id');
        // $exist = null;

        // if($id != null){
        //     // CEK DATA IF EXIST BY ID
        //     $exist = $this->visit->getById($id);
        // }

        // if($exist != null){
        //     // UPDATE
        //     $result = $this->visit->update($id, $data);
        // }else{
        //     // INSERT
        //     $id = $this->visit->insert($data);
        //     $result = $this->visit->getById($id);
        // }

        $exist = $this->visit->cekIsExist($data['userid'], $data['customerno'], $data['visitdate']);
        
        $result;
        if($exist != null){
            // UPDATE
            $this->visit->update($exist[0]->id, $data);
            $result = $this->visit->getById($exist[0]->id);
        }else{
            // INSERT
            $id = $this->visit->insert($data);
            $result = $this->visit->getById($id);
        }
        // INSERT
        // $id = $this->visit->insert($data);
        // $result = $this->visit->getById($id);

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
        $data['userid'] = $this->put('userid');
        $data['customerno'] = $this->put('customerno');
        $data['visitdate'] = $this->put('visitdate');
        $data['notvisitreason'] = $this->put('notvisitreason');
        $data['notbuyreason'] = $this->put('notbuyreason');
        $data['regionid'] = $this->put('regionid');
        $data['salesofficeid'] = $this->put('salesofficeid');
        $data['salesgroupid'] = $this->put('salesgroupid');
        $data['salesdistrictid'] = $this->put('salesdistrictid');
        if($this->put('checkintime') != null)
            $data['checkintime'] = $this->put('checkintime');
        if($this->put('checkouttime') != null)
            $data['checkouttime'] = $this->put('checkouttime');
        $data['cycle'] = $this->put('cycle');
        $data['week'] = $this->put('week');
        $data['year'] = $this->put('year');

        $data['active'] = $this->put('0');
        $data['updatedby'] = $this->put('userid');
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->visit->update($id, $data);

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
        $data = $this->visit->delete($id);

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
        $data = $this->visit->delete_flag($id);

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