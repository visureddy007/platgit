<body>
  <div class="app" id="app">

<!-- ############ LAYOUT START-->

  <div class="padding">
    <div class="navbar">
      <div class="pull-center">
        <!-- brand -->
        <a href="index.html" class="navbar-brand">
        	<div data-ui-include="'images/logo.svg'"></div>
        	<img src="<?=base_url('assets')?>/images/logo.png" alt="." class="hide">
        	<span class="hidden-folded inline">Platinum Recall</span>
        </a>
        <!-- / brand -->
      </div>
    </div>
  </div>
  <div class="b-t">
    <div class="center-block w-xxl w-auto-xs p-y-md text-center">
      <div class="p-a-md">
        
        <form method="post" role="form" action="" id="signin_form" name="signin_form">
		<?=($this->session->flashdata('msg'))?$this->session->flashdata('msg'):'';?>
			<div id="signin_msg"></div>
          <div class="form-group">
           <input class="form-control" type="text" required="" placeholder="User Name" name="emp_username" id="emp_username">
          </div>
          <div class="form-group">
            <input class="form-control" type="password" required="" placeholder="Password" name="user_pass" id="user_pass">
          </div>      
          <div class="m-b-md">        
            <label class="md-check">
              <input type="checkbox"><i class="primary"></i> Keep me signed in
            </label>
          </div>
          <button type="submit" class="btn btn-lg black p-x-lg">Sign in</button>
        </form>
        <div class="m-y">
          <a href="forgot-password.html" class="_600">Forgot password?</a>
        </div>
        <div>
          Do not have an account? 
          <a href="signup.html" class="text-primary _600">Sign up</a>
        </div>
      </div>
    </div>
  </div>

<!-- ############ LAYOUT END-->
  </div>
