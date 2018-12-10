<div class="app-body">

<div class="padding">
  <div class="box" style="padding-left:30px">
    <div class="box-header">
	<?php
	if($this->session->flashdata('success')){
		?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			  <strong><?=$this->session->flashdata('success')?></strong>
			</div>
		<?php
			}
			if($this->session->flashdata('invalid')){
		?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			  <strong><?=$this->session->flashdata('invalid')?></strong>
			</div>
		<?php
			}
		?>
      <h2>Calls and Appointments Per Hour List</h2>
      
    </div>
    <div class="box-body">
	<div class="row">
	
	
	
	
    </div>	
	         
    </div>
	
    <div>
     
	 	<?php
				 $sql ="SELECT (SELECT count(`emp_id`) FROM call_log
									WHERE "; 
									
										
										$sql.=" emp_id=e.emp_id  AND "; 
									
									$sql.=" date(`cl_created_on`) >='2017-01-01' AND 
									date(`cl_created_on`)<='2018-12-31') AS calls,
								(SELECT count(`emp_id`) FROM call_log
									WHERE "; 
									
										$sql.=" emp_id=e.emp_id  AND "; 
									
									$sql.=" date(`cl_created_on`) >='2017-01-01' AND 
									 date(`cl_created_on`)<='2018-12-31' AND  
									 `patient_response` = 'Schedule Appointment' )   AS apts,e.emp_firstname ,e.emp_lastname,e.emp_id
									 FROM 
										call_log as c 
									JOIN 
										employee as e on e.emp_id = c.emp_id  "; 
									
									$sql.=" GROUP BY e.emp_id; ";
									
									$CI =& get_instance();
							 $td = $CI->timeclock_model->query($sql);
						
						// print_r($td);exit;
					//	 echo $this->db->last_query(); exit;
						 $sql1 ="SELECT 
									*
								FROM 
									`time_clock`
								
								WHERE "; 
									
									$sql1.=" time_in_date>='2017-01-01' AND 
									time_in_date<='2018-12-31'";
						// $wh = $this->model->timeclock_model->query_empwise($sql1);
						 
						  $wh = $CI->timeclock_model->query_empwise($sql1);
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
						 if($td['num']>0){
							?>
							<table class="table m-b-none default footable-loaded footable" data-ui-jp="footable" data-filter="#filter" data-page-size="5"  style="width:1060px;">
							  <thead>
										<tr>
											<th>Employee Name</th>
											<th>Calls Made</th>
											<th>Appointments</th>
											<th>CPH</th>
											<th>APH</th>
										</tr>
									</thead>
										<tbody>
										<?php
							$total=0;
							$crd_total=0;
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
									?>
									<tr>
										<td><?=$r->emp_firstname.' '.$r->emp_lastname?></td>
										<td><?=$r->calls?></td><td><?=$r->apts?></td>
										<td><?=round($calls_per_hr)?></td>
										<td><?=round($apts_per_hr)?></td>
									</tr>
									
									<?php
							 }
						 }else{
							 $msg='No Records Found';
						 }
						 
					 ?>
	 </div>
  </div>
</div>

<!-- ############ PAGE END-->

    </div>
  