<div class="app-body" id="managebreakpunch">
<!-- ############ PAGE START-->
<div class="padding">
  <div class="row">
    <div class="col-sm-6">
      <div class="box">
        <div class="box-header">
          <h2>Manage Break Punches</h2>
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
					<button id="btn-start" class="md-btn md-raised m-b-sm w-xs black getbreakpunches" >Get Result</button>
		   </div>
		   
    </div>
	</div>
	<div class="col-sm-6">
      <div class="box">
        <div class="box-header">
          <h2>Time In/Out</h2></br>
		  <div id="msg"></div>
          <small> Break punches</small>
        </div>
        <div class="box-divider m-a-0"></div>
        <table  class="table"  id="breakpunchres" style="display:none;">
          <thead>
            <tr>        
              <th>Time-In</th>
              <th>Time-Out</th>
              <th>Break Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="breakRes"></tbody>
        </table>
	
      </div>
    </div>
	<!--- add new table here-->
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="box">
        <div class="box-header">
          <h2>Add New Break Punch</h2></br>
		    <div id="add_brkpun_msg"></div>
		   <div class="col-sm-4">
				
			  </div>
          <!--<small>Break punches</small>-->
        </div>
        <div class="box-divider m-a-0"></div>
	
        <table class="table">
          
        </table>
		 <form data-ui-jp="parsley" name="add_brkpun_form" id="add_brkpun_form" role="form" method="post" action="<?=base_url('Managebreak/create_breakpunch')?>">
	
			<div class="row m-b" style="margin-left: 0px;">
			  <div class="col-sm-5">
					<select id="emp" name="emp" required="" class="form-control c-select m-y" style="margin-top: -3px;
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
			  <div class="col-sm-5">
					<select id="break_type" name="break_type" required="" class="form-control c-select m-y" style="margin-top: -3px;
    margin-left: 7px;">
                   <option value="">Select Break Type </option>
                   <option value="Work Related">Work Related</option>
                   <option value="Non-Work Related">Non-Work Related</option>
                </select>
			  </div>
			 
		   </div>
		   <div class="row m-b" style="margin-left: 0px;">
			  <div class="col-sm-4">
					
					<input type="text" name="time_in" id="time_in" class="form-control timepicker" placeholder="Time In" required>
			  </div>
			  <div class="col-sm-4">
				<input type="text" name="break_in_date" id="break_in_date" class="form-control datetimepicker" placeholder="Time In Date" required>
			 </div> 
		   </div>
		   <div class="row m-b" style="margin-left: 0px;">
			   <div class="col-sm-4">
					<input type="text" name="time_out" id="time_out" class="form-control timepicker" placeholder="Time Out" required>
			  </div>
			  <div class="col-sm-4">
				<input type="text" name="break_out_date" id="break_out_date" class="form-control datetimepicker" placeholder="Time Out Date" required>
			 </div> 
					<button id=""  type="submit"  class="md-btn md-raised m-b-sm w-xs black" >Add</button>
		   </div>
		   </form>
		   
    </div>
	</div>
	<!--<div class="col-sm-4">
      <div class="box">
        <div class="box-header">
          <h2>Time In/Out</h2>
          <small> Time punches</small>
        </div>
        <div class="box-divider m-a-0"></div>
        <table  class="table"  id="timepunchres" style="display:none;">
          <thead>
            <tr>        
              <th>Time-In</th>
              <th>Time-Out</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="timeRes"></tbody>
        </table>
	
      </div>
    </div>-->
	<!--- add new table here-->
  </div>
<!-- ############ PAGE END-->
</div>
  