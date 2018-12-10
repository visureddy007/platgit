<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="add_team_form" id="add_team_form" role="form" method="post" action="<?=base_url('team/create_team')?>">
	  <div id="add_team_msg"></div>
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
            <h2>Add Team</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>Team Name</label>
                  <input type="text" name="team_name" id="team_name" class="form-control" placeholder="Team Name" required>
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
  