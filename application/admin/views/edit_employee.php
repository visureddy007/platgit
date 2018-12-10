<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="edit_emp_form" id="edit_emp_form" role="form" method="post" action="<?=base_url('employee/modify/'.$record['emp_id'])?>">
	  <div id="edit_emp_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Edit Employee</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>User name</label>
                  <input type="text" name="emp_username" id="emp_username" class="form-control" placeholder="User name" value="<?=$record['emp_username']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Email</label>
                  <input type="email" name="emp_email" id="emp_email" class="form-control" placeholder="Enter email" value="<?=$record['emp_email']?>" readonly required>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>First Name</label>
                  <input type="text" name="emp_firstname" id="emp_firstname" class="form-control" placeholder="Enter first name" value="<?=$record['emp_firstname']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input type="text" name="emp_lastname" id="emp_lastname" class="form-control" placeholder="Enter last name" value="<?=$record['emp_lastname']?>" required>
                </div>
              </div>

			    <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Address Line 1</label>
                  <input type="text" name="emp_add1" id="emp_add1" class="form-control" placeholder="Enter address line 1" value="<?=$record['emp_add1']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Address Line 2</label>
                  <input type="text" name="emp_add2" id="emp_add2" class="form-control" placeholder="Enter address line 2" value="<?=$record['emp_add2']?>" required>
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
							<option <?=($record['state_id']==$c->id?'selected':'')?> value="<?=$c->id?>"><?=$c->name?></option>
						<?php			
								}
							
							}
						?>	
                </select>
                </div>
			  <div class="col-sm-6">
                  <label>City</label>
                  <input type="text" name="city" id="city" class="form-control" placeholder="Enter city" value="<?=$record['city']?>" required>
                </div>
               
              </div> 
			 <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Zip Code</label>
                  <input type="text" name="zip" id="zip" class="form-control" placeholder="Enter zip code" value="<?=$record['zip']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Phone</label>
                  <input type="text" name="emp_phone" id="emp_phone" class="form-control" placeholder="Enter phone" value="<?=$record['emp_phone']?>" required>
                </div>
              </div>
			
			   <div class="row m-b">
				 <div class="col-sm-6"> 				
					  <select required="" name="emp_role" id="emp_role" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
						<option value="">Please choose role</option>
						<option <?=($record['emp_role']=="Employee")?'selected':''?> value="Employee" >Employee</option>
						<option <?=($record['emp_role']=="Manager")?'selected':''?> value="Manager" >Manager</option>
						<option <?=($record['emp_role']=="Administrator")?'selected':''?> value="Administrator" >Administrator</option>
					</select>
				  </div>
				  <div class="col-sm-6"> 				
					   <select required="" name="emp_timezone" id="emp_timezone" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
							<option  value="">Please choose Time zone</option>
						<?php
							if(count($timezone) > 0){
								foreach($timezone as $t){
						?>
							<option <?=($record['emp_timezone']==$t->id?'selected':'')?> value="<?=$t->id?>"><?=$t->timezone?></option>
						<?php			
								}
							
							}
						?>	</option>
						</select>
				  </div>
               
              </div>  
			  
			  <div class="row m-b">
				  <div class="col-sm-6"> 				
					   <select required="" name="emp_status" id="emp_status" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
							<option  value="">Please select status</option>
							<option <?=($record['emp_status']==1)?'selected':''?> value="1">Active</option>
							<option <?=($record['emp_status']==0)?'selected':''?> value="0">In Active</option>
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
  