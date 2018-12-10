<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class timeoffreq_model extends CI_Model{
	
	private $tbl_name = 'time_off_req';

	function getDetails($id){
		$this->db->where('e.req_id',$id);	
		$q = $this->db->get("$this->tbl_name as e");
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function create($data){
		$q = $this->db->insert($this->tbl_name, $data);
		return $q;
	}	
	
	
	function modify($data,$id){
		$this->db->where('emp_id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
	}
	
	function del_assndoc($id){
		$this->db->where('id',$id);
		$q = $this->db->delete($this->tbl_assn);
		return $q;
		
	}
	
}


    


?>