<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="edit_team_form" id="edit_team_form" role="form" method="post" action="<?=base_url('team/update_team/'.$record['team_id'])?>">
	  <div id="edit_team_msg"></div>
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
            <h2>Edit Team</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>Team Name</label>
                  <input type="text" name="team_name" id="team_name" class="form-control" value="<?=$record['team_name']?>" placeholder="Team Name" required>
                </div>
               
              </div>
			   <?php 
				$assn = explode(',',$record['team_members']);
				/*print_r($assn);exit;*/
			   ?>
			  <div class="row m-b">
                 <div class="col-sm-6"> 
				    <label>Assign Employees</label>
					 <select id="team_members" name="team_members[]"  multiple class="form-control chosen-select c-control__input c-select m-y" data-parsley-id="29" data-ui-options="{theme: 'bootstrap'}" style="margin-top:27px;">
					   <option value="">Select Employees</option>
					 <?php
							if(count($employees) > 0){
								foreach($employees as $e){
						?>
							<option <?=(in_array($e->emp_id,$assn))?'selected':''?> value="<?=$e->emp_id?>"><?=$e->emp_firstname?></option>
						<?php			
								}
							
							}
						?>	
				   </select>
                </div>
              </div>
			  <div class="row m-b">
                 <div class="col-sm-6"> 
					 <select id="team_lead" name="team_lead" class="form-control c-control__input c-select m-y" data-parsley-id="29" data-ui-options="{theme: 'bootstrap'}" style="margin-top:27px;">
					   <option value="">Select Lead</option>
					 <?php
							if(count($employees) > 0){
								foreach($employees as $e){
						?>
							
							<option <?=($record['team_lead']==$e->emp_id?'selected':'')?> value="<?=$e->emp_id?>"><?=$e->emp_firstname?></option>
						<?php			
								}
							
							}
						?>	
				   </select>
                </div>
              </div>
			    
			
          </div>
          <div class=" p-a text-right">
            <button type="submit" class="btn black">Next</button>
		<a class="btn danger" href="<?=base_url('team')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  