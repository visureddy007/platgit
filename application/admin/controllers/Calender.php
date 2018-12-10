<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calender extends CI_Controller {
	 public  $stateArray=array();
	 public  $timezoneArray=array();
	//private $uid;
	//private $group_id;
	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->load->model('signup_model');
			$this->load->model('employee_model');
			$this->load->model('timeclock_model');
			$this->load->model('doctor_model');
			$this->load->model('excel_model');
			$this->load->library('excel_reader');
			$this->stateArray = $this->excel_model->stateCodeArray();
			$this->timezoneArray = $this->excel_model->timezoneCodeArray();
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
		
	}
	
    function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
	public function index(){
		$ed = $this->doctor_model->selectForCalander();
		$data['ev_bind'] = $ed['data'];
		//print_r($ed);exit;
		$data['main_content2']='calendar';	
		$this->load->view('template2/body',$data);		
	}
	
	/*public function updateDate(){
		print_r($_POST);exit;
			
		}*/
		
	function updateDate(){
	   extract($_POST);
			 $update_data = array();
			 $update_data = array(
				'appt_date'=>addslashes($_POST['start_date']),
				);
			 $q = $this->doctor_model->modify_calllog($update_data,$_POST['cl_id']);
				 if($q){
				$status=1;
			   $this->session->set_flashdata('success','Doctor Updated successfully!!!!');
			   $msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Doctor Updated Successfully</strong></div>';	 
				}else{
						$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please Try Again Later</strong></div>';	 		 	
				}	
			
		
		
		 $res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;	
	}	

}
?>