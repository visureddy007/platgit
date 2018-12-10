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
      <h2>Offices</h2>
      
    </div>
    <div class="box-body">
	<div class="row">
	
	<!--<div class="col-md-8 col-sm-4">
      Search: <input id="filter" type="text" class="form-control input-sm w-auto inline m-r">
	</div>  -->
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('doctor/add')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Add Office</a>
			
          </p>
	</div>
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('doctor/upload')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Upload Office</a>
			
          </p>
	</div>
    </div>	
    </div>
	
    <div>
	<?php
					if($this->session->flashdata('already_existsA')){
				?>
				 <div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default">

                        <div class="panel-heading">
                            These Office  already exists in database
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
	
      <table class="table m-b-none default footable-loaded footable" id="all-doc-tbl" style="width:1000px;">
		<thead>
			<tr>
				<th>Office Name</th>												
				<th data-hide="phone">Scheduling Specific</th>												
				<!--<th data-hide="phone">Answers Scheduling Specifics</th>-->												
				<th data-hide="phone">Appointments</th>												
				<th data-hide="phone">Call Log</th>												
				<th data-hide="phone,tablet">Actions</th>														
				<th data-hide="phone,tablet">Status</th>									
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
  