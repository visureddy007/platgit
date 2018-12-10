<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->model('timeclock_model');
			$this->load->model('employee_model');
			$this->load->model('doctor_model');
			$this->load->model('team_model');
			$this->load->library('datatbl');
	}
	
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true){
			redirect('login');			
		}				
	}
	
	public function index(){
		$data['employees'] = $this->employee_model->selectAllEmpActive();
		$data['doctors'] = $this->doctor_model->selectAllActive();
		$data['team'] = $this->team_model->selectAllTeam();
		$data['main_content2']='reports';	
		$this->load->view('template2/body',$data);		
	}
	
	function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds');
	}
	
	function decimalHours($time){
		$hms = explode(":", $time);
		return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
    }
	
	function getData(){
		$success=false;
		$msg='';
		$tbl='';
		$tot_tbl='';
		$ctotal=0;
		$dtotal=0;
		$total=0;
		$count=0;
		$pechrt='';
		 if(isset($_POST['report_type']) && $_POST['report_type']!="" && isset($_POST['start']) && $_POST['start']!="" && isset($_POST['end']) && $_POST['end']!=""){
			 $report_type = $_POST['report_type'];
			 $emp_id = $_POST['emp_id'];
			 $doc_id = $_POST['doc_id'];
			 $team_id = $_POST['team_id'];
			 $from = $_POST['start'];
			 $to = $_POST['end'];
			         if($report_type=='timepunches'){
				 $sql ="SELECT 
							e.emp_firstname,t.*
						FROM 
							`time_clock` as t
						JOIN 
							employee as e on e.emp_id= t.emp_id 
						WHERE
							t.time_in_date>='$from' AND t.time_in_date<='$to'
							";
						if($emp_id != "all"){
							$sql.=" AND e.emp_id=$emp_id"; 
						}		
							 $sql.="  ORDER BY e.emp_firstname ASC";
	
						 $td = $this->timeclock_model->query($sql);
						// print_r($td);exit;
						 if($td['num']>0){
							 $success=true;
							 $tbl.='<thead>
										<tr><th>Employee Name</th><th>Time In Date</th><th>Time In</th><th>Time Out Date</th><th>Time Out</th><th>Hours Worked Out</th></tr>
									</thead><tbody>';
							$total=0;
							$crd_total=0;
					 foreach($td['data'] as $r){
						$datetime1 = new DateTime($r->time_in);
						$datetime2 = new DateTime($r->time_out);
						$interval = $datetime1->diff($datetime2);
						if($interval->format('%h') == 0){
							$difference = $interval->format('%i')." Minutes";
						}else{
							$difference = $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
						}
						$time = $difference;
						$time_in_sec = strtotime("1970-01-01 $difference UTC");
						$styl = ($r->time_out_date =="0000-00-00")?"style='color:red'":"";
						$styl_time = ($r->time_out =="00:00:00")?"style='color:red'":"";
						$tbl.='<tr><td>'.$r->emp_firstname.'</td><td>'.$r->time_in_date.'</td><td>'.$r->time_in.'</td><td><span '.$styl.'>'.$r->time_out_date.'</span></td><td><span '.$styl_time.'>'.$r->time_out.'</span></td><td>'.$difference.'</td></tr>';
						$total = bcadd($total,$time_in_sec);
					 }
						$working_time = $total;
					    $total_time = $this->secondsToTime($working_time);;
							
						$tot_tbl.='<tr><th>Total Working Hours</th><th>'.$total_time.'</th></tr>';
						 }else{
							 $msg='No Records Found';
						 }
					}
					 else if($report_type =='tmprdct'){
						 /*** Team Details  ***/
						 $total_calls_made = 0;
						 $total_apts_made = 0;
						 $sql ="SELECT
									`team_members`,`team_name` 
								FROM `team` 
								
								 ";
								if($team_id!='allTeam'){	
									$sql.="WHERE team_id = $team_id "; 
								}else{
									
									$sql.="  "; 
								}
									
						 $td = $this->timeclock_model->query_array($sql);
						 // print_r($td);exit;
						 $tbl.='<thead>
										<tr>
											<th>Team Name</th>
											<th>Hours Worked</th>
											<th>Calls Made(Patients Contacted)</th>
											<th>Total Appointments</th>
											<th>CPH</th>
											<th>APH</th>
										</tr>
									</thead>
								<tbody>';
				foreach($td['data'] as $k=>$v){
							// print_r($td['num']);exit;
						 $team_mem = $v['team_members'];/*** team members ***/
						 $team_name = $v['team_name'];
						  /*** Employee Working Hours ***/
						 $sql1 ="SELECT 
										*
								FROM 
									`time_clock`
								WHERE 
									`emp_id` IN($team_mem)  AND date(time_in_date) >='$from' AND date(time_in_date)<='$to'";
						 $ed = $this->timeclock_model->query($sql1);
					foreach($ed['data'] as $r){
						$datetime1 = new DateTime($r->time_in);
						$datetime2 = new DateTime($r->time_out);
						$interval = $datetime1->diff($datetime2);
						if($interval->format('%h') == 0){
							$difference = $interval->format('%i')." Minutes";
						}else{
							$difference = $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
						}
						$time = $difference;
						$time_in_sec = strtotime("1970-01-01 $difference UTC");
						$total = bcadd($total,$time_in_sec);
					 }
					$seconds = $total;
					$total_time = gmdate('H:i:s', $seconds); /*** total working hours ***/												 
					$sql2 ="SELECT (SELECT count(`emp_id`) FROM call_log
								WHERE
								`emp_id` IN($team_mem)  AND 
								date(`cl_created_on`) >='$from' AND 
								date(`cl_created_on`)<='$to') AS calls,
							(SELECT count(`emp_id`) FROM call_log
								WHERE
								`emp_id` IN($team_mem)  AND 
								 date(`cl_created_on`) >='$from' AND 
								 date(`cl_created_on`)<='$to' AND  
								 `patient_response` = 'Schedule Appointment' )   AS apts ";
							$cd = $this->timeclock_model->query_array($sql2);
							$total_calls = $cd['data']['0']['calls'];
							$total_apts = $cd['data']['0']['apts'];
							$wrkhr_in_sec =  strtotime("1970-01-01 $total_time UTC");
							if($total_calls == 0){
									$calls_per_hr = 0;
							}
							if($total_apts == 0){
									$apts_per_hr = 0;
							}
							if($wrkhr_in_sec==""){
								$calls_per_hr  = 0;
								$apts_per_hr  = 0;
							}else if($wrkhr_in_sec != ""){
								$clls_pr_sc = bcdiv($total_calls,$wrkhr_in_sec,6);
								$calls_per_hr = bcmul($clls_pr_sc,3600,2);
								$apts_pr_sc = bcdiv($total_apts,$wrkhr_in_sec,6);
								$apts_per_hr = bcmul($apts_pr_sc,3600,2);
							}
						
					if($td['num']>0){
						 $success=true;
						 
						$total=0;
						$crd_total=0;
						
							 $tbl.='<tr>
										<td>'.$team_name.'</td>
										<td>'.$total_time.'</td>
										<td>'.$total_calls.'</td>
										<td>'.$total_apts.'</td>
										<td>'.round($calls_per_hr).'</td>
										<td>'.round($apts_per_hr).'</td>
									</tr>';
						 $total_calls_made  = bcadd($total_calls_made,$total_calls,2);
					     $total_apts_made   = bcadd($total_apts_made,$total_apts,2);
						
					 }else{
						 $msg='No Records Found';
					 }

			    }
					 	 
						 $tot_tbl.='<tr>
										<th>Average Calls Made</th>
										<th>Average Apts Made</th>
										<th>Total Calls Made</th>
										<th>Total Apts Made</th>
									</tr>
								  <tr>
									<th>'.bcdiv($total_calls_made,$td['num'],2).'</th>
									<th>'.bcdiv($total_apts_made,$td['num'],2).'</th>
									<th>'.$total_calls_made.'</th>
									<th>'.$total_apts_made.'</th>
									
								  </tr>';
						
						 
					 } 
			         else if($report_type=='breakpunches'){
						 $sql ="SELECT 
									*
								FROM 
									`break_punches`
								
								WHERE emp_id=$emp_id  AND 	break_in_date>='$from' AND 	break_in_date<='$to'";
			
						 $td = $this->timeclock_model->query($sql);
						 if($td['num']>0){
							 $success=true;
							 $tbl.='
										<thead>
											<tr><th>Break Type</th><th>Time In Date</th><th>Time In</th><th>Time Out Date</th><th>Time Out</th><th>Total Break Time</th></tr>
										</thead>
										<tbody>';
							$total=0;
							$crd_total=0;
							 foreach($td['data'] as $r){
								$datetime1 = new DateTime($r->time_in);
								$datetime2 = new DateTime($r->time_out);
								$interval = $datetime1->diff($datetime2);
								if($interval->format('%h') == 0){
									$difference = $interval->format('%i')." Minutes";
								}else{
									$difference = $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
								}
								$time = $difference;
								$time_in_sec = strtotime("1970-01-01 $difference UTC");
								 $tbl.='<tr><td>'.$r->break_type.'</td><td>'.$r->break_in_date.'</td><td>'.$r->time_in.'</td><td>'.$r->	time_out.'</td><td>'.$r->break_out_date.'</td><td>'.$difference.'</td></tr>';
								  $total = bcadd($total,$time_in_sec);
							 }
								$seconds = $total;
								$total_time = gmdate('H:i:s', $seconds);
								$tot_tbl.='<tr><th>Total Working Hours</th><th>'.$total_time.'</th></tr>';
						 }else{
							 $msg='No Records Found';
						 }
		        	 }
					 else if($report_type=='empprfrm'){
						 $sql ="SELECT (SELECT count(`emp_id`) FROM call_log
									WHERE "; 
									if($emp_id!='all'){
										
										$sql.=" emp_id=$emp_id  AND "; 
									}else{
										
										$sql.=" emp_id=e.emp_id  AND "; 
									}
									$sql.=" date(`cl_created_on`) >='$from' AND 
									date(`cl_created_on`)<='$to') AS calls,
								(SELECT count(`emp_id`) FROM call_log
									WHERE "; 
									if($emp_id!='all'){
										
										$sql.=" emp_id=$emp_id  AND "; 
									}else{
										
										$sql.=" emp_id=e.emp_id  AND "; 
									}
									$sql.=" date(`cl_created_on`) >='$from' AND 
									 date(`cl_created_on`)<='$to' AND  
									 `patient_response` = 'Schedule Appointment' )   AS apts,e.emp_firstname ,e.emp_lastname,e.emp_id
									 FROM 
										call_log as c 
									JOIN 
										employee as e on e.emp_id = c.emp_id  "; 
									if($emp_id!='all'){
										
										$sql.=" WHERE  e.emp_id=$emp_id   "; 
									}
									$sql.=" GROUP BY e.emp_id; ";
						 $td = $this->timeclock_model->query($sql);
						// print_r($td);exit;
					//	 echo $this->db->last_query(); exit;
						 $sql1 ="SELECT 
									*
								FROM 
									`time_clock`
								
								WHERE "; 
									if($emp_id!='all'){
										
										$sql1.=" emp_id=$emp_id  AND "; 
									}
									$sql1.=" time_in_date>='$from' AND 
									time_in_date<='$to'";
						 $wh = $this->timeclock_model->query_empwise($sql1);
						/* echo $this->db->last_query(); exit;*/
						 /*
						 echo "<pre>";
						 print_r($wh);
							exit;
						 */ 
						 $total_time =array();
						foreach($wh['data'] as $ek=>$ev){
							$total=0;
							foreach($ev as $k=>$h){
								/*print_r($h); exit;	*/
								$datetime1 = new DateTime($h->time_in);
								$datetime2 = new DateTime($h->time_out);
								$interval = $datetime1->diff($datetime2);
								if($interval->format('%h') == 0){
									$difference = $interval->format('%i')." Minutes";
								}else{
									$difference = $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
								}
								$time = $difference;
								$time_in_sec = strtotime("1970-01-01 $difference UTC");
								$total = bcadd($total,$time_in_sec);
						   }
							$seconds = $total;
							$total_time[$ek] = gmdate('H:i:s', $seconds);
						}
						
							//print_r($total_time); 
						
						
									
					
						 if($td['num']>0){
							 $success=true;
							 $tbl.='<thead>
										<tr>
											<th>Employee Name</th>
											<th>Hours Worked</th>
											<th>Calls Made(Patients Contacted)</th>
											<th>Appointments</th>
											<th>CPH</th>
											<th>APH</th
										</tr>
									</thead>
										<tbody>';
							$total=0;
							$crd_total=0;
							$total_calls_made = 0;
							$total_apts_made = 0;
							$total_cph_made = 0;
							 foreach($td['data'] as $r){
									$tt = (isset($total_time[$r->emp_id]))?$total_time[$r->emp_id]:0;
									
										
										$wrkhr_in_sec =  strtotime("1970-01-01 ".$tt." UTC");
									  //  print_r($wrkhr_in_sec);exit;
										if($wrkhr_in_sec==""){
											$calls_per_hr  = 0;
											$apts_per_hr  = 0;
										}else if($wrkhr_in_sec != ""){
											$clls_pr_sc = bcdiv($r->calls,$wrkhr_in_sec,6);
											$calls_per_hr = bcmul($clls_pr_sc,3600,2);
											$apts_pr_sc = bcdiv($r->apts,$wrkhr_in_sec,6);
											$apts_per_hr = bcmul($apts_pr_sc,3600,2); 
										}
									
										$tbl.='<tr>
												<td>'.$r->emp_firstname.' '.$r->emp_lastname.'</td>
												<td>'.$this->decimalHours($total_time[$r->emp_id]).'</td>
												<td>'.$r->calls.'</td>
												<td>'.$r->apts.'</td>
												<td>'.round($calls_per_hr).'</td>
												<td>'.round($apts_per_hr).'</td>
											</tr>';
									$total_calls_made  = bcadd($total_calls_made,$r->calls,2);
									$total_apts_made   = bcadd($total_apts_made,$r->apts,2);
							 }
							 $total_calls  = $total_calls_made;
							 $total_apts  = $total_apts_made;
								$tot_tbl.='<tr>
											<th>Average Calls Made</th>
											<th>Average Apts Made</th>
											<th>Total Calls Made</th>
										    <th>Total Apts Made</th>
											
										  </tr>
										  <tr>
											<th>'.bcdiv($total_calls,count($wh['data']),2).'</th>
											<th>'.bcdiv($total_apts,count($wh['data']),2).'</th>
											<th>'.$total_calls.'</th>
											<th>'.$total_apts.'</th>
											
										  </tr>';
						 }else{
							 $msg='No Records Found';
						 }
			         }
				     else  if($report_type =='drgoal'){
						 $sql ="SELECT c.`doc_id`,sum(c.adults) as tot_adu,sum(c.children) as tot_child,c.adults,c.children,d.doc_firstname,d.doc_lastname,d.doc_goal_no,count(c.`doc_id`) as total_apts, MONTHNAME(c.`cl_created_on`) as month , YEAR(c.`cl_created_on`) as year 
								FROM
									`call_log`  as c
								JOIN
								  doctors as d on d.doc_id = c.doc_id
								WHERE
									c.`patient_response` = 'Schedule Appointment' AND";
								if($doc_id != 'all'){
									$sql.=" c.doc_id = '$doc_id' AND "; 
								}
								
								$sql.=" date(c.`cl_created_on`) >='$from' AND 
									date(c.`cl_created_on`) <='$to'  
								GROUP BY 
									c.`doc_id`, MONTHNAME(c.`cl_created_on`) 
								ORDER BY 
									MONTH(c.`cl_created_on`) ASC";
			
						 $ad = $this->timeclock_model->query($sql);
						// echo $this->db->last_query(); exit;
						// print_r($ad);exit;
						 
						 if($ad['num']>0){
							 $success=true;
							 $tbl.='
										<thead>
											<tr>
												<th>Doctor Name</th>
												<th>Month</th>
												<th>Year</th>
												<th>Goal</th>
												<th>Adults</th>
												<th>Children</th>
												<th>Appointments </th>
												<th>% Achieved</th>
											</tr>
										</thead>
										<tbody>';
								$total_adu= 0;		
								$total_chi= 0;		
								$total_apts= 0;		
							 foreach($ad['data'] as $r){
								 $ach =  bcdiv($r->total_apts,$r->doc_goal_no,2);
									 if($ach == 0){
										$ach_per = 0;
									 }else{
										$ach_per = bcmul($ach,100,2);
									 }
								 $tbl.='<tr>
											<td><a target="_blank" href="'.base_url('doctor/calllog/'.$r->doc_id).'">'.$r->doc_firstname.' '.$r->doc_lastname.'</a></td>
											<td>'.$r->month.'</td>
											<td>'.$r->year.'</td>
											<td>'.$r->doc_goal_no.'</td>
											<td>'.$r->tot_adu.'</td>
											<td>'.$r->tot_child.'</td>
											<td>'.$r->total_apts.'</td>
											<td>'.$ach_per.' %</td>
									   </tr>';
								$total_adu  = bcadd($total_adu,$r->tot_adu,2);
								$total_chi  = bcadd($total_chi,$r->tot_child,2);
								$total_apts  = bcadd($total_apts,$r->total_apts,2);
							    }
								$tot_tbl.='<tr>
												<th>Average Adults</th>
												<th>Average Children</th>
												<th>Average Appointments</th>
												<th>Total Appointments Made</th>
											</tr>
											<tr>
												<th>'.round(bcdiv($total_adu,count($ad['data']),2)).'</th>
												<th>'.round(bcdiv($total_chi,count($ad['data']),2)).'</th>
												<th>'.round(bcdiv($total_apts,count($ad['data']),2)).'</th>
												<th>'.$total_apts.'</th>
											</tr>';
						 }else{
							 $msg='No Records Found';
						 }
			          }
					 else  if($report_type =='inactivepat'){
						 $sql ="SELECT `first_name`,`last_name`,`reason_for_leave` FROM `call_log` WHERE `patient_response` = 'Discontinued Services' AND `cl_created_on` >='$from' AND `cl_created_on`<='$to';";
			
						 $td = $this->timeclock_model->query($sql);
						
						// print_r($td);exit;
						 if($td['num']>0){
							 $success=true;
							 $tbl.='
										<thead>
											<tr><th>Patient Name</th><th>Reason For Leaving</th></tr>
										</thead>
										<tbody>';
							$total=0;
							$crd_total=0;
							 foreach($td['data'] as $r){
									
								 $tbl.='<tr><td>'.$r->first_name.' '.$r->last_name.'</td><td>'.$r->reason_for_leave.'</td></tr>';
							 }
						 }else{
							 $msg='No Records Found';
						 }
			         }
					 else  if($report_type =='inactivedoc'){
						 $sql ="SELECT `doc_firstname`,`doc_lastname`,`doc_phone`,`doc_email` FROM `doctors` WHERE `doc_status` = 0 AND `created_on` >='$from' AND `created_on`<='$to';";
			
						 $td = $this->timeclock_model->query($sql);
						
						// print_r($td);exit;
						 if($td['num']>0){
							 $success=true;
							 $tbl.='
										<thead>
											<tr><th>Doctor Name</th><th>Phone No</th><th>Email</th></tr>
										</thead>
										<tbody>';
							$total=0;
							$crd_total=0;
							 foreach($td['data'] as $r){
									
								 $tbl.='<tr><td>'.$r->doc_firstname.' '.$r->doc_lastname.'</td><td>'.$r->doc_phone.'</td><td>'.$r->doc_email.'</td></tr>';
							 }
						 }else{
							 $msg='No Records Found';
						 }
					 }
					 else  if($report_type =='ptentrspn'){
						 $sql ="SELECT
									`first_name`,`last_name` ,`call_result`,`patient_response`,`notes`,`appt_date`,`appt_time`,`adults`,`children`
								FROM `call_log`
								WHERE
									date(`cl_created_on`) >='$from' AND 
									date(`cl_created_on`) <='$to'";
							if($doc_id != 'all'){
								$sql.=" AND doc_id = '$doc_id' "; 
							}		
					   
			
						 $ad = $this->timeclock_model->query($sql);
						 
					   $sql1 ="SELECT
								`call_result`,count(`call_result`) as cr
							FROM `call_log`
							WHERE
								date(`cl_created_on`) >='$from' AND 
								date(`cl_created_on`) <='$to' ";
								if($doc_id != 'all'){
								$sql1.=" AND doc_id = '$doc_id' "; 
							}	
							$sql1.="GROUP BY `call_result`";
							
							
						$pd = $this->timeclock_model->query($sql1);
						if($ad['num']>0){
							 $success=true;
							 $tbl.='<thead>
											<tr>
												<th>Patient Name</th>
												<th>Call Result</th>
												<th>Patient Response</th>
												<th>Notes</th>
												<th>Apt Date</th>
												<th>Apt Time</th>
												<th>Adults</th>
												<th>Children</th>
											</tr>
										</thead>
										<tbody>';
							 foreach($ad['data'] as $r){
								 $tbl.='<tr>
											<td>'.$r->first_name.' '.$r->last_name.'</td>
											<td>'.$r->call_result.'</td>
											<td>'.$r->patient_response.'</td>
											<td>'.$r->notes.'</td>
											<td>'.$r->appt_date.'</td>
											<td>'.$r->appt_time.'</td>
											<td>'.$r->adults.'</td>
											<td>'.$r->children.'</td>
										</tr>';
							 } 
							 $arrData = array();
							 foreach($pd['data'] as $r){
								 $arrData[]=array(
										'label'=>$r->call_result,
										'data'=>$r->cr,
									);
							 }
								$pechrt=$arrData; 
						 }else{
							 $msg='No Records Found';
						 }
					}
					 else  if($report_type =='inactivepat'){
						 $sql ="SELECT `first_name`,`last_name`,`reason_for_leave` FROM `call_log` WHERE `patient_response` = 'Discontinued Services' AND `cl_created_on` >='$from' AND `cl_created_on`<='$to';";
			
						 $td = $this->timeclock_model->query($sql);
						
						// print_r($td);exit;
						 if($td['num']>0){
							 $success=true;
							 $tbl.='
										<thead>
											<tr><th>Patient Name</th><th>Reason For Leaving</th></tr>
										</thead>
										<tbody>';
							$total=0;
							$crd_total=0;
							 foreach($td['data'] as $r){
									
								 $tbl.='<tr><td>'.$r->first_name.' '.$r->last_name.'</td><td>'.$r->reason_for_leave.'</td></tr>';
								 
							 }
						 }else{
							 $msg='No Records Found';
						 }
					 }
		 }else{
			 $msg='Invalid Request';
		 }
		 echo json_encode(array('success'=>$success,'msg'=>$msg,'tbl'=>$tbl,'tot'=>$tot_tbl,'pechrt'=>$pechrt));
	}
}
?>