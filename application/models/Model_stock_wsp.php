<?php
class Model_stock_wsp extends CI_Model
{
    var $table = 'stock_wsp';
    var $primaryKey = 'id';

	public function getBySalesOffice($salesoffice)
	{
        $this->db->select('sw.id, sw.salesofficeid, sw.materialgroupidwsp, 
            sw.wspclass, sw.materialgroupid, g.name as materialgroupname, g.description as materialgroupdesc,
            sw.pac, sw.startdate, sw.enddate');
        $this->db->join('material_group as g', 'sw.materialgroupid = g.id');
        $this->db->from('stock_wsp as sw');
        $this->db->where('sw.salesofficeid', $salesoffice);
        $this->db->where('sw.enddate >= CURDATE()');
        $this->db->where('sw.startdate <= CURDATE()');
        $active = "(sw.active != 2 OR sw.active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('sw.id, sw.salesofficeid, sw.materialgroupidwsp, 
        sw.wspclass, sw.materialgroupid, g.name as materialgroupname, g.description as materialgroupdesc,
            sw.pac, sw.startdate, sw.enddate');
            $this->db->join('material_group as g', 'sw.materialgroupid = g.id');
        $this->db->from('stock_wsp as sw');
        $this->db->where('sw.id', $id);
        $active = "(sw.active != 2 OR sw.active IS NULL)";
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