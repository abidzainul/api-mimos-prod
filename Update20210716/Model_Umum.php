<?php
class Model_Umum extends CI_Model
{
	public function getLookup($userid)
	{
		//$this->db->select('id as lookupid,lookupkey,lookupvalue,lookupdesc')
        //    ->from('lookup');
       // $data=$this->db->get()->result_array();
 //Return $data;
        $query = $this->db->query("SELECT
distinct
lookup.id as lookupid,
lookup.lookupvalue,
lookup.lookupdesc,
lookup.lookupkey,
posm_default.posmroleid
FROM
user
INNER JOIN posm_default ON user.userroleid = posm_default.userroleid AND user.salesofficeid = posm_default.salesofficeid
INNER JOIN lookup ON posm_default.posmtypeid = lookup.lookupvalue
WHERE
user.userid = '".$userid."' and lookup.lookupkey='posm_type' and user.active='0' and posm_default.active='0' and lookup.active='0' union
select lookup.id as lookupid,
lookup.lookupvalue,
lookup.lookupdesc,
lookup.lookupkey,
'0' as posmroleid
 from lookup where lookup.lookupkey in('posm_condition','posm_status' ,'not_visit_reason' ,'not_buy_reason') and lookup.active='0'

");
  return $query->result_array();

       
	}

	public function getLookupMax($userid)
	{
		
     $query = $this->db->query("SELECT distinct
posm_max.posmtypeid,
posm_max.materialgroupid,
posm_max.qtymax
FROM
user
INNER JOIN posm_max ON user.salesofficeid = posm_max.salesofficeid AND user.userroleid = posm_max.userroleid where user.userid='".$userid."' and user.active='0' and posm_max.active='0'
");
  return $query->result_array();
	}
}