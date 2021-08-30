<?php
class Model_User extends CI_Model
{
	public function Get_User_By_UserID($userid)
	{
		$this->db->select('userid,user.name as username,userroleid,user_role.name as rolename,salesofficeid,salesgroupid,salesdistrictid,regionid');
		$this->db->from('user');
		$this->db->join('user_role','user_role.id = user.userroleid','left');
		$this->db->where('userid',$userid);
		$this->db->where('user.active','0');
		$Data = $this ->db->get()->result_array();
		//$Data =$this->db->get_where('User_Tbl',['Email_User'=>$email])->result_array();
		//$Data = $this->db->query("select Id_User,Nama_User from User_Tbl where Email_User='".$email."' ")->result_array();
		return $Data;
	}

	public function Get_All_User()
	{
		$this->db->select('userid,user.name as username,userroleid,user_role.name as rolename,salesofficeid,salesgroupid,salesdistrictid,regionid');
		$this->db->from('user');
		$this->db->join('user_role','user_role.id = user.userroleid','left');
		//$this->db->where('userid',$userid);
		$this->db->where('user.active','0');
		$Data = $this ->db->get()->result_array();
		//$Data =$this->db->get_where('User_Tbl',['Email_User'=>$email])->result_array();
		//$Data = $this->db->query("select Id_User,Nama_User from User_Tbl where Email_User='".$email."' ")->result_array();
		return $Data;
	}
	
}
?>