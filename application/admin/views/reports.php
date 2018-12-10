<script language="javascript" type="text/javascript" src="<?=base_url('assets')?>/libs/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url('assets')?>/libs/flot/jquery.flot.pie.js"></script>
<div class="app-body" id="">
<!-- ############ PAGE START-->
<div class="padding">
<div class="row">
		<div class="col-sm-12">
		<div class="form-group col-sm-3">
			<select id="report_type" name="report_type" class="form-control">
				<option value="">Select Report Type</option>
				<option value="timepunches">Time Punches</option>
				<!--option value="breakpunches">Break Punches</option-->	
				<option value="empprfrm">Employee performance</option>	
				<option value="drgoal">Doctor Goal</option>	
				<option value="inactivepat">Inactive Patients</option>	
				<option value="inactivedoc">Inactive Offices</option>	
				<option value="ptentrspn">Patient Response</option>	
				<option value="tmprdct">Team Productivity</option>	
			</select>
			</div>
			<div class="form-group col-sm-3" id="empDiv" style="display:none">
				<select id="emp_id" name="emp_id" class="form-control">
				<option value="">Select Employee</option>
				<option value="all">All</option>
					<?php
						if(count($employees) > 0){
						foreach($employees as $e){
					?>
						<option value="<?=$e->emp_id?>"><?=$e->emp_firstname?> <?=$e->emp_lastname?></option>
					<?php			
						}
					}
					?>	
				</select>
			</div>
			<div class="form-group col-sm-3" id="docDiv" style="display:none">
				<select id="doc_id" name="doc_id" class="form-control">
				<option value="">Select Doctor</option>
				<option value="all">All</option>
					<?php
						if(count($doctors) > 0){
						foreach($doctors as $d){
					?>
						<option value="<?=$d->doc_id?>"><?=$d->doc_username?></option>
					<?php			
						}
					}
					?>	
				</select>
			</div>
			<div class="form-group col-sm-3" id="teamDiv" style="display:none">
				<select id="team_id" name="team_id" class="form-control">
				<option value="">Select Team</option>
				<option value="allTeam">All</option>
					<?php
						if(count($team) > 0){
						foreach($team as $d){
					?>
						<option value="<?=$d->team_id?>"><?=$d->team_name?></option>
					<?php			
						}
					}
					?>	
				</select>
			</div>
			
			
			<div id="reportrange" class=" form-group col-sm-4" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
							  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
							  <span></span> <b class="caret"></b>
						   </div>
						
							<input type="hidden" name="from" id="from" value="">
						   <input type="hidden" name="to" id="to" value="">
			

				<script type="text/javascript">
               $(document).ready(function() {
                  $('#reportrange').daterangepicker(
                     {
                        startDate: moment().subtract('days', 29),
                        endDate: moment(),      
                        showDropdowns: true,
                        showWeekNumbers: true,
                        timePicker: false,
                        timePickerIncrement: 1,
                        timePicker12Hour: true,
                        ranges: {
                           'Today': [moment(), moment()],
                           'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                           'Last 7 Days': [moment().subtract('days', 6), moment()],
                           'Last 30 Days': [moment().subtract('days', 29), moment()],
                           'This Month': [moment().startOf('month'), moment().endOf('month')],
                           'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                        },
                        opens: 'left',
                        buttonClasses: ['btn btn-default'],
                        applyClass: 'btn-small btn-primary',
                        cancelClass: 'btn-small',
                        format: 'MM/DD/YYYY',
                        separator: ' to ',
                        locale: {
                            applyLabel: 'Apply',
                            fromLabel: 'From',
                            toLabel: 'To',
                            customRangeLabel: 'Custom Range',
                            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            firstDay: 1
                        }
                     },
                     function(start, end) {
                      console.log("Callback has been called!");
                      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
						$('#from').val(start.format('YYYY-MM-DD'));
						$('#to').val(end.format('YYYY-MM-DD'));
                     }
                  );
                  //Set the initial state of the picker label
                  $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
				  $('#from').val(moment().subtract('days', 29).format('YYYY-MM-DD'));
				  $('#to').val(moment().format('YYYY-MM-DD'));
               });
               </script>
			<div class="form-group col-sm-2">
				<button class="btn btn-default getData" type="button"><i class="fa fa-refresh fa-fw"></i> Get Result</button>
			</div>
			
		
		</div>
		<div class="col-sm-6 col-md-6" id="chart-div" style="display:none">
			<div class="box">
				<div class="box-header">
					<h3>Pie</h3>
					<small>Full fill</small>
				</div>
				<div class="box-body patpiechart" style="height:600px">
				
				</div>
			  
			  
			</div>
		</div>
		<div class="col-sm-12">
				<br></br>
		
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
			<div class="card-box table-responsive">

				<h4 class="m-t-0 header-title"><b>Report</b></h4>
				
				<p class="text-muted font-13 m-b-30">
				   
				</p>
				<div class="repStats">
					
					</div>
				                                    
			                     
				
			</div>
		</div>
		
	</div>
		
  </div>
  