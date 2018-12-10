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
								<h4><i class="icon-reorder"></i>Upload Doctor</h4>
							</div>
							<div class="widget-content">
								<form  data-ui-jp="parsley" method="post" class="form-horizontal row-border" id="validate-3" action="<?=base_url('doctor/doupload')?>" enctype="multipart/form-data">
									
									<div class="form-group">
										<label class="col-md-3 control-label">File <span class="required">*</span></label>
										<div class="col-md-3">
											<input type="file" name="file1" class="required" accept="" data-style="fileinput" data-inputsize="medium">
											<p class="help-block">only  .xls, .xlsx, .csv <br>
											</p>
											<a href="<?=base_url('pr_sample_doc_excel.xls')?>">Click Here for Sample File</a>
										</div>
											<label for="file1" class="has-error help-block" generated="true" style="display:none;"> </label>
										</div>
									<div class="form-group">
										
									<div class="col-md-12">
										<p>Your '.xls' file must contain the following coloumns.</p>
										<table style="color:#003333; border:#003333 solid 1px thin; background:#CCCCCC" border="1px" cellpadding="2" cellspacing="2" width="100%"><tbody><tr>
									   <td>User name</td><td>Email</td><td>First Name</td><td>Last Name</td><td>Password</td><td>Address Line 1</td><td>Address Line 2</td><td>State</td><td>City</td><td>Zip</td><td>Phone No</td><td>Time Zone</td><td>Office Name</td><td>Goal No</td><td>Can Exceed Goal</td><td>Monthly Fee</td></tr></tbody></table>
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
				
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

</div>
  