<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class App_version extends REST_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_appversion', 'appversion');
    }
  	
    public function getVersion_get(){

        $userid	= $this->input->get("userid");
        
        if($userid == null){
            $last = $this->appversion->getLastVersionAllUser();
            $response['status'] = TRUE;
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $last;
            $this->response($response);
            exit;
        }

        $last = $this->appversion->getLastVersionApps();
        if($last->all_user != 1){
            $data = $this->appversion->getAppReleaseUserByUser($userid, $last->id);
            if($data == null){
                $last = $this->appversion->getLastVersionAllUser();
            }
        }

        if($last){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $last;
        }

        $this->response($response);

    }
  	
    public function getLastVersion_get(){

        $data = $this->appversion->getLastVersionApps();

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
  	
    public function getLastVersionAllUser_get(){

        $data = $this->appversion->getLastVersionAllUser();

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
  	
    public function getAppReleaseUserByUser_get(){

        $userid	= $this->input->get("userid");
        $appversionid	= $this->input->get("appversionid");
        $data = $this->appversion->getAppReleaseUserByUser($userid, $appversionid);

        // Response
        $response['status'] = FALSE;
        $response['message'] = "Gagal mendapatkan data";
        $response['data'] = $data;

        if($data){
            $response['status'] = TRUE;
            $response['message'] = "Berhasil mendapatkan data";
            $response['data'] = $data;
        }

        $this->response($response);

    }
  
    public function add_post(){
        $userid = $this->input->get_request_header('user');

        $data['version_code'] = $this->post('version_code');
        $data['version_name'] = $this->post('version_name');
        $data['release_date'] = $this->post('release_date');
        $data['release_log'] = $this->post('release_log');
        $data['link_android'] = $this->post('link_android');
        $data['link_ios'] = $this->post('link_ios');
        $data['force_update'] = $this->post('force_update');
        $data['all_user'] = $this->post('all_user');

        $data['createdby'] = $userid;
        $data['createdon'] = date('Y-m-d H:i:s');

        // INSERT
        $id = $this->appversion->insert($data);
        $result = $this->appversion->getById($id);

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

        $data['version_code'] = $this->put('version_code');
        $data['version_name'] = $this->put('version_name');
        $data['release_date'] = $this->put('release_date');
        $data['release_log'] = $this->put('release_log');
        $data['link_android'] = $this->post('link_android');
        $data['link_ios'] = $this->post('link_ios');
        $data['force_update'] = $this->put('force_update');
        $data['all_user'] = $this->put('all_user');

        $data['updatedby'] = $userid;
        $data['updatedon'] = date('Y-m-d H:i:s');

        $id = $this->put('id');

        $result = $this->appversion->update($id, $data);

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
        $data = $this->appversion->delete($id);

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
        $data = $this->appversion->delete_flag($id);

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