<div class="app-body">
<!-- ############ PAGE START-->
  <div class="row-col">
	<div class="col-lg b-r">
	  <?php if($this->session->userdata("platinum_user_type") == "ADMIN"){ ?>
	  	<div class="padding">
				  <div class="box" style="padding-left:30px">
					<div class="box-header">
					
					  <h2>Employee Statistics</h2>
					  
					</div>
					
					
					<div>
					
					 
					  <div class="box-divider m-a-0"></div>
						<table class="table table-striped b-t b-b">
										<thead>
											<tr>
												<th>Employee</th>
												<th>CPH</th>
												<th>APH</th>
												
											</tr>
										</thead>
										<?php
										$sql ="SELECT (SELECT count(`emp_id`) FROM call_log
												WHERE "; 
										$sql.=" emp_id=e.emp_id   "; 
										$sql.=" ) AS calls,(SELECT count(`emp_id`) FROM call_log
												WHERE "; 
										$sql.=" emp_id=e.emp_id  "; 
										$sql.="  AND  `patient_response` = 'Schedule Appointment' )   AS apts,e.emp_firstname ,e.emp_lastname,e.emp_id
												 FROM 
													call_log as c 
												JOIN 
													employee as e on e.emp_id = c.emp_id  "; 
										$sql.=" GROUP BY e.emp_id; ";
										$td = $this->timeclock_model->query($sql);
										$sql1 ="SELECT 
													*
												FROM 
													`time_clock`
												 "; 
						 $wh = $this->timeclock_model->query_empwise($sql1);
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
						
							$total=0;
							$crd_total=0;
							$total_calls_made = 0;
							$total_apts_made = 0;
							$total_cph_made = 0;
							 foreach($td['data'] as $r){
									$tt = (isset($total_time[$r->emp_id]))?$total_time[$r->emp_id]:0;
									$wrkhr_in_sec =  strtotime("1970-01-01 ".$tt." UTC");
									 if($wrkhr_in_sec==""){
											$calls_per_hr  = 0;
											$apts_per_hr  = 0;
										}else if($wrkhr_in_sec != ""){
											$clls_pr_sc = bcdiv($r->calls,$wrkhr_in_sec,6);
											$calls_per_hr = bcmul($clls_pr_sc,3600,2);
											$apts_pr_sc = bcdiv($r->apts,$wrkhr_in_sec,6);
											$apts_per_hr = bcmul($apts_pr_sc,3600,2); 
										} ?>
									
										<tr>
											    <td><?php echo $r->emp_firstname .''.$r->emp_lastname ?></td>
												<td><?php echo round($calls_per_hr) ?></td>
												<td><?php echo round($apts_per_hr) ?></td>
											</tr>
									<?php } ?>
						
						</table>
					 </div>
				  </div>
				</div>
		<div class="row no-gutter">
			<div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-ios-grid-view text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$doc['num']?></h2>
							<a href="<?=base_url('doctor')?>"><p class="text-muted m-b-md">Offices </p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[2,3,2,2,1,3,6,3,2,1], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-document text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$actdoc['num']?></h2>
							<a href="<?=base_url('doctor/active')?>"><p class="text-muted m-b-md">Active Offices </p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[1,1,0,2,3,4,2,1,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$inactdoc['num']?></h2>
						<a href="<?=base_url('doctor/inactive')?>"><p class="text-muted m-b-md">In-Active Offices </p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
			<div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-ios-grid-view text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$emp['num']?></h2>
						<a href="<?=base_url('employee')?>"><p class="text-muted m-b-md">Employees</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[2,3,2,2,1,3,6,3,2,1], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	    </div>
	  <?php } ?>
		<div class="row no-gutter">
			
	        <div class="col-xs-6 col-sm-6 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-up text-primary m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-document text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$todayscalls['num']?></h2>
						<a href="<?=base_url('doctor/calllogtoday')?>"><p class="text-muted m-b-md">Today's Calls</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[1,1,0,2,3,4,2,1,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-6 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$todaysapts['num']?></h2>
						<a href="<?=base_url('doctor/aptstoday')?>"><p class="text-muted m-b-md">Today's Appointments</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
			<div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$cph?></h2>
						<a href="<?=base_url('doctor/aphcphlist')?>"><p class="text-muted m-b-md">Calls per hour</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$aph?></h2>
						<a href="<?=base_url('doctor/aphcphlist')?>"><p class="text-muted m-b-md">Appointments per hour</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$con_per?> %</h2>
						<a ><p class="text-muted m-b-md">Conversion %</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
			<div class="col-xs-6 col-sm-3 b-r b-b">
					<div class="padding">
						<div>
							<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
							<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
						</div>
						<div class="text-center">
							<h2 class="text-center _600"><?=$total_apts?> </h2>
							<a href="<?=base_url('doctor/calllog')?>"><p class="text-muted m-b-md">Total Appointments </p></a>
							<div>
								<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
							</div>
						</div>
					</div>
				</div>
				
		<?php if($this->session->userdata("platinum_user_type") != "ADMIN"){ ?>		
			<div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$cpht?></h2>
						<a href="<?=base_url('doctor/aphcphlist')?>"><p class="text-muted m-b-md">Team Calls per hour</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$apht?></h2>
						<a href="<?=base_url('doctor/aphcphlist')?>"><p class="text-muted m-b-md">Team Appointments per hour</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
	        <div class="col-xs-6 col-sm-3 b-r b-b">
				<div class="padding">
					<div>
						<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
						<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
					</div>
					<div class="text-center">
						<h2 class="text-center _600"><?=$con_per_team?> %</h2>
						<a ><p class="text-muted m-b-md">Team Conversion %</p></a>
						<div>
							<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
						</div>
					</div>
				</div>
	        </div>
			<div class="col-xs-6 col-sm-3 b-r b-b">
					<div class="padding">
						<div>
							<span class="pull-right"><i class="fa fa-caret-down text-danger m-y-xs"></i></span>
							<span class="text-muted l-h-1x"><i class="ion-pie-graph text-muted"></i></span>
						</div>
						<div class="text-center">
							<h2 class="text-center _600"><?=$total_apts_team?> </h2>
							<a href="<?=base_url('doctor/calllog')?>"><p class="text-muted m-b-md">Team Total Appointments </p></a>
							<div>
								<span data-ui-jp="sparkline" data-ui-options="[9,2,5,5,7,4,4,3,2,2], {type:'line', height:20, width: '60', lineWidth:1, valueSpots:{'0:':'#818a91'}, lineColor:'#818a91', spotColor:'#818a91', fillColor:'', highlightLineColor:'rgba(120,130,140,0.3)', spotRadius:0}" class="sparkline inline"></span>
							</div>
						</div>
					</div>
				</div>
	    
		<?php } ?>
	    
        </div>
		 <?php if($this->session->userdata("platinum_user_type") == "ADMIN"){ ?>
		 
						<div class="padding">
							<div class="row">
								<div class="col-sm-6">
									<div class="box">
									  <div class="box-header">
										<h3>Calls</h3>
									   
									  </div>
									  <div class="box-tool">
										<ul class="nav">
										  <li class="nav-item inline">
											<a class="nav-link">
											  <i class="ion-android-sync m-x-xs"></i>
											</a>
										  </li>
										  <!--<li class="nav-item inline dropdown">
											<a class="nav-link" data-toggle="dropdown">
											  <i class="ion-android-menu m-x-xs"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-scale pull-right">
											  <a class="dropdown-item" href="#">This week</a>
											  <a class="dropdown-item" href="#">This month</a>
											  <a class="dropdown-item" href="#">This week</a>
											  <div class="dropdown-divider"></div>
											  <a class="dropdown-item">Today</a>
											</div>
										  </li>-->
										</ul>
									  </div>
										<div>
										
										
										<canvas data-ui-jp="chart" data-ui-options="
											{
											  type: 'line',
											  data: {
												  
												  
													 labels: ['<?=(implode("','",$mnt))?>'],
													
												  datasets: [
													  {
														  label: 'Calls',
														  data: [<?=(implode(",",$cls))?>],
														  fill: true,
														  backgroundColor: '#FF9900',
														  borderColor: '#FF9900',
														  borderWidth: 2,
														  borderCapStyle: 'butt',
														  borderDash: [],
														  borderDashOffset: 0.0,
														  borderJoinStyle: 'miter',
														  pointBorderColor: '#FF9900',
														  pointBackgroundColor: '#fff',
														  pointBorderWidth: 2,
														  pointHoverRadius: 4,
														  pointHoverBackgroundColor: '#FF9900',
														  pointHoverBorderColor: '#fff',
														  pointHoverBorderWidth: 2,
														  pointRadius: [0,4,4,4,4,4,0],
														  pointHitRadius: 10,
														  spanGaps: false
													  }
												  ]
											  },
											  options: {
												scales: {
													xAxes: [{
													   display: false
													}],
													yAxes: [{
													   display: false,
													   ticks:{
														 min: 0,
														 max: 60
													   }
													}]
												},
												legend: {
													display: false
												}
											  }
											}
											" height="150">
											</canvas>
										
										</div>
										<div class="box-body info text-center p-b-md">
											
											<span>Calculated in last 6 Months</span>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="box">
									  <div class="box-header">
										<h3>Appointments</h3>
									  
									  </div>
									  <div class="box-tool">
										<ul class="nav">
										  <li class="nav-item inline">
											<a class="nav-link">
											  <i class="ion-android-sync m-x-xs"></i>
											</a>
										  </li>
										 
										</ul>
									  </div>
										<div>
										<canvas data-ui-jp="chart" data-ui-options="
											{
											  type: 'line',
											  data: {
												 labels: ['<?=(implode("','",$apt_mnt))?>'],
												  datasets: [
													  {
														  label: 'Appointments',
														  data: [<?=(implode(",",$apt_cls))?>],
														  fill: true,
														  backgroundColor: '#E7E7E7',
														  borderColor: '#E7E7E7',
														  borderWidth: 2,
														  borderCapStyle: 'butt',
														  borderDash: [],
														  borderDashOffset: 0.0,
														  borderJoinStyle: 'miter',
														  pointBorderColor: '#E7E7E7',
														  pointBackgroundColor: '#fff',
														  pointBorderWidth: 2,
														  pointHoverRadius: 4,
														  pointHoverBackgroundColor: '#E7E7E7',
														  pointHoverBorderColor: '#fff',
														  pointHoverBorderWidth: 2,
														  pointRadius: [0,4,4,4,4,4,0],
														  pointHitRadius: 10,
														  spanGaps: false
													  }
												  ]
											  },
											  options: {
												scales: {
													xAxes: [{
													   display: false
													}],
													yAxes: [{
													   display: false,
													   ticks:{
														 min: 0,
														 max: 100
													   }
													}]
												},
												legend: {
													display: false
												}
											  }
											}
											" height="150">
											</canvas>
										</div>
										<div class="box-body danger text-center p-b-md">
											
											<span>Calculated in last 6 Months</span>
										</div>
									</div>
								</div>
								
								<!--<div class="col-sm-4">
									<div class="box">
									  <div class="box-header">
										<h3>Responses</h3>
										<small>Calculated in last 7 days</small>
									  </div>
									  <div class="box-tool">
										<ul class="nav">
										  <li class="nav-item inline">
											<a class="nav-link">
											  <i class="ion-android-sync m-x-xs"></i>
											</a>
										  </li>
										  <li class="nav-item inline dropdown">
											<a class="nav-link" data-toggle="dropdown">
											  <i class="ion-android-menu m-x-xs"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-scale pull-right">
											  <a class="dropdown-item" href="#">This week</a>
											  <a class="dropdown-item" href="#">This month</a>
											  <a class="dropdown-item" href="#">This week</a>
											  <div class="dropdown-divider"></div>
											  <a class="dropdown-item">Today</a>
											</div>
										  </li>
										</ul>
									  </div>
										<div>
										<canvas data-ui-jp="chart" data-ui-options="
											{
											  type: 'line',
											  data: {
												  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
												  datasets: [
													  {
														  label: 'Dataset',
														  data: [10, 15, 25, 40, 60, 75, 80],
														  fill: true,
														  backgroundColor: '#22b66e',
														  borderColor: '#22b66e',
														  borderWidth: 2,
														  borderCapStyle: 'butt',
														  borderDash: [],
														  borderDashOffset: 0.0,
														  borderJoinStyle: 'miter',
														  pointBorderColor: '#22b66e',
														  pointBackgroundColor: '#fff',
														  pointBorderWidth: 2,
														  pointHoverRadius: 4,
														  pointHoverBackgroundColor: '#22b66e',
														  pointHoverBorderColor: '#fff',
														  pointHoverBorderWidth: 2,
														  pointRadius: [0,4,4,4,4,4,0],
														  pointHitRadius: 10,
														  spanGaps: false
													  }
												  ]
											  },
											  options: {
												scales: {
													xAxes: [{
													   display: false
													}],
													yAxes: [{
													   display: false,
													   ticks:{
														 min: 0,
														 max: 120
													   }
													}]
												},
												legend: {
													display: false
												}
											  }
											}
											" height="150">
											</canvas>
										</div>
										<div class="box-body success text-center p-b-md">
											<span class="dark-white rounded m-r p-x p-y-xs text-success"><i class="fa fa-caret-up"></i> 85%</span>
											<span>Over last Month</span>
										</div>
									</div>
								</div>-->
							</div>

							</div>
						
			<div class="padding">
				  <div class="box" style="padding-left:30px">
					<div class="box-header">
					
					  <h2>Goals</h2>
					  
					</div>
					
					
					<div>
					
					 
					  <div class="box-divider m-a-0"></div>
						<table class="table table-striped b-t b-b">
										<thead>
											<tr>
												<th>Office Name</th>
												<th>Goals</th>
												<th>Calls</th>
												<th>Appointment</th>
												<th>% Achieved</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$cd = $this->doctor_model->selectAllCalls(); 
											$ap = $this->doctor_model->selectAllApts(); 
										?>
										<?php 
										$calls = array();
											 if($cd['num']>0){
												 foreach($cd['data'] as $c){
													 $calls[$c->doc_id]=$c->total_calls;
												 }
											 }
										?>
										<?php 
										$apts = array();
											 if($ap['num']>0){
												 foreach($ap['data'] as $c){
													 $apts[$c->doc_id]=$c->total_apts;
												 }
											 }
										?>
										<?php
										if ($doc['data'] == NULL) {
										?>
											<tr align="center"> <td colspan="9">No Data to display</td></tr>
										<?php
										} else {
											$total_calls = 0;
											$total_apts = 0;
											foreach ($doc['data'] as $r) {
												$calls_by_doc = (isset($calls[$r->doc_id]))?$calls[$r->doc_id]:0;
												$apts_doc = (isset($apts[$r->doc_id]))?$apts[$r->doc_id]:0;
												$ach = bcdiv($apts_doc,$r->doc_goal_no,2);
												if($apts_doc == 0){
													$ach_per = 0;
												}else{
													$ach_per = bcmul($ach,100,2);
												}
											?>
												<tr>
													<td><a href= "<?=base_url('doctor/calllog/'.$r->doc_id)?>"> <?php echo $r->doc_office_name; ?></a></td>										
													<td><?php echo $r->doc_goal_no; ?></td>										
													<td><?php echo $calls_by_doc; ?></td>										
													<td><?php echo $apts_doc; ?></td>										
													<td><?php echo $ach_per.' %'; ?></td>										
												</tr>
											<?php
												$total_calls = bcadd($total_calls,$calls_by_doc,2);
												$total_apts = bcadd($total_apts,$apts_doc,2);
											} ?>
											 <tr>
												<th>Average Calls</th>
												<th>Average Appointments</th>
												<th>Total Calls</th>
												<th>Total Appointments</th>
											</tr>
											<tr>
												<th><?=round(bcdiv($total_calls,count($doc['data']),2))?></th>
												<th><?=round(bcdiv($total_apts,count($doc['data']),2))?></th>
												<th><?=round($total_calls)?></th>
												<th><?=round($total_apts)?></th>
											</tr>
											<?php
												   
											
										}
										?>                                       
										</tbody>
									</table>
								
					 </div>
				  </div>
				</div>
				
			
		 <?php } ?>

	</div>
	<div class="col-lg w-lg w-auto-md white bg">
		<div>
			<div class="p-a">
				<h6 class="text-muted m-a-0">Quick chat</h6>
				<input type="hidden" id="current_id" value="<?=$this->session->userdata('platinum_user_name')?>" />
				<input type="hidden" id="current_name" value="<?=$this->session->userdata('platinum_emp_name')?>" />
			</div>
			<?php
				if(count($empChat) > 0){
					foreach($empChat['data'] as $c){
			?>
			<div class="list inset">
				<a class="doActnForChat list-item" data-toggle="modal" data-target="#chat" data-dismiss="modal" data-empid='<?=$c->emp_username?>' data-empname='<?=$c->emp_firstname?>'>
		            <span class="list-left">
		            	<span class="avatar">
		            		<i class="on avatar-center no-border"></i>
		                	<img src="<?=base_url('assets')?>/images/a1.jpg" class="w-20" alt=".">
		                </span>
		            </span>
		            <span class="list-body text-ellipsis">
		            	<?=$c->emp_firstname?>
		            </span>
	            </a>
	        </div>
			<?php			
					}
				
				}
			?>	
	       </div>
	</div>

	</div>
	<div class="modal fade inactive" id="chat" data-backdrop="false">
	  <div class="modal-right w-xxl dark-white b-l">
		  <div class="row-col">
			<a data-dismiss="modal" class="pull-right text-muted text-lg p-a-sm m-r-sm">&times;</a>
			<div class="p-a b-b">
			  <span class="h5" id="empName"></span>
			</div>
			<div class="row-row light">
			  <div class="row-body scrollable hover">
				<div class="row-inner chatbox">
				  <div class="p-a-md">
					<div class="m-b">
					  <a href="#" class="pull-left w-40 m-r-sm"><img src="<?=base_url('assets')?>/images/a2.jpg" alt="..." class="w-full img-circle"></a>
					  <div class="clear">
						<div class="p-a p-y-sm dark-white inline r">
						  Hi John, What's up...
						</div>
						<div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 2 minutes ago</div>
					  </div>
					</div>
					<div class="m-b">
					  <a href="#" class="pull-right w-40 m-l-sm"><img src="<?=base_url('assets')?>/images/a3.jpg" class="w-full img-circle" alt="..."></a>
					  <div class="clear text-right">
						<div class="p-a p-y-sm success inline text-left r">
						  Lorem ipsum dolor soe rooke..
						</div>
						<div class="text-muted text-xs m-t-xs">1 minutes ago</div>
					  </div>
					</div>
					<div class="m-b">
					  <a href="#" class="pull-left w-40 m-r-sm"><img src="<?=base_url('assets')?>/images/a2.jpg" alt="..." class="w-full img-circle"></a>
					  <div class="clear">
						<div class="p-a p-y-sm dark-white inline r">
						  Good!
						</div>
						<div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 5 seconds ago</div>
					  </div>
					</div>
					<div class="m-b">
					  <a href="#" class="pull-right w-40 m-l-sm"><img src="<?=base_url('assets')?>/images/a3.jpg" class="w-full img-circle" alt="..."></a>
					  <div class="clear text-right">
						<div class="p-a p-y-sm success inline text-left r">
						  Dlor soe isep..
						</div>
						<div class="text-muted text-xs m-t-xs">Just now</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
  	    </div>
  	    <div class="p-a b-t">
  	      
  	        <div class="input-group">
  	          <input type="text" class="form-control chatmsg" placeholder="Say something">
  	          <span class="input-group-btn">
  	            <button class="btn white b-a no-shadow sentbutton" type="button">SEND</button>
  	          </span>
  	        </div>
  	    </div>
  	  </div>
  </div>
</div>



<!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->

  
  <!-- ############ SWITHCHER START-->
    <!-- ############ SWITHCHER END-->

<!-- ############ LAYOUT END-->
  </div>