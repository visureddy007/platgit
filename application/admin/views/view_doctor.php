
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
            <h4 class="m-a-0 m-b-sm"><?=$record['doc_office_name']?> </h4>
            <p class="text-muted"><span class="m-r"><?=$record['timezone']?></span> <small><i class="fa fa-map-marker m-r-xs"></i><?=$record['name']?>,<?=$record['city']?>,<?=$record['zip']?></small></p>
            <!--div class="block clearfix m-b">
              <a href="" class="btn btn-icon btn-social rounded b-a btn-sm">
                <i class="fa fa-facebook"></i>
                <i class="fa fa-facebook indigo"></i>
              </a>
              <a href="" class="btn btn-icon btn-social rounded b-a btn-sm">
                <i class="fa fa-twitter"></i>
                <i class="fa fa-twitter light-blue"></i>
              </a>
              <a href="" class="btn btn-icon btn-social rounded b-a btn-sm">
                <i class="fa fa-google-plus"></i>
                <i class="fa fa-google-plus red"></i>
              </a>
              <a href="" class="btn btn-icon btn-social rounded b-a btn-sm">
                <i class="fa fa-linkedin"></i>
                <i class="fa fa-linkedin cyan-600"></i>
              </a>
            </div>
            <a href="#" class="btn btn-sm warn rounded success active m-b" data-ui-toggle-class="success">
              <span class="inline">Follow</span>
              <span class="none">Following</span>
            </a>-->
          </div>
        </div>
       <!-- <div class="col-sm-5">
          <p class="text-md profile-status">I am feeling good!</p>
          <button class="btn btn-sm rounded btn-outline b-success" data-toggle="collapse" data-target="#editor">Edit</button>
          <div class="collapse box m-t-sm" id="editor">
            <textarea class="form-control no-border" rows="2" placeholder="Type something..."></textarea>
          </div>
        </div>-->
      </div>
    </div>
  </div>
  <div class="white bg b-b p-x">
    <div class="row">
      <div class="col-sm-6 push-sm-6">
        <!--<div class="p-y text-center text-sm-right">
          <a href="#" class="inline p-x text-center">
            <span class="h4 block m-a-0">2k</span>
            <small class="text-xs text-muted">Followers</small>
          </a>
          <a href="#" class="inline p-x b-l b-r text-center">
            <span class="h4 block m-a-0">250</span>
            <small class="text-xs text-muted">Following</small>
          </a>
          <a href="#" class="inline p-x text-center">
            <span class="h4 block m-a-0">89</span>
            <small class="text-xs text-muted">Activities</small>
          </a>
        </div>-->
      </div>
      <div class="col-sm-6 pull-sm-6">
        <div class="p-y-md clearfix nav-active-info">
          <ul class="nav nav-pills nav-sm">
            <!--<li class="nav-item active">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_1">Time Punches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_2">Appointments </a>
            </li>-->
          
            <li class="nav-item active">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_4">Profile</a>
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
          <!--<div class="tab-pane p-v-sm active" id="tab_1">
            </div>
          <div class="tab-pane p-v-sm" id="tab_2">
            <div class="streamline">
              <div class="sl-item">
                <div class="sl-content">
                  <div class="sl-date text-muted">2 minutes ago</div>
                  <p>Check your Internet connection</p>
                </div>
              </div>
              <div class="sl-item">
                <div class="sl-content">
                  <div class="sl-date text-muted">9:30</div>
                  <p>Meeting with tech leader</p>
                </div>
              </div>
              <div class="sl-item b-success">
                <div class="sl-content">
                  <div class="sl-date text-muted">8:30</div>
                  <p>Call to customer <a href="#" class="text-info">Jacob</a> and discuss the detail.</p>
                </div>
              </div>
              <div class="sl-item">
                <div class="sl-content">
                  <div class="sl-date text-muted">Wed, 25 Mar</div>
                  <p>Finished task <a href="#" class="text-info">Testing</a>.</p>
                </div>
              </div>
              <div class="sl-item">
                <div class="sl-content">
                  <div class="sl-date text-muted">Thu, 10 Mar</div>
                  <p>Trip to the moon</p>
                </div>
              </div>
              <div class="sl-item b-info">
                <div class="sl-content">
                  <div class="sl-date text-muted">Sat, 5 Mar</div>
                  <p>Prepare for presentation</p>
                </div>
              </div>
              <div class="sl-item">
                <div class="sl-content">
                  <div class="sl-date text-muted">Sun, 11 Feb</div>
                  <p><a href="#" class="text-info">Jessi</a> assign you a task <a href="#" class="text-info">Mockup Design</a>.</p>
                </div>
              </div>
              <div class="sl-item">
                <div class="sl-content">
                  <div class="sl-date text-muted">Thu, 17 Jan</div>
                  <p>Follow up to close deal</p>
                </div>
              </div>
            </div>
          </div>-->
        
          <div class="tab-pane p-v-sm active" id="tab_4">
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Cell Phone</small>
                <div class="_500"><?=$record['doc_phone']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Address</small>
                <div class="_500"><?=$record['doc_add1']?></br> <?=$record['doc_add2']?></div>
              </div>
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Email ID</small>
                <div class="_500"><?=$record['doc_email']?></div>
              </div>
              <!--<div class="col-xs-6">
                <small class="text-muted">Manager</small>
                <div class="_500">James Richo</div>
              </div>-->
            </div>
            <!--<div>
              <small class="text-muted">Bio</small>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue.</div>
            </div>-->
          </div>
		   <div class="tab-pane p-v-sm" id="tab_5">
		   
		   <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Providers (names, #s)</small>
                <div class="_500"><?=(isset($sech_spec['pro_names']))?$sech_spec['pro_names']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Doctor Schedule</small>
                <div class="_500"><?=(isset($sech_spec['doc_sche']))?$sech_spec['doc_sche']:''?></div>
              </div>
            </div>
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Hygiene Schedule</small>
                <div class="_500"><?=(isset($sech_spec['hyg_sche']))?$sech_spec['hyg_sche']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Adult/Child Age</small>
                <div class="_500"><?=(isset($sech_spec['adu_chi_age']))?$sech_spec['adu_chi_age']:''?></div>
              </div>
            </div>
			
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Insurance Providers</small>
                <div class="_500"><?=(isset($sech_spec['insurance_prov']))?$sech_spec['insurance_prov']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Adult/Child Time</small>
                <div class="_500"><?=(isset($sech_spec['adu_chi_time']))?$sech_spec['adu_chi_time']:''?></div>
              </div>
            </div>
			
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Hygiene Schedule</small>
                <div class="_500"><?=(isset($sech_spec['hyg_sche']))?$sech_spec['hyg_sche']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Adult/Child Age</small>
                <div class="_500"><?=(isset($sech_spec['adu_chi_age']))?$sech_spec['adu_chi_age']:''?></div>
              </div>
            </div>
			
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">New Patients Time</small>
                <div class="_500"><?=(isset($sech_spec['pat_time']))?$sech_spec['pat_time']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Scheduling Details - 
					(overlapping, accelerated hyg, 
					operatories to schedule in, etc)</small>
                <div class="_500"><?=(isset($sech_spec['sch_det']))?$sech_spec['sch_det']:''?></div>
              </div>
            </div>
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">“BUZZ” words</small>
                <div class="_500"><?=(isset($sech_spec['buzz_word']))?$sech_spec['buzz_word']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">PERIO-Scheduling RP/Sc, 
						Perio maint, etc Time frames, 
						when to sched perio</small>
                <div class="_500"><?=(isset($sech_spec['perio_sch']))?$sech_spec['perio_sch']:''?></div>
              </div>
            </div>
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Do you work on days 
					where dr is not here? 
					(answer phones, etc)</small>
                <div class="_500"><?=(isset($sech_spec['do_you_word']))?$sech_spec['do_you_word']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Do we call on 90 days 
					past due balance?</small>
                <div class="_500"><?=(isset($sech_spec['do_we_call']))?$sech_spec['do_we_call']:''?></div>
              </div>
            </div>
			
			<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">How do you answer 
					your phone?</small>
                <div class="_500"><?=(isset($sech_spec['how_do_you_ans']))?$sech_spec['how_do_you_ans']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Bwx how often?</small>
                <div class="_500"><?=(isset($sech_spec['bmx']))?$sech_spec['bmx']:''?></div>
              </div>
            </div>
			
				<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Notes in Patient notes 
					(fam file) ok?</small>
                <div class="_500"><?=(isset($sech_spec['pat_notes']))?$sech_spec['pat_notes']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Initials (*PR) in appts 
						and dateline</small>
                <div class="_500"><?=(isset($sech_spec['initials_appts']))?$sech_spec['initials_appts']:''?></div>
              </div>
            </div>
			
				<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Resetting recall dates</small>
                <div class="_500"><?=(isset($sech_spec['resetting_recall']))?$sech_spec['resetting_recall']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Passwords: Windows, 
						Computer Access Code, 
						Dentrix passwords</small>
                <div class="_500"><?=(isset($sech_spec['passwords']))?$sech_spec['passwords']:''?></div>
              </div>
            </div>
			
				<div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Treatment to add 
to appointment</small>
                <div class="_500"><?=(isset($sech_spec['treat_appt']))?$sech_spec['treat_appt']:''?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Other scheduling details:</small>
                <div class="_500"><?=(isset($sech_spec['other_sche_det']))?$sech_spec['other_sche_det']:''?></div>
              </div>
            </div>
			
			
			
		   </div>
		    <div class="tab-pane p-v-sm" id="tab_6">
              <div class="col-sm-6">
     
        <div class="box">
          <div class="box-header">
            <h2>Doctor Schedule</h2>
          </div>
          <div class="box-body">
            <p class="text-muted"></p>                        
              <div class="panel-body">
												<div class="table-responsive">
												<div id="msg"></div>
													<table class="table table-striped table-bordered table-hover">
														<thead>
															<tr>
																<th>Day</th>
																<th>In Time</th>
																<th>Out Time</th>
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
															
																<?=$daysA[$t->day]?>						
																
															</td>
															<td><?=$t->in_time?></td>		
															<td><?=$t->out_time?></td>
																			
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
          </div>
     
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
