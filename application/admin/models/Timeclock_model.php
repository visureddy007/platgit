<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class timeclock_model extends CI_Model{
	
	private $tbl_name = 'time_clock';
	private $tbl_break = 'break_punches';
	

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
	function selectAllByID($id){
		$this->db->where('emp_id',$id);
		$q = $this->db->get($this->tbl_name);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function selectBreaksAllByID($id){
		$this->db->select('b.*');
		//$this->db->join('time_clock as t','b.tc_id = t.tc_id');
		$this->db->where('b.emp_id',$id);
		$q = $this->db->get("$this->tbl_break as b");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}

	function selectOutEmpty($date,$id){
		$this->db->where('emp_id',$id);
		$this->db->where('time_out',"00:00:00");
		$this->db->where('time_in_date',$date);
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function selectStopEmpty($date,$id){
		$this->db->where('emp_id',$id);
		$this->db->where('time_out',"00:00:00");
		$this->db->where('break_in_date',$date);
		$q = $this->db->get($this->tbl_break);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getRepTimeByDateEmpID($id,$date){
		$this->db->where('emp_id',$id);
		$this->db->where('time_in_date',$date);
		$q = $this->db->get($this->tbl_name);
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			foreach ($q->result() as $r) {
			$data[] = $r;
			}
			return array('num'=>$num,'data'=>$data,'recordsTotal'=>$num,'recordsFiltered'=>$num);
		}
	}
		function getRepBreakByDateEmpID($id,$date){
		$this->db->where('emp_id',$id);
		$this->db->where('break_in_date',$date);
		$q = $this->db->get($this->tbl_break);
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			foreach ($q->result() as $r) {
			$data[] = $r;
			}
			return array('num'=>$num,'data'=>$data,'recordsTotal'=>$num,'recordsFiltered'=>$num);
		}
	}
	
	function query($query) {
	  
	  $q = $this->db->query($query);
	  $num=  $q->num_rows();
	  $data= array();
	  if($num>0){
		  $data = $q->result();
	  }
	  return array('num'=>$num,'data'=>$data);
	}
	
	function query_array($query) {
	  
	  $q = $this->db->query($query);
	  $num=  $q->num_rows();
	  $data= array();
	  if($num>0){
		  $data = $q->result_array();
	  }
	  return array('num'=>$num,'data'=>$data);
	}
	
	function query_empwise($query){
		
		 $q = $this->db->query($query);
		$num  = $q->num_rows();
		$data=array();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $r) {
				$data[$r->emp_id][] = $r;
			} 
		}
		return array('data'=>$data,'num'=>$num);
	}
	
}
?>