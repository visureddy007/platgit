<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="add_docsche_form" id="add_docsche_form" role="form" method="post" action="<?=base_url("doctor/sche_modify/".$record['doc_id'])?>">
	  <div id="add_doc_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Add Doctor</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                 <div class="col-lg-9">
										<div class="panel panel-default">
											<div class="panel-heading">											
												<b>In-Out Time</b>
													<button style="float:right;margin-top:-8px;" type="button" id="addTime" class="btn btn-success"> <span class="glyphicon glyphicon-plus"></span></button>
											</div></br>
											
											<!-- /.panel-heading -->
											<div id="err"></div>
											<div class="panel-body">
												<div class="table-responsive">
												<div id="msg"></div>
													<table class="table table-striped table-bordered table-hover">
														<thead>
														<tr>
															<th>Day</th>
															<th>In Time</th>
															<th>Out Time</th>													
															<th>Action</th>														
																						
														</tr>
														</thead>
													<tbody id="tmgs">
													   <?php
														if(isset($tmgs) && $tmgs['num']>0){
															$d=0;
															foreach($tmgs['data'] as $t){
														?>
														<tr class="daytmgs">
															<!--<td id="datepairExample">Monday</td>-->
															<td>
															<?php 
															
															$daysA = array('mon'=>'Monday','tue'=>'Tuesday','wed'=>'Wednesday','thu'=>'Thursday','fri'=>'Friday','sat'=>'Saturday','sun'=>'Sunday');
															?>
															<select class="form-control" id="day<?=$d?>" name="day[]" style="width:120px;">
																<option value=""> Select Day</option>
																<?php													
																	foreach($daysA as $k=>$v){
																		$selected = ($t->day==$k)?'selected':'';
																?>
																<option <?=$selected?> value="<?=$k?>"><?=$v?></option>									
																<?php																	
																	}
																?>
															</select>
															</td>
															<td><input type="text" name="in[]"  id="in<?=$d?>" data-index="<?=$d?>"  class="form-control timepicker in" value="<?=$t->in_time?>" ></td>		
															<td><input type="text" name="out[]"  id="out<?=$d?>" data-index="<?=$d?>"  class="form-control timepicker out " value="<?=$t->out_time?>" ><input type="hidden" class="assid" id="assid" name="assid[]" value="<?=$t->id?>" /></td>
														
															<td><button data ="<?=$t->id?>" class="btn btn-icon waves-effect waves-light btn-danger delTimeBtn"> <i class="fa fa-remove"></i> </button></td>						
														</tr>	
															<?php
															$d++;
																}															
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
  