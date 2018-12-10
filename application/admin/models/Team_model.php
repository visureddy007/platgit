<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class team_model extends CI_Model{
	
	private $tbl_name = 'team';
	
	function assnTeamEmp($data){
		$q = $this->db->insert($this->tbl_name, $data);
		return $q;
	}
	
	function del($id){
		$this->db->where('team_id',$id);
		$q = $this->db->delete($this->tbl_name);
		return $q;
	}
	function selectAllTeam(){
		//$this->db->where('doc_status',1);
		$q = $this->db->get($this->tbl_name);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	
	function getDetails($id){
		$this->db->select('t.*,e.emp_firstname,e.emp_lastname');
		$this->db->join('employee as e','e.emp_id = t.team_members');
		$this->db->where('t.team_id',$id);	
		$q = $this->db->get("$this->tbl_name as t");
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function modify_team($data,$id){
		$this->db->where('team_id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
	}
	
}


    


?>