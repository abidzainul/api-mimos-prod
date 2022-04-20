<?php
class Model_sellin_detail extends CI_Model
{
    var $table = 'sellin_detail';
    var $primaryKey = 'id';

	public function getByHead($sellinids, $userid)
	{
        $this->db->select('sd.id, sd.sellinid, sd.materialid, g.description as materialname,
            sd.bal, sd.slof, sd.pac, sd.qty, sd.qtyintrodeal, sd.price, sd.sellinvalue');
        $this->db->join('material as m', 'sd.materialid = m.id');
        $this->db->join('material_group as g', 'm.materialgroupid = g.id');
        $this->db->from('sellin_detail as sd');
        $this->db->where_in('sd.sellinid', $sellinids);
        $this->db->where('sd.createdby', $userid);
        $active = "(sd.active != 2 OR sd.active IS NULL)";
        $this->db->where($active);
		$data = $this->db->get()->result_array();
		return $data;
    }
    
	public function getById($id)
	{
        $this->db->select('sd.id, sd.sellinid, sd.materialid, m.name as materialname,
            sd.bal, sd.slof, sd.pac, sd.qty, sd.qtyintrodeal, sd.price, sd.sellinvalue');
        $this->db->join('material as m', 'sd.materialid = m.id');
        $this->db->from('sellin_detail as sd');
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

    function cekIsExist($sellinid, $materialid, $userid){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('sellinid', $sellinid);
        $this->db->where('materialid', $materialid);
        $this->db->where('createdby', $userid);
        $active = "(active != 2 OR active IS NULL)";
        $this->db->where($active);
        $this->db->order_by('createdon', 'DESC');
		$data = $this->db->get()->row();
        return $data;
    }

    function getExist($sellinid, $materialid, $userid){
        $this->db->select('sd.id, sd.sellinid, sd.materialid, g.description as materialname,
            sd.bal, sd.slof, sd.pac, sd.qty, sd.qtyintrodeal, sd.price, sd.sellinvalue');
        $this->db->from('sellin_detail as sd');
        $this->db->join('material as m', 'sd.materialid = m.id');
        $this->db->join('material_group as g', 'm.materialgroupid = g.id');
        $this->db->where('sd.sellinid', $sellinid);
        $this->db->where('sd.materialid', $materialid);
        $this->db->where('sd.createdby', $userid);
        $this->db->where('sd.active', '0');
        $this->db->order_by('sd.createdon', 'DESC');
		$data = $this->db->get()->row();
        return $data;
    }
	
	public function insertBatch($userid, $arr){
			
		$res = array();
		foreach($arr as $row){
			$data['sellinid'] = $row['sellinid'];
			$data['materialid'] = $row['materialid'];
			$data['bal'] = $row['bal'];
			$data['slof'] = $row['slof'];
			$data['pac'] = $row['pac'];
			$data['qty'] = $row['qty'];
			$data['qtyintrodeal'] = $row['qtyintrodeal'];
			$data['price'] = $row['price'];
			$data['sellinvalue'] = $row['sellinvalue'];
			$data['createdby'] = $userid;
			$data['createdon'] = date('Y-m-d H:i:s');
			
			$sellinid = $row['sellinid'];
			$materialid = $row['materialid'];
			
			// CEK DATA EXIST
			$cek = "
				SELECT *
				FROM sellin_detail
				WHERE sellinid = '$sellinid'
				AND materialid = '$materialid'
				AND createdby = '$userid'
				AND active = 0
			";
			
			$exist = $this->db->query($cek)->result_array();
			if(count($exist) == 0){
				array_push($res, $data);
			}
			
		}
		
		$status = true;
		if(count($res) > 0){
			// $status = $this->db->insert_batch('sellin_detail', $res);
			$this->db->insert_batch('sellin_detail', $res);
			if($this->db->affected_rows() > 0)
				$status = true;
			else
				$status = false;
		}
		
		// SELECT DATA
		if($status){
			$baris = count($res);
			
			$result = array();
			foreach($arr as $row){
				$sellinid = $row['sellinid'];
				$materialid = $row['materialid'];
				
				// GET DATA
				$get = "
					SELECT sd.id, sd.sellinid, sd.materialid, m.name as materialname,
						sd.bal, sd.slof, sd.pac, sd.qty, sd.qtyintrodeal, sd.price, sd.sellinvalue
					FROM sellin_detail sd
					LEFT JOIN material as m ON sd.materialid = m.id
					WHERE sd.sellinid = '$sellinid'
					AND sd.materialid = '$materialid'
					AND sd.createdby = '$userid'
					AND sd.active = 0
				";
				
				$exist = $this->db->query($get)->result_array();
				if(count($exist) != 0){
					if(count($exist) > 1){
						$this->delete_flag($exist[1]['id']);
					}
					array_push($result, $exist[0]);
				}
				
			}
			
			return $result;
		}
		else {
			return null;
		}
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
