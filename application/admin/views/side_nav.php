 <div data-flex class="hide-scroll">
          <nav class="scroll nav-stacked nav-stacked-rounded nav-color">
            
            <ul class="nav" data-ui-nav>
			
			
			   <?php 
				    $mem_type = $this->session->userdata("platinum_user_type");
					if($mem_type == "EMPLOYEE"){
						$menuAry = array(
									'Dashboard'=>array(
											'icon'=>'<span class="nav-icon text-white no-fade"><i class="ion-filing"></i></span>',
											'controller'=>'dashboard',
											'methods'=>array(),
										),
										
								/*	'Employee'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-person"></i></span>',
											'controller'=>'employee',
											'methods'=>array(),
									  ),	*/
									  'Offices'=>array(
											'icon'=>'',
											'span'=>'',
											'controller'=>'doctor',
											'methods'=>array('All'=>'','Active'=>'active','Inactive'=>'inactive'),
									  ),	
									/*  'Team'=>array(
											'icon'=>'<span class="nav-icon">	<i class="ion-person-stalker"></i></span>',
											'controller'=>'team',
											'methods'=>array(),
									  ),	*/
									  'Time Clock'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-clock"></i></span>',
											'controller'=>'timeclock',
											'methods'=>array(),
									  ),
										/*'Doctor Call Log '=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span>',
											'controller'=>'doctor/calllog',
											'methods'=>array(),
									  ),	*/
									'Doctor Call Log'=>array(
											'icon'=>'',
											'span'=>'',
											'controller'=>'doctor',
											'methods'=>array('All'=>'calllog','RA'=>'reqAtt'),
									  ),											  
									 /* 'Message'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-chatbubble-working"></i></span>',
											'controller'=>'message/view/1',
											'methods'=>array(),
									  ),	*/
									 /* 'Manage Time Punch'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span></i></span>',
											'controller'=>'Managetime',
											'methods'=>array(),
									  ),	
									  'Manage Break Punch'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span>',
											'controller'=>'Managebreak',
											'methods'=>array(),
									  ),	*/
									  
									  
									/*'Doctors'=>array(
											'icon'=>'<i class="fa fa-list"></i>',
											'span'=>'<span class="menu-arrow"></span>',
											'controller'=>'bookings',
											'methods'=>array('All'=>'','Active'=>'','In-Active'=>''),
								    	),	*/
								);
					}else{
						$menuAry = array(
									'Dashboard'=>array(
											'icon'=>'<span class="nav-icon text-white no-fade"><i class="ion-filing"></i></span>',
											'controller'=>'dashboard',
											'methods'=>array(),
										),
										'Time off request'=>array(
											'icon'=>'<span class="nav-icon text-white no-fade"><i class="ion-filing"></i></span>',
											'controller'=>'time_off_req',
											'methods'=>array(),
										),
									'Employee'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-person"></i></span>',
											'controller'=>'employee',
											'methods'=>array('All'=>'','Active'=>'active','Inactive'=>'inactive'),
									  ),	
									    'Offices '=>array(
											'icon'=>'',
											'span'=>'',
											'controller'=>'doctor',
											'methods'=>array('All'=>'','Active'=>'active','Inactive'=>'inactive'),
									  ),	
									  'Team'=>array(
											'icon'=>'<span class="nav-icon">	<i class="ion-person-stalker"></i></span>',
											'controller'=>'team',
											'methods'=>array(),
									  ),	
									  'Time Clock'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-clock"></i></span>',
											'controller'=>'timeclock',
											'methods'=>array(),
									  ),	
									  'Message'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-chatbubble-working"></i></span>',
											'controller'=>'message/view/1',
											'methods'=>array(),
									  ),	
									  'Manage Time Punch'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span></i></span>',
											'controller'=>'Managetime',
											'methods'=>array(),
									  ),	
									 /* 'Manage Break Punch'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span>',
											'controller'=>'Managebreak',
											'methods'=>array(),
									  ),*/	
									 /* 'Doctor Call Log '=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span>',
											'controller'=>'doctor/calllog',
											'methods'=>array(),
									  ),*/
										'Doctor Call Log'=>array(
											'icon'=>'',
											'span'=>'',
											'controller'=>'doctor',
											'methods'=>array('All'=>'calllog','RA'=>'reqAtt'),
									  ),										  
									  'Reports'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span>',
											'controller'=>'Reports',
											'methods'=>array(),
									  ),	
									  'Goals'=>array(
											'icon'=>'<span class="nav-icon"><i class="ion-search"></i></span>',
											'controller'=>'Goals',
											'methods'=>array(),
									  ),	
								/*	'Doctors'=>array(
											'icon'=>'<i class="fa fa-list"></i>',
											'span'=>'<span class="menu-arrow"></span>',
											'controller'=>'bookings',
											'methods'=>array('All'=>'','Active'=>'','In-Active'=>''),
								    	),	*/						
								);
					}
				 ?>
						
				<?php
				foreach($menuAry as $k=>$v){
					echo "<li>";
					if(!empty($v['methods'])){
									$sub = ($this->router->fetch_class()==$v['controller'])?'subdrop':'';
									$sub1 = ($this->router->fetch_class()==$v['controller'])?'display:block':'';
									  echo " <a><span class='nav-caret'><i class='fa fa-caret-down'></i></span><span class='nav-icon'><i class='ion-person'></i></span><span class='nav-text'>".$k."</span></a>";
							echo "<ul class='nav-sub'>";
								foreach($v['methods'] as $mk=>$mv){
									$listLabel = ($mv=='')?$v['controller']:$mk;
									echo "<li><a href='".base_url($v['controller'].'/'.$mv)."'> <span class='nav-text'>".$mk."</span></a></li>";
								}
							echo "</ul>";
						}else{
							echo "<a href='".base_url($v['controller'])."'>".$v['icon']."<span class='nav-text'>".$k."</span></a>";
						}
					echo "</li>";
				}
				?>
		</ul>
          </nav>
      </div>