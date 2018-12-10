<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="add_doc_form" id="add_doc_form" role="form" method="post" action="<?=base_url('doctor/create')?>">
	  <div id="add_doc_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Add Doctor</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>User name</label>
                  <input type="text" name="doc_username" id="doc_username" class="form-control" placeholder="User name" required>
                </div>
                <div class="col-sm-6">
                  <label>Email</label>
                  <input type="email" name="doc_email" id="doc_email" class="form-control" placeholder="Enter email" required>
                </div>
              </div>
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Password</label>
                  <input type="password" name="doc_password" id="doc_password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="col-sm-6">
                  <label>Confirm Password</label>
                  <input type="password" name="cnf_password" id="cnf_password" class="form-control" placeholder="Re-enter password" required>
                </div>
              </div>
			 <!-- <div class="row m-b">
			  <div class="col-sm-6">
                  <label>First Name</label>
                  <input type="text" name="doc_firstname" id="doc_firstname" class="form-control" placeholder="Enter first name" required>
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input type="text" name="doc_lastname" id="doc_lastname" class="form-control" placeholder="Enter last name" required>
                </div>
              </div>-->

			    <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Address Line 1</label>
                  <input type="text" name="doc_add1" id="doc_add1" class="form-control" placeholder="Enter address line 1" required>
                </div>
                <div class="col-sm-6">
                  <label>Address Line 2</label>
                  <input type="text" name="doc_add2" id="doc_add2" class="form-control" placeholder="Enter address line 2" required>
                </div>
              </div>
			   <div class="row m-b">
			    <div class="col-sm-6"> 
				
                  <select id="state_id" name="state_id" required="" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
                   <option value="">Select State</option>
						<?php
							if(count($states) > 0){
								foreach($states as $c){
						?>
							<option value="<?=$c->id?>"><?=$c->name?></option>
						<?php			
								}
							
							}
						?>	
                </select>
                </div>
			  <div class="col-sm-6">
                  <label>City</label>
                  <input type="text" name="city" id="city" class="form-control" placeholder="Enter city" required>
                </div>
               
              </div> 
			 <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Zip Code</label>
                  <input type="text" name="zip" id="zip" class="form-control" placeholder="Enter zip code" required>
                </div>
                <div class="col-sm-6">
                  <label>Phone</label>
                  <input type="text" name="doc_phone" id="doc_phone" class="form-control" placeholder="Enter phone" required>
                </div>
              </div>
			
			   <div class="row m-b">
				  <div class="col-sm-6"> 				
					   <select required="" name="doc_timezone" id="doc_timezone" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
							<option value="">Please choose Time zone</option>
								<?php
									if(count($timezone) > 0){
										foreach($timezone as $t){
								?>
									<option value="<?=$t->id?>"><?=$t->timezone?></option>
								<?php			
										}
									
									}
								?>	
						</select>
				  </div>
				<div class="col-sm-6">
                  <label>Office Name</label>
                  <input type="text" name="doc_office_name" id="doc_office_name" class="form-control" placeholder="Office Name" required>
                </div>
               
              </div> 
			  
			  <div class="row m-b">
				<div class="col-sm-6">
                  <label>Goal No</label>
                  <input type="text" name="doc_goal_no" id="doc_goal_no" class="form-control" placeholder="Goal No" required>
                </div>
				<div class="col-sm-6">
                  <label class="col-sm-4 form-control-label">Can exceed goal?</label>
				  <div class="col-sm-10">
					<label class="ui-switch data-ui-switch-md info" style="margin-top:9px;">
					  <input type="checkbox" checked="" value="yes" name="doc_can_excgoal" id="doc_can_excgoal" class="has-value">
					  <i></i>
					</label>
				  </div>
                </div>
               
              </div>

			  <div class="row m-b">
				<div class="col-sm-6">
                  <label>Montly Fee</label>
                  <input type="text" name="doc_monthly_fee" id="doc_monthly_fee" class="form-control" placeholder="Montly Fee" required>
                </div>           
              </div>
			 
          </div>
          <div class=" p-a text-right">
            <button type="submit" class="btn black">Submit</button>
			<a class="btn danger" href="<?=base_url('doctor')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  