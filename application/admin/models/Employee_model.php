<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class employee_model extends CI_Model{
	
	private $tbl_name = 'employee';
	private $tbl_states = 'states';
	private $tbl_timezone = 'timezones';
	private $tbl_assn = 'doc_assign_emp';
	
	function getdata(){
		//	$this->db->where('doc_id',$id);	
		$sku = array();
			$this->db->select('e.*,s.name');
			$this->db->join('states as s','s.id = e.state_id');	
			$q = $this->db->get("$this->tbl_name as e");
			$num = $num = $q->num_rows();
			$data="";
			if ($num > 0) {
				$data = $q->result_array();	
				$e = array();			
				foreach($data as $k=>$v){
					$e['emp_username'] = $v['emp_username'];
					$e['emp_email'] = $v['emp_email'];
					$e['emp_firstname'] = $v['emp_firstname'];
					$e['emp_lastname'] = $v['emp_lastname'];
					$e['emp_add1'] = $v['emp_add1'];
					$e['emp_add2'] = $v['emp_add2'];
					$e['name'] = $v['name'];
					$e['zip'] = $v['zip'];
					$e['city'] = $v['city'];
					$e['emp_phone'] = $v['emp_phone'];
					array_push($sku, $e);
				}
			}
			return array('sku'=>$sku);
		}	

	function selectAllEmpActive(){
		$this->db->where('emp_status',1);
		$this->db->where('emp_id !=',0);
		$q = $this->db->get($this->tbl_name);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
			}
		}
	
	function del($id){
		$this->db->where('emp_id',$id);
		$q = $this->db->delete($this->tbl_name);
		return $q;
	}
	
	function selectAllEmps(){
		$this->db->where('user_type',"EMPLOYEE");
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	function selectAll(){
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllForChat($id){
		$this->db->where('emp_id !=', $id);
		/*$this->db->where('user_type !=', 'ADMIN');*/
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDocAssnedByEmpId($id){
		$this->db->select('doc_id');
		$this->db->where('emp_id',$id);
		$q = $this->db->get($this->tbl_assn);
		$num  = $q->num_rows();
		$data=array();
		if ($num > 0) {
			foreach($q->result() as $r){
				$data[] = $r->doc_id;               	
			}
			//print_r($data); exit;
		}
		return $data;
	}
		
	function selectAllStates(){
		$q = $this->db->get($this->tbl_states);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	
	function selectAllTimezone(){
		$q = $this->db->get($this->tbl_timezone);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	
	function create($data){
		$q = $this->db->insert($this->tbl_name, $data);
		return $q;
	}	
	
	function assign_doc($data){
		$q = $this->db->insert($this->tbl_assn, $data);
		return $q;
	}
	
	function getDetails($id){
		$this->db->select('e.*,s.name,t.timezone');
		$this->db->join('states as s','s.id = e.state_id');
		$this->db->join('timezones as t','t.id = e.emp_timezone');
		$this->db->where('e.emp_id',$id);	
		$q = $this->db->get("$this->tbl_name as e");
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDetailsByIds($ids){
		$this->db->where_in('emp_id',$ids);	
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
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