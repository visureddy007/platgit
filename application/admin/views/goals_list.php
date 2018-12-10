<div class="app-body">

<div class="padding">
  <div class="box" style="padding-left:30px">
    <div class="box-header">
	
      <h2>Goals</h2>
      
    </div>
    <div class="box-body">
	<div class="row">
	
	<!--<div class="col-md-8 col-sm-4">
      Search: <input id="filter" type="text" class="form-control input-sm w-auto inline m-r">
	</div>  -->
	
    </div>	
    </div>
	
    <div>
	
     
	  <div class="box-divider m-a-0"></div>
        <table data-ui-jp="dataTable" class="table table-striped b-t b-b">
						<thead>
							<tr>
								<th>Office Name</th>
								<th>Goals</th>
								<th>Calls</th>
								<th>Appointment</th>
								<th>% Achieved</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$cd = $this->doctor_model->selectAllCalls(); 
							$ap = $this->doctor_model->selectAllApts(); 
						?>
						<?php 
						$calls = array();
							 if($cd['num']>0){
								 foreach($cd['data'] as $c){
									 $calls[$c->doc_id]=$c->total_calls;
								 }
							 }
					    ?>
						<?php 
						$apts = array();
							 if($ap['num']>0){
								 foreach($ap['data'] as $c){
									 $apts[$c->doc_id]=$c->total_apts;
								 }
							 }
					    ?>
						<?php
						if ($doc['data'] == NULL) {
						?>
							<tr align="center"> <td colspan="9">No Data to display</td></tr>
						<?php
						} else {
							foreach ($doc['data'] as $r) {
								$calls_by_doc = (isset($calls[$r->doc_id]))?$calls[$r->doc_id]:0;
								$apts_doc = (isset($apts[$r->doc_id]))?$apts[$r->doc_id]:0;
								$ach = bcdiv($apts_doc,$r->doc_goal_no,2);
								if($apts_doc == 0){
									$ach_per = 0;
								}else{
									$ach_per = bcmul($ach,100,2);
								}
							?>
								<tr>
									<td><?php echo $r->doc_office_name; ?></td>										
									<td><?php echo $r->doc_goal_no; ?></td>										
									<td><?php echo $calls_by_doc; ?></td>										
									<td><?php echo $apts_doc; ?></td>										
									<td><?php echo $ach_per.' %'; ?></td>										
									
									
								</tr>
							<?php
							}
						}
						?>                                       
						</tbody>
			        </table>
				
	 </div>
  </div>
</div>

<!-- ############ PAGE END-->

    </div>
  