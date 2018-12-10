<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeclock extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->model('timeclock_model');
			$this->load->library('datatbl');
	}
	
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
	public function index(){
		$date = date('Y-m-d');
		/*$id = "0";*/
	    $id =	$this->user_id;
		$data['timepunches'] = $this->timeclock_model->selectAllByID($id);
		$data['break'] = $this->timeclock_model->selectBreaksAllByID($id);
		
		$tp = $this->timeclock_model->selectOutEmpty($date,$id);
		if($tp['num']==1){
			$data['tp'] = $tp['data'][0];
		}
		$bp = $this->timeclock_model->selectStopEmpty($date,$id);
	//	print_r($bp);exit;
		if($bp['num']==1){
			$data['bp'] = $bp['data'][0];
		}
	     //$t = $this->timeclock_model->selectTimeEm($date);
		
		$data['main_content2']='time_clock';	
		$this->load->view('template2/body',$data);		
	}
	
	 function insertime() {
		// print_r($_POST); exit;
		    $id = '';
			extract($_POST);
			$status=0;
			$msg='';
			$time = $_POST['time'];
			$tc_id = $_POST['tc_id'];
			$emp_id = $_POST['emp_id'];
			$insert_data = array(	
					'time_in' => $time,
					'emp_id' => $emp_id,
					'time_in_date'=> date('Y-m-d')					
				);				
			if(isset($tc_id) && $tc_id>0){
				$update_data = array(	
					'time_out' =>$time,					
					'time_out_date' =>date('Y-m-d')						
				);			
				$q = $this->timeclock_model->update($update_data,$tc_id);
			}else{
				$q = $this->timeclock_model->create($insert_data);
				$id = $this->db->insert_id();	
			}	
			/*echo $this->db->last_query(); exit;*/
			if($q){	
	            $status=1;			
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Successfully!!</strong>
						</div>' ;
			}else{
				 $msg='<div class="alert alert-warning">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Unable To Update, Try Again !!</strong>
						</div>' ;		
			}
	
		 $res = array('status'=>$status,'msg'=>$msg,'id'=>$id,'tc_id'=>$tc_id,'time'=>$time);
		/* print_r($res); exit;*/
		echo json_encode($res); exit;
	 }
	 
	 
	  function insertbreak() {
		// print_r($_POST); exit;
		    $id =	$this->user_id;
			extract($_POST);
			$status=0;
			$msg='';
			$time = $_POST['time'];
			$tc_id = $_POST['tc_id'];
			$bp_id = $_POST['bp_id'];
			$break_type = $_POST['break_type'];
			$emp_id = $_POST['emp_id'];
			$insert_data = array(	
					'emp_id' =>$emp_id,
					'time_in' =>$time,
					//'tc_id' =>$tc_id,
					'break_type' =>$break_type,
					'break_in_date'=>date('Y-m-d')	
				);				
			if(isset($bp_id) && $bp_id>0){
				$update_data = array(	
					'time_out' =>$time,
					'break_out_date'=>date('Y-m-d')						
				);			
				$q = $this->timeclock_model->update_break($update_data,$bp_id);
			}else{
				$q = $this->timeclock_model->create_break($insert_data);
				$bp_id = $this->db->insert_id();	
			}	
			//echo $this->db->last_query(); exit;
			if($q){	
	            $status=1;			
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Successfully!!</strong>
						</div>' ;
			}else{
				 $msg='<div class="alert alert-warning">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Unable To Update, Try Again !!</strong>
						</div>' ;		
			}
	
		 $res = array('status'=>$status,'msg'=>$msg,'bp_id'=>$bp_id,'tc_id'=>$tc_id,'time'=>$time,'break_type'=>$break_type);
		/* print_r($res); exit;*/
		echo json_encode($res); exit;
	 }
}
?>