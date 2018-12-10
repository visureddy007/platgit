<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class doctor_model extends CI_Model{
	
	private $tbl_name = 'doctors';
	private $tbl_states = 'states';
	private $tbl_sch = 'doc_sech_spec';
	private $assign = 'doc_assign_emp';
	private $tbl_schedule = 'doc_schedule';
	private $tbl_call = 'call_log';
	private $tbl_ans_sch = 'ans_scheduling_spec';
	private $tbl_team = 'team';
    
    function selectForCalander(){
		$query = "SELECT `cl_id`,`call_result`,`appt_date`, STR_TO_DATE(appt_time, '%l:%i %p')  as appt_time,`patient_response` FROM `call_log` where `call_result` = 'Contact'; ";
		$q = $this->db->query($query);
		
		$data= array();
		
		/* if($num>0){
			  $data = $q->result();
			 
		  }*/
		  foreach($q->result_array() as $r){
			  $data[] = $r;
			  
		  }
		  return array('data'=>$data);
	}
	
	
   function selectTeamEmpsbyEmp($emp_id){
	    $sql = "SELECT * FROM `team` WHERE find_in_set($emp_id, `team_members`) ";
		//$this->db->where_in('team_members',$emp_id);
		//$q = $this->db->get($this->tbl_team);
		//echo $this->db->last_query();exit;
		$q = $this->db->query($sql);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return $data;
	}
	
	
	function getdata(){
		//	$this->db->where('doc_id',$id);	
		$sku = array();
			$this->db->select('c.*,e.emp_firstname,d.doc_office_name');
			$this->db->join('employee as e','e.emp_id = c.emp_id');	
			$this->db->join('doctors as d','d.doc_id = c.doc_id');	
			$q = $this->db->get("$this->tbl_call as c");
			$num = $num = $q->num_rows();
			$data="";
			if ($num > 0) {
				$data = $q->result_array();	
				$e = array();			
				foreach($data as $k=>$v){
					$e['cl_created_on'] = $v['cl_created_on'];
					$e['first_name'] = $v['first_name'];
					$e['requires_attention'] = $v['requires_attention'];
					$e['resolved'] = $v['resolved'];
					$e['call_result'] = $v['call_result'];
					$e['adults'] = $v['adults'];
					$e['children'] = $v['children'];
					$e['doc_office_name'] = $v['doc_office_name'];
					$e['emp_firstname'] = $v['emp_firstname'];
					array_push($sku, $e);
				}
			}
			return array('sku'=>$sku);
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
	
	function selectAllActive(){
		//$this->db->where('doc_status',1);
		$q = $this->db->get($this->tbl_name);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	
	function selectAllPat(){
		//$this->db->where('doc_status',1);
		$q = $this->db->get($this->tbl_call);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	
	function getCallogDetails($id){
		$this->db->select('c.*,e.emp_username,d.doc_firstname,d.doc_lastname');
		$this->db->join('employee as e','e.emp_id = c.emp_id');
		$this->db->join('doctors as d','d.doc_id = c.doc_id');
		$this->db->where('c.cl_id',$id);	
		$q = $this->db->get("$this->tbl_call as c");
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllDoc(){
      $q = $this->db->get($this->tbl_name);
	  $num=  $q->num_rows();
	  $data= array();
	  if($num>0){
		  $data = $q->result();
	  }
	  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCallsForCnt(){
		$query = "SELECT cl_id FROM `call_log`";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCallsForCntTodays(){
		$query = "SELECT cl_id FROM `call_log` where appt_date = CURDATE()";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllAptsForCnt(){
		$query = "SELECT cl_id FROM `call_log` WHERE `patient_response` = 'Schedule Appointment' ";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllAptsForCntTodays(){
		$query = "SELECT cl_id FROM `call_log` WHERE`patient_response` = 'Schedule Appointment' AND appt_date = CURDATE()";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCalls(){
		$query = "SELECT `doc_id` ,count(`emp_id`) as total_calls FROM `call_log` GROUP BY `doc_id`";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCallsAptsByUid($id){
		$query = "SELECT (SELECT count(`emp_id`) FROM call_log WHERE emp_id='$id') as calls,(SELECT count(`emp_id`) FROM call_log  WHERE emp_id='$id'  AND   `patient_response` = 'Schedule Appointment')   AS apts";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function selectAllApts(){
		$query = "SELECT `doc_id` ,count(`emp_id`) as total_apts FROM `call_log` WHERE `patient_response` = 'Schedule Appointment' GROUP BY `doc_id`";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllAptsTot(){
		$query = "SELECT count(`emp_id`) as total_apts FROM `call_log` WHERE`patient_response` = 'Schedule Appointment'";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllAptsTotIndividual($emp_id){
		$query = "SELECT count(`emp_id`) as total_apts FROM `call_log` WHERE `patient_response` = 'Schedule Appointment' AND emp_id = $emp_id ";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllAptsTotTeam($emps){
		$query = "SELECT count(`emp_id`) as total_apts FROM `call_log` WHERE`patient_response` = 'Schedule Appointment' AND emp_id IN($emps) ";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCallsTot(){
		$query = "SELECT count(`emp_id`) as tot_calls FROM call_log";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCallsTotIndividual($emp_id){
		$query = "SELECT count(`emp_id`) as tot_calls FROM call_log WHERE emp_id = $emp_id ";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllCallsTotTeam($emps){
		$query = "SELECT count(`emp_id`) as tot_calls FROM call_log WHERE emp_id IN($emps)";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectwrknghrsTot(){
		$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`time_out`)-TIME_TO_SEC(`time_in`))) AS working_hours
					FROM time_clock WHERE `emp_id` !='0'";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectwrknghrsTotIndividual($emp_id){
		$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`time_out`)-TIME_TO_SEC(`time_in`))) AS working_hours
					FROM time_clock WHERE `emp_id` !='0' AND `emp_id` = $emp_id";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectwrknghrsTotTeam($emps){
		$query = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(`time_out`)-TIME_TO_SEC(`time_in`))) AS working_hours
					FROM time_clock WHERE `emp_id` !='0' AND emp_id IN($emps)";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		  if($num>0){
			  $data = $q->result_array();
		  }
		  return array('num'=>$num,'data'=>$data);
	}
	
	function selectCallsLastSixMonths(){
		$query = "SELECT count(`emp_id`)as calls , MONTHNAME(`cl_created_on`) as month  FROM `call_log` WHERE `cl_created_on` > DATE_SUB(now(), INTERVAL 7 MONTH)  GROUP BY  MONTHNAME(`cl_created_on`) ORDER BY MONTH(`cl_created_on`) ASC ; ";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		$mnt= array();
		/* if($num>0){
			  $data = $q->result();
			 
		  }*/
		  foreach($q->result() as $r){
			  $data[] = $r->calls;
			  $mnt[] = $r->month;
		  }
		  return array('num'=>$num,'data'=>$data,'mnt'=>$mnt);
	}
	
	function selectAptsLastSixMonths(){
		$query = "SELECT count(`emp_id`)as calls , MONTHNAME(`cl_created_on`) as month  FROM `call_log` WHERE `cl_created_on` > DATE_SUB(now(), INTERVAL 7 MONTH) AND `patient_response` = 'Schedule Appointment' GROUP BY  MONTHNAME(`cl_created_on`) ORDER BY MONTH(`cl_created_on`) ASC  ";
		$q = $this->db->query($query);
		$num=  $q->num_rows();
		$data= array();
		$mnt= array();
		/* if($num>0){
			  $data = $q->result();
			 
		  }*/
		  foreach($q->result() as $r){
			  $data[] = $r->calls;
			  $mnt[] = $r->month;
		  }
		  return array('num'=>$num,'data'=>$data,'mnt'=>$mnt);
	}
	
	function getDrsByDocDay($doc_id,$day,$slot_duration){
		$query = "SELECT 
						d.doc_firstname,d.doc_status,d.doc_office_name,dc.*
					FROM 
						`doctors` as d 
					JOIN
						$this->tbl_schedule as dc
						ON
							dc.doc_id=d.doc_id
					where
						d.doc_id = ? AND
						dc.day = ? AND
						d.doc_status=1";
		$q = $this->db->query($query,array($doc_id,$day));		
		$num =  $q->num_rows();
		$slotsA= array();
		$data=array();
		$total_slots = 0;
		if ($num > 0) {
			foreach($q->result() as $d){
				$out = $d->out_time;
				$in = $d->in_time;
				$stoStr = (strtotime($d->out_time) < strtotime($out))?strtotime($d->out_time):strtotime($out);
					$slotmin = bcmul($slot_duration,60);
					$fromStr = strtotime($d->in_time);
					$toStr = strtotime($d->out_time);
					$from = date('H:i',$fromStr);
					$to = date('H:i',$stoStr);
					$time_diff = strtotime($to) - strtotime($from);
					$noof_hrs = ($time_diff/60)/60;
					$slots='';
					
					$data[]= $d;
					$noofslots = ($noof_hrs*60)/$slot_duration;
					$sfrom = $from;
					for($i=1;$i<=$noofslots;$i++){
						if($i>1){
						
							$sfrom = date('H:i', strtotime($sfrom)+$slotmin);							
						}
						if(strtotime($sfrom)>=strtotime($in)){
							
							$slotsA[$d->doc_id][]= $sfrom;
						}
					}
					$dr_slot_count = (isset($slotsA[$d->doc_id]))?count($slotsA[$d->doc_id]):0;
					$total_slots = bcadd($total_slots,$dr_slot_count,0);
			}
		}
		return array('num'=>$num,'data'=>$data,'slot'=>$slotsA,'total'=>$total_slots);
	}
	
	function create_bulk_time($data){
		$q = $this->db->insert_batch($this->tbl_schedule,$data);
		return $q;
	}
	
	function update_bulk_time($data){
		$q = $this->db->update_batch($this->tbl_schedule,$data,'id');
		return $q;
	}

	function getScheByID($id){
		$this->db->where('doc_id',$id);	
		$q = $this->db->get($this->tbl_schedule);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDetailsOfSche($id){
		$this->db->where('id',$id);	
		$q = $this->db->get($this->tbl_schedule);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function del_time($id){
		$this->db->where('id',$id);
		$q = $this->db->delete($this->tbl_schedule);
		return $q;
	}
	
	function selectAllForCnt(){
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function selectAllForCntInAct(){
		$this->db->where('doc_status',0);
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	

	function selectAllForCntAct(){
		$this->db->where('doc_status',1);
		$q = $this->db->get($this->tbl_name);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function selectAll($assn,$id){
		if(!empty($assn)){
			$this->db->select('d.*,s.name');
			$this->db->join('states as s','d.state_id = s.id');
			$this->db->where_not_in('d.doc_id', $assn);
		}else{
			$this->db->select('d.*,s.name');
			$this->db->join('states as s','d.state_id = s.id');
		}
		
		$q = $this->db->get("$this->tbl_name as d");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
				$result[] = $data;
			}
			return $result;
		}
	}
	
	function del($id){
		$this->db->where('doc_id',$id);
		$q = $this->db->delete($this->tbl_name);
		return $q;
	}

	function selectAllAssigned($emp_id){
		$this->db->select('d.*,s.name,da.*');
		$this->db->join('states as s','d.state_id = s.id');
		$this->db->join('doc_assign_emp as da','d.doc_id = da.doc_id');
		$this->db->where('da.emp_id',$emp_id);
		//$this->db->where_not_in('da.doc_id', $doc_assn);
		$q = $this->db->get("$this->tbl_name as d");
		//echo $this->db->last_query();exit;
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
	
	function create_calllog($data){
		$q = $this->db->insert($this->tbl_call, $data);
		return $q;
	}
	
	function create_doc_spec($data){
		$q = $this->db->insert($this->tbl_sch, $data);
		return $q;
	}
	
	function create_doc_ans_spec($data){
		$q = $this->db->insert($this->tbl_ans_sch, $data);
		return $q;
	}
	
	function getDetails($id){
		$this->db->select('d.*,s.name,t.timezone');
		$this->db->join('states as s','d.state_id = s.id');
		$this->db->join('timezones as t','t.id = d.doc_timezone');
		$this->db->where('d.doc_id',$id);	
		$q = $this->db->get("$this->tbl_name as d");
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getsch_det($id){
		$this->db->where('doc_id',$id);	
		$q = $this->db->get($this->tbl_sch);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getanssch_det($id){
		$this->db->where('doc_id',$id);	
		$q = $this->db->get($this->tbl_ans_sch);
		$num = $num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function modify($data,$id){
		$this->db->where('doc_id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
	}
	
	function modify_spec($data,$id){
		$this->db->where('doc_id',$id);
		$q = $this->db->update($this->tbl_sch,$data);
		return $q;
	}
	
	function modify_ans_spec($data,$id){
		$this->db->where('doc_id',$id);
		$q = $this->db->update($this->tbl_ans_sch,$data);
		return $q;
	}
	
	function modify_calllog($data,$id){
		$this->db->where('cl_id',$id);
		$q = $this->db->update($this->tbl_call,$data);
		return $q;
	}
}


    


?>