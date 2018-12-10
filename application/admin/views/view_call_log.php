
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
            <h4 class="m-a-0 m-b-sm"><?=$record['doc_firstname']?> <?=$record['doc_lastname']?></h4>
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
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_4">Call Log</a>
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
                <small class="text-muted">Call Result</small>
                <div class="_500"><?=$record['call_result']?></div>
              </div>
			  <?php if(($record['call_result']) == 'Contact'){ ?>
              <div class="col-xs-6">
                <small class="text-muted">Requires Attention</small>
                <div class="_500"><?=($record['requires_attention']=='1')?'Yes':'No';?></div>
              </div>
			  <?php 
			  }
			  ?>
            </div>
			
            <div class="row m-b">
              <?php if(($record['call_result'] == 'Contact')){ ?>
              <div class="col-xs-6">
                <small class="text-muted">Patient Response</small>
                <div class="_500"><?=$record['patient_response']?></div>
              </div>
			  <?php 
			  }
			  ?>
              <?php if(($record['patient_response'] == 'Schedule Appointment') || ($record['patient_response'] == 'Rescheduled Appointment') ){ ?>
              <div class="col-xs-6">
                <small class="text-muted">Notes</small>
                <div class="_500"><?=$record['notes']?></div>
              </div>
			  <?php 
			  }
			  ?>
            </div>
           <div class="row m-b">
              <?php if(($record['patient_response'] == 'Schedule Appointment') || ($record['patient_response'] == 'Rescheduled Appointment')) { ?>
              <div class="col-xs-6">
                <small class="text-muted">Appointment Date</small>
                <div class="_500"><?=$record['appt_date']?></div>
              </div>
			  <?php 
			  }
			  ?>
              <?php if(($record['patient_response'] == 'Schedule Appointment') || ($record['patient_response'] == 'Rescheduled Appointment')) { ?>
              <div class="col-xs-6">
                <small class="text-muted">Appointment Time</small>
                <div class="_500"><?=$record['appt_time']?></div>
              </div>
			  <?php 
			  }
			  ?>
            </div>
           <div class="row m-b">
              <?php if(($record['patient_response'] == 'Schedule Appointment') || ($record['patient_response'] == 'Rescheduled Appointment')) { ?>
              <div class="col-xs-6">
                <small class="text-muted">Adult</small>
                <div class="_500"><?=$record['adults']?></div>
              </div>
			  <?php 
			  }
			  ?>
               <?php if(($record['patient_response'] == 'Schedule Appointment') || ($record['patient_response'] == 'Rescheduled Appointment') ){ ?>
              <div class="col-xs-6">
                <small class="text-muted">Child</small>
                <div class="_500"><?=$record['children']?></div>
              </div>
			  <?php 
			  }
			  ?>
            </div>
             <div class="row m-b">
              <?php if(($record['patient_response']) == 'Discontinued Services'){ ?>
              <div class="col-xs-6">
                <small class="text-muted">Notes</small>
                <div class="_500"><?=$record['notes']?></div>
              </div>
			 
              <div class="col-xs-6">
                <small class="text-muted">Reason For Leaving</small>
                <div class="_500"><?=$record['reason_for_leave']?></div>
              </div>
			  <?php 
			  }
			  ?>
            </div>
            <!--<div>
              <small class="text-muted">Bio</small>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue.</div>
            </div>-->
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
