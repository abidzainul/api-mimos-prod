<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Customer extends REST_Controller{
	public function __construct()
  	{
    	parent::__construct();
    	$this->load->model('Model_Customer');
  	}
  	public function customerbyvisitday_post(){
        $tgl = $this->post('tgl');
        $visitday = date('N',strtotime($tgl));
  		//$visitday  = $this->post('visitday');
        $userid  = $this->post('userid');
        //$visitweek  = $this->post('visitweek');
        $visitweek = $this->Model_Customer->getWeekGenapGanjilbyCycle($tgl);
        $data =  array(
            '0' => array('customerno' => '-', 'userid' => '-', 'visitday' => '-', 'visitweek' => '-', 'name' => '-', 'address' => '-', 'city' => '-', 'owner' => '-', 'phone' => '-', 'customergroupid' => '-', 'customergroupname' => '-', 'priceid' => '-', 'salesdistrictid' => '-', 'salesdistrictname' => '-', 'salesgroupid' => '-', 'salesgroupname' => '-', 'salesofficeid' => '-', 'salesofficename' => '-', 'usersfaid' => '-', 'userroleid' => '-','tanggalkunjungan' => '-','nourut' => '0'),
            );

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
						$result = $this->Model_Customer->getCustomersByVisitDay($userid, $visitday,$visitweek,$tgl);
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
    public function customerbyvisitday20201215_post()
    {
      $tgl = $this->post('tgl');
      $visitday = date('N',strtotime($tgl));
        //(1 for Senin, 7 for minggu)
      //$visitday  = $this->post('visitday');
      $userid  = $this->post('userid');
        //$visitweek  = $this->post('visitweek');
      $visitweek = $this->Model_Customer->getWeekGenapGanjilbyCycle($tgl);
      $data =  array(
            '0' => array('customerno' => '-', 'userid' => '-', 'visitday' => '-', 'visitweek' => '-', 'name' => '-', 'address' => '-', 'city' => '-', 'owner' => '-', 'phone' => '-', 'customergroupid' => '-', 'customergroupname' => '-', 'priceid' => '-', 'salesdistrictid' => '-', 'salesdistrictname' => '-', 'salesgroupid' => '-', 'salesgroupname' => '-', 'salesofficeid' => '-', 'salesofficename' => '-', 'usersfaid' => '-', 'userroleid' => '-','tanggalkunjungan' => '-','nourut' => '0'),
            );

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
              $result = $this->Model_Customer->getCustomersByVisitDay20201215($userid, $visitday,$visitweek,$tgl);
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
     public function customerbyvisitday20210101_post()
    {
			$version = $this->input->get_request_header('version');
			$vCode = $this->input->get_request_header('version_code');
			
			// if($vCode == null){
				// $this->response([
					// 'status' => FALSE,
					// 'message' =>'Silahkan Update aplikasi 2.1.1',
					// 'data' => null
				// ], REST_Controller::HTTP_BAD_REQUEST);
			// }else if($vCode < 25){
				// $this->response([
					// 'status' => FALSE,
					// 'message' =>'Silahkan Update aplikasi 2.1.1',
					// 'data' => $vCode
				// ], REST_Controller::HTTP_BAD_REQUEST);
			// }

      $tgl = $this->post('tgl');
      //$visitday = date('N',strtotime($tgl));
        //(1 for Senin, 7 for minggu)
      //$visitday  = $this->post('visitday');
      $userid  = $this->post('userid');
			// if($userid == '71401021'){
			// 	$this->response([
			// 		'status' => FALSE,
			// 		'message' =>'Silahkan update aplikasi versi 2.1.1',
			// 		'data' => []
			// 	], REST_Controller::HTTP_BAD_REQUEST);
			// }
        //$visitweek  = $this->post('visitweek');
      //$visitweek = $this->Model_Customer->getWeekGenapGanjilbyCycle($tgl);
      $data =  array(
            '0' => array('customerno' => '-', 'userid' => '-', 'visitday' => '-', 'visitweek' => '-', 'name' => '-', 'address' => '-', 'city' => '-', 'owner' => '-', 'phone' => '-', 'customergroupid' => '-', 'customergroupname' => '-', 'priceid' => '-', 'salesdistrictid' => '-', 'salesdistrictname' => '-', 'salesgroupid' => '-', 'salesgroupname' => '-', 'salesofficeid' => '-', 'salesofficename' => '-', 'usersfaid' => '-', 'userroleid' => '-','tanggalkunjungan' => '-','nourut' => '0'),
            );

      if ($userid === null || $tgl === null) {
         $this->response([
          'status' => FALSE,
          'message' =>'Identitas Pengguna, Visit Day  null',
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
          
              $result = $this->Model_Customer->getCustomersByTglByUserid20210101($userid,$tgl);
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
    public function getcustomermaterialidbyuseridbytgl_post(){
        $data =  array(
            '0' => array('customerno' => '-', 'userid' => '-', 'materialid' => '-'),
            );
      $tgl = $this->post('tgl');
      $userid  = $this->post('userid');
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
                $result = $this->Model_Customer->getCustomerMaterialIDbyVisitday($userid,$visitday, $visitweek,$tgl);
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
     public function getcustomermaterialidbyuseridbytgl20210101_post(){
        $data =  array(
            '0' => array('customerno' => '-', 'userid' => '-', 'materialid' => '-'),
            );
      $tgl = $this->post('tgl');
      $userid  = $this->post('userid');
      if ($userid === null || $tgl === null) {
        $this->response([
                    'status' => FALSE,
                    'message' =>'Identitas Pengguna, tgl null',
                    'data' => $data
                  ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
        //$visitday = date('N',strtotime($tgl));
        //$visitweek = $this->Model_Customer->getWeekGenapGanjilbyCycle($tgl);
      
        if ($userid === null ) {
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
            
              
                $result = $this->Model_Customer->getCustomerMaterialIDbyTglbyUserid20210101($userid,$tgl);
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
