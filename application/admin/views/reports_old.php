<div class="app-body" id="managetimepunch">
<!-- ############ PAGE START-->
<div class="padding">
  <div class="row">
    <div class="col-sm-6">
      <div class="box">
        <div class="box-header">
          <h2>Reports</h2>
          <!--<small>Break punches</small>-->
        </div>
        <div class="box-divider m-a-0"></div>
	
        <table class="table">
          
        </table>
		
			<div class="row m-b">&nbsp
			   <div class="col-sm-4">
				<select id="emp_id" name="emp_id" required="" class="form-control c-select m-y" style="margin-top: -3px;
				margin-left: 7px;">
				
					<?php
						if(count($employees) > 0){
						foreach($employees as $e){
					?>
						<option value="<?=$e->emp_id?>"><?=$e->emp_firstname?></option>
					<?php			
						}
					}
					?>	
				</select>
			  </div>
			  <div class="col-sm-4">
				<input type="text" name="date" id="date" class="form-control datetimepicker" placeholder="Date" required>
			 </div> 
					<button id="btn-start" class="md-btn md-raised m-b-sm w-xs black getTimeReports" >Get Result</button>
		   </div>
		   
		   
    </div>
	</div>
	
  </div>
  </div>
  	<div class="col-sm-12">
  	<div class="col-sm-6">
			<div class="card-box table-responsive">
				<h4 class="m-t-0 header-title"><b>Employee Time Sheet</b></h4>
				<p class="text-muted font-13 m-b-30"></p>
				<table id="example1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Time In</th>
							<th>Time In Date</th>                                        
							<th>Time Out</th>                                                                 
							<th>Time Out Date</th>                                        
						</tr>
					</thead>
					
				</table>
			</div>
		</div>	
		<div class="col-sm-6">
			<div class="card-box table-responsive">
				<h4 class="m-t-0 header-title"><b>Employee Break Sheet</b></h4>
				<p class="text-muted font-13 m-b-30"></p>
				<table id="example2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Break Type</th>
							<th>Time In</th>
							<th>Time In Date</th>                                        
							<th>Time Out</th>                                                                 
							<th>Time Out Date</th>                                        
						</tr>
					</thead>
					
				</table>
			</div>
		</div>
		</div>
  