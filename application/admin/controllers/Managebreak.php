<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managebreak extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->model('managebreak_model');
			$this->load->model('employee_model');
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
		$data['employees'] = $this->employee_model->selectAllEmpActive();
		$data['main_content2']='emp_break_punches';	
		$this->load->view('template2/body',$data);		
	}
	
	public function getBreakPunches(){		
		$num=0;
		$breakpunches='';
			$date = $_POST['date'];
			$emp_id = $_POST['emp_id'];
			$ed = $this->managebreak_model->getEmpBreakPunches($emp_id,$date);
			$num = $ed['num'];
			if($num > 0){					
				$data['pat'] = $ed;
					$breakpunches.='';
					foreach($ed['data'] as $p){
						$breakpunches.='<tr><td>'.$p->time_in.' &nbsp; '.$p->break_in_date.' </td><td>'.$p->time_out.' &nbsp; '.$p->break_out_date.'</td><td>'.$p->break_type.' </td><td><a href="" class="label deep-orange delBreakPunch" data-id = "'.$p->bp_id.'" >Delete</a></td></tr>';			
					}		
			}
		
		echo json_encode(array('num'=>$num,'breakpunches'=>$breakpunches));
	}
	
	public function breakpunchDel(){
			$e = addslashes($_POST['e']);
			$td = $this->managebreak_model->getDetailsOfBreakPun($e);
			//print_r($sd);exit;
			if($td['num']==1){
				$d = $this->managebreak_model->del_breakpun($e);
				if($d){
					$msg['success']=true;
					$msg['msg']='<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Break Punch Deleted Successfully</strong>
			</div>' ;
				}else{
					$msg['msg']='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Invalid Request</strong>
			</div>' ;
				}
			}else{
				$msg['msg']='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Invalid Request</strong>
			</div>' ;
			}	
		
		echo json_encode($msg);
	}
	
	
	function create_breakpunch(){
		//print_r($_POST);exit;
		extract($_POST);
		$status=0;
		$msg='';
		 if($this->input->post('time_in')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter break in</strong>
			</div>' ;
			
		 }else if($this->input->post('break_in_date')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter break in date</strong>
			</div>' ;
			
		 }else if($this->input->post('time_out')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter break out</strong>
			</div>' ;
			
		 }else if($this->input->post('break_out_date')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter break out date</strong>
			</div>' ;
			
		 }else if($this->input->post('emp')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select employee</strong>
			</div>' ;
			
		 }else if($this->input->post('break_type')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select break type</strong>
			</div>' ;
			
		 } else{	
		   
			$insert_data = array(			
				'time_in'=>addslashes($time_in),
				'break_in_date'=>addslashes($break_in_date),
				'time_out'=>$time_out,
				'break_out_date'=>addslashes($break_out_date),
				'emp_id'=>addslashes($emp),
				'break_type'=>addslashes($break_type),
			);
			$res = $this->managebreak_model->create($insert_data);		
			if($res){
 
                  $status=1;				
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Break Punch created successfully!!</strong>
						</div>' ;
			}else{
				 $msg='<div class="alert alert-warning">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Unable to register please try again later!!</strong>
						</div>' ;
			}
		 }
		 $res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;
	}	
	
	
	
}
?>