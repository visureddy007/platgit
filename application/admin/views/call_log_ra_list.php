<div class="app-body">

<div class="padding">
  <div class="box" style="padding-left:30px">
    <div class="box-header">
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
      <h2>Call Log </h2>
    </div>
    <div class="box-body">
	<div class="row">
	
	<!--<div class="col-md-8 col-sm-4">
      Search: <input id="filter" type="text" class="form-control input-sm w-auto inline m-r">
	</div>  -->
	<div class="col-md-2 col-sm-4">
		<p>
          
			
          </p>
	</div>

    </div>	
    </div>
	
    <div>
	
      <table class="table m-b-none default footable-loaded footable" id="all-calllog-ra-tbl" style="width:1000px;">
		<thead>
			<tr>
				<!--<th data-class="expand">#</th>-->
															
				<th>Call Log Timestamp</th>												
				<th>First Name</th>												
				<th data-hide="phone">Last Name</th>												
				<th data-hide="phone">Call Result</th>
				<th data-hide="phone">Adults</th>
				<th data-hide="phone">Children</th>
				<th data-hide="phone">Doctor</th>												
				<th data-hide="phone">Employee</th>																					
				<th data-hide="phone,tablet">Actions</th>																						
			</tr>
		</thead>
		<tbody>
		</tbody>									
	 </table>
	 </div>
  </div>
</div>

<!-- ############ PAGE END-->

    </div>
  
