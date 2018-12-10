<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class excel_model extends CI_Model{
	
	private $tbl_name='employee';
	private $tbl_doc='doctors';
	private $tbl_states ='states';
	private $tbl_timezone ='timezones';
	
	function stateCodeArray(){
		$q = $this->db->get($this->tbl_states);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[$data->name] = $data->id;
			}
			return $result;
		}
	}
	
	function timezoneCodeArray(){
		$q = $this->db->get($this->tbl_timezone);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[$data->timezone] = $data->id;
			}
			return $result;
		}
	}
	
	function create_emp($data) {
		$q = $this->db->insert($this->tbl_name,$data);
		return $q;
	}	
		
	function create_doc($data) {
		$q = $this->db->insert($this->tbl_doc,$data);
		return $q;
	}	
	
	function emp_email_exists($email) {
	  $this->db->where('emp_username',$email);
	  $q = $this->db->get($this->tbl_name);
	  $num=  $q->num_rows();
	  return $num;
	}
	
	function doc_email_exists($email) {
	  $this->db->where('doc_email',$email);
	  $q = $this->db->get($this->tbl_doc);
	  $num=  $q->num_rows();
	  return $num;
	}
	
}

