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
        $data['idsqlite'] = $this->post('id');
        $data['active'] = 0;

        // $data['createdby'] = $this->post('userid');
        // $data['createdon'] = date('Y-m-d H:i:s');

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

        $exist = null;
        $exist = $this->sellin->cekIsExist(
            $data['userid'], 
            $data['customerno'], 
            $data['sellindate']
        );
        
        $result;
        if($exist != null){
            // UPDATE
            $data['typein'] = 'UPDATE';
            $data['updatedby'] = $this->post('userid');
            $data['updatedon'] = date('Y-m-d H:i:s');
            $data['updatedms'] = $this->udate('Y-m-d H:i:s.u T');
            
			if($data['amount'] != 0){
				$this->sellin->update($exist->id, $data);
			}
            $result = $this->sellin->getById($exist->id);
        }else{
            // INSERT
            $data['typein'] = 'INSERT';
            $data['createdby'] = $this->post('userid');
            $data['createdon'] = date('Y-m-d H:i:s');
            $data['createdms'] = $this->udate('Y-m-d H:i:s.u T');

            $this->sellin->deleteFlagBy(
				$data['userid'], 
				$data['customerno'], 
				$data['sellindate']
			);
            $id = $this->sellin->insert($data);
            if($id){
                // $result = $this->sellin->getById($id);
				$countExist = $this->sellin->countExist(
					$data['userid'], 
					$data['customerno'], 
					$data['sellindate']
				);
				if($countExist > 1){
					$this->sellin->deleteFlagBy(
						$data['userid'], 
						$data['customerno'], 
						$data['sellindate']
					);
					$result = $this->sellin->cekIsExist(
						$data['userid'], 
						$data['customerno'], 
						$data['sellindate']
					);
				}else{
					$result = $this->sellin->getById($id);
				}
                // $result = $this->sellin->getExist(
                //     $data['userid'], 
                //     $data['customerno'], 
                //     $data['sellindate'],
                //     $data['sellinno']
                // );
            }
        }
        // INSERT
        // $id = $this->sellin->insert($data);
        // $result = $this->sellin->getById($id);

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
  
    public function cekExist_post(){
        $data['userid'] = $this->post('userid');
        $data['sellinno'] = $this->post('sellinno');
        $data['customerno'] = $this->post('customerno');
        $data['sellindate'] = $this->post('sellindate');

        $exist = null;
        $exist = $this->sellin->cekIsExist(
            $data['userid'], 
            $data['customerno'], 
            $data['sellindate']
        );

        if($exist != null){
            $this->response($exist);
        }else{
            $this->response('null');
        }
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

    public function deleteBy_post()
    {
        $userid = $this->post('userid');
        $customerno = $this->post('customerno');
        $sellindate = $this->post('sellindate');

        $data = $this->sellin->deleteBy($userid, $customerno, $sellindate);

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

    function uploadJson_post(){
        $now = date('Y-m-d');
        $userid = $this->post('userid');
        $filename = $this->post('filename');
        $path = "assets";
        $config['upload_path'] = "./".$path;
        $config['allowed_types'] = 'jpg|pdf|txt|json';
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = 20000;
        $config['file_name'] = $now.'-('.$userid.')-'.$filename;
         

        $this->load->library('upload', $config);
        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
 
            $path_file = $path."/".$data['upload_data']['file_name']; 

            // $id = $this->input->post("id");
            // $this->insert($path_file);
             
            // echo json_decode($result);
            $response['status'] = true;
            $response['message'] = "Berhasil upload data";
			$this->response($response);
        }
 
    }

	private function udate($format = 'u', $utimestamp = null) {
		if (is_null($utimestamp))
			$utimestamp = microtime(true);

		$timestamp = floor($utimestamp);
		$milliseconds = round(($utimestamp - $timestamp) * 1000000);

		return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
	}
}
