<?php
class Model_stock_detail extends CI_Model
{
    var $table = 'stock_detail';
    var $primaryKey = 'id';

	public function getByHead($stockids)
	{
        $this->db->select('sd.id, sd.stockid, sd.materialid, g.description as materialname,
            sd.bal, sd.slof, sd.pac, sd.qty');
        $this->db->join('material as m', 'sd.materialid = m.id');
        $this->db->join('material_group as g', 'm.materialgroupid = g.id');
        $this->db->from('stock_detail as sd');
        $this->db->where_in('stockid', $stockids);
        $active = "(sd.active != 2 OR sd.active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('sd.id, sd.stockid, sd.materialid, m.name as materialname,
            sd.bal, sd.slof, sd.pac, sd.qty');
        $this->db->join('material as m', 'sd.materialid = m.id');
        $this->db->from('stock_detail as sd');
        $this->db->where('sd.id', $id);
        $active = "(sd.active != 2 OR sd.active IS NULL)";
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

    function cekIsExist($stockid, $materialid){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('stockid', $stockid);
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