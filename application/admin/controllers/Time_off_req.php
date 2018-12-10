<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Time_off_req extends CI_Controller {
	 public  $stateArray=array();
	 public  $timezoneArray=array();
	//private $uid;
	//private $group_id;
	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();	
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->load->model('timeoffreq_model');
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->library('datatbl');
			$this->load->library('m_pdf');
	}
	
	
	
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
	function viewPlanPdf(){
		$req_id = $this->uri->segment('3');
		if($req_id!="" &&$req_id!=0){
			$tp = $this->timeoffreq_model->getDetails($req_id);
		    if($tp['num'] >0){
				$data['record']=$tp['data'];				
				$data['style']  = base_url('assets').'/css/icons.css';
				$html=$this->load->view('time_off_pdf',$data, true);
				$pdf = $this->m_pdf->load();
				$pdf->WriteHTML($html,2);
				$filename= $file_name.".pdf"; 
				$pdf->Output($filename, 'I');
			}else{
				$this->session->set_flashdata('invalid','Access Denied');
				redirect('time_off_req');
			}
		}else{
				$this->session->set_flashdata('invalid','Invalid request');
			    redirect('time_off_req');
		}
	}
	
	public function index(){
		$data['main_content2']='time_off_req_list';	
		$this->load->view('template2/body',$data);		
	}
	
	public function add(){
		$data['main_content2']='add_time_off_req';	
		$this->load->view('template2/body',$data);
	}
	
	function create(){
		extract($_POST);
		$status=0;
		$msg='';
		 if($this->input->post('name')=='' ){
			$msg='<div class="alert alert-warning">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Please enter name</strong>
			</div>' ;
			
		 }
		 else{	
			$insert_data = array(			
				'name'=>addslashes($name),
				'today_date'=>addslashes($today_date),
				'from_date'=>addslashes($from_date),
				'to_date'=>addslashes($to_date),
				'reason'=>stripcslashes($reason),
			);
			$res = $this->timeoffreq_model->create($insert_data);
			if($res){
                  $status=1;				
				 $msg='<div class="alert alert-success">
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						  <strong>Created successfully!!</strong>
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
	function getTimeOffAll(){
		$column = array('e.name','e.today_date','e.from_date','e.to_date','e.reason');
		$order = array('e.req_id' => 'desc');
		$join = array();
		$where="e.req_id!='0'";
		$tb_name = 'time_off_req as e';
		$list = $this->datatbl->get_datatables($column,$order,$tb_name,$join,$where);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $req) {
			$actions='<a target="_blank" href="'.base_url('time_off_req/viewPlanPdf/'.$req->req_id).'" class="btn btn-sm btn-icon black">Print</a>';
			
			$no++;
			$row = array();
			$row[] = $req->name;
			$row[] = $req->today_date;
			$row[] = $req->from_date;
			$row[] = $req->to_date;
			$row[] = $req->reason;
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
}
?>