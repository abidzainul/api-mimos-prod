<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class InjectDB extends REST_Controller{
	public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_InjectDB');
  }
  //----- sellin
  public function injectSellingDetail_post(){
    $sellinid = $this->post('trxid');
    $materialid = $this->post('materialid');
    $bal = $this->post('bal');
    $slof = $this->post('slof');
    $pac = $this->post('pac');
    $qty = $this->post('qtypenjualan');
    $qtyintrodeal = $this->post('introdeal');
    $harga = $this->post('harga');
    $sellinvalue = $this->post('sellinvalue');
    $userid = $this->post('userid');

    if ($sellinid === null) {
      $this->response([
        'status' => FALSE,
        'message' =>'sellin ID null',
        'data' => 'sellin ID Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($sellinid ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'sellin ID kosong',
        'data' => 'sellin ID Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($materialid ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'material ID kosong',
        'data' => 'material ID Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($materialid === null){
      $this->response([
        'status' => FALSE,
        'message' =>'material ID Null',
        'data' => 'material ID Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($bal ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'qty bal kosong',
        'data' => 'qty bal Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($bal === null){
      $this->response([
        'status' => FALSE,
        'message' =>'qty bal Null',
        'data' => 'qty bal ID Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($pac ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'qty pac kosong',
        'data' => 'qty pac Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($pac === null){
      $this->response([
        'status' => FALSE,
        'message' =>'qty pac Null',
        'data' => 'qty pac Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($slof ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'qty slof kosong',
        'data' => 'qty slof Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($slof === null){
      $this->response([
        'status' => FALSE,
        'message' =>'qty slof Null',
        'data' => 'qty slof Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($qty == ""){
      $this->response([
        'status' => FALSE,
        'message' =>'qty all kosong',
        'data' => 'qty all Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($qty === null){
      $this->response([
        'status' => FALSE,
        'message' =>'qty all Null',
        'data' => 'qty all Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($qtyintrodeal == ""){
      $this->response([
        'status' => FALSE,
        'message' =>'qty introdeal kosong',
        'data' => 'qty introdeal Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($qtyintrodeal === null){
      $this->response([
        'status' => FALSE,
        'message' =>'qty introdeal Null',
        'data' => 'qty introdeal Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($harga == ""){
      $this->response([
        'status' => FALSE,
        'message' =>'harga kosong',
        'data' => 'harga Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($harga === null){
      $this->response([
        'status' => FALSE,
        'message' =>'harga Null',
        'data' => 'harga Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($sellinvalue ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'sellinvalue kosong',
        'data' => 'sellinvalue Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($sellinvalue === null){
      $this->response([
        'status' => FALSE,
        'message' =>'sellinvalue Null',
        'data' => 'sellinvalue Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($userid ==""){
      $this->response([
        'status' => FALSE,
        'message' =>'userid kosong',
        'data' => 'userid Kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else if($userid === null){
      $this->response([
        'status' => FALSE,
        'message' =>'userid Null',
        'data' => 'userid Null'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }else{
     $data = array(
      'sellinid' => $sellinid,
      'materialid' => $materialid,
      'bal' => $bal,
      'slof' => $slof,
      'pac' =>$pac,
      'qty' =>$qty,
      'qtyintrodeal' =>$qtyintrodeal,
      'price' =>$harga,
      'sellinvalue' =>$sellinvalue,
      'createdby' =>$userid,
      'createdon' => date('Y-m-d H:i:s')
    );

     $dataupdate = array(
      'sellinid' => $sellinid,
      'materialid' => $materialid,
      'bal' => $bal,
      'slof' => $slof,
      'pac' =>$pac,
      'qty' =>$qty,
      'qtyintrodeal' =>$qtyintrodeal,
      'price' =>$harga,
      'sellinvalue' =>$sellinvalue,
      'updatedby' =>$userid,
      'updatedon' => date('Y-m-d H:i:s')
    );
     //--- cek data 
     $cekdata = $this->Model_InjectDB->cek_Data_Sellin_detail($sellinid,$materialid);

     if ($cekdata){
        //---update data
        $transacid = $cekdata[0]['id'];
        $this->db->where('id', $transacid);
        $prosesupdate = $this->db->update('sellin_detail', $dataupdate);           

        if($prosesupdate){
          $this->response([
            'status' => TRUE,
            'message' =>'Update Sukses',
            'data' => $transacid
          ], REST_Controller::HTTP_OK);
        }else{

          $this->response([
            'status' => FALSE,
            'message' =>'Update Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }

     }else{
        //--- insert
        //---- delete 
        $this->db->delete('sellin_detail',array('sellinid' => $sellinid, 'materialid' => $materialid,));
        $result = $this->Model_InjectDB->insertDetailSelling($data);

        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Insert Sukses',
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Insert Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }

      }
    }
}

public function injectSellingHead_post(){
  $trx = $this->post('trx');
  $trxid = $this->post('trxid');
      /// head
  $nonota = $this->post('nonota');
  $keterangan = $this->post('keterangan');
  $customerno = $this->post('customerno');
  $tglkunjungan = $this->post('tglkunjungan');
  $userid = $this->post('userid');
  $regionid = $this->post('regionid');
  $salesofficeid = $this->post('salesofficeid');
  $salesgroupid = $this->post('salesgroupid');
  $salesdistrictid = $this->post('salesdistrictid');
  $amount = $this->post('amountnota');
  $cycle = $this->post('cycle');
  $week = $this->post('week');
  $year = $this->post('year');

  if ($trx === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'trx null',
      'data' => 'trx Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($trx == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'trx kosong',
      'data' => 'trx Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($nonota === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'No Nota null',
      'data' => 'No Nota Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($nonota ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'No Nota kosong',
      'data' => 'No Nota Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($customerno === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'customer no null',
      'data' => 'customer no Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($customerno ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'customer no kosong',
      'data' => 'customer no Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($tglkunjungan === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan null',
      'data' => 'tgl kunjungan Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($tglkunjungan ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan kosong',
      'data' => 'tgl kunjungan Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($userid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'sales id null',
      'data' => 'sales id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'sales id kosong',
      'data' => 'sales id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else{
    // cek new atau edit berdasarkan userid, tglkunjungan dan customerno
    $transac = $this->Model_InjectDB->getTransacIDSellin($userid,$customerno,$tglkunjungan);

    if ($transac){
// edit
      $transacid = $transac[0]['id'];
      $arrstrsql = array();
      $strsql ="Update sellin  set sellinno = '".$nonota."',notes = '".$keterangan."',customerno ='".$customerno."',sellindate ='".$tglkunjungan."',userid ='".$userid."',regionid ='".$regionid."',salesofficeid ='".$salesofficeid."',salesgroupid ='".$salesgroupid."',salesdistrictid ='".$salesdistrictid."',amount='".$amount."',cycle ='".$cycle."',week ='".$week."',year ='".$year."',updatedby ='".$userid."',updatedon = Now() where id ='".$transacid."';" ;
      $arrstrsql[0]['strsql'] =$strsql;
      $strsql = " delete from sellin_detail where sellinid ='".$transacid."';";
      $arrstrsql[1]['strsql'] =$strsql;
          // delete sellin_detail
      $result=$this->Model_InjectDB->query_jamak($arrstrsql);
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Update Sukses',
          'data' => $transacid
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Update Error',
          'data' => '-1'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }else{
      // new
      $dataHead = array(
        'sellinno' => $nonota,
        'notes' => $keterangan,
        'customerno' => $customerno,
        'sellindate' =>$tglkunjungan,
        'userid' =>$userid,
        'regionid' =>$regionid,
        'salesofficeid' =>$salesofficeid,
        'salesgroupid' =>$salesgroupid,
        'salesdistrictid' =>$salesdistrictid,
        'amount' =>$amount,
        'cycle' =>$cycle,
        'week' =>$week,
        'year' =>$year,
        'createdby' =>$userid,
        'createdon' => date('Y-m-d H:i:s')
      );
      $result = $this->Model_InjectDB->insertHeadSelling($dataHead);
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Insert Sukses',
          'data' => $result
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Insert Error',
          'data' => '-1'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    // if ($trx ==="new"){
    //       // proses insert return idhead utk update di flutternya
    
    // }else{
    //   if ($trxid === null){
    //     $this->response([
    //       'status' => FALSE,
    //       'message' =>'trx id null',
    //       'data' => 'trx id null'
    //     ], REST_Controller::HTTP_BAD_REQUEST);
    //   }else if (empty($trxid)){
    //     $this->response([
    //       'status' => FALSE,
    //       'message' =>'trx id kosong',
    //       'data' => 'trx id kosong'
    //     ], REST_Controller::HTTP_BAD_REQUEST);
    //   }else{
    //       //--- proses update
    
    //   }
    // }
  }
}
//--- end sellin

//---- posm
public function injectPosmHead_post(){
  $trx = $this->post('trx');
  $trxid = $this->post('trxid');
  $customerno = $this->post('customerno');
  $tglkunjungan = $this->post('tglkunjungan');
  $userid = $this->post('userid');
  $regionid = $this->post('regionid');
  $salesofficeid = $this->post('salesofficeid');
  $salesgroupid = $this->post('salesgroupid');
  $salesdistrictid = $this->post('salesdistrictid');
  $cycle = $this->post('cycle');
  $week = $this->post('week');
  $year = $this->post('year');

  if ($trx === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'trx null',
      'data' => 'trx Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($trx == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'trx kosong',
      'data' => 'trx Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);


  }else  if ($customerno === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'customer no null',
      'data' => 'customer no Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($customerno ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'customer no kosong',
      'data' => 'customer no Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($tglkunjungan === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan null',
      'data' => 'tgl kunjungan Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($tglkunjungan ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan kosong',
      'data' => 'tgl kunjungan Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($userid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'sales id null',
      'data' => 'sales id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'sales id kosong',
      'data' => 'sales id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else{
    $transac = $this->Model_InjectDB->getTransacIDPosm($userid,$customerno,$tglkunjungan);
    if ($transac){
      ///----update
      $transacid = $transac[0]['id'];
      $arrstrsql = array();
      $strsql ="Update posm  set customerno ='".$customerno."',posmdate ='".$tglkunjungan."',userid ='".$userid."',regionid ='".$regionid."',salesofficeid ='".$salesofficeid."',salesgroupid ='".$salesgroupid."',salesdistrictid ='".$salesdistrictid."',cycle ='".$cycle."',week ='".$week."',year ='".$year."',updatedby ='".$userid."',updatedon = Now() where id ='".$transacid."';" ;
      $arrstrsql[0]['strsql'] =$strsql;
      $strsql = " delete from posm_detail where posmid ='".$transacid."';";
      $arrstrsql[1]['strsql'] =$strsql;
          // delete sellin_detail
      $result=$this->Model_InjectDB->query_jamak($arrstrsql);
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Update Sukses',
          'data' => $transacid
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Update Error',
          'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }

    }else{
//---- new
      $dataHead = array(
        'customerno' => $customerno,
        'posmdate' =>$tglkunjungan,
        'userid' =>$userid,
        'regionid' =>$regionid,
        'salesofficeid' =>$salesofficeid,
        'salesgroupid' =>$salesgroupid,
        'salesdistrictid' =>$salesdistrictid,
        'cycle' =>$cycle,
        'week' =>$week,
        'year' =>$year,
        'createdby' =>$userid,
        'createdon' => date('Y-m-d H:i:s')
      );
      $result = $this->Model_InjectDB->insertHeadPosm($dataHead);
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Insert Sukses',
          'data' => $result
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Insert Error',
          'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    // if ($trx ==="new"){
    //       // proses insert return idhead utk update di flutternya
    
    // }else{
    //   if ($trxid === null){
    //     $this->response([
    //       'status' => FALSE,
    //       'message' =>'trx id null',
    //       'data' => 'trx id null'
    //     ], REST_Controller::HTTP_BAD_REQUEST);
    //   }else if (empty($trxid)){
    //     $this->response([
    //       'status' => FALSE,
    //       'message' =>'trx id kosong',
    //       'data' => 'trx id kosong'
    //     ], REST_Controller::HTTP_BAD_REQUEST);
    //   }else{
    //       //--- proses update
    
    //   }
    // }
  }
}

public function injectPosmDetail_post(){
  $posmid = $this->post('trxid');
  $materialgroupid = $this->post('materialgroupid');
  $posmtypeid = $this->post('posmtypeid');
  $status = $this->post('status');
  $condition = $this->post('condition');
  $qty = $this->post('qty');
  $note = $this->post('note');
  $userid = $this->post('userid');

  if ($posmid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'posm ID null',
      'data' => 'posm ID Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($posmid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'psom ID kosong',
      'data' => 'posm ID Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($materialgroupid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'material group ID kosong',
      'data' => 'material group ID Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($materialgroupid === null){
    $this->response([
      'status' => FALSE,
      'message' =>'material group ID Null',
      'data' => 'material group ID Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($posmtypeid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'posmtype id kosong',
      'data' => 'posmtype id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($posmtypeid === null){
    $this->response([
      'status' => FALSE,
      'message' =>'posmtype id Null',
      'data' => 'posmtype id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($status ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'status kosong',
      'data' => 'status Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($status === null){
    $this->response([
      'status' => FALSE,
      'message' =>'status Null',
      'data' => 'status Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($condition ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'condition kosong',
      'data' => 'condition Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($condition === null){
    $this->response([
      'status' => FALSE,
      'message' =>'condition Null',
      'data' => 'condition Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($qty == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'qty all kosong',
      'data' => 'qty all Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($qty === null){
    $this->response([
      'status' => FALSE,
      'message' =>'qty all Null',
      'data' => 'qty all Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($note === null){
    $this->response([
      'status' => FALSE,
      'message' =>'note Null',
      'data' => 'note Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'userid kosong',
      'data' => 'userid Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid === null){
    $this->response([
      'status' => FALSE,
      'message' =>'userid Null',
      'data' => 'userid Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else{
   $data = array(
    'posmid' => $posmid,
    'posmtypeid' => $posmtypeid,
    'materialgroupid' => $materialgroupid,
    'status' => $status,
    'qty' => $qty,
    'condition' =>$condition,
    'notes' =>$note,
    'createdby' =>$userid,
    'createdon' => date('Y-m-d H:i:s')
  );
   $dataupdate = array(
    'posmid' => $posmid,
    'posmtypeid' => $posmtypeid,
    'materialgroupid' => $materialgroupid,
    'status' => $status,
    'qty' => $qty,
    'condition' =>$condition,
    'notes' =>$note,
    'updatedby' =>$userid,
    'updatedon' => date('Y-m-d H:i:s')
  );
   //---- cek data
  $cekdata = $this->Model_InjectDB->cek_Data_Posm_detail($posmid,$posmtypeid,$materialgroupid);
  if ($cekdata){
    //--- update
            //---update data
        $transacid = $cekdata[0]['id'];
        $this->db->where('id', $transacid);
        $prosesupdate = $this->db->update('posm_detail', $dataupdate);           

        if($prosesupdate){
          $this->response([
            'status' => TRUE,
            'message' =>'Update Sukses',
            'data' => $transacid
          ], REST_Controller::HTTP_OK);
        }else{

          $this->response([
            'status' => FALSE,
            'message' =>'Update Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
  }else{
    //--- insert
    $this->db->delete('posm_detail',array('posmid' => $posmid, 'posmtypeid' => $posmtypeid,'materialgroupid' =>$materialgroupid,));
      $result = $this->Model_InjectDB->insertDetailPosm($data);

      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Insert Sukses',
          'data' => $result
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Insert Error',
          'data' => '-1'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
  }


  }
}
  //--- end posm
//--- Stock
public function injectStockHead_post(){
  $trx = $this->post('trx');
  $trxid = $this->post('trxid');
  $customerno = $this->post('customerno');
  $tglkunjungan = $this->post('tglkunjungan');
  $userid = $this->post('userid');
  $regionid = $this->post('regionid');
  $salesofficeid = $this->post('salesofficeid');
  $salesgroupid = $this->post('salesgroupid');
  $salesdistrictid = $this->post('salesdistrictid');
  $cycle = $this->post('cycle');
  $week = $this->post('week');
  $year = $this->post('year');

  if ($trx === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'trx null',
      'data' => 'trx Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($trx == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'trx kosong',
      'data' => 'trx Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);


  }else  if ($customerno === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'customer no null',
      'data' => 'customer no Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($customerno ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'customer no kosong',
      'data' => 'customer no Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($tglkunjungan === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan null',
      'data' => 'tgl kunjungan Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($tglkunjungan ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan kosong',
      'data' => 'tgl kunjungan Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($userid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'sales id null',
      'data' => 'sales id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'sales id kosong',
      'data' => 'sales id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else{
    $transac = $this->Model_InjectDB->getTransacIDStock($userid,$customerno,$tglkunjungan);
    if($transac){
      //--- update
      $transacid=$transac[0]['id'];
      $arrstrsql = array();
      $strsql ="Update stock  set customerno ='".$customerno."',stockdate ='".$tglkunjungan."',userid ='".$userid."',regionid ='".$regionid."',salesofficeid ='".$salesofficeid."',salesgroupid ='".$salesgroupid."',salesdistrictid ='".$salesdistrictid."',cycle ='".$cycle."',week ='".$week."',year ='".$year."',updatedby ='".$userid."',updatedon = Now() where id ='".$transacid."';" ;
      $arrstrsql[0]['strsql'] =$strsql;
      $strsql = " delete from stock_detail where stockid ='".$transacid."';";
      $arrstrsql[1]['strsql'] =$strsql;
          // delete sellin_detail
      $result=$this->Model_InjectDB->query_jamak($arrstrsql);
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Update Sukses',
          'data' => $transacid
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Update Error',
          'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }else{
      // -- new
     $dataHead = array(
      'customerno' => $customerno,
      'stockdate' =>$tglkunjungan,
      'userid' =>$userid,
      'regionid' =>$regionid,
      'salesofficeid' =>$salesofficeid,
      'salesgroupid' =>$salesgroupid,
      'salesdistrictid' =>$salesdistrictid,
      'cycle' =>$cycle,
      'week' =>$week,
      'year' =>$year,
      'createdby' =>$userid,
      'createdon' => date('Y-m-d H:i:s')
      );
      $result = $this->Model_InjectDB->insertHeadStock($dataHead);
      if($result){
        $this->response([
        'status' => TRUE,
        'message' =>'Insert Sukses',
        'data' => $result
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
        'status' => FALSE,
        'message' =>'Insert Error',
        'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    if ($trx ==="new"){
          // proses insert return idhead utk update di flutternya
    }else{
      if ($trxid === null){
        $this->response([
        'status' => FALSE,
        'message' =>'trx id null',
        'data' => 'trx id null'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else if (empty($trxid)){
        $this->response([
        'status' => FALSE,
        'message' =>'trx id kosong',
        'data' => 'trx id kosong'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
          //--- proses update
      
      }
    }
  }
}

public function injectStockDetail_post(){
  $stockid = $this->post('trxid');
  $materialid = $this->post('materialid');
  $bal = $this->post('bal');
  $slof = $this->post('slof');
  $pac = $this->post('pac');
  $qty = $this->post('qtystock');
  $userid = $this->post('userid');

  if ($stockid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'stock ID null',
      'data' => 'stock ID Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($stockid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'stock ID kosong',
      'data' => 'stock ID Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($materialid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'material ID kosong',
      'data' => 'material ID Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($materialid === null){
    $this->response([
      'status' => FALSE,
      'message' =>'material ID Null',
      'data' => 'material ID Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($slof ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'slof kosong',
      'data' => 'slof Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($slof === null){
    $this->response([
      'status' => FALSE,
      'message' =>'slof Null',
      'data' => 'slof Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($bal ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'bal kosong',
      'data' => 'bal Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($bal === null){
    $this->response([
      'status' => FALSE,
      'message' =>'bal Null',
      'data' => 'bal Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($qty == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'qty all kosong',
      'data' => 'qty all Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($qty === null){
    $this->response([
      'status' => FALSE,
      'message' =>'qty all Null',
      'data' => 'qty all Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($pac === null){
    $this->response([
      'status' => FALSE,
      'message' =>'pac Null',
      'data' => 'pac Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($pac ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'pac kosong',
      'data' => 'pac Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($userid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'sales id null',
      'data' => 'sales id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'sales id kosong',
      'data' => 'sales id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);

  }else{
   $data = array(
    'stockid' => $stockid,
    'materialid' => $materialid,
    'bal' => $bal,
    'qty' => $qty,
    'slof' =>$slof,
    'pac' =>$pac,
    'createdby' =>$userid,
    'createdon' => date('Y-m-d H:i:s')
  );

   $dataupdate = array(
    'stockid' => $stockid,
    'materialid' => $materialid,
    'bal' => $bal,
    'qty' => $qty,
    'slof' =>$slof,
    'pac' =>$pac,
    'updatedby' =>$userid,
    'updatedon' => date('Y-m-d H:i:s')
  );
   //--- cek data

   $cekdata = $this->Model_InjectDB->cek_Data_Stock_detail($stockid,$materialid);

    if ($cekdata){
        //---update data
        $transacid = $cekdata[0]['id'];
        $this->db->where('id', $transacid);
        $prosesupdate = $this->db->update('stock_detail', $dataupdate);           

        if($prosesupdate){
          $this->response([
            'status' => TRUE,
            'message' =>'Update Sukses',
            'data' => $transacid
          ], REST_Controller::HTTP_OK);
        }else{

          $this->response([
            'status' => FALSE,
            'message' =>'Update Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }

     }else{
        $this->db->delete('stock_detail',array('stockid' => $stockid, 'materialid' => $materialid,));
        $result = $this->Model_InjectDB->insertDetailStock($data);
        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Insert Sukses',
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Insert Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
     }
   
  }
}
  //--- end stock

//========= visibility
public function injectVisibilityHead_post(){
  $trx = $this->post('trx');
  $trxid = $this->post('trxid');
  $customerno = $this->post('customerno');
  $tglkunjungan = $this->post('tglkunjungan');
  $userid = $this->post('userid');
  $regionid = $this->post('regionid');
  $salesofficeid = $this->post('salesofficeid');
  $salesgroupid = $this->post('salesgroupid');
  $salesdistrictid = $this->post('salesdistrictid');
  $cycle = $this->post('cycle');
  $week = $this->post('week');
  $year = $this->post('year');

  if ($trx === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'trx null',
      'data' => 'trx Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($trx == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'trx kosong',
      'data' => 'trx Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);


  }else  if ($customerno === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'customer no null',
      'data' => 'customer no Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($customerno ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'customer no kosong',
      'data' => 'customer no Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($tglkunjungan === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan null',
      'data' => 'tgl kunjungan Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($tglkunjungan ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'tgl kunjungan kosong',
      'data' => 'tgl kunjungan Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($userid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'sales id null',
      'data' => 'sales id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'sales id kosong',
      'data' => 'sales id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else{
    $transac = $this->Model_InjectDB->getTransacIDVisibility($userid,$customerno,$tglkunjungan);
    if($transac){
      //--- update
      $transacid=$transac[0]['id'];
      $arrstrsql = array();
      $strsql ="Update visibility  set customerno ='".$customerno."',visibilitydate ='".$tglkunjungan."',userid ='".$userid."',regionid ='".$regionid."',salesofficeid ='".$salesofficeid."',salesgroupid ='".$salesgroupid."',salesdistrictid ='".$salesdistrictid."',cycle ='".$cycle."',week ='".$week."',year ='".$year."',updatedby ='".$userid."',updatedon = Now() where id ='".$transacid."';" ;
      $arrstrsql[0]['strsql'] =$strsql;
      $strsql = " delete from visibility_detail where visibilityid ='".$transacid."';";
      $arrstrsql[1]['strsql'] =$strsql;
          // delete sellin_detail
      $result=$this->Model_InjectDB->query_jamak($arrstrsql);
      if($result){
        $this->response([
          'status' => TRUE,
          'message' =>'Update Head Sukses',
          'data' => $transacid
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
          'status' => FALSE,
          'message' =>'Update Error',
          'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }else{
      // -- new
     $dataHead = array(
      'customerno' => $customerno,
      'visibilitydate' =>$tglkunjungan,
      'userid' =>$userid,
      'regionid' =>$regionid,
      'salesofficeid' =>$salesofficeid,
      'salesgroupid' =>$salesgroupid,
      'salesdistrictid' =>$salesdistrictid,
      'cycle' =>$cycle,
      'week' =>$week,
      'year' =>$year,
      'createdby' =>$userid,
      'createdon' => date('Y-m-d H:i:s')
      );

      $result = $this->Model_InjectDB->insertHeadVisibility($dataHead);
      if($result){
        $this->response([
        'status' => TRUE,
        'message' =>'Insert Head Sukses',
        'data' => $result
        ], REST_Controller::HTTP_OK);
      }else{
        $this->response([
        'status' => FALSE,
        'message' =>'Insert Error',
        'data' => $result
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
    if ($trx ==="new"){
          // proses insert return idhead utk update di flutternya
    }else{
      if ($trxid === null){
        $this->response([
        'status' => FALSE,
        'message' =>'trx id null',
        'data' => 'trx id null'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else if (empty($trxid)){
        $this->response([
        'status' => FALSE,
        'message' =>'trx id kosong',
        'data' => 'trx id kosong'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }else{
          //--- proses update
      
      }
    }
  }
}

public function injectVisibilityDetail_post(){
  $stockid = $this->post('trxid');
  $materialid = $this->post('materialid');
  $pac = $this->post('pac');
  $userid = $this->post('userid');

  if ($stockid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'stock ID null',
      'data' => 'stock ID Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($stockid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'stock ID kosong',
      'data' => 'stock ID Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($materialid ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'material ID kosong',
      'data' => 'material ID Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($materialid === null){
    $this->response([
      'status' => FALSE,
      'message' =>'material ID Null',
      'data' => 'material ID Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($pac === null){
    $this->response([
      'status' => FALSE,
      'message' =>'pac Null',
      'data' => 'pac Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($pac ==""){
    $this->response([
      'status' => FALSE,
      'message' =>'pac kosong',
      'data' => 'pac Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else  if ($userid === null) {
    $this->response([
      'status' => FALSE,
      'message' =>'sales id null',
      'data' => 'sales id Null'
    ], REST_Controller::HTTP_BAD_REQUEST);
  }else if($userid == ""){
    $this->response([
      'status' => FALSE,
      'message' =>'sales id kosong',
      'data' => 'sales id Kosong'
    ], REST_Controller::HTTP_BAD_REQUEST);

  }else{
   $data = array(
    'visibilityid' => $stockid,
    'materialid' => $materialid,
    'pac' =>$pac,
    'createdby' =>$userid,
    'createdon' => date('Y-m-d H:i:s')
  );

   $dataupdate = array(
    'visibilityid' => $stockid,
    'materialid' => $materialid,
    'pac' =>$pac,
    'updatedby' =>$userid,
    'updatedon' => date('Y-m-d H:i:s')
  );
   $cekdata = $this->Model_InjectDB->cek_Data_Visibility_detail($stockid,$materialid);

     if ($cekdata){
        //---update data
        $transacid = $cekdata[0]['id'];
        $this->db->where('id', $transacid);
        $prosesupdate = $this->db->update('visibility_detail', $dataupdate);           

        if($prosesupdate){
          $this->response([
            'status' => TRUE,
            'message' =>'Update Sukses',
            'data' => $transacid
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Update Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }

     }else{
        $this->db->delete('visibility_detail',array('visibilityid' => $stockid, 'materialid' => $materialid,));
        $result = $this->Model_InjectDB->insertDetailVisibility($data);
        if($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Insert Sukses',
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Insert Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }
     }
    
  }
}
//========= end visibility
// public function injectSelling_post(){
//   $trx = $this->post('trx');
//   $trxid = $this->post('trxid');
//     /// head
//   $nonota = $this->post('nonota');
//   $customerno = $this->post('customerno');
//   $tglkunjungan = $this->post('tglkunjungan');
//   $userid = $this->post('userid');
//   $regionid = $this->post('regionid');
//   $salesofficeid = $this->post('salesofficeid');
//   $salesgroupid = $this->post('salesgroupid');
//   $salesdistrictid = $this->post('salesdistrictid');
//   $amount = $this->post('amountnota');
//   $cycle = $this->post('cycle');
//   $week = $this->post('week');
//   $year = $this->post('year');
//   $detail = $this->post('detail');

//   if ($detail === null) {
//     $this->response([
//       'status' => FALSE,
//       'message' =>'detail null',
//       'data' => 'detail Null'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else if(empty($detail)){
//     $this->response([
//       'status' => FALSE,
//       'message' =>'detail kosong',
//       'data' => 'detail Kosong'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else  if ($trx === null) {
//     $this->response([
//       'status' => FALSE,
//       'message' =>'trx null',
//       'data' => 'trx Null'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else if(empty($trx)){
//     $this->response([
//       'status' => FALSE,
//       'message' =>'trx kosong',
//       'data' => 'trx Kosong'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else  if ($nonota === null) {
//     $this->response([
//       'status' => FALSE,
//       'message' =>'No Nota null',
//       'data' => 'No Nota Null'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else if(empty($nonota)){
//     $this->response([
//       'status' => FALSE,
//       'message' =>'No Nota kosong',
//       'data' => 'No Nota Kosong'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else  if ($customerno === null) {
//     $this->response([
//       'status' => FALSE,
//       'message' =>'customer no null',
//       'data' => 'customer no Null'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else if(empty($customerno)){
//     $this->response([
//       'status' => FALSE,
//       'message' =>'customer no kosong',
//       'data' => 'customer no Kosong'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else  if ($tglkunjungan === null) {
//     $this->response([
//       'status' => FALSE,
//       'message' =>'tgl kunjungan null',
//       'data' => 'tgl kunjungan Null'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else if(empty($tglkunjungan)){
//     $this->response([
//       'status' => FALSE,
//       'message' =>'tgl kunjungan kosong',
//       'data' => 'tgl kunjungan Kosong'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else  if ($userid === null) {
//     $this->response([
//       'status' => FALSE,
//       'message' =>'sales id null',
//       'data' => 'sales id Null'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else if(empty($userid)){
//     $this->response([
//       'status' => FALSE,
//       'message' =>'sales id kosong',
//       'data' => 'sales id Kosong'
//     ], REST_Controller::HTTP_BAD_REQUEST);
//   }else{
//        //$data = json_encode($detail);
//        //print_r($detail);exit;
//     if ($trx ==="new"){
//         // proses insert return idhead utk update di flutternya
//       $result = $this->Model_InjectDB->InsertSelling($nonota,$customerno,$tglkunjungan,$userid,$regionid,$salesofficeid,$salesgroupid,$salesdistrictid,$amount,$cycle,$week,$year,$detail);
//       If($result){
//         $this->response([
//           'status' => TRUE,
//           'message' =>'Insert Sukses',
//           'data' => $result
//         ], REST_Controller::HTTP_OK);
//       }else{
//         $this->response([
//           'status' => FALSE,
//           'message' =>'Insert Error',
//           'data' => $result
//         ], REST_Controller::HTTP_BAD_REQUEST);
//       }
//     }else{
//       if ($trxid === null){
//         $this->response([
//           'status' => FALSE,
//           'message' =>'trx id null',
//           'data' => 'trx id null'
//         ], REST_Controller::HTTP_BAD_REQUEST);
//       }else if (empty($trxid)){
//         $this->response([
//           'status' => FALSE,
//           'message' =>'trx id kosong',
//           'data' => 'trx id kosong'
//         ], REST_Controller::HTTP_BAD_REQUEST);
//       } else{
//           //--- proses update
//       }
//     }
//   }
// }


public function injectVisit_post(){
 $userid = $this->post('userid');
 $customerno = $this->post('customerno');
 $visitdate = $this->post('visitdate');
 $notvisitreason = $this->post('notvisitreason');
 $notbuyreason = $this->post('notbuyreason');
 $regionid = $this->post('regionid');
 $salesofficeid = $this->post('salesofficeid');
 $salesgroupid = $this->post('salesgroupid');
 $salesdistrictid = $this->post('salesdistrictid');
 $cycle = $this->post('cycle');
 $week = $this->post('week');
 $year = $this->post('year');

 if ($userid === null) {
  $this->response([
    'status' => FALSE,
    'message' =>'userid null',
    'data' => 'userid Null'
  ], REST_Controller::HTTP_BAD_REQUEST);
}else if($userid ==""){
  $this->response([
    'status' => FALSE,
    'message' =>'userid kosong',
    'data' => 'userid Kosong'
  ], REST_Controller::HTTP_BAD_REQUEST);
}else if($customerno === null){
  $this->response([
    'status' => FALSE,
    'message' =>'customerno Null',
    'data' => 'customerno Null'
  ], REST_Controller::HTTP_BAD_REQUEST);
}else if($customerno == ""){
  $this->response([
    'status' => FALSE,
    'message' =>'customerno kosong',
    'data' => 'customerno Kosong'
  ], REST_Controller::HTTP_BAD_REQUEST);
}else if($visitdate === null){
  $this->response([
    'status' => FALSE,
    'message' =>'visitdate Null',
    'data' => 'visitdate Null'
  ], REST_Controller::HTTP_BAD_REQUEST);
}else if($visitdate ==""){
  $this->response([
    'status' => FALSE,
    'message' =>'visitdate kosong',
    'data' => 'visitdate Kosong'
  ], REST_Controller::HTTP_BAD_REQUEST);
}else{
  if ($notbuyreason !="-1"){
    $dataupdate = array(
      'userid' => $userid,
      'customerno' => $customerno,
      'visitdate' => $visitdate,
      'notvisitreason' =>$notvisitreason,
      'notbuyreason' =>$notbuyreason,  
      'regionid' =>$regionid,
      'salesofficeid' =>$salesofficeid,
      'salesgroupid' => $salesgroupid,
      'salesdistrictid' => $salesdistrictid,
      'cycle' => $cycle,
      'week' => $week,
      'year' => $year,
      'active' => 0,
      'updatedby' => $userid,
      'updatedon' => date('Y-m-d H:i:s')
    );
  }else{
    $dataupdate = array(
      'userid' => $userid,
      'customerno' => $customerno,
      'visitdate' => $visitdate,
      'notvisitreason' =>$notvisitreason,
      'regionid' =>$regionid,
      'salesofficeid' =>$salesofficeid,
      'salesgroupid' => $salesgroupid,
      'salesdistrictid' => $salesdistrictid,
      'cycle' => $cycle,
      'week' => $week,
      'year' => $year,
      'active' => 0,
      'updatedby' => $userid,
      'updatedon' => date('Y-m-d H:i:s')
    );
  }
//--- cek data
        $cekdata = $this->Model_InjectDB->cek_Data_Visit($userid,$customerno,$visitdate);

     if ($cekdata){
        //---update data
        $transacid = $cekdata[0]['id'];
        $this->db->where('id', $transacid);
        $prosesupdate = $this->db->update('visit', $dataupdate);           

        if($prosesupdate){
          $this->response([
            'status' => TRUE,
            'message' =>'Update Sukses',
            'data' => $transacid
          ], REST_Controller::HTTP_OK);
        }else{

          $this->response([
            'status' => FALSE,
            'message' =>'Update Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }

     }else{
        //-- delete
        $this->db->delete('visit',array('userid' => $userid, 'customerno' => $customerno,'visitdate' => $visitdate,));
        $result = $this->Model_InjectDB->InjectVisit($userid,$customerno,$visitdate,$notvisitreason,$notbuyreason,$regionid,$salesofficeid,$salesgroupid,$salesdistrictid,$cycle,$week,$year);
        If($result){
          $this->response([
            'status' => TRUE,
            'message' =>'Insert Sukses',
            'data' => $result
          ], REST_Controller::HTTP_OK);
        }else{
          $this->response([
            'status' => FALSE,
            'message' =>'Insert Error',
            'data' => '-1'
          ], REST_Controller::HTTP_BAD_REQUEST);
        }    
     }
  
}
}
}