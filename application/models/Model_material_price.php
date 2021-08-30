<?php
class Model_material_price extends CI_Model
{
    var $table = 'material';
    var $primaryKey = 'id';

	public function getBySalesOffice($salesofficeid)
	{
        $this->db->select('p.id, m.name as materialname, m.materialgroupid, m.bal, m.slof, m.pac, m.year,
            p.materialid, p.priceid, p.value as price, p.validfrom, p.validto,
            g.name as materialgroupname, g.description as materialgroupdesc,
            md.salesofficeid');
        $this->db->from("{$this->table} as m");
		$this->db->join('material_price as p','m.id = p.materialid');
		$this->db->join('material_group as g','m.materialgroupid = g.id');
		$this->db->join('material_default as md','m.id = md.materialid');
        $m = "(m.active != 2 OR m.active IS NULL)";
        $this->db->where($m);
        $p = "(p.active != 2 OR p.active IS NULL)";
        $this->db->where($p);
        $g = "(g.active != 2 OR g.active IS NULL)";
        $this->db->where($g);
        $md = "(md.active != 2 OR md.active IS NULL)";
        $this->db->where($md);
        $this->db->where('md.salesofficeid', $salesofficeid);
        $this->db->where('p.validto >= CURDATE()');
        $this->db->where('p.validfrom <= CURDATE()');
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('p.id, m.name as materialname, m.materialgroupid, m.bal, m.slof, m.pac, m.year,
            p.materialid, p.priceid, p.value as price, p.validfrom, p.validto,
            g.name as materialgroupname, g.description as materialgroupdesc,
            md.salesofficeid');
        $this->db->from("{$this->table} as m");
		$this->db->join('material_price as p','m.id = p.materialid');
		$this->db->join('material_group as g','m.materialgroupid = g.id');
		$this->db->join('material_default as md','m.id = md.materialid');
        $m = "(m.active != 2 OR m.active IS NULL)";
        $this->db->where($m);
        $p = "(p.active != 2 OR p.active IS NULL)";
        $this->db->where($p);
        $g = "(g.active != 2 OR g.active IS NULL)";
        $this->db->where($g);
        $md = "(md.active != 2 OR md.active IS NULL)";
        $this->db->where($md);
        $this->db->where('p.validto >= CURDATE()');
        $this->db->where('p.validfrom <= CURDATE()');
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