<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __Construct(){
		parent:: __construct();
		
		$this->is_not_logged_in();
	}
	
	function is_not_logged_in()
	{
		$is_logged_in = $this->session->userdata('platinum_admin_logged_in');
		if(isset($is_logged_in) && $is_logged_in != true)
		{
			redirect('login');			
		}		
	}
		
	
	public function index()
	{		
		$sess_data = array(
			'platinum_emp_name'=>'',			
			'platinum_user_name'=>'',			
			'platinum_user_type'=>'',			
			'platinum_user_email'=>'',			
			'platinum_user_id'=>'',			
			'platinum_user_logged_in'=>false
		);
		$this->session->set_userdata($sess_data);
		redirect("login");
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */