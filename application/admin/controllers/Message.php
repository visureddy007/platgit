<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->model('message_model');
			
	}
	
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
  /*	public function index(){
		$data['main_content2']='employee_list';	
		$this->load->view('template2/body',$data);		
	}
	
	public function add(){
		$data['states'] = $this->employee_model->selectAllStates();
		$data['timezone'] = $this->employee_model->selectAllTimezone();
		$data['main_content2']='add_employee';	
		$this->load->view('template2/body',$data);
	}*/
	
	
	function view(){
		$id = $this->uri->segment('3');
		$ed = $this->message_model->getDetails($id);
		if($ed['num']==1){	
			$data['record'] = $ed['data'][0];
			$data['main_content2'] = 'message';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('message');
		}
	}
	
	function modify(){
	   extract($_POST);
		$status=0;
		$msg='';
		$id = $this->uri->segment('3');
		$ed = $this->message_model->getDetails($id);
		if($ed['num']==1){			
			  if($this->input->post('msg_default')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter message default</strong>
			</div>' ;
			
		 }else if($this->input->post('msg_doctor')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter doctor message</strong>
			</div>' ;
			
		 }else{
			     $update_data = array();
				 $update_data = array(
						'msg_default'=>stripcslashes($msg_default),
						'msg_doctor'=>stripcslashes($msg_doctor),		
					);
			 	
				 $q = $this->message_model->modify($update_data,$id);
				 if($q){
				$status=1;
			   $this->session->set_flashdata('success','Employee Updated successfully!!!!');
			   $msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Message Updated Successfully</strong></div>';	 
				
					}else{
							$msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Please Try Again Later</strong></div>';	 		 	
					}	
			 }
		}else{
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong>Invalid action</div>';
		}
		
		 $res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;	
	}	
}
?>