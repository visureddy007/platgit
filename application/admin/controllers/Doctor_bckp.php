<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doctor extends CI_Controller {
	 public $stateArray=array();
	 public  $timezoneArray=array();
	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();
			$this->load->model('signup_model');
			$this->load->model('employee_model');
			$this->load->model('doctor_model');
			$this->load->model('excel_model');
			$this->load->model('bookings_model');
			$this->load->library('excel_reader');
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->stateArray = $this->excel_model->stateCodeArray();
			$this->timezoneArray = $this->excel_model->timezoneCodeArray();
			$this->load->library('datatbl');
	}
	
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
	/*public function index(){
	
		$parm = $this->uri->segment(2);		
		$data['doc_id'] = $parm;	
		$this->load->view('doctor_list',$data);		
	}*/
	
		
	function index(){
		 $parm = $this->uri->segment(2);		
		if($parm=='inactive'){	
			$data['doc_id'] = $parm;	 
			$data['title']='Appointments List';
			$this->load->view('doctor_list',$data);
		 }else if($parm=='active'){
			$data['doc_id'] = $parm;	 	 
			$data['title']='Completed List';
			$this->load->view('doctor_list',$data);
		 }else {
			$data['title']='Appointments List';
			$data['doc_id'] = $parm;
			$this->load->view('doctor_list',$data);			
		 }
	 }
	 
	 
	/*public function all(){
		$parm = $this->uri->segment(2);		
		$data['doc_id'] = $parm;	 
		$this->load->view('doctor_list',$data);		
	}
	
	
	
	public function inactive(){
		$data['main_content2']='doctor_inactive_list';	
		$this->load->view('template2/body',$data);		
	}*/
	
	public function add(){
		$data['timezone'] = $this->employee_model->selectAllTimezone();
		$data['states'] = $this->employee_model->selectAllStates();
		$data['main_content2']='add_doctor';	
		$this->load->view('template2/body',$data);
	}
	
	public function upload(){
		$data['main_content2']='upload_doc';	
		$this->load->view('template2/body',$data);
	}
	
	function doupload(){		
		$file_types = array('application/octet-stream','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
		if($_FILES['file1']['name']!=""){
			$file_type = $_FILES['file1']['type'];
			if(in_array($file_type,$file_types)){			
				$file = $_FILES['file1']['tmp_name'];
				$this->excel_reader->read($file);
				$worksheet = $this->excel_reader->sheets[0];
				$numRows = $worksheet['numRows']; 
				$numCols = $worksheet['numCols']; 
				$cells = $worksheet['cells']; 
				//print_r($numCols);exit;
				$already_existsA = array();
				if($numRows>=2 && $numCols==16){			
					$j=0;
					for($i = 2; $i <= count($cells); $i++ ){
							//print_r($cells);
						if($this->excel_model->doc_email_exists($cells[$i][2])>0){
							$already_existsA[] = $cells[$i];
						}else{
							if(isset($this->stateArray[$cells[$i][8]])){
								$insert_data = array(		
									'doc_username' =>$cells[$i][1],
									'doc_email' =>$cells[$i][2],
									'doc_firstname'=>$cells[$i][3],
									'doc_lastname'=>$cells[$i][4],
									'doc_password'=>$cells[$i][5],
									'doc_add1'=>$cells[$i][6],
									'doc_add2'=>$cells[$i][7],
									'state_id'=>$this->stateArray[$cells[$i][8]],
									'city'=>$cells[$i][9],
									'zip'=>$cells[$i][10],
									'doc_phone'=>$cells[$i][11],
									'doc_timezone'=>$this->timezoneArray[$cells[$i][12]],
									'doc_office_name'=>$cells[$i][13],
									'doc_goal_no'=>$cells[$i][14],
									'doc_can_excgoal'=>$cells[$i][15],
									'doc_monthly_fee'=>$cells[$i][16],
									'created_on'=> date('Y-m-d H:i:s')
								);
								$q = $this->excel_model->create_doc($insert_data);
                                if($q){
									 $id = $this->db->insert_id();	
									  $insert_spec = array(
									   'doc_id' => $id
									  );
									  $q = $this->doctor_model->create_doc_spec($insert_spec);
											
								}								
									//echo $this->db->last_query();
							}
							$j++;
						}	
					}
					$this->session->set_flashdata('already_existsA',$already_existsA);
					$this->session->set_flashdata('success',"$j records uploaded successfully");
				}else{
					$this->session->set_flashdata('invalid','Invalid file format or No data exist');
				}
		
			}else{
				$this->session->set_flashdata('invalid','Invalid file type');						
			}			
		}else{
			$this->session->set_flashdata('invalid','Please select file');
		}
		
			redirect('doctor');
	} 
	
	function view(){
		$id = $this->uri->segment('3');
		$dd = $this->doctor_model->getDetails($id);
		$ds = $this->doctor_model->getsch_det($id);
		if($dd['num']==1){	
		    $data['states'] = $this->employee_model->selectAllStates();
			$data['timezone'] = $this->employee_model->selectAllTimezone();
			$tmgs = $this->doctor_model->getScheByID($id);
			$data['tmgs'] =  $tmgs;
			$data['record'] = $dd['data'][0];
			$data['sech_spec'] = $ds['data'][0];
			$data['main_content2'] = 'view_doctor';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('doctor');
		}
	}
	
	function create(){
		//print_r($_POST);exit;
		extract($_POST);
		$status=0;
		$msg='';
		 if($this->input->post('doc_username')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter username</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_email') && $this->signup_model->doc_email_exists($this->input->post('doc_email'))>0){
			 $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Doctor with this "'.$this->input->post('emp_email').'" Email-Id already exists </strong>
			</div>' ;
			
		 }else if($this->input->post('doc_password')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter password</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_firstname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter first name</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_lastname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter lastname</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_add1')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter address line 1</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_add2')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter address line 2</strong>
			</div>' ;
			
		 }else if($this->input->post('state_id')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select state</strong>
			</div>' ;
			
		 }else if($this->input->post('zip')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter zip</strong>
			</div>' ;
			
		 }else if($this->input->post('city')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter city</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_phone')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter phone number</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_office_name')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter office name</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_goal_no')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter goal no</strong>
			</div>' ;
			
		 }/*else if($this->input->post('doc_can_excgoal')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select can doctor exceed goal</strong>
			</div>' ;
			
		 }*/else if($this->input->post('doc_monthly_fee')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter monthly fee</strong>
			</div>' ;
			
		 }
		 else{	
		    $goal = isset($doc_can_excgoal)?"yes":"no";
			$insert_data = array(			
				'doc_username'=>addslashes($doc_username),
				'doc_email'=>addslashes($doc_email),
				'doc_password'=>$doc_password,
				'doc_firstname'=>addslashes($doc_firstname),
				'doc_lastname'=>addslashes($doc_lastname),
				'doc_add1'=>addslashes($doc_add1),
				'doc_add2'=>addslashes($doc_add2),
				'state_id'=>addslashes($state_id),
				'zip'=>addslashes($zip),
				'city'=>addslashes($city),
				'doc_timezone'=>addslashes($doc_timezone),
				'doc_phone'=>addslashes($doc_phone),
				'doc_office_name'=>addslashes($doc_office_name),
				'doc_goal_no'=>addslashes($doc_goal_no),
				'doc_can_excgoal'=>addslashes($goal), 	
				'doc_monthly_fee'=>addslashes($doc_monthly_fee), 	
				'doc_status'=>1,					
				'created_on'=> date('Y-m-d H:i:s')
			);
			$res = $this->doctor_model->create($insert_data);		
			if($res){
                  $id = $this->db->insert_id();	
					  $insert_spec = array(
					   'doc_id' => $id
					  );
					  $q = $this->doctor_model->create_doc_spec($insert_spec);
                  $status=1;				
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Doctor created successfully!!</strong>
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
	
	   /***** get doctors****/
	function getDocAll(){
		$assn_doc = $this->employee_model->getDocAssnedByEmpId($this->user_id);
		$parm = $this->uri->segment(3);	
	//	print_r($parm);exit;
		$assn_ids = implode(',',$assn_doc);
		$column = array('doc_id','doc_username','doc_email','doc_firstname','doc_lastname','doc_phone');
		$order = array('doc_id' => 'desc');
		$join = array();
		/*$where="posted_by='".$this->reg_by."'";*/
		if($this->user_id != 0 && $parm  == 'active'){
			$where="doc_id IN ($assn_ids) AND doc_status ='1'";
		}else if($this->user_id != 0 && $parm  == 'inactive'){
			$where="doc_id IN ($assn_ids) AND doc_status ='0'";
		}else if($this->user_id != 0 && $parm  == 'all'){
			$where="doc_id IN ($assn_ids)";
		}else{
			$where="doc_id!='0'";
		}
		if($this->user_id == 0 && $parm  == 'active'){
			$where="doc_status ='1'";
		}
		if($this->user_id == 0 && $parm  == 'inactive'){
			$where="doc_status ='0'";
		}
		$tb_name = 'doctors';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('doctor/view/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/edit/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/del/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-remove"></i></a>';
			$status = ($req->doc_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';
			$schedulespec='<a  href="'.base_url('doctor/schespec/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View	</button></a>';
			$schedule='<a  href="'.base_url('doctor/sche/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View	</button></a>';
			$bookapt='<a  href="'.base_url('doctor/docApts/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View</button></a>';
			$call_log='<a  href="'.base_url('doctor/calllog/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View</button></a>';
			$no++;
			$row = array();
			//$row[] = '';
			$row[] = $req->doc_firstname;
			$row[] = $req->doc_lastname;
			$row[] = $req->doc_office_name;
			/*$row[] = $req->doc_email.'<br>'.$req->doc_phone;*/
			$row[] = $schedulespec;
			$row[] = $schedule;
			$row[] = $bookapt;
			$row[] = $call_log;
			$row[] = $actions;
			$row[] = $status;
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
	  /***** get doctors****/
	function getDocAllActive(){
		$column = array('doc_id','doc_username','doc_email','doc_firstname','doc_lastname','doc_phone');
		$order = array('doc_id' => 'desc');
		$join = array();
		/*$where="posted_by='".$this->reg_by."'";*/
		$where="doc_status='1'";
		$tb_name = 'doctors';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('doctor/view/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/edit/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/del/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-remove"></i></a>';
			$status = ($req->doc_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';
			$schedulespec='<a  href="'.base_url('doctor/schespec/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View	</button></a>';
			$no++;
			$row = array();
			//$row[] = '';
			$row[] = $req->doc_firstname;
			$row[] = $req->doc_lastname;
			$row[] = $req->doc_office_name;
			$row[] = $req->doc_email.'<br>'.$req->doc_phone;
			$row[] = $schedulespec;
			$row[] = $actions;
			$row[] = $status;
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
	  
	function getDocAllInActive(){
		$column = array('doc_id','doc_username','doc_email','doc_firstname','doc_lastname','doc_phone');
		$order = array('doc_id' => 'desc');
		$join = array();
		/*$where="posted_by='".$this->reg_by."'";*/
		$where="doc_status='0'";
		$tb_name = 'doctors';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('doctor/view/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/edit/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/del/'.$req->doc_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-remove"></i></a>';
			$status = ($req->doc_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';
			$schedulespec='<a  href="'.base_url('doctor/schespec/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View	</button></a>';
			$no++;
			$row = array();
			//$row[] = '';
			$row[] = $req->doc_firstname;
			$row[] = $req->doc_lastname;
			$row[] = $req->doc_office_name;
			$row[] = $req->doc_email.'<br>'.$req->doc_phone;
			$row[] = $schedulespec;
			$row[] = $actions;
			$row[] = $status;
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
		$dd = $this->doctor_model->getDetails($id);
		if($dd['num']==1){	
		    $data['states'] = $this->employee_model->selectAllStates();
			$data['timezone'] = $this->employee_model->selectAllTimezone();
			$data['record'] = $dd['data'][0];
			$data['main_content2'] = 'edit_doctor';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('doctor');
		}
	}
	
	function sche(){
		$id = $this->uri->segment('3');
		$dd = $this->doctor_model->getDetails($id);
		if($dd['num']==1){	
			$data['record'] = $dd['data'][0];
			$tmgs = $this->doctor_model->getScheByID($id);
			$data['tmgs'] =  $tmgs;
			$data['main_content2'] = 'doc_schedule';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('doctor');
		}
	}
	
	function bookapt(){
		$id = $this->uri->segment('3');
		$dd = $this->doctor_model->getDetails($id);
		if($dd['num']==1){	
			$data['record'] = $dd['data'][0];
			$data['main_content2'] = 'book_apt';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('doctor');
		}
	}
	
	function sche_modify(){
	    extract($_POST);
		$status=0;
		$msg='';
		$id = $this->uri->segment('3');
		$dd = $this->doctor_model->getDetails($id);
		$doc_id = $dd['data'][0]['doc_id'];
			if($dd['num']==1 ){			
						$day = $_POST['day'];
						$in = $_POST['in'];
						$out = $_POST['out'];
						$tmgsA = array();
						$mtmgsA = array();
						for($i=0;$i<count($day);$i++){
							if($day[$i]!=""){
								if(isset($assid[$i]) && $assid[$i]!=""){									
											$mtmgsA[]=array(
												'day'=>$day[$i],
												'in_time'=>$in[$i],
												'out_time'=>$out[$i],
												'doc_id'=>$id,
												'id'=>$assid[$i],
											);
									}else{
										$tmgsA[]=array(
												'day'=>$day[$i],
												'in_time'=>$in[$i],
												'out_time'=>$out[$i],
												'doc_id'=>$id,
											);
									}	
								}
						}
					if(!empty($tmgsA)){
								$q = $this->doctor_model->create_bulk_time($tmgsA);				
							}else{
								$q = true;
							}
							if(!empty($mtmgsA)){
								$m = $this->doctor_model->update_bulk_time($mtmgsA);	
							}else{
								$m = true;
							}	 
												
				$status=1;
			   /*$this->session->set_flashdata('success','Page Updated successfully!!!!');*/
			   $msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Doctor Updated Successfully</strong></div>';	 
				
		}else{
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong>Invalid action</div>';
		}
		
		 $res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;	
	}
	
	public function timeDel(){
			$e = addslashes($_POST['e']);
			$td = $this->doctor_model->getDetailsOfSche($e);
			//print_r($sd);exit;
			if($td['num']==1){
				$d = $this->doctor_model->del_time($e);
				if($d){
					$msg['success']=true;
					$msg['msg']='<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Timing Deleted Successfully</strong>
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
	
	function del(){
		$id = $this->uri->segment('3');
		$cd = $this->doctor_model->getDetails($id);
		if($cd['num']==1){	 
			$this->doctor_model->del($id);
			$this->session->set_flashdata('success','"'.$cd['data']['0']['doc_firstname'].'" deleted successfully');
			redirect('doctor');			
		}else{
			$this->session->set_flashdata('invalid','invalid request');
			redirect('doctor');
		}
	}
	
	function schespec(){
		$id = $this->uri->segment('3');
		$ds = $this->doctor_model->getsch_det($id);
		$dd = $this->doctor_model->getDetails($id);
		if($dd['num']==1 && $ds['num']==1){
            $data['id']	= $this->uri->segment('3');		
		    $data['states'] = $this->employee_model->selectAllStates();
			$data['record'] = $ds['data'][0];
			$data['main_content2'] = 'scheduling_spec';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('doctor');
		}
	}
	
	function modify(){
	   extract($_POST);
		$status=0;
		$msg='';
		$id = $this->uri->segment('3');
		$ed = $this->employee_model->getDetails($id);
		if($ed['num']==1){			
			   if($this->input->post('doc_username')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter username</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_firstname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter first name</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_lastname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter lastname</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_add1')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter address line 1</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_add2')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter address line 2</strong>
			</div>' ;
			
		 }else if($this->input->post('state_id')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select state</strong>
			</div>' ;
			
		 }else if($this->input->post('zip')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter zip</strong>
			</div>' ;
			
		 }else if($this->input->post('city')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter city</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_phone')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter phone number</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_office_name')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter office name</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_goal_no')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter goal no</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_monthly_fee')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter monthly fee</strong>
			</div>' ;
			
		 }else if($this->input->post('doc_status')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select status</strong>
			</div>' ;
			
		 }else{
			     $goal = isset($doc_can_excgoal)?"yes":"no";
			     $update_data = array();
				 $update_data = array(
					'doc_username'=>addslashes($doc_username),
					'doc_email'=>addslashes($doc_email),
					'doc_firstname'=>addslashes($doc_firstname),
					'doc_lastname'=>addslashes($doc_lastname),
					'doc_add1'=>addslashes($doc_add1),
					'doc_add2'=>addslashes($doc_add2),
					'state_id'=>addslashes($state_id),
					'zip'=>addslashes($zip),
					'city'=>addslashes($city),
					'doc_timezone'=>addslashes($doc_timezone),
					'doc_phone'=>addslashes($doc_phone),
					'doc_office_name'=>addslashes($doc_office_name),
					'doc_goal_no'=>addslashes($doc_goal_no),
					'doc_can_excgoal'=>addslashes($goal),		
					'doc_status'=>addslashes($doc_status),				
					);
			 	
				 $q = $this->doctor_model->modify($update_data,$id);
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
			 }
		}else{
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong>Invalid action</div>';
		}
		
		 $res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;	
	}	
	
	function modify_spec(){
	   extract($_POST);
		$status=0;
		$msg='';
		$id = $this->uri->segment('3');
		$ds = $this->doctor_model->getsch_det($id);
		if($ds['num']==1){			
			     $update_data = array();
				 $update_data = array(
					'pro_names'=>addslashes($pro_names),
					'doc_sche'=>addslashes($doc_sche),
					'hyg_sche'=>addslashes($hyg_sche),
					'insurance_prov'=>addslashes($insurance_prov),
					'adu_chi_age'=>addslashes($adu_chi_age),
					'adu_chi_time'=>addslashes($adu_chi_time),
					'pat_time'=>addslashes($pat_time),
					'sch_det'=>addslashes($sch_det),
					'buzz_word'=>addslashes($buzz_word),
					'perio_sch'=>addslashes($perio_sch),
					'do_you_word'=>addslashes($do_you_word),
					'do_we_call'=>addslashes($do_we_call),
					'how_do_you_ans'=>addslashes($how_do_you_ans),
					'bmx'=>addslashes($bmx),
					'pat_notes'=>addslashes($pat_notes),		
					'initials_appts'=>addslashes($initials_appts),				
					'resetting_recall'=>addslashes($resetting_recall),				
					'passwords'=>addslashes($passwords),				
					'treat_appt'=>addslashes($treat_appt),				
					'other_sche_det'=>addslashes($other_sche_det),				
					'created_on'=> date('Y-m-d H:i:s')	
					);
			 	
				 $q = $this->doctor_model->modify_spec($update_data,$id);
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
			
		}else{
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong>Invalid action</div>';
		}
		
		 $res = array('status'=>$status,'msg'=>$msg);
		echo json_encode($res); exit;	
	}	
	
	function calllog(){
		$doc_id = $this->uri->segment('3');
		$data['doc_id'] = $doc_id;
		$this->load->view('doc_call_log',$data);	
	}
	
	function docApts(){
		$doc_id = $this->uri->segment('3');
		$data['doc_id'] = $doc_id;
		$this->load->view('doc_apts',$data);	
	}
	
	/***** get doctors calllog****/
	function getCalllog(){
		$user_id  = $this->user_id;
		$assn_doc = $this->employee_model->getDocAssnedByEmpId($this->user_id);
		$assn_ids = implode(',',$assn_doc);
		$doc_id =  $this->uri->segment('3');
		//print_r($doc_id);exit;
		$column = array('c.cl_id','c.emp_id','c.doc_id','c.first_name','c.last_name','c.call_result','c.cl_created_on','e.emp_firstname','d.doc_firstname');
		$order = array('c.cl_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'employee as e','on'=>'e.emp_id = c.emp_id'); 
		$join[] = array('table_name'=>'doctors as d','on'=>'d.doc_id = c.doc_id'); 
		/*$where="posted_by='".$this->reg_by."'";*/
		if(isset($doc_id) && $user_id !=0){
			$where="c.doc_id = '$doc_id' AND c.emp_id = $user_id ";	
		}else if(isset($doc_id) && $user_id ==0){
			$where="c.doc_id = '$doc_id'";	
		} else if(($this->user_id) != 0){
			$where="c.doc_id != '0' AND c.doc_id IN ($assn_ids) AND c.emp_id = $user_id";
		}else{
			$where="c.doc_id != '0'";
		}
		
		$tb_name = 'call_log as c';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('doctor/calllog_view/'.$req->cl_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/calllog_edit/'.$req->cl_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="'.base_url('doctor/calllog_del/'.$req->cl_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-remove"></i></a>';
			$no++;
			$row = array();
			//$row[] = '';
			$row[] = $req->cl_created_on;
			$row[] = $req->first_name;
			$row[] = $req->last_name;
			$row[] = $req->call_result;
			$row[] = $req->doc_firstname;
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
	/***** get doctors calllog****/
	function getAllApts(){
		$doc_id =  $this->uri->segment('3');
		//print_r($doc_id);exit;
		$column = array('c.cl_id','c.emp_id','c.doc_id','c.first_name','c.last_name','c.appt_date','c.appt_time','c.adults','c.children','c.cl_created_on','e.emp_firstname','d.doc_firstname');
		$order = array('c.cl_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'employee as e','on'=>'e.emp_id = c.emp_id'); 
		$join[] = array('table_name'=>'doctors as d','on'=>'d.doc_id = c.doc_id'); 
		$where="c.doc_id = '$doc_id' AND c.patient_response = 'Schedule Appointment'";	
		$tb_name = 'call_log as c';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$no++;
			$row = array();
			//$row[] = '';
			$row[] = $req->cl_created_on;
			$row[] = $req->first_name;
			$row[] = $req->last_name;
			$row[] = $req->appt_date;
			$row[] = $req->appt_time;
			$row[] = $req->adults;
			$row[] = $req->children;
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
	
	function getCalllogByEmp(){
		$user_id  = $this->uri->segment('3');
		$assn_doc = $this->employee_model->getDocAssnedByEmpId($this->user_id);
		$assn_ids = implode(',',$assn_doc);
		$doc_id =  $this->uri->segment('3');
		//print_r($doc_id);exit;
		$column = array('c.cl_id','c.emp_id','c.doc_id','c.first_name','c.last_name','c.call_result','c.cl_created_on','e.emp_firstname','d.doc_firstname');
		$order = array('c.cl_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'employee as e','on'=>'e.emp_id = c.emp_id'); 
		$join[] = array('table_name'=>'doctors as d','on'=>'d.doc_id = c.doc_id'); 
		/*$where="posted_by='".$this->reg_by."'";*/
		
			$where="c.emp_id = $user_id ";	
		
		
		$tb_name = 'call_log as c';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			
			$no++;
			$row = array();
			//$row[] = '';
			$row[] = $req->cl_created_on;
			$row[] = $req->first_name;
			$row[] = $req->last_name;
			$row[] = $req->call_result;
			$row[] = $req->doc_firstname;
			
			
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
	
	public function addcall_log(){
		$doc_id =  $this->uri->segment('3');
		$tmgs = $this->doctor_model->getScheByID($doc_id);
		if($this->user_type == 'ADMIN'){
			$data['doctors'] = $this->doctor_model->selectAllActive();
		}else{
			$data['doctors'] =  $this->doctor_model->selectAllAssigned($this->user_id);
		}
		$data['tmgs'] =  $tmgs;
		$data['doc_id'] = $this->uri->segment('3');
		$data['main_content2']='add_doc_calllog';	
		$this->load->view('template2/body',$data);
	}
	
	function create_call_log(){
		//print_r($_POST);exit;
		if(isset($_POST['doc_id'])){
			$doc_id = $_POST['doc_id'];
		}else{
			$doc_id = $this->uri->segment('3');
		}
	
		extract($_POST);
		$status=0;
		$msg='';
		 if($this->input->post('first_name')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter first name</strong>
			</div>' ;
			
		 }else if($this->input->post('last_name')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter last name</strong>
			</div>' ;
			
		 }else if($this->input->post('call_result')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select call result</strong>
			</div>' ;
			
		 }else{	
			$insert_data = array(			
				'first_name'=>addslashes($first_name),
				'last_name'=>addslashes($last_name),
				'call_result'=>$call_result,
				'requires_attention'=>isset($requires_attention)? addslashes($requires_attention):'',
				'patient_response'=>isset($patient_response)?addslashes($patient_response):'',
				'notes'=>isset($notes)?addslashes($notes):'',
				'reason_for_leave'=>isset($reason_for_leave)?addslashes($reason_for_leave):'',
				'appt_date'=>isset($appt_date)?addslashes($appt_date):'',
				'appt_time'=>isset($notes)?addslashes($appt_time):'',
				'adults'=>isset($adults)?addslashes($adults):'',
				'children'=>isset($children)?addslashes($children):'',
				'doc_id' => $doc_id,
				'emp_id' => $this->session->userdata("platinum_user_id"),
				'cl_created_on'=> date('Y-m-d H:i:s')	
				
			);
			$res = $this->doctor_model->create_calllog($insert_data);		
			if($res){
                  $status=1;				
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Call Log created successfully!!</strong>
						</div>' ;
			}else{
				 $msg='<div class="alert alert-warning">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Unable to register please try again later!!</strong>
						</div>' ;
			}
		 }
		 $res = array('status'=>$status,'msg'=>$msg,'doc_id'=>$doc_id);
		echo json_encode($res); exit;
	}	
	  
}
?>