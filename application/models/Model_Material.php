<?php
class Model_Material extends CI_Model
{
	public function getMaterialTFbySalesoffice($salesofficeid)
	{
		$this->db->select('material_default.materialid,material.name as materialname,material.materialgroupid,material.bal,material.slof,material.pac,material_group.description as materialgroupdescription')
		->from('material_default')
		->join('material','material_default.materialid=material.id')
		->join('material_group','material_group.id = material.materialgroupid')
		->where('material_default.salesofficeid =',$salesofficeid)
		->where('material_default.active=', '0');
		$Data = $this ->db->get()->result_array();
		return $Data;

	}

	public function getMaterialTFbyUserID($userid){
		// $this->db->select('DISTINCT(material_default.materialid),material.name as materialname,material.materialgroupid,material.bal,material.slof,material.pac,material_group.description as materialgroupdescription')
		// ->from('user')
		// ->join('material_default','material_default.salesofficeid=user.salesofficeid')
		// ->join('material','material_default.materialid=material.id')
		// ->join('material_group','material_group.id = material.materialgroupid')
		// ->where('user.userid =',$userid)
		// ->where('material_default.active=', '0')
		// ->group_by('material_default.materialid');
		// $Data = $this ->db->get()->result_array();
		// return $Data;
		$results = $this->db->query(" SELECT distinct
material_default.materialid,
material.name as materialname,
material.materialgroupid,
material.bal,
material.slof,
material.pac,
material_group.description as materialgroupdescription
FROM
user
INNER JOIN material_default ON user.salesofficeid = material_default.salesofficeid
INNER JOIN material ON material_default.materialid = material.id
INNER JOIN material_group ON material_group.id = material.materialgroupid
where user.userid='".$userid."' and material_default.active='0' and material.active ='0' and material_group.active='0' and user.active='0' ");
		return  $results->result_array();
	}

	public function getMaterialGroup(){
		$results = $this->db->query(" select id as materialgroupid,name as materialgroupname,description as materialgroupdescription from  material_group where active = '0'  ");
		return  $results->result_array();
	}
	//--- sudah tidak digunakan lagi 20200803
	public function getWSPClassbyUserID($userid){
		$results = $this->db->query("SELECT distinct visibility_wsp.wspclass, visibility_wsp.pac,visibility_wsp.materialgroupid,material.id as materialid FROM user INNER JOIN visibility_wsp ON user.salesofficeid = visibility_wsp.salesofficeid INNER JOIN material ON visibility_wsp.materialgroupid = material.materialgroupid where userid='".$userid."'");
		return  $results->result_array();
	}
//-----
	public function getWSPClassStockbyUserID($userid,$visitweek,$visitday,$tgl){
		$results = $this->db->query("select '".$tgl."' as tglkunjungan,cu.customerno,cwsp.class as wspclass,swsp.materialgroupid, swsp.pac,material.id as materialid from user  
INNER JOIN customer_user  as cu  on cu.userid = user.userid
INNER JOIN customer_wsp cwsp on cwsp.customerno = cu.customerno 
INNER JOIN stock_wsp swsp on swsp.materialgroupidwsp = cwsp.materialgroupid  and swsp.wspclass = cwsp.class
INNER JOIN material ON swsp.materialgroupid = material.materialgroupid
where user.userid ='".$userid."' and (cu.visitweek=1 OR cu.visitweek='".$visitweek."') and cu.visitday='".$visitday."' AND cwsp.startdate <= '".$tgl."' AND cwsp.enddate >= '".$tgl."' AND swsp.startdate <= '".$tgl."' AND swsp.enddate >= '".$tgl."'");
		return  $results->result_array();
	}
	public function getWSPClassStockbyUserIDbytgl20210101($userid,$tgl){
		$results = $this->db->query("select rp.routedate as tglkunjungan,rp.customerno,cwsp.class as wspclass,swsp.materialgroupid, swsp.pac,material.id as materialid from user  
INNER JOIN routeplan  as rp  on rp.userid = user.userid
INNER JOIN customer_wsp cwsp on cwsp.customerno = rp.customerno 
INNER JOIN stock_wsp swsp on swsp.materialgroupidwsp = cwsp.materialgroupid  and swsp.wspclass = cwsp.class and swsp.salesofficeid = user.salesofficeid
INNER JOIN material ON swsp.materialgroupid = material.materialgroupid
INNER JOIN material_default md on md.materialid = material.id  and md.salesofficeid = user.salesofficeid
where user.userid ='".$userid."' 
and rp.routedate ='".$tgl."'
AND cwsp.startdate <= '".$tgl."' AND cwsp.enddate >= '".$tgl."' AND swsp.startdate <= '".$tgl."' AND swsp.enddate >= '".$tgl."' and user.active ='0' and rp.active='0' and cwsp.active ='0' and swsp.active='0' and material.active='0' and md.active='0'");
		return  $results->result_array();
	}
	public function getPriceMaterialTFbyUserIDbyTgl($userid,$tglakhir,$tglawal){
		// $this->db->select('material_price.materialid,material.name as materialname,material_price.priceid,material_price.value as harga,material_price.validfrom as tglmulaiberlaku,DATE_FORMAT(material_price.validfrom, "%Y%m%d") as since')
		// ->from('user')
		// ->join('material_default','material_default.salesofficeid=user.salesofficeid')
		// ->join('material','material_default.materialid=material.id')
		// ->join('material_group','material_group.id = material.materialgroupid')
		// ->join('material_price','material_price.materialid = material.id')
		// ->where('user.userid =',$userid)
		// ->where('material_price.validfrom <=',$tglakhir)
		// ->where('year(material_price.validfrom) >=',$tglawal)
		// ->where('material_price.active=', '0');
		// $Data = $this ->db->get()->result_array();
		// return $Data;

		$results = $this->db->query(" select material_price.materialid,material.name as materialname,material_price.priceid,material_price.value as harga,material_price.validfrom as tglmulaiberlaku,DATE_FORMAT(material_price.validfrom, '%Y%m%d') as since from  user INNER JOIN material_default ON user.salesofficeid = material_default.salesofficeid  INNER JOIN material ON material_default.materialid = material.id INNER JOIN material_group ON material_group.id = material.materialgroupid INNER JOIN material_price ON material_price.materialid = material.id where material_price.active = '0' and material_default.active='0' and user.userid ='".$userid."' and material_price.validfrom <='".$tglakhir."' and material_price.validto >= '".$tglawal."' and material_price.priceid ='Z2' and user.active='0' and material_default.active='0' and material.active='0' and material_group.active='0' ");
		return  $results->result_array();

	}
	public function getCustomerIntrodealbyUserbyTglawalbyTglakhir($userid,$tglawal,$tglakhir){
		$results = $this->db->query(" SELECT customer_introdeal.customerno,
			customer_introdeal.introdealid,
			customer_introdeal.materialid
			FROM
			user
			INNER JOIN material_default ON user.salesofficeid = material_default.salesofficeid
			INNER JOIN material ON material_default.materialid = material.id
			INNER JOIN introdeal ON introdeal.materialid = material.id
			INNER JOIN customer_introdeal ON customer_introdeal.introdealid = introdeal.id
			where user.userid ='".$userid."' and introdeal.active = 0 and introdeal.startdate <='".$tglakhir."' and  introdeal.enddate >='".$tglawal."' and user.active ='0' and material_default.active ='0' and material.active ='0'  and customer_introdeal.active='0'");
		return  $results->result_array();
	}
	public function getIntroDealTFbyUserIDbyTglawalbyTglakhir($userid,$tglawal,$tglakhir){
		// $this->db->select('introdeal.materialid,material.name as materialname,introdeal.qtyorder,introdeal.qtybonus,introdeal.startdate as tglmulaiberlaku, DATE_FORMAT(introdeal.startdate, "%Y%m%d") as since')
		// ->from('user')
		// ->join('material_default','material_default.salesofficeid=user.salesofficeid')
		// ->join('material','material_default.materialid=material.id')
		// //->join('material_group','material_group.id = material.materialgroupid')
		// ->join('introdeal','introdeal.materialid = material.id')
		// ->where('user.userid =',$userid)
		// ->where('introdeal.startdate <=',$tglakhir)
		// ->where('introdeal.active=', '0');
		// $Data = $this ->db->get()->result_array();
		//return $Data;
		$results = $this->db->query(" SELECT distinct introdeal.materialid,material.name as materialname,introdeal.qtyorder,introdeal.qtybonus,introdeal.startdate as tglmulaiberlaku, DATE_FORMAT(introdeal.startdate, '%Y%m%d') as since,DATE_FORMAT(introdeal.enddate, '%Y%m%d') as expired,introdeal.enddate as tglakhirberlaku, introdeal.id as introdealid
			FROM
			user
			INNER JOIN material_default ON user.salesofficeid = material_default.salesofficeid
			INNER JOIN material ON material_default.materialid = material.id
			INNER JOIN introdeal ON introdeal.materialid = material.id
			where user.userid ='".$userid."' and introdeal.active = 0 and introdeal.startdate <='".$tglakhir."' and  introdeal.enddate >='".$tglawal."' and user.active ='0' and material_default.active='0' and material.active ='0' ");
		return  $results->result_array();

		
	}
	public function getMaterialFL($salesofficeid,$datenow){
		
		$results = $this->db->query("
		Select md.materialid,m.name as materialname,m.materialgroupid,
		mg.description as materialgroupdescription,p.priceid,p.`value` as price
		From material_default md
		JOIN material m on md.materialid=m.id
		join material_group mg on mg.id = m.materialgroupid
		join material_price p on m.id=p.materialid
		where md.salesofficeid='".$salesofficeid."'
		and md.active=0
		and p.validfrom<='".$datenow."' 
		and p.validto>= '".$datenow."'
		and p.active=0
		and p.priceid='Z5' and m.active='0'");
		return  $results->result_array();

		
	}
}