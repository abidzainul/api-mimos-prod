<?php
class Model_Frontliner extends CI_Model
{
	public function getLookup()
	{
		
        $query = $this->db->query("SELECT
		distinct
		id as lookupid,
		lookupvalue,
		lookupdesc,
		lookupkey
		FROM
		lookup
		where lookupkey in ('trial_type','trial_knowing','trial_taste','trial_packaging')
		");
		
		return $query->result_array();      
	}
	
	public function getBrandCompetitor($salesofficeid)
	{
		
        $query = $this->db->query("SELECT sob.id as sobid,so.id as soid, mg.id as materialgroup, cb.name as competitorbrand
		from sob sob
		LEFT JOIN competitor_brand cb on cb.id = sob.competitorbrandid
		LEFT JOIN material_group mg on mg.id = sob.materialgroupid
		LEFT JOIN sales_office so on  so.id = sob.salesofficeid
		where sob.active=0
		and so.id='".$salesofficeid."'
		");
		
		return $query->result_array();      
	}

}