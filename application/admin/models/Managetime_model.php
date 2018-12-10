<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class managetime_model extends CI_Model{
	
	private $tbl_name = 'time_clock';
	private $tbl_break = 'break_punches';
	

	
	
	function getEmpTimePunches($emp,$date){
		$sql ="SELECT 
					*
				FROM 
					`time_clock` 
				where 			
					emp_id = ? and 
					time_in_date <= ?   
				";
		$q = $this->db->query($sql,array($emp,$date));		
		$num=$q->num_rows();		
		$data="";		
		if($num>0){			
		$data=$q->result();		
		}		
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDetailsOfTimePun($id){
		$this->db->where('tc_id',$id);	
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function del_timepun($id){
		$this->db->where('tc_id',$id);
		$q = $this->db->delete($this->tbl_name);
		return $q;
	}
	
	function create($data){
		$q = $this->db->insert($this->tbl_name, $data);
		return $q;
	}
	
	function create_break($data){
		$q = $this->db->insert($this->tbl_break, $data);
		return $q;
	}
	
	
	function update($data,$id){
		$this->db->where('tc_id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
	}
	
	function update_break($data,$id){
		$this->db->where('bp_id',$id);
		$q = $this->db->update($this->tbl_break,$data);
		return $q;
	}
	
	function selectAllByDate($date){
		$this->db->where('tc_date',$date);
		$q = $this->db->get($this->tbl_name);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	function selectBreaksAllByDate($date){
		$this->db->where('break_date',$date);
		$q = $this->db->get($this->tbl_break);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	function selectOutEmpty($date){
		$this->db->where('time_out',"");
		$this->db->where('tc_date',$date);
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function selectStopEmpty($date){
		$this->db->where('time_out',"");
		$this->db->where('break_date',$date);
		$q = $this->db->get($this->tbl_break);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
}
?>