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
            <h4 class="m-a-0 m-b-sm"><?=$record['team_name']?> </p>
            <!--<div class="block clearfix m-b">
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
        <div class="col-sm-5">
         <!--<p class="text-md profile-status">I am feeling good!</p>
          <button class="btn btn-sm rounded btn-outline b-success" data-toggle="collapse" data-target="#editor">Edit</button>
          <div class="collapse box m-t-sm" id="editor">
            <textarea class="form-control no-border" rows="2" placeholder="Type something..."></textarea>
          </div>-->
        </div>
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
            <li class="nav-item active">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_1">Assigned Members</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_2">Appointments </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_3">Assigned Doctors</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="tab" data-target="#tab_4">Profile</a>
            </li>-->
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
		   <div class="row row-sm">
		    <?php
			if($record['team_members']!=""){
				$ids = explode(',',$record['team_members']);
				if(!empty($ids)){
					$bpd = $this->employee_model->getDetailsByIds($ids);
					//print_r($ids);exit;
					if($bpd['num']>0){
						foreach($bpd['data'] as $bp){
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
										  <div class="text-ellipsis"><a href="#"> <?=$bp->emp_firstname?> <?=$bp->emp_lastname?></a></div>
										  <small class="text-muted text-ellipsis"></small>
										</div>
									  </div>
									</div>
							<?php
						}
					}
				}
			}
		  ?>
		  
			
                
				
                </div>
            </div>
          <!--div class="tab-pane p-v-sm" id="tab_2">
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
              </div>
            </div>
            <!--<div>
              <small class="text-muted">Bio</small>
              <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id neque quam. Aliquam sollicitudin venenatis ipsum ac feugiat. Vestibulum ullamcorper sodales nisi nec condimentum. Mauris convallis mauris at pellentesque volutpat. Phasellus at ultricies neque, quis malesuada augue.</div>
            </div>
          </div>-->
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
