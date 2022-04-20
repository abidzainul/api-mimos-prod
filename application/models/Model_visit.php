<?php
class Model_visit extends CI_Model
{
    var $table = 'visit';
    var $primaryKey = 'id';

	public function getByDate($userid, $date)
	{
        $this->db->select('id, userid, customerno, visitdate, 
            notvisitreason, notbuyreason, checkintime, checkouttime,
            regionid, salesofficeid, salesgroupid, salesdistrictid, photo,
            cycle, week, year');
        $this->db->from($this->table);
        $this->db->where('visitdate', $date);
        $this->db->where('userid', $userid);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('id, userid, customerno, visitdate, 
            notvisitreason, notbuyreason, checkintime, checkouttime,
            regionid, salesofficeid, salesgroupid, salesdistrictid, photo,
            cycle, week, year');
        $this->db->from($this->table);
        $this->db->where($this->primaryKey, $id);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
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

    function cekIsExist($userid, $customerno, $visitdate){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('userid', $userid);
        $this->db->where('customerno', $customerno);
        $this->db->where('visitdate', $visitdate);
        $this->db->order_by('id', 'DESC');
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
