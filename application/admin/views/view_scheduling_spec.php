
    <div class="app-body">

<!-- ############ PAGE START-->

  <div class="item">
    <div class="item-bg">
      <img src="<?=base_url('assets')?>/images/a2.jpg" class="blur opacity-3">
    </div>
    <div class="p-a-md">
      <div class="row m-t">
        <div class="col-sm-7">
          <a href="#" class="pull-left m-r-md">
            <span class="avatar w-96">
              <img src="<?=base_url('assets')?>/images/a2.jpg">
              <i class="on b-white"></i>
            </span>
          </a>
          <div class="clear m-b">
           <a href="<?=base_url('doctor/schespec/'.$record['doc_id'])?>" class="btn btn-fw success">Edit</a>
          </div>
        </div>
    
      </div>
    </div>
  </div>
  <div class="white bg b-b p-x">
    <div class="row">
      <div class="col-sm-6 push-sm-6">
       
      </div>
      <div class="col-sm-6 pull-sm-6">
        <div class="p-y-md clearfix nav-active-info">
          <ul class="nav nav-pills nav-sm">
          
          
            <li class="nav-item active">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_4">Office Specifics</a>
            </li> 
			<li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_5"> Office Policy</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_6">Office Contact Info</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_7">Answers Schedule Specific</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="padding">
    <div class="row">
      <div class="col-sm-8 col-lg-9">
        <div class="tab-content">      
      
            <div class="tab-pane p-v-sm active" id="tab_4">
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Office Name</small>
                <div class="_500"><?=$record['ofc_name']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Doctors Names (Pronunciation)</small>
                <div class="_500"><?=$record['doc_names']?></div>
              </div>
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Providers/ Specialists & Hours</small>
                <div class="_500"><?=$record['pro_spe_hrs']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Hygienists & Hours</small>
                <div class="_500"><?=$record['hyg_hrs']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Office Hours</small>
                <div class="_500"><?=$record['ofc_hrs']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Insurances Not Accepted</small>
                <div class="_500"><?=$record['ins_acc']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Insurances Not Accepted</small>
                <div class="_500"><?=$record['ins_not_acc']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Adult Scheduling</small>
                <div class="_500"><?=$record['adult_sche']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Child Scheduling</small>
                <div class="_500"><?=$record['child_sche']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Period Scheduling</small>
                <div class="_500"><?=$record['per_sche']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">New Patient Scheduling</small>
                <div class="_500"><?=$record['pat_sche']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Operatories</small>
                <div class="_500"><?=$record['oper']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Scheduling Details</small>
                <div class="_500"><?=$record['sche_det']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Patient Inactivation</small>
                <div class="_500"><?=$record['pat_inactv']?></div>
              </div>
             
            
            </div>
           
          </div>
		    <div class="tab-pane p-v-sm" id="tab_5">
		   
		    <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Notes & Communication</small>
                <div class="_500"><?=$record['notes_comm']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Scripting</small>
                <div class="_500"><?=$record['scrip']?></div>
              </div>
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Cancellation Policy</small>
                <div class="_500"><?=$record['canc_poli']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Pricing Details</small>
                <div class="_500"><?=$record['pric_det']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Office Reminders</small>
                <div class="_500"><?=$record['ofc_remi']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Balances</small>
                <div class="_500"><?=$record['balances']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Scheduling for Doctor</small>
                <div class="_500"><?=$record['schd_doc']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Computer Access Times</small>
                <div class="_500"><?=$record['comp_acc_times']?></div>
              </div>
             
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Computer Access Logins</small>
                <div class="_500"><?=$record['comp_acc_logins']?></div>
              </div>
             
             
            
            </div>
            </div>
		    <div class="tab-pane p-v-sm" id="tab_6">
				<div class="row m-b">
				  <div class="col-xs-6">
					<small class="text-muted">Location & Directions</small>
					<div class="_500"><?=$record['loc_dire']?></div>
				  </div>
				  <div class="col-xs-6">
					<small class="text-muted">Address</small>
					<div class="_500"><?=$record['address']?></div>
				  </div>
				</div>
				<div class="row m-b">
				  <div class="col-xs-6">
					<small class="text-muted">Phone Number</small>
					<div class="_500"><?=$record['phn_num']?></div>
				  </div>
				  <div class="col-xs-6">
					<small class="text-muted">Fax</small>
					<div class="_500"><?=$record['fax']?></div>
				  </div>
				 
				
				</div>
				<div class="row m-b">
				  <div class="col-xs-6">
					<small class="text-muted">Office Manager Name</small>
					<div class="_500"><?=$record['ofc_mand_name']?></div>
				  </div>
				  <div class="col-xs-6">
					<small class="text-muted">Office Manager Number</small>
					<div class="_500"><?=$record['ofc_mang_num']?></div>
				  </div>
				 
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Email</small>
                <div class="_500"><?=$record['email']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Emergency</small>
                <div class="_500"><?=$record['emergency']?></div>
              </div>
            </div>
          </div>
		  <div class="tab-pane p-v-sm" id="tab_7">
				<div class="row m-b">
				  <div class="col-xs-6">
					<small class="text-muted">Procedures Services</small>
					<div class="_500"><?=$record['Procedures_Services']?></div>
				  </div>
				  <div class="col-xs-6">
					<small class="text-muted">Treatment</small>
					<div class="_500"><?=$record['Treatment']?></div>
				  </div>
				</div>
				<div class="row m-b">
				  <div class="col-xs-6">
					<small class="text-muted">Pricing Promotions</small>
					<div class="_500"><?=$record['Pricing_Promotions']?></div>
				  </div>
				  <div class="col-xs-6">
					<small class="text-muted">Cancellation Procedure</small>
					<div class="_500"><?=$record['Cancellation_Procedure']?></div>
				  </div>
				 
				
				</div>
				<div class="row m-b">
				  <div class="col-xs-6">
					<small class="text-muted">Reschedule Procedure</small>
					<div class="_500"><?=$record['Reschedule_Procedure']?></div>
				  </div>
				  <div class="col-xs-6">
					<small class="text-muted">Scripting</small>
					<div class="_500"><?=$record['Scripting']?></div>
				  </div>
				 
            
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">New Patient</small>
                <div class="_500"><?=$record['New_Patient']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Pharmacy</small>
                <div class="_500"><?=$record['Pharmacy']?></div>
              </div>
             
            
            </div>
            
	
          </div>
        </div>
      </div>
    
    </div>
  </div>

<!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->
