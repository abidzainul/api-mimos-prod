<?php
class Model_visibility_detail extends CI_Model
{
    var $table = 'visibility_detail';
    var $primaryKey = 'id';

	public function getByHead($visibilityids)
	{
        $this->db->select('vd.id, vd.visibilityid, vd.materialid, g.description as materialname, vd.pac');
        $this->db->join('material as m', 'vd.materialid = m.id');
        $this->db->join('material_group as g', 'm.materialgroupid = g.id');
        $this->db->from('visibility_detail as vd');
        $this->db->where_in('visibilityid', $visibilityids);
        $active = "(vd.active != 2 OR vd.active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('vd.id, vd.visibilityid, vd.materialid, m.name as materialname, vd.pac');
        $this->db->join('material as m', 'vd.materialid = m.id');
        $this->db->from('visibility_detail as vd');
        $this->db->where('vd.id', $id);
        $active = "(vd.active != 2 OR vd.active IS NULL)";
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

    function cekIsExist($visibilityid, $materialid){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('visibilityid', $visibilityid);
        $this->db->where('materialid', $materialid);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
        $this->db->order_by('createdon', 'DESC');
		$data = $this->db->get()->row();
        return $data;
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