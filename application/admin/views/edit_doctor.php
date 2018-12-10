<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="edit_doc_form" id="edit_doc_form" role="form" method="post" action="<?=base_url('doctor/modify/'.$record['doc_id'])?>">
	  <div id="edit_doc_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Edit Doctor</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>User Name</label>
                  <input type="text" name="doc_username" id="doc_username" class="form-control" placeholder="User name" value="<?=$record['doc_username']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Email</label>
                  <input type="email" name="doc_email" id="doc_email" class="form-control" placeholder="Enter email" value="<?=$record['doc_email']?>" readonly required>
                </div>
              </div>
			  <!--<div class="row m-b">
			  <div class="col-sm-6">
                  <label>First Name</label>
                  <input type="text" name="doc_firstname" id="doc_firstname" class="form-control" placeholder="Enter first name" value="<?=$record['doc_firstname']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input type="text" name="doc_lastname" id="doc_lastname" class="form-control" placeholder="Enter last name" value="<?=$record['doc_lastname']?>" required>
                </div>
              </div>-->

			    <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Address Line 1</label>
                  <input type="text" name="doc_add1" id="doc_add1" class="form-control" placeholder="Enter address line 1" value="<?=$record['doc_add1']?>" required>
                </div>
                <div class="col-sm-6">
                  <label>Address Line 2</label>
                  <input type="text" name="doc_add2" id="doc_add2" class="form-control" placeholder="Enter address line 2" value="<?=$record['doc_add2']?>" required>
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
                  <input type="text" name="doc_phone" id="doc_phone" class="form-control" placeholder="Enter phone" value="<?=$record['doc_phone']?>" required>
                </div>
              </div>
			
			   <div class="row m-b">
				
				  <div class="col-sm-6"> 				
					   <select required="" name="doc_timezone" id="doc_timezone" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
							<option  value="">Please choose Time zone</option>
						<?php
							if(count($timezone) > 0){
								foreach($timezone as $t){
						?>
							<option <?=($record['doc_timezone']==$t->id?'selected':'')?> value="<?=$t->id?>"><?=$t->timezone?></option>
						<?php			
								}
							
							}
						?>	</option>
						</select>
				  </div>
				  
				 <div class="col-sm-6">
                  <label>Office Name</label>
                  <input type="text" name="doc_office_name" id="doc_office_name" class="form-control" placeholder="Office Name" value="<?=$record['doc_office_name']?>" required>
                </div>
               
              </div>  
			  
			  <div class="row m-b">
				<div class="col-sm-6">
                  <label>Goal No</label>
                  <input type="text" name="doc_goal_no" id="doc_goal_no" class="form-control" placeholder="Goal No" value="<?=$record['doc_goal_no']?>" required>
                </div>
				<div class="col-sm-6">
                  <label class="col-sm-4 form-control-label">Can exceed goal?</label>
				  <div class="col-sm-10">
					<label class="ui-switch data-ui-switch-md info" style="margin-top:9px;">
					  <input type="checkbox" <?=($record['doc_can_excgoal']=="yes")?'checked=""':''?>  value="<?=($record['doc_can_excgoal']=="yes")?'yes':''?>" name="doc_can_excgoal" id="doc_can_excgoal" class="has-value">
					  <i></i>
					</label>
				  </div>
                </div>
               
              </div>  
			  
			  <div class="row m-b">
			     <div class="col-sm-6">
                  <label>Montly Fee</label>
                  <input type="text" name="doc_monthly_fee" id="doc_monthly_fee" class="form-control" value="<?=$record['doc_monthly_fee']?>" placeholder="Montly Fee" required>
                </div>      
				  <div class="col-sm-6"> 				
					   <select required="" name="doc_status" id="doc_status" class="form-control c-select m-y" data-parsley-id="29" style="margin-top:27px;">
							<option  value="">Please select status</option>
							<option <?=($record['doc_status']==1)?'selected':''?> value="1">Active</option>
							<option <?=($record['doc_status']==0)?'selected':''?> value="0">In Active</option>
						</select>
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
  