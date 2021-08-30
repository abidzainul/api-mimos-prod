<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Material extends REST_Controller{
	public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_Material');
    $this->load->model('Model_Customer');
  }

  public function materialGroup_post(){
    $result = $this->Model_Material->getMaterialGroup();
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'get material group sukses ',
          'data' => $result
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Material group Not Found',
          'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
  }
  public function materialTFbyUserid_post(){
  	$userid = $this->post('userid');
  	$data =  array(
      '0' => array( 'materialid' => '-', 'materialname' => '-', 'materialgroupid' => '-', 'pac' => '-', 'slof' => '-', 'bal' => '-', 'materialgroupdescription' => '-'),
    );
  	if ($userid === null) {
  		$this->response([
        'status' => FALSE,
        'message' =>'Sales ID null',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
  	}else if(empty($userid)){
  		$this->response([
        'status' => FALSE,
        'message' =>'Sales ID kosong',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
  	}else{
  		  	// request data
  		$result = $this->Model_Material->getMaterialTFbyUserID($userid);
  		if($result){
  		  $this->response([
		      'status' => TRUE,
		      'message' =>'Sales ID = '.$userid,
		      'data' => $result
		    ], REST_Controller::HTTP_OK);
  		}else{
  		  $this->response([
          'status' => FALSE,
          'message' =>'Material Not Found',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
  		}
  	}
  }

    public function hargaMaterialTFbyUseridbyTgl_post(){
      $userid = $this->post('userid');
      //$tglakhir = $this->post('tglakhir');
      $tglawal = $this->post('tglawal');
      $data = array(
            '0' => array( 'materialid' => '-','materialname' => '-', 'priceid' => '-', 'harga' => 0, 'tglmulaiberlaku' => '-','since'=> 0),
      );
      if ($userid === null) {
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID null',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else if(empty($userid)){
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID kosong',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
          // request data
        $result = $this->Model_Material->getPriceMaterialTFbyUserIDbyTgl($userid,$tglawal,$tglawal);
        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Sales ID = '.$userid,
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Material Price Not Found',
            'data' => $data
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
      }
    }

    public function introDealTFbyUseridbyTgl_post(){
      $userid = $this->post('userid');
      $tglawal = $this->post('tglawal');
    //$tglakhir = $this->post('tglakhir');
      $data = array('0' => array( 'materialid' => '-', 'materialname' => '-','qtyorder' => 0, 'qtybonus' => 0, 'tglmulaiberlaku' => '-','since'=> 0),
      );
      if ($userid === null) {
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID null',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else if(empty($userid)){
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID kosong',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
          // request data
        $result = $this->Model_Material->getIntroDealTFbyUserIDbyTglawalbyTglakhir($userid,$tglawal,$tglawal);
        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Sales ID = '.$userid,
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Intro Deal Not Found',
            'data' => $data
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
      }
    }
    //--- sudah tidak digunakan lagi 20200803
    public function visibilitywspbyUserid_post(){
      $userid = $this->post('UserID');
      $data = array('0' => array( 'materialid' => '-', 'materialgroupid' => '-','wspclass' => '-','pac' => '0'),
      );
      if ($userid === null) {
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID null',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else if(empty($userid)){
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID kosong',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
          // request data
        $result = $this->Model_Material->getWSPClassbyUserID($userid);
        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Sales ID = '.$userid,
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'visibility wsp Not Found',
            'data' => $data
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
      }
    }
    //----
    public function customerWSPClassStockbyUseridbyTgl_post(){
       $data =  array(
            '0' => array('customerno' => '-', 'wspclass' => '-', 'materialgroupid' => '-', 'pac' => '-', 'materialid' => '-'),
            );
      $tgl = $this->post('tgl');
      $userid  = $this->post('UserID');
      if ($userid === null || $tgl === null) {
        $this->response([
                    'status' => FALSE,
                    'message' =>'Identitas Pengguna, tgl null',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
        $visitday = date('N',strtotime($tgl));
        $visitweek = $this->Model_Customer->getWeekGenapGanjilbyCycle($tgl);
      
        if ($userid === null || $visitday === null|| $visitweek === null) {
        $this->response([
                    'status' => FALSE,
                    'message' =>'Identitas Pengguna, Visit Day atau  Visit Week null',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
          if(empty($userid)){
              $this->response([
                    'status' => FALSE,
                    'message' =>'Identitas Pengguna Kosong',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
          }else{
            if(empty($visitday)){
              $this->response([
                    'status' => FALSE,
                    'message' =>'Visit Day Kosong',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
            }else{
              if(empty($visitweek) or $visitweek == 0){
                $this->response([
                      'status' => FALSE,
                      'message' =>'Visit Week Kosong atau Periode cycle belum dibuat',
                      'data' => $data
                    ], REST_Controller::HTTP_BAD_REQUEST);
              }else{
                $result = $this->Model_Material->getWSPClassStockbyUserID($userid, $visitweek,$visitday,$tgl);
                if($result){
                  $this->response([
                        'status' => TRUE,
                         'message' =>'ID User = '.$userid,
                        'data' => $result
                      ], REST_Controller::HTTP_OK);
                }else{
                  $this->response([
                        'status' => FALSE,
                        'message' =>'No Data',
                        'data' => $data
                      ], REST_Controller::HTTP_BAD_REQUEST);
                }
              }
            }
          }
        }
      }
      
    }
    public function customerWSPClassStockbyUseridbyTgl20210101_post(){
       $data =  array(
            '0' => array('customerno' => '-', 'wspclass' => '-', 'materialgroupid' => '-', 'pac' => '-', 'materialid' => '-'),
            );
      $tgl = $this->post('tgl');
      $userid  = $this->post('UserID');
      if ($userid === null || $tgl === null) {
        $this->response([
          'status' => FALSE,
          'message' =>'Identitas Pengguna, tgl null',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
       // $visitday = date('N',strtotime($tgl));
        //$visitweek = $this->Model_Customer->getWeekGenapGanjilbyCycle($tgl);
      
        if ($userid === null ) {
        $this->response([
                    'status' => FALSE,
                    'message' =>'Identitas Pengguna null',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
          if(empty($userid)){
              $this->response([
                    'status' => FALSE,
                    'message' =>'Identitas Pengguna Kosong',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
          }else{
                $result = $this->Model_Material->getWSPClassStockbyUserIDbytgl20210101($userid,$tgl);
                if($result){
                  $this->response([
                        'status' => TRUE,
                         'message' =>'ID User = '.$userid,
                        'data' => $result
                      ], REST_Controller::HTTP_OK);
                }else{
                  $this->response([
                        'status' => FALSE,
                        'message' =>'No Data',
                        'data' => $data
                      ], REST_Controller::HTTP_BAD_REQUEST);
                }
          }
        }
      }
    }
    public function customerIntroDealTFbyUseridbyTgl_post(){
      $userid = $this->post('userid');
      $tglawal = $this->post('tglawal');
    //$tglakhir = $this->post('tglakhir');
      $data = array('0' => array( 'materialid' => '-', 'introdealid' => '-','customerno' => '-'),
      );
      if ($userid === null) {
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID null',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else if(empty($userid)){
        $this->response([
          'status' => FALSE,
          'message' =>'Sales ID kosong',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
          // request data
        $result = $this->Model_Material->getCustomerIntrodealbyUserbyTglawalbyTglakhir($userid,$tglawal,$tglawal);
        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Sales ID = '.$userid,
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Intro Deal Not Found',
            'data' => $data
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
      }
    }
	
	// material frontliner (arta)
	public function materialFL_post(){
  	$salesofficeid = $this->post('salesofficeid');
	$datenow =  date("Y-m-d");
	// var_dump($datenow);exit();
  	$data =  array(
      '0' => array( 'materialid' => '-', 'materialname' => '-', 'materialgroupid' => '-', 'materialgroupdescription' => '-', 'price' => '-', 'pricecode' => '-'),
    );
  	if ($salesofficeid === null) {
  		$this->response([
        'status' => FALSE,
        'message' =>'SalesofficeID null',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
  	}else if(empty($salesofficeid)){
  		$this->response([
        'status' => FALSE,
        'message' =>'SalesofficeID kosong',
        'data' => $data
      ], REST_Controller::HTTP_BAD_REQUEST);
  	}else{
  		  	// request data material & harga
  		$result = $this->Model_Material->getMaterialFL($salesofficeid,$datenow);
  		if($result){
  		  $this->response([
		      'status' => TRUE,
		      'message' =>'Get Material Success',
		      'data' => $result
		    ], REST_Controller::HTTP_OK);
  		}else{
  		  $this->response([
          'status' => FALSE,
          'message' =>'Material Not Found',
          'data' => $data
        ], REST_Controller::HTTP_BAD_REQUEST);
  		}
  	}
  }

}