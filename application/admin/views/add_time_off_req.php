<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="add_timeoff_form" id="add_timeoff_form" role="form" method="post" action="<?=base_url('time_off_req/create')?>">
	  <div id="add_timeoff_msg"></div>
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
            <h2>Add Time off request</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
                </div>
               <div class="col-sm-6">
                  <label>Today's Date</label>
                  <input type="text" name="today_date" id="today_date" class="form-control datetimepicker" placeholder="Today's Date" required>
                </div>
               
              </div>
			<div class="row m-b">
                <div class="col-sm-6">
                  <label>From Date</label>
                  <input type="text" name="from_date" id="from_date" class="form-control datetimepicker" placeholder="From Date" required>
                </div>
               <div class="col-sm-6">
                  <label>To Date</label>
                  <input type="text" name="to_date" id="to_date" class="form-control datetimepicker" placeholder="To Date" required>
                </div>
               
              </div>
			<div class="row m-b">
                <div class="col-sm-12">
                  <label>Reason</label>
                  <textarea type="text" name="reason" id="reason" class="form-control" placeholder="Reason" required></textarea>
                </div>
              
              </div>
			
          </div>
          <div class=" p-a text-right">
            <button type="submit" class="btn black">Submit</button>
			<a class="btn danger" href="<?=base_url('time_off_req')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  