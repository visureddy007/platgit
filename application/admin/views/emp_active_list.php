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
      <h2>Employee</h2>
      
    </div>
    <div class="box-body">
	<div class="row">
	
	
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('employee/add')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Add Employee</a>
			
          </p>
	</div>
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('employee/upload')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Upload Employee</a>
			
          </p>
	</div>
    </div>	
	<?php
					if($this->session->flashdata('already_existsA')){
				?>
				 <div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default">

                        <div class="panel-heading">
                            These Employees  already exists in database
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>                                          
                                            <th>User Name</th>
											<th>Email</th>
                                            </tr>
                                    </thead>
                                    <tbody>
				<?php		
						foreach($this->session->flashdata('already_existsA') as $k){
						?>
						<tr>
							<td><?=$k['1']?></td>
							<td><?=$k['2']?></td>
						</tr>
					<?php
						}
					?>
					</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    </div>
					
                    <!-- /.panel -->
                </div>
					<?php
					}
				?>				
    </div>
	
    <div>
      <table class="table m-b-none default footable-loaded footable" id="all-empact-tbl" style="width:1000px;">
		<thead>
			<tr>
				<!--<th data-class="expand">ID</th>-->
				<th>Name</th>												
				<th data-hide="phone">Street Address 1</th>												
				<th data-hide="phone">State Zip</th>												
				<th data-hide="phone">Doctors</th>												
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
  