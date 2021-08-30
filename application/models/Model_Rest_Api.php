<?php
class Model_Rest_Api extends CI_Model
{
	public function Get_All_User($email = null)
	{
		if ($email === null){
			//$Data_All =$this->db->get('user_tbl')->result_array();
			$this->db->select('Id_User,Nama_User,Email_User');
			$this->db->from('user_tbl');
			//$this->db->where('Email_User',$email);
			$Data_All = $this ->db->get()->result_array();
		} else{
			$Data_All =$this->db->get_where('User_Tbl',['Email_User'=>$email])->result_array();
		// 		$this->db->select('Id_User,Nama_User');
		// $this->db->from('user_tbl');
		// $this->db->like('Email_User',$email);
		// $Data_All = $this ->db->get()->result_array();
		}
		return $Data_All;
	}

	public function Get_User_By_Email($email)
	{
		$this->db->select('Id_User,Nama_User,Email_User');
		$this->db->from('user_tbl');
		$this->db->where('Email_User',$email);
		$Data = $this ->db->get()->result_array();
		//$Data =$this->db->get_where('User_Tbl',['Email_User'=>$email])->result_array();
		//$Data = $this->db->query("select Id_User,Nama_User from User_Tbl where Email_User='".$email."' ")->result_array();
		return $Data;
	}

	public function Get_User_By_Email_Pass($email,$pass)
	{
		$Data =$this->db->get_where('User_Tbl',['Email_User'=>$email,'Password_User'=>$pass])->result_array();
		return $Data;
	}
	
	public function Delete_user($id)
	{
		$this->db->delete('User_Tbl',['Id_User'=>$id]);
		return $this->db->affected_rows();
	}

	public function Insert_data_user($data)
	{
		$this->db->insert('User_Tbl',$data);
		return $this->db->affected_rows();
	}

	public function Update_User($data,$id)
	{
		$this->db->update('User_Tbl',$data,['Id_User' => $id]);
		return $this->db->affected_rows();
	}
}
?>