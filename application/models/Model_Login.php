<?php
class Model_Login extends CI_Model
{
	
	public function Get_User_Login($userid,$pass)
	{
		$strpass = md5($pass);
		// $this->db->select('userid,user.name as username,userroleid,user_role.name as rolename,salesofficeid,salesgroupid,salesdistrictid,regionid');
		// $this->db->from('user');
		// $this->db->join('user_role','user_role.id = user.userroleid','left');
		// $this->db->where('userid',$userid);
		// $this->db->where('password',$strpass);
		// $this->db->where('user.active','0');
		// $Data = $this ->db->get()->result_array();
		// //$Data =$this->db->get_where('User_Tbl',['Email_User'=>$user_id,'Password_User'=>$pass])->result_array();
		// return $Data;

		$results = $this->db->query("SELECT u.userid, u.name as username, u.userroleid, u.regionid, u.salesofficeid,u.salesgroupid,u.salesdistrictid,concat(ur.name,' ',lookupdesc) as rolename,sales_office.type as salesofficetype,lookupdesc as salesofficetypename,sales_office.name as salesofficename FROM user u INNER JOIN user_role ur ON u.userroleid = ur.id INNER JOIN sales_office ON u.salesofficeid = sales_office.id INNER JOIN lookup ON sales_office.type = lookup.lookupvalue and lookupkey='sales_office_type'where u.userid ='".$userid."' and u.password = MD5('".$pass."') and u.active=0 ");
        return  $results->result_array();
	}
}
?>