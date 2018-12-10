<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->model('signup_model');
			$this->load->model('employee_model');
			$this->load->model('team_model');
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
		$data['main_content2']='team_list';	
		$this->load->view('template2/body',$data);		
	}
	
	 function ajGetTeamMem(){
				$ids = $_POST['emp'];
				if(!empty($ids)){
					$bpd = $this->employee_model->getDetailsByIds($ids);
					if($bpd['num']>0){
						foreach($bpd['data'] as $bp){
								 echo "<option value='$bp->emp_id'>$bp->emp_firstname</option>";
						}
					}
	          }
	     }
	
	 
	 
	public function add(){
		$data['main_content2']='add_team';	
		$this->load->view('template2/body',$data);
	}
	
	
	function create_team(){
		$team_name = $_POST['team_name'];
		if($team_name=='' ){
		  $this->session->set_flashdata('invalid','Please enter team name');
			}
		 $_SESSION['team_name'] = $team_name;
		
		 redirect('team/assignEmployeeTeam');	 
		
	}
	
	function assignEmployeeTeam(){
		// print_r($_SESSION['team_name']);exit;
		$data['employees'] = $this->employee_model->selectAllEmpActive();
		$data['team_name'] = $_SESSION['team_name'];
		$data['main_content2'] = 'assign_emp_team';		 
		$this->load->view('template2/body',$data);
	}
	
	function assnemp_create_team(){
		extract($_POST);
		/*echo "<pre>";
		print_r($_FILES);
		print_r($_POST);*/
		$status=0;
		$msg='';
		if($this->input->post('team_members')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please assign members</strong>
			</div>' ;
			
		 }else if($this->input->post('team_lead')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please assign lead</strong>
			</div>' ;
			
		 } else{	
			$insert_data = array(
			    'team_name' => $team_name,
			    'team_lead' => $team_lead,
				'team_status' => 1,
				'team_members'=>implode(",",$this->input->post('team_members')),			
                'created_on'=> date('Y-m-d H:i:s'),			
			);
		 }
			$q = $this->team_model->assnTeamEmp($insert_data);
			if($q){			
	            $status=1;			
				 $msg='<div class="alert alert-success">
						  <span class="closebtn">&times;</span>  
						  <strong>Team Has Been Created Successfully!!</strong>
						</div>' ;
			}else{
				 $msg='<div class="alert alert-warning">
						  <span class="closebtn">&times;</span>  
						  <strong>Unable To Assign, Try Again !!</strong>
						</div>' ;		
			}
		
		 $res = array('status'=>$status,'msg'=>$msg);
		 echo json_encode($res); exit;
	}
	
	/***** get team****/
	function getTeamAll(){
		$column = array('t.team_name','e.emp_firstname');
		$order = array('t.team_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'employee as e','on'=>'e.emp_id=t.team_lead'); 
		//$join[] = array('table_name'=>'employee as e','on'=>'e.emp_id=t.team_members'); 
		/*$where="posted_by='".$this->reg_by."'";*/
		$where="e.emp_id!='0'";
		$tb_name = 'team as t';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('team/view/'.$req->team_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('team/edit/'.$req->team_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="javascript:void(0);" data-clid="'.$req->team_id.'"  class="btn btn-sm btn-icon rounded black del-team"><i class="fa fa-remove"></i></a>';
			/*$status = ($req->emp_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';*/
			//$edit = '<a href="'.base_url('employee/edit/'.$req->emp_id).'" >'.$req->emp_id.'</a>';
			$no++;
			$row = array();
			$row[] = $req->team_name;
			$row[] = $req->emp_firstname;
			$row[] = $actions;
			$data[] = $row;
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->datatbl->count_all($tb_name,$join),
				"recordsFiltered" => $this->datatbl->count_filtered($column,$order,$tb_name,$join,$where),
				"data" => $data,
			);
		echo json_encode($output);
	}
	         
	function edit(){
		$id = $this->uri->segment('3');
		$td = $this->team_model->getDetails($id);
		if($td['num']==1){	
		    $data['employees'] = $this->employee_model->selectAllEmpActive();
			$data['record'] = $td['data'][0];
			$data['main_content2'] = 'edit_team';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('team');
		}
	}
	
	function view(){
		$id = $this->uri->segment('3');
		$ed = $this->team_model->getDetails($id);
		if($ed['num']==1){	
		    $data['employees'] = $this->employee_model->selectAllEmpActive();
			$data['record'] = $ed['data'][0];
			$data['main_content2'] = 'view_team';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('team');
		}
	}
	
	/* function del(){
		$id = $this->uri->segment('3');
		$cd = $this->team_model->getDetails($id);
		if($cd['num']==1){	 
			$this->team_model->del($id);
			$this->session->set_flashdata('success','"'.$cd['data']['0']['team_name'].'" deleted successfully');
			redirect('team');			
		}else{
			$this->session->set_flashdata('invalid','invalid request');
			redirect('team');
		}
	}*/
	
	function del(){
		$success=0;
		$msg = '';
		if(isset($_POST['e']) && $_POST['e']>0){
			$id = $_POST['e'];
			    
			$q = $this->team_model->del($id);
			if($q){
				$success=1;
				$msg = $this->comm_fun->success_msg('Team deleted successfully');	
				$this->session->set_flashdata('success','Team Deleted Successfully!!!!');				
			}else{
				$msg = $this->comm_fun->warning_msg('Something went wrong, please try again');
				$this->session->set_flashdata('warning','Something went wrong, please try again');	
			}
		}else{
			$msg = $this->comm_fun->warning_msg('Invalid Request, please try again');
			$this->session->set_flashdata('danger','Invalid Request, please try again');
		}
		echo json_encode(array('success'=>$success,'msg'=>$msg));
	}
	
	function update_team(){
	   extract($_POST);
		$status=0;
		$msg='';
		$id = $this->uri->segment('3');
		$td = $this->team_model->getDetails($id);
		if($td['num']==1){			
			  if($this->input->post('team_name')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter team name</strong>
			</div>' ;
			
		 }else if($this->input->post('team_members')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select team members</strong>
			</div>' ;
			
		 }else if($this->input->post('team_lead')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select team lead</strong>
			</div>' ;
			
		 }else{
			     $update_data = array();
				 $update_data = array(
						'team_name'=>addslashes($team_name),
						'team_lead'=>addslashes($team_lead),
						'team_members'=>implode(",",$this->input->post('team_members')),		
					);
			 	
				 $q = $this->team_model->modify_team($update_data,$id);
				 if($q){
				$status=1;
			   $this->session->set_flashdata('success','Team Updated successfully!!!!');
			   $msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Team Updated Successfully</strong></div>';	 
				
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