<?php
class Model_Person extends CI_Model
{
	public function Get_Person_Like($name = null)
	{
		if ($name === null){
			$this->db->select('id,name,address,phone');
			$this->db->from('tb_person');
			//$this->db->where('name',$name);
			$Data = $this ->db->get()->result_array();
		} else{
			$this->db->select('id,name,address,phone');
			$this->db->from('tb_person');
			$this->db->like('name',$name);
			//$this->db->where('name',$name);
			$Data = $this ->db->get()->result_array();
		}
		return $Data;
	}

	public function Get_Person($iduser)
	{
			$this->db->select('id,name,address,phone');
			$this->db->from('tb_person');
			$this->db->where('id',$iduser);
			$Data = $this ->db->get()->result_array();
		
		return $Data;
	}
}
?>