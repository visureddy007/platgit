<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class signup_model extends CI_Model{
	private $tbl_name = 'admin';
	private $tbl_emp = 'employee';
	private $tbl_doc = 'doctors';


	function insert($data){
		$q = $this->db->insert($this->tbl_name, $data);
		return $q;
	}
	
	function validate($username,$pwd){
		
		$sql = "select * from $this->tbl_emp where `emp_username`=? and md5(`emp_password`)=?";
		$q = $this->db->query($sql,array($username,$pwd));
		$num=$q->num_rows();
		$data="";
		if($num>0){
			$data=$q->result_array();
		}
		return array('num'=>$num,'data'=>$data);	
		
	}
	
	function email_exists($email){
		$this->db->where('emp_email',$email);
		$q = $this->db->get($this->tbl_emp);
		$num=  $q->num_rows();
		return $num;
	}	
	
	function doc_email_exists($email){
		$this->db->where('doc_email',$email);
		$q = $this->db->get($this->tbl_doc);
		$num=  $q->num_rows();
		return $num;
	}	
	
}


    


?>