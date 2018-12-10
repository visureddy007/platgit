<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {
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
			$this->load->library('datatbl');
			$this->load->library('Excel_reader');
			$this->load->library('Excel');
	}
	
	/**** for excel download ****/
	
	   public function excel(){
                $this->excel->setActiveSheetIndex(0);
                //name the worksheet
                $this->excel->getActiveSheet()->setTitle('Employees List');
                //set cell A1 content with some text
                $this->excel->getActiveSheet()->setCellValue('A1', 'Employees Excel Sheet');
                $this->excel->getActiveSheet()->setCellValue('A3', 'User-name');
                $this->excel->getActiveSheet()->setCellValue('B3', 'Email');
                $this->excel->getActiveSheet()->setCellValue('C3', 'First Name');
                $this->excel->getActiveSheet()->setCellValue('D3', 'Last Name');
                $this->excel->getActiveSheet()->setCellValue('E3', 'Address 1');
                $this->excel->getActiveSheet()->setCellValue('F3', 'Address 2');
                $this->excel->getActiveSheet()->setCellValue('G3', 'State');
                $this->excel->getActiveSheet()->setCellValue('H3', 'Zip');
                $this->excel->getActiveSheet()->setCellValue('I3', 'City');
                $this->excel->getActiveSheet()->setCellValue('J3', 'Phone');
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:C1');
                //set aligment to center for that merged cell (A1 to C1)
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                //make the font become bold
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
                $this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
       for($col = ord('A'); $col <= ord('C'); $col++){ //set column dimension $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
                 //change the font size
                $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
                 
                $this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        }
                //retrive contries table data
               // $rs = $this->db->get('dealers');
			   $rs = $this->employee_model->getdata();
                $exceldata="";
					foreach ($rs as $row){
							$exceldata[] = $row;
					}
                //Fill data 
                $this->excel->getActiveSheet()->fromArray($exceldata[0], null, 'A4');
                 
                $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                 
                $filename='EmployeesList.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
 
                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                 
    }
	
	
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
	public function index(){
		$data['main_content2']='employee_list';	
		$this->load->view('template2/body',$data);		
	}
	
	public function active(){
		$data['main_content2']='emp_active_list';	
		$this->load->view('template2/body',$data);		
	}
	
	public function inactive(){
		$data['main_content2']='emp_inactive_list';	
		$this->load->view('template2/body',$data);		
	}
	
	public function add(){
		$data['states'] = $this->employee_model->selectAllStates();
		$data['timezone'] = $this->employee_model->selectAllTimezone();
		$data['main_content2']='add_employee';	
		$this->load->view('template2/body',$data);
	}
	
	public function upload(){
		$data['main_content2']='upload_emp';	
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
				if($numRows>=2 && $numCols==13){			
					$j=0;
					for($i = 2; $i <= count($cells); $i++ ){
							//print_r($cells);
						if($this->excel_model->emp_email_exists($cells[$i][1])>0){
							$already_existsA[] = $cells[$i];
						}else{
							if(isset($this->stateArray[$cells[$i][8]])){
								$insert_data = array(		
									'emp_username' =>$cells[$i][1],
									'emp_email' =>$cells[$i][2],
									'emp_firstname'=>$cells[$i][3],
									'emp_lastname'=>$cells[$i][4],
									'emp_password'=>$cells[$i][5],
									'emp_add1'=>$cells[$i][6],
									'emp_add2'=>$cells[$i][7],
									'state_id'=>$this->stateArray[$cells[$i][8]],
									'city'=>$cells[$i][9],
									'zip'=>$cells[$i][10],
									'emp_phone'=>$cells[$i][11],
									'emp_timezone'=>$this->timezoneArray[$cells[$i][12]],
									'emp_role'=>$cells[$i][13],
									'created_on'=> date('Y-m-d H:i:s')
								);
								$q = $this->excel_model->create_emp($insert_data);	
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
		
			redirect('employee');
	} 
	
	function create(){
		extract($_POST);
		$status=0;
		$msg='';
		 if($this->input->post('emp_username')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter username</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_email') && $this->signup_model->email_exists($this->input->post('emp_email'))>0){
			 $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Employee with this "'.$this->input->post('emp_email').'" Email-Id already exists </strong>
			</div>' ;
			
		 }else if($this->input->post('emp_password')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter password</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_firstname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter first name</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_lastname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter lastname</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_add1')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter address line 1</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_add2')=='' ){
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
			
		 }else if($this->input->post('emp_phone')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter phone number</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_timezone')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select timezone</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_role')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select role</strong>
			</div>' ;
			
		 }
		 else{	
			$insert_data = array(			
				'emp_username'=>addslashes($emp_username),
				'emp_email'=>addslashes($emp_email),
				'emp_password'=>$emp_password,
				'emp_firstname'=>addslashes($emp_firstname),
				'emp_lastname'=>addslashes($emp_lastname),
				'emp_add1'=>addslashes($emp_add1),
				'emp_add2'=>addslashes($emp_add2),
				'state_id'=>addslashes($state_id),
				'zip'=>addslashes($zip),
				'city'=>addslashes($city),
				'emp_timezone'=>addslashes($emp_timezone),
				'emp_phone'=>addslashes($emp_phone),
				'emp_role'=>addslashes($emp_role),				
				'emp_status'=>1,					
				'created_on'=> date('Y-m-d H:i:s')
			);
			$res = $this->employee_model->create($insert_data);
			if($res){
                  $status=1;				
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Employee created successfully!!</strong>
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
	
	/***** get employees****/
	function getEmpAll(){
		$column = array('e.emp_id','e.emp_firstname','e.emp_lastname','e.emp_add1','e.emp_add2','emp_phone','s.name');
		$order = array('e.emp_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'states as s','on'=>'s.id=e.state_id'); 
		/*$where="posted_by='".$this->reg_by."'";*/
		$where="e.emp_id!='0'";
		$tb_name = 'employee as e';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('employee/view/'.$req->emp_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('employee/edit/'.$req->emp_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="javascript:void(0);" data-clid="'.$req->emp_id.'"  class="btn btn-sm btn-icon rounded black del-emp"><i class="fa fa-remove"></i></a>';
			$assign='<a  href="'.base_url('employee/assign/'.$req->emp_id).'"><button class="btn btn-outline btn-sm b-black text-black">View</button></a>';
			/*$status = ($req->emp_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';*/
			/*$doctors = '<a href="" >Doctors</a>';*/
			//$edit = '<a href="'.base_url('employee/edit/'.$req->emp_id).'" >'.$req->emp_id.'</a>';
			$no++;
			$row = array();
			//$row[] = $edit;
			$row[] = $req->emp_firstname.' '.$req->emp_lastname;
			$row[] = $req->emp_add1;
			$row[] = $req->name.' '.$req->zip;
			$row[] = $assign;
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
	         /***** get employees****/
	function getEmpAllActive(){
		$column = array('e.emp_id','e.emp_firstname','e.emp_lastname','e.emp_add1','e.emp_add2','emp_phone','s.name');
		$order = array('e.emp_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'states as s','on'=>'s.id=e.state_id'); 
		/*$where="posted_by='".$this->reg_by."'";*/
		$where="e.emp_status='1'";
		$tb_name = 'employee as e';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('employee/view/'.$req->emp_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('employee/edit/'.$req->emp_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="javascript:void(0);" data-clid="'.$req->emp_id.'"  class="btn btn-sm btn-icon rounded black del-emp"><i class="fa fa-remove"></i></a>';
			$assign='<a  href="'.base_url('employee/assign/'.$req->emp_id).'"><button class="btn btn-outline btn-sm b-black text-black">View</button></a>';
			/*$status = ($req->emp_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';*/
			/*$doctors = '<a href="" >Doctors</a>';*/
			//$edit = '<a href="'.base_url('employee/edit/'.$req->emp_id).'" >'.$req->emp_id.'</a>';
			$no++;
			$row = array();
			//$row[] = $edit;
			$row[] = $req->emp_firstname.' '.$req->emp_lastname;
			$row[] = $req->emp_add1;
			$row[] = $req->name.' '.$req->zip;
		    $row[] = $assign;
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
	         /***** get employees****/
	function getEmpAllInactive(){
		$column = array('e.emp_id','e.emp_firstname','e.emp_lastname','e.emp_add1','e.emp_add2','emp_phone','s.name');
		$order = array('e.emp_id' => 'desc');
		$join = array();
		$join[] = array('table_name'=>'states as s','on'=>'s.id=e.state_id'); 
		/*$where="posted_by='".$this->reg_by."'";*/
		$where="e.emp_status='0'";
		$tb_name = 'employee as e';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a href="'.base_url('employee/view/'.$req->emp_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-eye"></i></a>&nbsp;&nbsp<a href="'.base_url('employee/edit/'.$req->emp_id).'" class="btn btn-sm btn-icon rounded black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp<a href="javascript:void(0);" data-clid="'.$req->emp_id.'"  class="btn btn-sm btn-icon rounded black del-emp"><i class="fa fa-remove"></i></a>';
			$assign='<a  href="'.base_url('employee/assign/'.$req->emp_id).'"><button class="btn btn-outline btn-sm b-black text-black">View</button></a>';
			/*$status = ($req->emp_status==1)?'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>Active</span>':'<span class="label accent pos-rlt m-r-xs"><b class="arrow top b-accent pull-in"></b>In-Active</span>';*/
			/*$doctors = '<a href="" >Doctors</a>';*/
			//$edit = '<a href="'.base_url('employee/edit/'.$req->emp_id).'" >'.$req->emp_id.'</a>';
			$no++;
			$row = array();
			//$row[] = $edit;
			$row[] = $req->emp_firstname.' '.$req->emp_lastname;
			$row[] = $req->emp_add1;
			$row[] = $req->name.' '.$req->zip;
		    $row[] = $assign;
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
		$ed = $this->employee_model->getDetails($id);
		if($ed['num']==1){	
		    $data['states'] = $this->employee_model->selectAllStates();
			$data['timezone'] = $this->employee_model->selectAllTimezone();
			$data['record'] = $ed['data'][0];
			$data['main_content2'] = 'edit_employee';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('employee');
		}
	}
	
	/*function del(){
		$id = $this->uri->segment('3');
		$cd = $this->employee_model->getDetails($id);
		if($cd['num']==1){	 
			$this->employee_model->del($id);
			$this->session->set_flashdata('success','"'.$cd['data']['0']['emp_firstname'].'" deleted successfully');
			redirect('employee');			
		}else{
			$this->session->set_flashdata('invalid','invalid request');
			redirect('employee');
		}
	}*/
	
	function del(){
		$success=0;
		$msg = '';
		if(isset($_POST['e']) && $_POST['e']>0){
			$id = $_POST['e'];
			    
			$q = $this->employee_model->del($id);
			if($q){
				$success=1;
				$msg = $this->comm_fun->success_msg('Survey deleted successfully');	
				$this->session->set_flashdata('success','Employee Deleted Successfully!!!!');				
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
	
	function assign(){
		$id = $this->uri->segment('3');
		$ed = $this->employee_model->getDetails($id);
		if($ed['num']==1){	
			$data['record'] = $ed['data'][0];
			$data['emp_id'] = $id;
			$doc_assn = $this->employee_model->getDocAssnedByEmpId($id);
			$data['assigneddoc'] =  $this->doctor_model->selectAllAssigned($id);
			$data['doctors'] = $this->doctor_model->selectAll($doc_assn,$id);
			$data['main_content2'] = 'assign_doc_emp';		 
			$this->load->view('template2/body',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('employee');
		}
	}
	
	function assign_doc() {
		// print_r($_POST); exit;
		extract($_POST);
			$status=0;
			$msg='';
			$emp_id = $_POST['emp_id'];
			$doc_id = $_POST['doc_id'];
			$insert_data = array(	
					'emp_id' =>$emp_id,
					'doc_id' =>$doc_id,
					'assn_date'=>date('Y-m-d')					
				);				
				
				$q = $this->employee_model->assign_doc($insert_data);
				$id = $this->db->insert_id();	
				$doc =  $this->doctor_model->getDetails($doc_id);
				$details = $doc['data'][0];
				$doc_office_name = $details['doc_office_name'];
				
				$city = $details['city'];
				
			
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
	
		 $res = array('status'=>$status,'msg'=>$msg,'doc_office_name'=>$doc_office_name,'city'=>$city,'id'=>$id);
		/* print_r($res); exit;*/
		echo json_encode($res); exit;
	 }
	 
	public function remove_doc(){
			$status=0;
			$msg='';
			$emp_id = $_POST['emp_id'];
			$doc_id = $_POST['doc_id'];
			$id = $_POST['id'];
			$dd = $this->doctor_model->getDetails($doc_id);
			
			//print_r($sd);exit;
			if($dd['num']==1){
				$details = $dd['data'][0];
				$doc_office_name = $details['doc_office_name'];
				$city = $details['city'];
				$state= $details['name'];
				$d = $this->employee_model->del_assndoc($id);
				if($d){
				$status=1;			
					 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Deleted Successfully!!</strong>
						</div>' ;
				}else{
					$msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Invalid Request!!</strong>
						</div>' ;
				}
			}else{
			$msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Invalid Request!!</strong>
						</div>' ;
			}	
	 $res = array('status'=>$status,'msg'=>$msg,'doc_office_name'=>$doc_office_name,'city'=>$city,'state'=>$state,'emp_id'=>$emp_id,'doc_id'=>$doc_id);
		/* print_r($res); exit;*/
		echo json_encode($res); exit;
	}
	
	function view(){
		$id = $this->uri->segment('3');
		$ed = $this->employee_model->getDetails($id);
		if($ed['num']==1){	
		    $data['states'] = $this->employee_model->selectAllStates();
			$data['timezone'] = $this->employee_model->selectAllTimezone();
			$data['assigneddoc'] =  $this->doctor_model->selectAllAssigned($id);
			$data['timepunches'] = $this->timeclock_model->selectAllByID($id);
			$data['emp_id'] = $this->uri->segment('3');
			$data['record'] = $ed['data'][0];		 
			$this->load->view('view_employee',$data);
		}else{
			$this->session->set_flashdata('invalid','Invalid Request');
			redirect('employee');
		}
	}
	
	function modify(){
	   extract($_POST);
		$status=0;
		$msg='';
		$id = $this->uri->segment('3');
		$ed = $this->employee_model->getDetails($id);
		if($ed['num']==1){			
			  if($this->input->post('emp_username')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter username</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_firstname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter first name</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_lastname')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter lastname</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_add1')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter address line 1</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_add2')=='' ){
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
			
		 }else if($this->input->post('emp_phone')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter phone number</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_timezone')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select timezone</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_role')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select role</strong>
			</div>' ;
			
		 }else if($this->input->post('emp_status')=='' ){
			  $msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please select status</strong>
			</div>' ;
			
		 }else{
			     $update_data = array();
				 $update_data = array(
						'emp_username'=>addslashes($emp_username),
						'emp_email'=>addslashes($emp_email),
						'emp_firstname'=>addslashes($emp_firstname),
						'emp_lastname'=>addslashes($emp_lastname),
						'emp_add1'=>addslashes($emp_add1),
						'emp_add2'=>addslashes($emp_add2),
						'state_id'=>addslashes($state_id),
						'zip'=>addslashes($zip),
						'city'=>addslashes($city),
						'emp_timezone'=>addslashes($emp_timezone),
						'emp_phone'=>addslashes($emp_phone),
						'emp_role'=>addslashes($emp_role),				
						'emp_status'=>addslashes($emp_status),				
					);
			 	
				 $q = $this->employee_model->modify($update_data,$id);
				 if($q){
				$status=1;
			   $this->session->set_flashdata('success','Employee Updated successfully!!!!');
			   $msg='<div class="alert alert-warning">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Employee Updated Successfully</strong></div>';	 
				
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