<?php
class Model_customer_wsp extends CI_Model
{
    var $table = 'customer_wsp';
    var $primaryKey = 'id';

	public function getByListCustomer($customernos)
	{
        $this->db->select('cw.id, cw.customerno, cw.startdate, cw.enddate,
            cw.class as wspclass, cw.materialgroupid, cw.wspcode, cw.reason');
        $this->db->from('customer_wsp as cw');
        $this->db->where_in('cw.customerno', $customernos);
        $this->db->where('cw.enddate >= CURDATE()');
        $this->db->where('cw.startdate <= CURDATE()');
        $p = "(cw.active != 2 OR cw.active IS NULL)";
        $this->db->where($p);
		$data = $this->db->get()->result_array();
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