<?php
class Model_Customer extends CI_Model
{
	public function getCustomersByVisitDay($userid,$visitday,$visitweek,$tgl)
	{
		// $where = '(cu.visitweek=1 OR cu.visitweek=' . $visitweek . ')';
  //               $this->db->select('cu.customerno,cu.userid,cu.visitday,cu.visitweek,c.name,c.address,c.city,c.owner,c.phone,
  //                       c.customergroupid,cg.name as customergroupname,c.priceid,c.salesdistrictid,d.name as salesdistrictname,d.salesgroupid,g.name as salesgroupname,
  //                       g.salesofficeid,o.name as salesofficename,c.usersfaid,c.userroleid,"'.$tgl.'" as tanggalkunjungan, cu.nourut, o.regionid')
  //               ->from('customer_user as cu')        
  //               ->join('customer as c', 'c.customerno = cu.customerno','left')
  //               ->join('sales_district as d', 'c.salesdistrictid = d.id','left')
  //               ->join('sales_group as g', 'g.id = d.salesgroupid','left')
  //               ->join('sales_office as o', 'o.id = g.salesofficeid','left')
  //               ->join('customer_group as cg', 'cg.id = c.customergroupid','left')
  //               ->where('cu.userid=', $userid)
  //               ->where('cu.visitday=', $visitday)
  //               ->where($where);
  //               $Data = $this ->db->get()->result_array();
  //               return $Data;

    $results = $this->db->query("SELECT  cu.customerno, cu.userid,
                        cu.visitday,
                        cu.visitweek,
                        c.name,
                        c.address,
                        c.city,
                        c.owner,
                        c.phone,
                        c.customergroupid,
                        cg.name as customergroupname,
                        c.priceid,
                        c.salesdistrictid,
                        d.name as salesdistrictname,d.salesgroupid,g.name as salesgroupname,
                        g.salesofficeid,o.name as salesofficename,c.usersfaid,c.userroleid,'".$tgl."' as tanggalkunjungan, cu.nourut, o.regionid,
                        (select distinct CONCAT(year,';',cycle,';',week) as ycw from periode_cycle where startdate <='".$tgl."' and enddate >='".$tgl."' limit 1) as ycw,(SELECT CASE WHEN count(id) =0 THEN '-' ELSE customer_wsp.class END wspclass FROM customer_wsp WHERE customer_wsp.customerno = cu.customerno AND startdate <= '".$tgl."' AND enddate >= '".$tgl."') as wspclass
                        FROM
                        customer_user cu
                        INNER JOIN customer c ON cu.customerno = c.customerno
                        INNER JOIN sales_district d ON c.salesdistrictid = d.id
                        INNER JOIN sales_group g ON d.salesgroupid = g.id
                        INNER JOIN sales_office o ON g.salesofficeid = o.id
                        INNER JOIN customer_group cg ON c.customergroupid = cg.id
                        where cu.userid ='".$userid."' and (cu.visitweek=1 OR cu.visitweek='".$visitweek."') and cu.visitday='".$visitday."'
                        ");
    return  $results->result_array();
  }

  public function getCustomersByVisitDay20201215($userid,$visitday,$visitweek,$tgl)
  {
    $results = $this->db->query("SELECT  cu.customerno, cu.userid, cu.visitday, cu.visitweek,c.name,c.address,c.city,c.owner,c.phone,c.customergroupid,cg.name as customergroupname,c.priceid,c.salesdistrictid,d.name as salesdistrictname,d.salesgroupid,g.name as salesgroupname,g.salesofficeid,o.name as salesofficename,c.usersfaid,c.userroleid,'".$tgl."' as tanggalkunjungan, cu.nourut, o.regionid,(select distinct CONCAT(year,';',cycle,';',week) as ycw from periode_cycle where startdate <='".$tgl."' and enddate >='".$tgl."' limit 1) as ycw,(SELECT CASE WHEN count(customer_wsp.id) =0 THEN '-;-' ELSE CONCAT(customer_wsp.class,';',mg.name) END wspclass FROM customer_wsp INNER JOIN material_group mg on customer_wsp.materialgroupid = mg.id WHERE customer_wsp.customerno = cu.customerno AND startdate <= '".$tgl."' AND enddate >= '".$tgl."') as wspclass FROM customer_user cu INNER JOIN customer c ON cu.customerno = c.customerno INNER JOIN sales_district d ON c.salesdistrictid = d.id INNER JOIN sales_group g ON d.salesgroupid = g.id INNER JOIN sales_office o ON g.salesofficeid = o.id INNER JOIN customer_group cg ON c.customergroupid = cg.id where cu.userid ='".$userid."' and (cu.visitweek=1 OR cu.visitweek='".$visitweek."') and cu.visitday='".$visitday."'
                        ");
    return  $results->result_array();
  }

  public function getCustomersByTglByUserid20210101($userid,$tgl)
  {
    $results = $this->db->query("select rp.customerno, rp.userid, '0' as visitday, rp.week as visitweek ,c.name,c.address,c.city,c.owner,c.phone,c.customergroupid
,cg.name as customergroupname,c.priceid,c.salesdistrictid,d.name as salesdistrictname,d.salesgroupid
,g.name as salesgroupname,g.salesofficeid,o.name as salesofficename,c.usersfaid,c.userroleid,rp.routedate as tanggalkunjungan, rp.nourut, o.regionid
,(select distinct CONCAT(year,';',cycle,';',week) as ycw from periode_cycle where startdate <='".$tgl."' and enddate >='".$tgl."' and periode_cycle .active='0' limit 1) as ycw
,(SELECT CASE WHEN count(customer_wsp.id) =0 THEN '-;-' ELSE CONCAT(customer_wsp.class,';',mg.name) END wspclass FROM customer_wsp INNER JOIN material_group mg on customer_wsp.materialgroupid = mg.id WHERE customer_wsp.customerno = rp.customerno AND startdate <= '".$tgl."' AND enddate >= '".$tgl."' and customer_wsp.active ='0' and mg.active='0') as wspclass
from routeplan rp
INNER JOIN customer c ON rp.customerno = c.customerno
INNER JOIN sales_district d ON c.salesdistrictid = d.id 
INNER JOIN sales_group g ON d.salesgroupid = g.id 
INNER JOIN sales_office o ON g.salesofficeid = o.id 
INNER JOIN customer_group cg ON c.customergroupid = cg.id 
where rp.userid ='".$userid."' and rp.routedate='".$tgl."' and rp.active ='0' and c.active ='0' and d.active ='0' and g.active ='0' and o.active='0' and cg.active ='0' and (c.statusblock = 0 OR (c.statusblock = 1 AND c.blockdate > '".$tgl."'))
                        ");
    return  $results->result_array();
  }

  
  public function getCustomerMaterialIDbyVisitday($userid,$visitday,$visitweek,$tgl){
         $results = $this->db->query("select cu.customerno,material.id as materialid,(SELECT CASE WHEN count(id) =0 THEN '-' ELSE customer_wsp.class END wspclass FROM customer_wsp WHERE customer_wsp.customerno = cu.customerno AND startdate <= '".$tgl."' AND enddate >= '".$tgl."') as wspclass from user  INNER JOIN customer_user  as cu  on cu.userid = user.userid INNER JOIN material_default ON material_default.salesofficeid=user.salesofficeid
Inner Join material on material_default.materialid=material.id inner join material_group on material_group.id = material.materialgroupid where user.userid ='".$userid."' and (cu.visitweek=1 OR cu.visitweek='".$visitweek."') and cu.visitday='".$visitday."' AND material_default.active= '0' order by cu.customerno, material.id 
                        ");
    return  $results->result_array();
  }

  public function getCustomerMaterialIDbyTglbyUserid20210101($userid,$tgl)
  {
    $results = $this->db->query("select rp.customerno,material.id as materialid,(SELECT CASE WHEN count(id) =0 THEN '-' ELSE customer_wsp.class END wspclass FROM customer_wsp WHERE customer_wsp.customerno = rp.customerno AND startdate <= '".$tgl."' AND enddate >= '".$tgl."') as wspclass 
from user  
INNER JOIN routeplan  as rp  on rp.userid = user.userid 
INNER JOIN material_default ON material_default.salesofficeid=user.salesofficeid
Inner Join material on material_default.materialid=material.id 
inner join material_group on material_group.id = material.materialgroupid 
where user.userid ='".$userid."' 
and rp.routedate ='".$tgl."'
AND material_default.active= '0' 
order by rp.customerno, material.id 
                        ");
    return  $results->result_array();
  }
  
  public function getWeekGenapGanjilbyCycle($tgl){
    $this->db->select('week')
            ->from('periode_cycle')
            ->where ('startdate <=',$tgl)
            -> where('enddate >=',$tgl);
            $data=$this->db->get()->result_array();
              if ($data){
                $xWeek = $data[0]['week'];
                // cek apakah ganjil atau genap
                if ($xWeek % 2 == 0){
                  // genap
                  $week = 3;
                }else{
                  // ganjil
                  $week = 2;
                }
              }else{
                $week =0;
              }

    return $week;
  }
}
?>