<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class message_model extends CI_Model{
	
	private $tbl_name = 'message';
	
	
	function getDetails($id){
		$this->db->where('msg_id',$id);	
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function modify($data,$id){
		$this->db->where('msg_id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
	}
}


    


?>