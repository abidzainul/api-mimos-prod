<?php
class Model_appversion extends CI_Model
{
    var $table = 'app_version';
    var $primaryKey = 'id';
    
	public function getLastVersionApps()
	{
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by("id", "DESC");
		$data = $this->db->get()->row();
		return $data;
	}
    
	public function getLastVersionAllUser()
	{
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("all_user", "1");
        $this->db->order_by("id", "DESC");
		$data = $this->db->get()->row();
		return $data;
	}
    
	public function getAppReleaseUserByUser($userid, $appversionid)
	{
        $this->db->select('*');
        $this->db->from("app_release_user");
        $this->db->where("userid", "{$userid}");
        $this->db->where("appversionid", "{$appversionid}");
        $this->db->order_by("id", "DESC");
		$data = $this->db->get()->row();
		return $data;
	}
    
	public function getById($id)
	{
        $this->db->select('*');
        $this->db->from("{$this->table} ci");
        $this->db->where("ci.id", $id);
		$data = $this->db->get()->row();
		return $data;
	}
	
    function countAll(){
        $this->db->select('*');
        $this->db->from($this->table);
		$data = $this->db->get()->num_rows();
		return $data;
    }

    function getAll(){
        $this->db->select('*');
        $this->db->from($this->table);
		$data = $this->db->get()->result();
		return $data;
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    public function update($id, $data){
        $this->db->where($this->primaryKey, $id);
        $this->db->update($this->table, $data);
        return $this->getById($id);
    }

    public function delete($id)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->delete($this->table);
    }

    public function delete_flag($id)
    {
        $this->db->set('active', 2); 
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table);
    }

}
?>