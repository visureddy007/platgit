<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goals extends CI_Controller {
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
	
	public function index(){
		$data['doc'] = $this->doctor_model->selectAllDoc();
		$data['calls'] = $this->doctor_model->selectAllCalls();
		//print_r($data['calls']);exit;
		$data['main_content2']='goals_list';	
		$this->load->view('template2/body',$data);		
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
	
	
	   /***** get doctors****/
	function getDocAll(){
		$assn_doc = $this->employee_model->getDocAssnedByEmpId($this->user_id);
		$assn_ids = implode(',',$assn_doc);
		$column = array('doc_id','doc_username','doc_email','doc_firstname','doc_lastname','	doc_phone');
		$order = array('doc_id' => 'desc');
		$join = array();
		/*$where="posted_by='".$this->reg_by."'";*/
		if($this->user_id != 0){
			$where="doc_id IN ($assn_ids)";
		}else{
			$where="doc_id!='0'";
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
			$bookapt='<a  href="'.base_url('doctor/bookapt/'.$req->doc_id).'"><button class="btn btn-outline btn-sm b-black text-black">View</button></a>';
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
}
?>