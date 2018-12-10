<div class="app-body" id="docassign">
<!-- ############ PAGE START-->
	<div class="padding">
	  <div class="row">
    <div class="col-sm-5">
      <div class="box">
        <div class="box-header">
          <h2>Employee doctors</h2>
          <small></small>
        </div>
        <div class="box-divider m-a-0"></div>
        <table id="assn_table" class="table">
          <thead>
            <tr>        
              <th>Office Name</th>
              <th>City</th>
              <th>Doctor</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
		     <?php
				if ($assigneddoc == NULL) {
				?>
					
				<?php
				} else {
					foreach ($assigneddoc as $row) {
					?>
				<tr>            
				  <td><?php echo $row->doc_office_name; ?></td>
				  <td><?php echo $row->city; ?></td>
				  <td><a href="<?=base_url('doctor/view/'.$row->doc_id)?>"><span class="label green pos-rlt m-r-xs">View</span></a></td>
				  <td><span data-id="<?=$row->id?>" data-emp="<?=$row->emp_id?>" data-doc="<?=$row->doc_id?>" class="label danger pos-rlt m-r-xs delete">Remove</span></td>
				</tr>
				<?php
						}
					}
					?>           
          </tbody>
        </table>
		
	
      </div>
    </div>
	<!--- add new table here-->
	
	<div class="col-sm-7">
      <div class="box">
        <div class="box-header">
          <h2>Doctors not in Employee</h2>
          <small></small>
        </div>
        <div class="box-divider m-a-0"></div>
        <table id="doctor-table" class="table">
          <thead>
            <tr>        
              <th>Office Name</th>
              <th>City</th>
              <th>State</th>
              <th>Assign</th>
            </tr>
          </thead>
          <tbody>
			  <?php
				if ($doctors == NULL) {
				?>
					
				<?php
				} else {
					foreach ($doctors as $row) {
					?>
				<tr>            
				  <td><?php echo $row->doc_office_name; ?></td>
				  <td><?php echo $row->city; ?></td>
				  <td><?php echo $row->name; ?></td>
				  <td><span data-doc="<?=$row->doc_id;?>" data-emp="<?=$emp_id?>" class="label success pos-rlt m-r-xs assign">Assign</span></td>
				</tr>
				<?php
						}
					}
					?>           
          </tbody>
        </table> 
	<!--- add new table here-->
    
    </div>
  
	</div>

<!-- ############ PAGE END-->
</div>
  