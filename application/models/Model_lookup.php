<?php
class Model_lookup extends CI_Model
{
    var $table = 'lookup';
    var $primaryKey = 'id';

	public function getByUser($userid)
	{
        $query = $this->db->query("SELECT DISTINCT
                lookup.id as lookupid,
                lookup.lookupvalue,
                lookup.lookupdesc,
                lookup.lookupkey
            FROM user u
            INNER JOIN posm_default pd ON u.userroleid = pd.userroleid AND u.salesofficeid = pd.salesofficeid
            INNER JOIN lookup ON pd.posmtypeid = lookup.lookupvalue
            WHERE (u.userid = '{$userid}' AND lookup.lookupkey = 'posm_type') 
            OR (lookup.lookupkey='posm_condition') 
            OR (lookup.lookupkey='posm_status')
            OR (lookup.lookupkey = 'not_visit_reason') 
            OR (lookup.lookupkey = 'not_buy_reason') 
            OR (lookup.lookupkey like 'trial%')");
    
        return $query->result_array();
    }


}
?>