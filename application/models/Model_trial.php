<?php
class Model_trial extends CI_Model
{
    var $table = 'trial';
    var $primaryKey = 'id';

	public function getByDate($userid, $date)
	{
        $this->db->select('trial.id, userid, trialdate, trialtype, location, trial.name, phone,
        age, materialid, m.name as materialname, qty, price, amount, competitorbrandid, cb.name as competitorbrandname,
        knowing, taste, packaging, outletname, outletaddress, notes');
        $this->db->from($this->table);
        $this->db->join('material as m', 'materialid = m.id');
        $this->db->join('competitor_brand as cb', 'competitorbrandid = cb.id');
        $this->db->where('trial.trialdate', $date);
        $this->db->where('trial.userid', $userid);
        $active = "(trial.active != 2 OR trial.active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('trial.id, userid, trialdate, trialtype, location, trial.name, phone,
        age, materialid, m.name as materialname, qty, price, amount, competitorbrandid, cb.name as competitorbrandname,
        knowing, taste, packaging, outletname, outletaddress, notes');
        $this->db->from($this->table);
        $this->db->join('material as m', 'materialid = m.id');
        $this->db->join('competitor_brand as cb', 'competitorbrandid = cb.id');
        $this->db->where('trial.id', $id);
        $active = "(trial.active != 2 OR trial.active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->row();
		return $data;
	}

	public function getExist($userid, $trialdate, $trialtype, $materialid, $competitorbrandid, $name)
	{
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('userid', $userid);
        $this->db->where('trialdate', $trialdate);
        $this->db->where('trialtype', $trialtype);
        $this->db->where('materialid', $materialid);
        $this->db->where('competitorbrandid', $competitorbrandid);
        $this->db->where('name', $name);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
        $this->db->order_by('createdon', 'DESC');
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