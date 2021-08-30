<?php
class Model_introdeal extends CI_Model
{
    var $table = 'introdeal';
    var $primaryKey = 'id';

	public function getBySalesOffice($salesofficeid)
	{
        $this->db->select('i.id, i.salesofficeid, i.materialid, i.qtyorder, i.qtybonus, 
            i.startdate, i.enddate, m.name as materialname, m.materialgroupid');
        $this->db->from("{$this->table} as i");
		$this->db->join('material as m','m.id = i.materialid');
        $i = "(i.active != 2 OR i.active IS NULL)";
        $this->db->where($i);
        $this->db->where('i.salesofficeid', $salesofficeid);
        $this->db->where('i.enddate >= CURDATE()');
        $this->db->where('i.startdate <= CURDATE()');
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('i.id, i.salesofficeid, i.materialid, i.qtyorder, i.qtybonus, 
            i.startdate, i.enddate, m.name as materialname, m.materialgroupid');
        $this->db->from("{$this->table} as i");
		$this->db->join('material as m','m.id = i.materialid');
        $i = "(i.active != 2 OR i.active IS NULL)";
        $this->db->where($i);
        $this->db->where('i.salesofficeid', $salesofficeid);
        $this->db->where('i.enddate >= CURDATE()');
        $this->db->where('i.startdate <= CURDATE()');
        $this->db->where($this->primaryKey, $id);
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