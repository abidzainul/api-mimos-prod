<?php
class Model_sellin extends CI_Model
{
    var $table = 'sellin';
    var $primaryKey = 'id';

	public function getByDate($userid, $date)
	{
        $this->db->select('id, sellinno, userid, customerno, sellindate, 
            regionid, salesofficeid, salesgroupid, salesdistrictid, 
            amount, notes,
            cycle, week, year');
        $this->db->from($this->table);
        $this->db->where('sellindate', $date);
        $this->db->where('userid', $userid);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('id, sellinno, userid, customerno, sellindate, 
            regionid, salesofficeid, salesgroupid, salesdistrictid, 
            amount, notes,
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

    function countExist($userid, $customerno, $sellindate){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('userid', $userid);
        $this->db->where('customerno', $customerno);
        $this->db->where('sellindate', $sellindate);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
        $this->db->order_by('createdon', 'DESC');
		$data = $this->db->get()->num_rows();
        return $data;
    }

    function cekIsExist($userid, $customerno, $sellindate){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('userid', $userid);
        $this->db->where('customerno', $customerno);
        $this->db->where('sellindate', $sellindate);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->row();
        return $data;
    }

    function getExist($userid, $customerno, $sellindate, $sellinno){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('userid', $userid);
        $this->db->where('customerno', $customerno);
        $this->db->where('sellindate', $sellindate);
        $this->db->where('sellinno', $sellinno);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
        $this->db->order_by('createdon', 'DESC');
		$data = $this->db->get()->row();
        return $data;
    }

    function deleteFlagBy($userid, $customerno, $sellindate){
		if($userid==null){
			return false;
		}
		if($customerno==null){
			return false;
		}
		if($sellindate==null){
			return false;
		}
		$query = "
			UPDATE sellin s
			LEFT JOIN sellin_detail sd ON s.id = sd.sellinid
			SET s.active = 2
			WHERE s.userid = '${userid}'
			AND s.customerno = '${customerno}'
			AND s.sellindate = '${sellindate}'
			AND sd.sellinid IS NULL
		";

		$res = $this->db->query($query);
		if($res){
			return $res;
		}
		return false;
    }

    public function insert($data){
        if ($this->db->insert($this->table, $data)){
            return $this->db->insert_id();
        }
        return false;
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
