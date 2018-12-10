<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
	
	  <div class="row">
					<!--=== Validation Example 3 ===-->
					<div class="col-md-12">
						<div>
							<div class="widget-header">
								<h4><i class="icon-reorder"></i>Upload Employees</h4>
							</div>
							<div class="widget-content">
								<form  data-ui-jp="parsley" method="post" class="form-horizontal row-border" id="validate-3" action="<?=base_url('employee/doupload')?>" enctype="multipart/form-data">
									
									<div class="form-group">
										<label class="col-md-3 control-label">File <span class="required">*</span></label>
										<div class="col-md-3">
											<input type="file" name="file1" class="required" accept="" data-style="fileinput" data-inputsize="medium">
											<p class="help-block">only  .xls, .xlsx, .csv <br>
											</p>
											<a href="<?=base_url('pr_sample_emp_excel.xls')?>">Click Here for Sample File</a>
										</div>
											<label for="file1" class="has-error help-block" generated="true" style="display:none;"> </label>
										</div>
									<div class="form-group">
										
									<div class="col-md-12">
										<p>Your '.xls' file must contain the following coloumns.</p>
										<table style="color:#003333; border:#003333 solid 1px thin; background:#CCCCCC" border="1px" cellpadding="2" cellspacing="2" width="100%"><tbody><tr>
									   <td>User name</td><td>Email</td><td>First Name</td><td>Last Name</td><td>Password</td><td>Address Line 1</td><td>Address Line 2</td><td>State</td><td>City</td><td>Zip</td><td>Phone No</td><td>Role</td><td>Time Zone</td></tr></tbody></table>
									</div>
									</div>
									
									
									
									
									<div class="form-actions">
										<input type="submit" value="Update" class="btn btn-primary pull-left">
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Validation Example 3 -->

					
					<!-- /Validation Example 4 -->
				</div>
				<?php
					if($this->session->flashdata('already_existsA')){
				?>
				 <div class="row">
					<div class="col-lg-12">
					<div class="panel panel-default">

                        <div class="panel-heading">
                            These Dealers  already exists in database
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
  </div>
 
</div>

<!-- ############ PAGE END-->

</div>
  