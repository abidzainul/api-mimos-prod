<?php
class Model_master_data extends CI_Model
{

	public function getLookupByUser($userid)
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

	public function getBrandCompetitor($salesofficeid)
	{
        $query = $this->db->query("SELECT 
                sob.id as id, cb.id as competitorbrandid, 
                mg.id as materialgroupid, mg.name as materialgroup, 
                cb.name as competitorbrandname
            FROM sob
            LEFT JOIN competitor_brand cb on cb.id = sob.competitorbrandid
            LEFT JOIN material_group mg on mg.id = sob.materialgroupid
            LEFT JOIN sales_office so on  so.id = sob.salesofficeid
            WHERE sob.active=0
            AND so.id = {$salesofficeid}
            ORDER BY competitorbrandname");
    
        return $query->result_array();
    }

}
?>