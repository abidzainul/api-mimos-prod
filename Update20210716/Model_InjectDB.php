<?php
class Model_InjectDB extends CI_Model
{
	public function InjectVisit($userid,$customerno,$visitdate,$notvisitreason,$notbuyreason,$regionid,$salesofficeid,$salesgroupid,$salesdistrictid,$cycle,$week,$year,$ms,$status,$cekin,$cekout)
	{
        if ($notbuyreason !="-1"){
            $data = array(
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
              'createdby' => $userid,
              'createdon' => date('Y-m-d H:i:s'),
              'createdms' =>$ms,
              'status' => $status,
              'checkintime' => $cekin,
              'checkouttime' => $cekout
          );
        }else{
            $data = array(
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
              'createdby' => $userid,
              'createdon' => date('Y-m-d H:i:s'),
              'createdms' =>$ms,
               'status' => $status,
              'checkintime' => $cekin,
              'checkouttime' => $cekout
          );
        }

		//return $this->db->insert('visit', $data);
        if ($this->db->insert('visit', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;

    }
    function insertHeadSelling($data){
        if ($this->db->insert('sellin', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

    function insertDetailSelling($data){
        if ($this->db->insert('sellin_detail', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }
    function insertHeadPosm($data){
        if ($this->db->insert('posm', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

    function insertDetailPosm($data){
        if ($this->db->insert('posm_detail', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

function insertHeadVisibility($data){
        if ($this->db->insert('visibility', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }
     function insertDetailVisibility($data){
        if ($this->db->insert('visibility_detail', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

    function insertVisitpause($data){
        if ($this->db->insert('visit_pause', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

    function insertHeadStock($data){
        if ($this->db->insert('stock', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

    function insertDetailStock($data){
        if ($this->db->insert('stock_detail', $data)){
      //get last insert id
            return $this->db->insert_id();
        }
        return false;
    }

    function getTransacIDSellin($userid,$customerno,$tglkunjungan){
$results = $this->db->query("SELECT id FROM sellin where userid ='".$userid."' and sellindate ='".$tglkunjungan."' and customerno='".$customerno."' ");
                return  $results->result_array();
    }
    function getTransacIDStock($userid,$customerno,$tglkunjungan){
$results = $this->db->query("SELECT id FROM stock where userid ='".$userid."' and stockdate ='".$tglkunjungan."' and customerno='".$customerno."' ");
                return  $results->result_array();
    }

     function getTransacIDVisibility($userid,$customerno,$tglkunjungan){
$results = $this->db->query("SELECT id FROM visibility where userid ='".$userid."' and visibilitydate ='".$tglkunjungan."' and customerno='".$customerno."' ");
                return  $results->result_array();
    }

    function getTransacIDPosm($userid,$customerno,$tglkunjungan){
$results = $this->db->query("SELECT id FROM posm where userid ='".$userid."' and posmdate ='".$tglkunjungan."' and customerno='".$customerno."' ");
                return  $results->result_array();
    }

    function cek_Data_Sellin_detail($sellinid,$materialid){
      $results = $this->db->query("SELECT id FROM sellin_detail where sellinid ='".$sellinid."' and materialid ='".$materialid."' ");
      return  $results->result_array();
    }

    function cek_Data_Posm_detail($posmid,$posmtypeid,$materialgroupid){
      $results = $this->db->query("SELECT id FROM posm_detail where posmid ='".$posmid."' and posmtypeid ='".$posmtypeid."' and materialgroupid ='".$materialgroupid."' ");
      return  $results->result_array();
    }

    function cek_Data_Stock_detail($stockid,$materialid){
      $results = $this->db->query("SELECT id FROM stock_detail where stockid ='".$stockid."' and materialid ='".$materialid."'  ");
      return  $results->result_array();
    }

    function cek_Data_Visibility_detail($stockid,$materialid){
      $results = $this->db->query("SELECT id FROM visibility_detail where visibilityid ='".$stockid."' and materialid ='".$materialid."'  ");
      return  $results->result_array();
    }

function cek_Data_VisitPause($visitid,$starttime){
      $results = $this->db->query("SELECT id FROM visit_pause where visitid ='".$visitid."' and starttime ='".$starttime."'  ");
      return  $results->result_array();
    }

    function cek_Data_Visit($userid,$customerno,$visitdate){
      $results = $this->db->query("SELECT id FROM visit where userid ='".$userid."' and customerno ='".$customerno."'  and visitdate ='".$visitdate."' ");
      return  $results->result_array();
    }
//     public function InsertSelling($nonota,$customerno,$tglkunjungan,$userid,$regionid,$salesofficeid,$salesgroupid,$salesdistrictid,$amount,$cycle,$week,$year,$detail){
//       $arrDetail = $detail;
//       print_r(count($arrDetail));exit;
//       $narrdetail = count($arrDetail);
//       if ($narrdetail > 0 ){
//          $dataHead = array(
//             'sellinno' => $nonota,
//             'customerno' => $customerno,
//             'sellindate' =>$tglkunjungan,
//             'userid' =>$userid,
//             'regionid' =>$regionid,
//             'salesofficeid' =>$salesofficeid,
//             'salesgroupid' =>$salesgroupid,
//             'salesdistrictid' =>$salesdistrictid,
//             'amount' =>$amount,
//             'cycle' =>$cycle,
//             'week' =>$week,
//             'year' =>$year,
//             'createdby' =>$userid,
//             'createdon' => date('Y-m-d H:i:s')
//         );
//          $this->db->trans_start();
//          $idHeader = $this->insertHeadSelling($dataHead);
//          if ($idHeader){

//            for ($i=0; $i<$narrdetail; $i++){
//             $dataDetail = array(
//                 'sellinid' => $idHeader,
//                 'materialid' => $arrDetail[$i]['materialid'],
//                 'bal' => $arrDetail[$i]['bal'],
//                 'slof' => $arrDetail[$i]['slof'],
//                 'pac' =>$arrDetail[$i]['pac'],
//                 'qty' =>$arrDetail[$i]['qtypenjualan'],
//                 'qtyintrodeal' =>$arrDetail[$i]['introdeal'],
//                 'price' =>$arrDetail[$i]['harga'],
//                 'sellinvalue' =>$arrDetail[$i]['sellinvalue'],
//                 'createdby' =>$userid,
//                 'createdon' => date('Y-m-d H:i:s')
//             );
//             $this->db->insert('sellin_detail', $dataDetail);
//         }
//         if ($this->db->trans_status() == TRUE){
//             $getIDHead =$idHeader;
//             $this->db->trans_commit();
//         }else{
//             $getIDHead =0;
//             $this->db->trans_rollback();
//         }

//         return $getIDHead;
//     }else{
//      return false;
//  }
// }else {
//     return false;
// }
// }
// public function InsertSelling1($head,$detail){
//     $arrHead = $head;
//     $nArrHead = count($arrHead);
//     if ($nArrHead > 0 ){
//          // urai array head
//         $sellInNo = $arrHead[0]['nonota'];
//         $customerNo = $arrHead[0]['customerno'];
//         $sellinDate = $arrHead[0]['tglkunjungan'];
//         $userID = $arrHead[0]['userid'];
//         $regionID = $arrHead[0]['regionid'];
//         $salesOfficeID = $arrHead[0]['salesofficeid'];
//         $salesGroupID = $arrHead[0]['salesgroupid'];
//         $salesDistrictID = $arrHead[0]['salesdistrictid'];
//         $amount = $arrHead[0]['amountnota'];
//         $cycle = $arrHead[0]['cycle'];
//         $week = $arrHead[0]['week'];
//         $year = $arrHead[0]['year'];
//         $dataHead = array(
//             'sellinno' => $sellInNo,
//             'customerno' => $customerNo,
//             'sellindate' =>$sellinDate,
//             'userid' =>$userID,
//                 // 'regionid' =>$regionID,
//                 // 'salesofficeid' =>$salesOfficeID,
//                 // 'salesgroupid' =>$salesGroupID,
//                 // 'salesdistrictid' =>$salesDistrictID,
//                 // 'amount' =>$amount,
//                 // 'cycle' =>$cycle,
//                 // 'week' =>$week,
//                 // 'year' =>$year,
//                 // 'createdby' =>$userID,
//             'createdon' => date('Y-m-d H:i:s')
//         );
//         $this->db->trans_start();
//         $idHeader = $this->insertHeadSelling($dataHead);
//         if ($idHeader){
//             // urai array detail
//             $arrDetail = $detail;
//             $nArrDetail = count($arrDetail);
//             if ($nArrDetail > 0){
//                for ($i=0; $i<$nArrDetail; $i++){
//                 $dataDetail = array(
//                     'sellinid' => $idHeader,
//                     'materialid' => $arrDetail[$i]['materialid'],
//                     'bal' => $arrDetail[$i]['bal'],
//                     'slof' => $arrDetail[$i]['slof'],
//                     'pac' =>$arrDetail[$i]['pac'],
//                         // 'qty' =>$arrDetail[$i]['qtypenjualan'],
//                         // 'qtyintrodeal' =>$arrDetail[$i]['introdeal'],
//                         // 'price' =>$arrDetail[$i]['harga'],
//                         // 'sellinvalue' =>$arrDetail[$i]['sellinvalue'],
//                         // 'createdby' =>$userID,
//                     'createdon' => date('Y-m-d H:i:s')
//                 );
//                 $this->db->insert('sellindetailintrodeal', $dataDetail);
//             }
//             if ($this->db->trans_status() == TRUE){
//                 $getIDHead =$idHeader;
//                 $this->db->trans_commit();
//             }else{
//                 $getIDHead =0;
//                 $this->db->trans_rollback();
//             }
//         }
//         return $getIDHead;
//     }else{
//         return false;
//     }
// }else{
//     return false;
// }
// }
    function query_jamak($arrstrsql){
        $total  = count($arrstrsql);
        $this->db->trans_start();
        for ($x=0; $x<$total; $x++){
            $strsql =$arrstrsql[$x]['strsql'];
            $this->db->query($strsql);
        };
        $hasil=$this->db->trans_complete();
        return $hasil;
    }
}