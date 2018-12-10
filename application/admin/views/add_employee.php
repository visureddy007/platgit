<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="add_emp_form" id="add_emp_form" role="form" method="post" action="<?=base_url('employee/create')?>">
	  <div id="add_emp_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Add Employee</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>User Name</label>
                  <input type="text" name="emp_username" id="emp_username" class="form-control" placeholder="User name" required>
                </div>
                <div class="col-sm-6">
                  <label>Email</label>
                  <input type="email" name="emp_email" id="emp_email" class="form-control" placeholder="Enter email" required>
                </div>
              </div>
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Password</label>
                  <input type="password" name="emp_password" id="emp_password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="col-sm-6">
                  <label>Confirm Password</label>
                  <input type="password" name="cnf_password" id="cnf_password" class="form-control" placeholder="Re-enter password" required>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>First Name</label>
                  <input type="text" name="emp_firstname" id="emp_firstname" class="form-control" placeholder="Enter first name" required>
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input type="text" name="emp_lastname" id="emp_lastname" class="form-control" placeholder="Enter last name" required>
                </div>
              </div>

			    <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Address Line 1</label>
                  <input type="text" name="emp_add1" id="emp_add1" class="form-control" placeholder="Enter address line 1" required>
                </div>
                <div class="col-sm-6">
                  <label>Address Line 2</label>
                  <input type="text" name="emp_add2" id="emp_add2" class="form-control" placeholder="Enter address line 2" required>
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
                  <input type="text" name="emp_phone" id="emp_phone" class="form-control" placeholder="Enter phone" required>
                </div>
              </div>
			
			   <div class="row m-b">
				 <div class="col-sm-6"> 				
					  <select required="" name="emp_role" id="emp_role" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
						<option value="">Please choose role</option>
						<option value="Employee">Employee</option>
						<option value="Manager">Manager</option>
						<option value="Administrator">Administrator</option>
					</select>
				  </div>
				  <div class="col-sm-6"> 				
						 <select id="emp_timezone" name="emp_timezone" required="" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
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
               
              </div>
			 
          </div>
          <div class=" p-a text-right">
            <button type="submit" class="btn black">Submit</button>
		<a class="btn danger" href="<?=base_url('employee')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  