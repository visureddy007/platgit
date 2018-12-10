<div class="app-body" id="timeclock">
<!-- ############ PAGE START-->
	<div class="padding">
	  <div class="row">
    <div class="col-sm-9">
      <div class="box">
        <div class="box-header">
          <h2>Time In/Out</h2>
          <small> Time punches</small>
        </div>
        <div class="box-divider m-a-0"></div>
        <table id="my_table" data-ui-jp="dataTable" class="table table-striped b-t b-b">
          <thead>
            <tr>        
              <th>Time-In</th>
              <th>Time-Out</th>
            </tr>
          </thead>
          <tbody>
		  <?php
			if ($timepunches == NULL) {
			?>
				
			<?php
			} else {
				foreach ($timepunches as $row) {
				?>
            <tr>            
              <td id="in_<?=$row->tc_id ?>"><?php echo $row->time_in; ?>&nbsp;<?php echo date("m-d-Y", strtotime($row->time_in_date)); ?></td>
              <td id="out_<?=$row->tc_id ?>"><p <?=($row->time_out == "00:00:00")?"style='color:red'":''?>><?php echo $row->time_out; ?>&nbsp;<?php echo $row->time_out_date; ?></p></td>
            </tr>
			<?php
					}
				}
				?>          
          </tbody>
        </table>
		
		<?php 
		  if(isset($tp)){
		?>
		&nbsp <button id="btn-in" data-emp = "<?php echo $this->session->userdata("platinum_user_id")?>" data-date="<?php echo date("Y-m-d"); ?>" class="md-btn md-raised m-b-sm w-xs indigo timeout" data-id="<?=$tp['tc_id']?>">Time-Out</button>
		
		<?php 
		  }else{
		?>
		&nbsp <button id="btn-in" data-emp = "<?php echo $this->session->userdata("platinum_user_id")?>" data-date = "<?php echo date("Y-m-d"); ?>" class="md-btn md-raised m-b-sm w-xs indigo timein">Time-In</button>
		 <?php }?>
		
      </div>
    </div>
	<!--- add new table here-->
	
	<!--<div class="col-sm-6">
      <div class="box">
        <div class="box-header">
          <h2>Break Start/End</h2>
          <small>Break punches</small>
        </div>
        <div class="box-divider m-a-0"></div>
		<input type="hidden" id="tc_id" name="tc_id">
        <table id="break_table" data-ui-jp="dataTable" class="table table-striped b-t b-b">
          <thead>
            <tr>        
              <th>Start</th>
              <th>End</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
			   <?php
				if ($break == NULL) {
				?>
					
				<?php
				} else {
					foreach ($break as $row) {
					?>
				<tr>            
				  <td id="in_<?=$row->bp_id ?>"><?php echo $row->time_in; ?>&nbsp;<?php echo $row->break_in_date; ?></td>
				  <td id="out_break<?=$row->bp_id ?>"><?php echo $row->time_out; ?>&nbsp;<?php echo $row->break_out_date; ?></td>
				  <td id="type_<?=$row->bp_id ?>"><?php echo $row->break_type; ?></td>
				</tr>
				<?php
						}
					}
					?>          
          </tbody>
        </table>  <div class="row m-b">
		&nbsp  <div class="col-sm-5"> 
		        <select id="break_type" name="break_type" required="" class="form-control c-select m-y" style="margin-top: -3px;
    margin-left: 7px;">
                   <option value="">Select Type </option>
                   <option value="Work Related">Work Related</option>
                   <option value="Non-Work Related">Non-Work Related</option>
                </select>
				</div>
		<?php 
		  if(isset($bp)){
		?>
		<button id="btn-start" data-emp = "<?php echo $this->session->userdata("platinum_user_id")?>" data-date = "<?php echo date("Y-m-d"); ?>" class="md-btn md-raised m-b-sm w-xs purple breakstop" data-id="<?=$bp['bp_id']?>">Stop Break</button>
		
		<?php 
		  }else{
		?>
			<button id="btn-start" data-emp = "<?php echo $this->session->userdata("platinum_user_id")?>"  data-date = "<?php echo date("Y-m-d"); ?>" class="md-btn md-raised m-b-sm w-xs purple breakstart">Start Break</button>
		 <?php }?>
				
      </div>
    </div>
	
    
    </div>-->
  
	</div>

<!-- ############ PAGE END-->
</div>
  