<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Platinum Recall</title>
  <meta name="description" content="Responsive, Bootstrap, BS4" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- for ios 7 style, multi-resolution icon of 152x152 -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
  <link rel="apple-touch-icon" href="<?=base_url('assets')?>/images/logo.png">
  <meta name="apple-mobile-web-app-title" content="Flatkit">
  <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" sizes="196x196" href="<?=base_url('assets')?>/images/logo.png">
  
  <!-- style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/animate.css/animate.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/glyphicons/glyphicons.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/material-design-icons/material-design-icons.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/ionicons/css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <!---- Datatable Lib------>
  <link rel="stylesheet" href="<?=base_url('assets')?>/libs/datatables/media/css/dataTables.bootstrap4.min.css" type="text/css" />
  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/styles/app.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/styles/style.css" type="text/css" />
  <!-- endbuild -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/styles/font.css" type="text/css" />
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/styles/prism.css">
  <link rel="stylesheet" href="<?=base_url('assets')?>/css/styles/chosen.css">
  <link href="<?=base_url('assets')?>/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="<?=base_url('assets')?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
  	<link href="<?=base_url('assets')?>/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	
	<!-- build:js scripts/app.min.js -->
<!-- jQuery -->
  <script src="<?=base_url('assets')?>/libs/jquery/dist/jquery.js"></script>
  <script src="<?=base_url('assets')?>/scripts/jquery.validate.js" type="text/javascript"></script>
<!-- Bootstrap -->
  <script src="<?=base_url('assets')?>/libs/tether/dist/js/tether.min.js"></script>
  <script src="<?=base_url('assets')?>/libs/bootstrap/dist/js/bootstrap.js"></script>
  <script src="<?=base_url('assets')?>/daterangepicker/moment.js"></script>
 <script src="<?=base_url('assets')?>/daterangepicker/daterangepicker.js"></script>
</head>
<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <!-- aside -->
  <div id="aside" class="app-aside fade nav-dropdown black">
    <!-- fluid app aside -->
    <div class="navside dk" data-layout="column">
      <div class="navbar no-radius">
        <!-- brand -->
        <a href="<?=base_url('dashboard')?>" class="navbar-brand">
        	<div data-ui-include="'<?=base_url('assets')?>/images/logo.svg'"></div>
        	<img src="<?=base_url('assets')?>/images/logo.png" alt="." class="hide">
        	<span class="hidden-folded inline">Platinum Recall</span>
        </a>
        <!-- / brand -->
      </div>
	   <?php $this->load->view('side_nav'); ?>
      <!--<div data-flex class="hide-scroll">
          <nav class="scroll nav-stacked nav-stacked-rounded nav-color">
            
            <ul class="nav" data-ui-nav>
              <li>
				<a href="<?=base_url('dashboard')?>" class="b-danger">
				<span class="nav-icon text-white no-fade">
				<i class="ion-filing"></i>
				</span>
				<span class="nav-text">Dashboard</span>
				</a>
				</li>
				<li>
				<a href="<?=base_url('employee')?>" class="b-default">
				<span class="nav-icon">
				<i class="ion-person"></i>
				</span>
				<span class="nav-text">Employees</span>
				</a>
				</li>
				<li>
                <a >
                  <span  class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-plus-circled"></i>
                  </span>
                  <span class="nav-text">Doctors</span>
                </a>
                <ul class="nav-sub nav-mega nav-mega-3">
                  <li>
                    <a href="<?=base_url('doctor')?>" >
                      <span class="nav-text">All</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?=base_url('doctor/active')?>" >
                      <span class="nav-text">Active</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?=base_url('doctor/inactive')?>" >
                      <span class="nav-text">In-Active</span>
                    </a>
                  </li>
                </ul>
              </li>
            
              
				<li>
				<a href="<?=base_url('team')?>" class="b-default">
				<span class="nav-icon">
				<i class="ion-person-stalker"></i>
				</span>
				<span class="nav-text">Teams</span>
				</a>
				</li>
				<li>
				<li>
				<a href="<?=base_url('timeclock')?>" class="b-default">
				<span class="nav-icon">
				<i class="ion-clock"></i>
				</span>
				<span class="nav-text">Time Clock</span>
				</a>
				</li>
				<li>
				<a href="<?=base_url('message/view/1')?>" class="b-default">
				<span class="nav-icon">
				<i class="ion-chatbubble-working"></i>
				</span>
				<span class="nav-text">Messages</span>
				</a>
				</li>
				<li>
					<a href="<?=base_url('Managetime')?>" class="b-default">
						<span class="nav-icon">
						<i class="ion-search"></i>
						</span>
						<span class="nav-text">Manage Time Punch</span>
					</a>
				</li>
				<li>
					<a href="<?=base_url('Managebreak')?>" class="b-default">
						<span class="nav-icon">
						<i class="ion-search"></i>
						</span>
						<span class="nav-text">Manage Break Punch</span>
					</a>
				</li>
				<li>
				<a href="app.contact.html" class="b-default">
				<span class="nav-icon">
				<i class="ion-clock"></i>
				</span>
				<span class="nav-text">Work Schedules</span>
				</a>
				</li>
				<li>
				<a href="app.contact.html" class="b-default">
				<span class="nav-icon">
				<i class="ion-ios-calendar-outline"></i>
				</span>
				<span class="nav-text">Calendar</span>
				</a>
				</li>
				<li>
				<a href="app.contact.html" class="b-default">
				<span class="nav-icon">
				<i class="ion-stats-bars"></i>
				</span>
				<span class="nav-text">Reports</span>
				</a>
			</li>
		</ul>
          </nav>
      </div>-->
      <div data-flex-no-shrink>
        <div class="nav-fold dropup">
          <a data-toggle="dropdown">
              <div class="pull-left">
                <div class="inline"><span class="avatar w-40 grey">A</span></div>
                <img src="<?=base_url('assets')?>/images/a0.jpg" alt="..." class="w-40 img-circle hide">
              </div>
              <div class="clear hidden-folded p-x">
                <span class="block _500 text-muted">Admin</span>
                <div class="progress-xxs m-y-sm lt progress">
                    <div class="progress-bar info" style="width: 15%;">
                    </div>
                </div>
              </div>
          </a>
          <div class="dropdown-menu w dropdown-menu-scale ">
            <a class="dropdown-item" href="profile.html">
              <span>Profile</span>
            </a>
            <a class="dropdown-item" href="setting.html">
              <span>Settings</span>
            </a>
            <a class="dropdown-item" href="app.inbox.html">
              <span>Inbox</span>
            </a>
            <a class="dropdown-item" href="app.message.html">
              <span>Message</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="docs.html">
              Need help?
            </a>
            <a class="dropdown-item" href="signin.html">Sign out</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / -->
  
  <!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                  <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">Dashboard</div>
                <!-- nabar right -->
                <ul class="nav navbar-nav pull-right">
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link" data-toggle="dropdown">
                      <i class="ion-android-search w-24"></i>
                    </a>
                    <div class="dropdown-menu text-color w-md animated fadeInUp pull-right">
                      <!-- search form -->
                      <form class="navbar-form form-inline navbar-item m-a-0 p-x v-m" role="search">
                        <div class="form-group l-h m-a-0">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search projects...">
                            <span class="input-group-btn">
                              <button type="submit" class="btn white b-a no-shadow"><i class="fa fa-search"></i></button>
                            </span>
                          </div>
                        </div>
                      </form>
                      <!-- / search form -->
                    </div>
                  </li>
                  <li class="nav-item dropdown pos-stc-xs">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <!--<i class="ion-android-notifications-none w-24"></i>-->
					  <!--<i class="fa fa-power-off"></i>-->
                      <!--<span class="label up p-a-0 danger"></span>-->
                    </a>
                    <!-- dropdown -->
                    <div class="dropdown-menu pull-right w-xl animated fadeIn no-bg no-border no-shadow">
                        <div class="scrollable" style="max-height: 220px">
                          <ul class="list-group list-group-gap m-a-0">
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="<?=base_url('assets')?>/images/a0.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                Use awesome <a href="#" class="text-primary">animate.css</a><br>
                                <small class="text-muted">10 minutes ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="<?=base_url('assets')?>/images/a1.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Joe</a> Added you as friend<br>
                                <small class="text-muted">2 hours ago</small>
                              </span>
                            </li>
                            <li class="list-group-item dark-white text-color box-shadow-z0 b">
                              <span class="pull-left m-r">
                                <img src="<?=base_url('assets')?>/images/a2.jpg" alt="..." class="w-40 img-circle">
                              </span>
                              <span class="clear block">
                                <a href="#" class="text-primary">Danie</a> sent you a message<br>
                                <small class="text-muted">1 day ago</small>
                              </span>
                            </li>
                          </ul>
                        </div>
                    </div>
                    <!-- / dropdown -->
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link clear" data-toggle="dropdown">
                      <span class="avatar w-32">
                        <img src="<?=base_url('assets')?>/images/a3.jpg" class="w-full rounded" alt="...">
                      </span>
                    </a>
                    <div class="dropdown-menu w dropdown-menu-scale pull-right">
                      <a class="dropdown-item" href="profile.html">
                        <span>Profile</span>
                      </a>
                      <a class="dropdown-item" href="setting.html">
                        <span>Settings</span>
                      </a>
                      <a class="dropdown-item" href="app.inbox.html">
                        <span>Inbox</span>
                      </a>
                      <a class="dropdown-item" href="app.message.html">
                        <span>Message</span>
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="docs.html">
                        Need help?
                      </a>
                      <a class="dropdown-item" href="<?=base_url('logout')?>">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- / navbar right -->
          </div>
    </div>
    <div class="app-footer white bg p-a b-t">
      <div class="pull-right text-sm text-muted">Version 1.0.1</div>
      <span class="text-sm text-muted">&copy; Copyright.</span>
    </div>
	
	
  <!-- ############ SWITHCHER START-->
    <div id="switcher">
      <div class="switcher dark-white" id="sw-theme">
        <a href="#" data-ui-toggle-class="active" data-ui-target="#sw-theme" class="dark-white sw-btn">
          <i class="fa fa-gear text-muted"></i>
        </a>
        
        <div class="box-divider"></div>
        <div class="box-body">
          <p id="settingLayout" class="hidden-md-down">
            <label class="md-check m-y-xs" data-target="folded">
              <input type="checkbox">
              <i></i>
              <span>Folded Aside</span>
            </label>
            <label class="m-y-xs pointer" data-ui-fullscreen data-target="fullscreen">
              <span class="fa fa-expand fa-fw m-r-xs"></span>
              <span>Fullscreen Mode</span>
            </label>
          </p>
          
          <p>Themes:</p>
          <div data-target="bg" class="clearfix">
            <label class="radio radio-inline m-a-0 ui-check ui-check-lg">
              <input type="radio" name="theme" value="">
              <i class="light"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="grey">
              <i class="grey"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="dark">
              <i class="dark"></i>
            </label>
            <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
              <input type="radio" name="theme" value="black">
              <i class="black"></i>
            </label>
          </div>
        </div>
      </div>
    </div>
  <!-- ############ SWITHCHER END-->

<!-- content -->
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
    <div class="app-header white bg b-b">
          
	</div>
    <div class="app-footer white bg p-a b-t">
      <div class="pull-right text-sm text-muted">Version 1.0.1</div>
      <span class="text-sm text-muted">&copy; Copyright.</span>
    </div>
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
            <h4 class="m-a-0 m-b-sm"><?=$record['emp_firstname']?> <?=$record['emp_lastname']?></h4>
            <p class="text-muted"><span class="m-r"><?=$record['emp_role']?></span> <small><i class="fa fa-map-marker m-r-xs"></i><?=$record['name']?>,<?=$record['city']?>,<?=$record['zip']?></small></p>
         
          </div>
        </div>
        <div class="col-sm-5">
        
          <div class="collapse box m-t-sm" id="editor">
            <textarea class="form-control no-border" rows="2" placeholder="Type something..."></textarea>
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
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_1">Time Punches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_2">Appointments </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_3">Assigned Doctors</a>
            </li>
            <li class="nav-item">
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
          <div class="tab-pane p-v-sm active" id="tab_1">
		      <table id="my_table" data-ui-jp="dataTable" class="table table-striped b-t b-b">
          <thead>
            <tr>        
              <th>Time-In</th>
              <th>Time-Out</th>
            </tr>
          </thead>
          <tbody>
		  <?php
			if ($timepunches == NULL) {
			?>
				
			<?php
			} else {
				foreach ($timepunches as $row) {
				?>
            <tr>            
              <td><?php echo $row->time_in; ?>&nbsp;<?php echo $row->time_in_date; ?></td>
              <td><?php echo $row->time_out; ?>&nbsp;<?php echo $row->time_out_date; ?></td>
            </tr>
			<?php
					}
				}
				?>          
          </tbody>
        </table>
		
            </div>
          <div class="tab-pane p-v-sm" id="tab_2">
			  <table class="table m-b-none default footable-loaded footable" id="all-empcall-tbl" style="width:1060px;">
				<thead>
					<tr>
						<!--<th data-class="expand">#</th>-->
																	
						<th>Call Log Timestamp</th>												
						<th>First Name</th>												
						<th data-hide="phone">Last Name</th>												
						<th data-hide="phone">Call Result</th>																				
						<th data-hide="phone">Doctor</th>												
																							
																									
					</tr>
				</thead>
				<tbody>
				</tbody>									
			 </table>
          </div>
          <div class="tab-pane p-v-sm" id="tab_3">
              <div class="row row-sm">
			  <?php
				if ($assigneddoc == NULL) {
				?>
					
				<?php
				} else {
					foreach ($assigneddoc as $row) {
					?>
                <div class="col-xs-6 col-lg-4">
                  <div class="list-item box r m-b">
                    <a herf class="list-left">
                      <span class="w-40 avatar">
                        <img src="<?=base_url('assets')?>/images/a0.jpg" alt="...">
                        <i class="on b-white bottom"></i>
                      </span>
                    </a>
                    <div class="list-body">
                      <div class="text-ellipsis"><a href="#"><?php echo $row->doc_firstname; ?></a></div>
                      <small class="text-muted text-ellipsis"><?php echo $row->city; ?></small>
                    </div>
                  </div>
                </div>
				<?php
						}
					}
					?>      
                </div>
          </div>
          <div class="tab-pane p-v-sm" id="tab_4">
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Cell Phone</small>
                <div class="_500"><?=$record['emp_phone']?></div>
              </div>
              <div class="col-xs-6">
                <small class="text-muted">Address</small>
                <div class="_500"><?=$record['emp_add1']?></br> <?=$record['emp_add2']?></div>
              </div>
            </div>
            <div class="row m-b">
              <div class="col-xs-6">
                <small class="text-muted">Email ID</small>
                <div class="_500"><?=$record['emp_email']?></div>
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
        </div>
      </div>
      <!--<div class="col-sm-4 col-lg-3">
        <div>
          <div class="box">
              <div class="box-header">
                <h3>Who to follow</h3>
              </div>
              <div class="box-divider m-a-0"></div>
              <ul class="list no-border p-b">
                <li class="list-item">
                  <a herf class="list-left">
                    <span class="w-40 avatar">
                      <img src="<?=base_url('assets')?>/images/a4.jpg" alt="...">
                      <i class="on b-white bottom"></i>
                    </span>
                  </a>
                  <div class="list-body">
                    <div><a href="#">Chris Fox</a></div>
                    <small class="text-muted text-ellipsis">Designer, Blogger</small>
                  </div>
                </li>
                <li class="list-item">
                  <a herf class="list-left">
                    <span class="w-40 avatar">
                      <img src="<?=base_url('assets')?>/images/a5.jpg" alt="...">
                      <i class="on b-white bottom"></i>
                    </span>
                  </a>
                  <div class="list-body">
                    <div><a href="#">Mogen Polish</a></div>
                    <small class="text-muted text-ellipsis">Writter, Mag Editor</small>
                  </div>
                </li>
                <li class="list-item">
                  <a herf class="list-left">
                    <span class="w-40 avatar">
                      <img src="<?=base_url('assets')?>/images/a6.jpg" alt="...">
                      <i class="busy b-white bottom"></i>
                    </span>
                  </a>
                  <div class="list-body">
                    <div><a href="#">Joge Lucky</a></div>
                    <small class="text-muted text-ellipsis">Art director, Movie Cut</small>
                  </div>
                </li>
                <li class="list-item">
                  <a herf class="list-left">
                    <span class="w-40 avatar">
                      <img src="<?=base_url('assets')?>/images/a7.jpg" alt="...">
                      <i class="away b-white bottom"></i>
                    </span>
                  </a>
                  <div class="list-body">
                    <div><a href="#">Folisise Chosielie</a></div>
                    <small class="text-muted text-ellipsis">Musician, Player</small>
                  </div>
                </li>
                <li class="list-item">
                  <a herf class="list-left">
                    <span class="w-40 circle green avatar">
                      P
                      <i class="away b-white bottom"></i>
                    </span>
                  </a>
                  <div class="list-body">
                    <div><a href="#">Peter</a></div>
                    <small class="text-muted text-ellipsis">Musician, Player</small>
                  </div>
                </li>
              </ul>
          </div>
          <div class="box info">
            <div class="box-body">
              <a href="#" class="pull-left m-r">
                <img src="<?=base_url('assets')?>/images/a0.jpg" class="img-circle w-40">
              </a>
              <div class="clear">
                <a href="#">@Mike Mcalidek</a>
                <small class="block text-muted">2,415 followers / 225 tweets</small>
                <a href="#" class="btn btn-sm btn-rounded btn-info m-t-xs"><i class="fa fa-twitter m-t-xs"></i> Follow</a>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="box-header">
              <h2>Latest Tweets</h2>
            </div>
            <div class="box-divider m-a-0"></div>
            <ul class="list">
              <li class="list-item">
                <div class="list-body">
                  <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                  <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 2 minuts ago</small>
                </div>
              </li>
              <li class="list-item">
                <div class="list-body">
                  <p>Morbi nec <a href="#" class="text-info">@Jonathan George</a> nunc condimentum ipsum dolor sit amet, consectetur</p>
                  <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 1 hour ago</small>
                </div>
              </li>
              <li class="list-item">
                <div class="list-body">                   
                  <p><a href="#" class="text-info">@Josh Long</a> Vestibulum ullamcorper sodales nisi nec adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis</p>
                  <small class="block text-muted"><i class="fa fa-fw fa-clock-o"></i> 2 hours ago</small>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>-->
    </div>
  </div>

<!-- ############ PAGE END-->

    </div>
  </div>
  <!-- / -->

<!-- core -->
  <script src="<?=base_url('assets')?>/libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="<?=base_url('assets')?>/libs/PACE/pace.min.js"></script>
  <!--script src="<?=base_url('assets')?>/libs/jquery-pjax/jquery.pjax.js"></script-->
  <script src="<?=base_url('assets')?>/libs/blockUI/jquery.blockUI.js"></script>
  <script src="<?=base_url('assets')?>/libs/jscroll/jquery.jscroll.min.js"></script>
<!---- Datatables Libs---->
  <script src="<?=base_url('assets')?>/libs/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets')?>/libs/datatables/media/js/dataTables.bootstrap4.min.js"></script>
<!---- Datatables Ends Here--->  
  <script src="<?=base_url('assets')?>/scripts/config.lazyload.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-load.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-jp.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-include.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-device.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-form.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-modal.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-nav.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-list.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-screenfull.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-scroll-to.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-toggle-class.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-taburl.js"></script>
  <script src="<?=base_url('assets')?>/scripts/app.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ajax.js"></script>
  <script src="<?= base_url('assets') ?>/scripts/tinymce/tinymce.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets') ?>/scripts/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
  <!----- chosen jquery----------->
  <script src="<?=base_url('assets')?>/scripts/chosen.jquery.js"></script> 
  <script src="<?=base_url('assets')?>/scripts/prism.js"></script> 
  <!--- chosen jquery ends here---->
  <script src="http://malsup.github.com/jquery.form.js"></script>
  <script src="<?=base_url('assets')?>/scripts/comns.js" type="text/javascript"></script>
  <script src="<?=base_url('assets')?>/scripts/scripts.js" type="text/javascript"></script>
  <script src="<?=base_url('assets')?>/scripts/bootstrap-timepicker.min.js"></script>
  <script src="<?=base_url('assets')?>/scripts/bootstrap-datetimepicker.js"></script>
  <script>
		$(document).ready(function () {
			 var table;
			var responsiveHelper = undefined;
			var responsiveHelper1 = undefined;
			var responsiveHelper2 = undefined;
			var responsiveHelper3 = undefined;
			var responsiveHelper4 = undefined;
			var responsiveHelper5 = undefined;
			var responsiveHelper6 = undefined;
			var responsiveHelper7 = undefined;
			var breakpointDefinition = {
				lap: 1440,
				tablet: 1024,
				phone : 480
			};
			 
			   table = $('#all-empcall-tbl').DataTable({ 
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('doctor/getCalllogByEmp/'.$emp_id)?>",
					"type": "POST"
				},
				//Set column definition initialisation properties.
				"columnDefs": [
				{ 
				  "targets": [ -1 ], //last column
				  "orderable": false, //set not orderable
				},
				],
			  });
			  
		});
	</script>
	<script>
		var close = document.getElementsByClassName("closebtn");
		var i;

		for (i = 0; i < close.length; i++) {
			close[i].onclick = function(){
				var div = this.parentElement;
				div.style.opacity = "0";
				setTimeout(function(){ div.style.display = "none"; }, 600);
			}
		}
		</script>
	<script type="text/javascript">
		var config = {
		  '.chosen-select'           : {},
		  '.chosen-select-deselect'  : {allow_single_deselect:true},
		  '.chosen-select-no-single' : {disable_search_threshold:10},
		  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		  '.chosen-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
		  $(selector).chosen(config[selector]);
		}
	</script>
<!-- endbuild -->
</body>
</html>
