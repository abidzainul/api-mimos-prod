<?php
class Model_posm_detail extends CI_Model
{
    var $table = 'posm_detail';
    var $primaryKey = 'id';

	public function getByHead($posmids)
	{
        $this->db->select('p.id, p.posmid, p.posmtypeid, p.materialgroupid, 
            p.status, p.qty, p.condition, p.notes,
            mg.name as materialgroupname, mg.description as materialgroupdesc');
        $this->db->join('material_group as mg', 'p.materialgroupid = mg.id');
        // $this->db->join('lookup as l', 'p.posmtypeid = l.id');
        $this->db->from('posm_detail as p');
        $this->db->where_in('posmid', $posmids);
        $p = "(p.active != 2 OR p.active IS NULL)";
        $this->db->where($p);
        $mg = "(mg.active != 2 OR mg.active IS NULL)";
        $this->db->where($mg);
        // $l = "(l.active != 2 OR l.active IS NULL)";
        // $this->db->where($l);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('p.id, p.posmid, p.posmtypeid, p.materialgroupid, 
            p.status, p.qty, p.condition, p.notes,
            mg.name as materialgroupname, mg.description as materialgroupdesc');
        $this->db->join('material_group as mg', 'p.materialgroupid = mg.id');
        // $this->db->join('lookup as l', 'p.posmtypeid = l.id');
        $this->db->from('posm_detail as p');
        $this->db->where('p.id', $id);
        $p = "(p.active != 2 OR p.active IS NULL)";
        $this->db->where($p);
        $mg = "(mg.active != 2 OR mg.active IS NULL)";
        $this->db->where($mg);
        // $l = "(l.active != 2 OR l.active IS NULL)";
        // $this->db->where($l);
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

    function cekIsExist($posmid, $posmtypeid, $materialgroupid){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('posmid', $posmid);
        $this->db->where('posmtypeid', $posmtypeid);
        $this->db->where('materialgroupid', $materialgroupid);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
        $this->db->order_by('id', 'DESC');
        $this->db->order_by('createdon', 'DESC');
		$data = $this->db->get()->row();
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