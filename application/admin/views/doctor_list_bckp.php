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
                     
                      <a class="dropdown-item" href="">
                        <span>Change Password</span>
                      </a>
                      <div class="dropdown-divider"></div>
                     
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
      <h2>Doctors</h2>
      
    </div>
    <div class="box-body">
	<div class="row">
	
	<!--<div class="col-md-8 col-sm-4">
      Search: <input id="filter" type="text" class="form-control input-sm w-auto inline m-r">
	</div>  -->
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('doctor/add')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Add Doctor</a>
			
          </p>
	</div>
	<div class="col-md-2 col-sm-4">
		<p>
            <a href="<?=base_url('doctor/upload')?>" class="btn btn-sm black"><i class="fa fa-plus pull-left"></i>Upload Doctor</a>
			
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
                            These Doctors  already exists in database
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
	
      <table class="table m-b-none default footable-loaded footable" id="all-doc-tbl" style="width:1060px;">
		<thead>
			<tr>
				<th>First Name</th>												
				<th data-hide="phone">Last Name</th>												
				<th data-hide="phone">Clinic Name</th>															
				<th data-hide="phone">Schedule Specific</th>												
				<th data-hide="phone">Schedule</th>												
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
  <!--script src="<?=base_url('assets')?>/scripts/datatbl-inits.js"></script-->
  
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
	<script>
		$(document).ready(function () {
			 var table;
			
			  table = $('#all-doc-tbl').DataTable({ 
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('doctor/getDocAll/'.$doc_id)?>",
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
		
<!-- endbuild -->
</body>
</html>
