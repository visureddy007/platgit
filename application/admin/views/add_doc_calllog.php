<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
  
  
   <div class="col-sm-12">
    <div class="col-sm-6">
      <form data-ui-jp="parsley" name="add_calllog_form" id="add_calllog_form" role="form" method="post"  action="<?=base_url('doctor/create_call_log/'.$doc_id)?>">
	  <div id="add_calllog_msg"></div>
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
        <div class="box">
          <div class="box-header">
            <h2>Add Call Log</h2> 
          </div>
		  <?php 
		    if($doc_id){
		  ?>
		  <div class="col-md-4 col-sm-4">
			<p><a href="<?=base_url('doctor/view/'.$doc_id)?>" class="btn btn-sm black">Schedule Specific</a></p>
		  </div>
			<?php }?>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>
			
			 <?php 
				if(!isset($doc_id)){
			  ?>
           <div class="row m-b">
			    <div class="col-sm-12"> 
                  <select id="doc_id" name="doc_id" required="" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
                   <option value="">Select Doctor</option>
						<?php
							if(count($doctors) > 0){
								foreach($doctors as $c){
						?>
							<option value="<?=$c->doc_id?>"><?=$c->doc_office_name?></option>
						<?php			
								}
							
							}
						?>	
                </select>
                </div>
              </div> 
<?php }?>
			  
              <div class="row m-b">
				<div class="col-sm-12">
					<div class="col-sm-6">
					  <label>First Name</label>
					  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
					</div>
					 <div class="col-sm-6">
					  <label>Last Name</label>
					  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
					</div>
				</div>
				   
              </div>
			
			 <div class="row m-b">
				 <div class="col-sm-9"> 			 
					  <select required="" name="call_result" id="call_result" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
						<option value="">Select Call Result</option>
						<option value="Contact">Contact</option>
						<option value="Busy">Busy</option>
						<option value="Wrong Number">Wrong Number</option>
						<option value="No Answer">No Answer</option>
						<option value="Three Tone">Three Tone</option>
						<option value="Other">Other</option>
					</select>
				  </div>
			</div>
			 <div class="row m-b"  id="req_att" style="display:none">
				<label class="col-lg-12 control-label " for="userName">Requires Attention</label>
				<div class="col-lg-6">
				</label>&nbsp;&nbsp;&nbsp;
				<label class="ui-radio-inline">
					<input type="radio" name="requires_attention" id="requires_attention" value="Yes" class="required" aria-required="true"> 
					<span>Yes</span>
				</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label class="ui-radio-inline">
					<input type="radio" name="requires_attention" id="requires_attention" value="No" class="required" aria-required="true" checked="checked"> 
					<span>No</span>
				</label>
				<label id="ctype-error" class="error" for="requires_attention"></label>
				</div>

		      </div> 
			  
			  <div class="row m-b" id="pat_resp" style="display:none">
				 <div class="col-sm-9"> 			 
					  <select required="" name="patient_response" id="patient_response" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
						<option value="">Select Patient Response</option>
						<option value="Schedule Appointment"> Schedule Appointment</option>
						<option value="Discontinued Services">Discontinued Services</option>
						<option value="Other">Other</option>
						<option value="PR Call back">PR Call back</option>
						<option value="Patient Call back"> Patient Call back</option>
						<option value="Rescheduled Appointment">Rescheduled Appointment</option>
					</select>
				  </div>
			</div>
			
			 <div class="row m-b" id="nts"  style="display:none">
                <div class="col-sm-9">
                  <label>Notes</label>
                  <textarea type="text" name="notes" id="notes" class="form-control" placeholder="Notes" ></textarea>
                </div>
             </div>
			 
			  <div class="row m-b" id="rfl" style="display:none">
				 <div class="col-sm-9"> 			 
					  <select required="" name="reason_for_leave" id="reason_for_leave" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
						<option value="">Select Reason For Leaving</option>
						<option value="Not Leaving"> Not Leaving</option>
						<option value="Money">Money</option>
						<option value="Insurance">Insurance</option>
						<option value="Emergency only">Emergency only</option>
						<option value="Moved">Moved</option>
						<option value="Unsatisfied">Unsatisfied</option>
						<option value="Miscellaneous">Miscellaneous</option>
					</select>
				  </div>
			</div>
			
			 <div class="row m-b" id="apt" style="display:none">
                <div class="col-sm-12">
                <div class="col-sm-6">
                  <label>Appointment Date</label>
                  <input type="text" name="appt_date" id="appt_date" class="form-control datetimepicker" placeholder="Appointment Date" required>
                </div>
				<div class="col-sm-6">
                  <label>Appointment Time</label>
                  <input type="text" name="appt_time" id="appt_time" class="form-control timepicker1" placeholder="Appointment Time" required>
                </div>
                </div>
             </div>
		
			 <div class="row m-b" id="ac" style="display:none">
                <div class="col-sm-12">
                <div class="col-sm-6">
                  <label>Adults</label>
                  <input type="text" name="adults" id="adults" class="form-control" placeholder="Adults">
                </div>
				 <div class="col-sm-6">
                  <label>Children</label>
                  <input type="text" name="children" id="children" class="form-control" placeholder="Children">
                </div>
                </div>
             </div>
			 
			</div>
          <div class=" p-a text-right">
            <button type="submit" class="btn black">Submit</button>
			<a class="btn danger" href="<?=base_url('team')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
	
	 <div class="col-sm-3">
     
        <div class="box">
          <div class="box-header">
            <h2>Employee Details</h2>
          </div>
          <div class="box-body">
            <p class="text-muted"></p>                        
              <div class="panel-body">
						<div class="table-responsive">
						<div id="msg"></div>
							<table class="table table-striped table-bordered table-hover">
									<thead>
							<tr>
								                                                                            
								<th>Total Calls</th>
								<th>Total Appointments</th>
							</tr>
						</thead>
						<tbody>
						<?php
									if ($calls == NULL) {
									?>
										<tr align="center"> <td colspan="3">No Data to display</td></tr>
									<?php
									} else {
										foreach ($calls as $row) {
										?>
											<tr>
											
												<td><?php echo $row->calls; ?></td>
												<td><?php echo $row->apts; ?></td>
												
											</tr>
										<?php
										}
									}
									?>             
						</tbody>
					</table>
				</div>
													<!-- /.table-responsive -->
			</div>
          </div>
     
    </div>
    </div>
	
	
	
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  