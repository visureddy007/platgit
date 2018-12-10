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
      <h2>Team</h2>
      
    </div>
    <div class="box-body">
	<div class="row">
	
	
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('team/add')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Add Team</a>
			
          </p>
	</div>
	
    </div>	
	         
    </div>
	
    <div>
     
	  <table class="table m-b-none default footable-loaded footable" data-ui-jp="footable" data-filter="#filter" data-page-size="5" id="all-team-tbl" style="width:1060px;">
		<thead>
			<tr>											
				<th data-hide="phone">Name</th>												
				<th data-hide="phone">Leader</th>												
				<th data-hide="phone">Actions</th>																					
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
  