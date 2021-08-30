<?php
class Model_introdeal_cust extends CI_Model
{
    var $table = 'customer_introdeal';
    var $primaryKey = 'id';

	public function getByUser($userid)
	{
        $this->db->select('ci.id, ci.customerno, ci.introdealid, ci.materialid, ci.sellindetailid, i.startdate, i.enddate');
        $this->db->from("{$this->table} ci");
		$this->db->join('introdeal i','ci.introdealid = i.id');
        $this->db->where("ci.customerno IN", "(SELECT customerno FROM customer_user where userid = '{$userid}')", false);
        $this->db->where('i.enddate >= CURDATE()');
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('ci.id, ci.customerno, ci.introdealid, ci.materialid, ci.sellindetailid, i.startdate, i.enddate');
        $this->db->from("{$this->table} ci");
		$this->db->join('introdeal i','ci.introdealid = i.id');
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