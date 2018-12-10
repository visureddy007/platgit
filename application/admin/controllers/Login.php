<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __Construct(){
		parent:: __Construct();
		$this->is_logged_in();
		$this->load->model('signup_model');
	}
	
	function is_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_admin_logged_in');
		if(isset($is_logged_in) && $is_logged_in == true)
		{
			redirect('dashboard');			
		}				
	}


	public function index(){
		$data['main_content']='login';
		$this->load->view('template/body',$data);
	}
	
	
	 
	 function validate(){
		extract($_POST);
		$status=0;
		$msg='';
		if(isset($emp_username) && $emp_username==""){
			$msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Please enter valid username</strong></div>';
		}else if(isset($user_pass) && $user_pass==""){
			$msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Please enter password</strong></div>';
		}else{			
			$ud = $this->signup_model->validate($emp_username,md5($user_pass));		
         // print_r($ud);exit;
			$sess_data = array();
			if($ud['num']==1){
                        $user_type = $ud['data'][0]['user_type'];				
					    $user = $ud['data']['0'];
						$emp_name = $user['emp_firstname'].''.$user['emp_lastname'];					
						$user_name = $user['emp_username'];		
						$user_email = $user['emp_email'];		
						$user_id = $user['emp_id'];	
							$sess_data = array(					
								'platinum_emp_name'=>$emp_name,		
								'platinum_user_name'=>$user_name,		
								'platinum_user_type'=>$user_type,		
								'platinum_user_email'=>$user_email,		
								'platinum_user_id'=>$user_id,		
								'platinum_user_logged_in'=>true
							);
						$this->session->set_userdata($sess_data);						
						$status=1;
						$msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Successfully logged in</strong></div>';
				}else{
				  $msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Please enter valid details</strong></div>';			
			}		 			 
		}
		$res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;
	 }	
}
