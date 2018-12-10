<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	//private $uid;
	public function __construct(){
		parent::__construct();
			$this->is_not_logged_in();
			$this->user_type=$this->session->userdata("platinum_user_type");
			$this->user_id=$this->session->userdata("platinum_user_id");
			$this->comm_fun->accessControl($this->user_type,$this->router->fetch_class(),$this->router->fetch_method());
			$this->load->library('datatbl');
			$this->load->model('employee_model');
			$this->load->model('doctor_model');		
	}
	function is_not_logged_in(){
		$is_logged_in = $this->session->userdata('platinum_user_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');			
		}				
	}
	
	public function index(){
		$data['emp'] = $this->employee_model->selectAllEmps();
		$data['doc'] = $this->doctor_model->selectAllForCnt();
		$data['inactdoc'] = $this->doctor_model->selectAllForCntInAct();
		$data['actdoc'] = $this->doctor_model->selectAllForCntAct();
		$data['calls'] = $this->doctor_model->selectAllCallsForCnt();
		$data['todayscalls'] = $this->doctor_model->selectAllCallsForCntTodays();
		$data['todaysapts'] = $this->doctor_model->selectAllAptsForCntTodays();
		$data['empChat'] = $this->employee_model->selectAllForChat($this->user_id);
		
		/**** cph and aph ****/
		if($this->user_type == "ADMIN"){
			$tot_apts = $this->doctor_model->selectAllAptsTot();
			$tot_calls = $this->doctor_model->selectAllCallsTot();
			$tot_wrkng_hrs = $this->doctor_model->selectwrknghrsTot();
		    $wrk_in_sec  =strtotime("1970-01-01 ".$tot_wrkng_hrs['data'][0]['working_hours']." UTC");
			
			/** calls since last 6 months ***/
			$data['cl6'] = $this->doctor_model->selectCallsLastSixMonths();
			$data['mnt'] = $data['cl6']['mnt'];
			$data['cls'] = $data['cl6']['data'];
			/*** apts since last 6 months ***/
			$data['apts6'] = $this->doctor_model->selectAptsLastSixMonths();
			$data['apt_mnt'] = $data['apts6']['mnt'];
			$data['apt_cls'] = $data['apts6']['data'];
		}else{
			/*** For Team ***/
			/** individual **/
			
			$get_teamMems = $this->doctor_model->selectTeamEmpsbyEmp($this->user_id);
		    //echo $this->db->last_query();exit;
			//print_r($this->user_id);exit;
		    $emps = $get_teamMems[0]->team_members;
			
			/**** team ***/
			$tot_apts_team = $this->doctor_model->selectAllAptsTotTeam($emps);
		    $data['total_apts_team'] = $tot_apts_team['data'][0]['total_apts'];
			
			$tot_calls_team = $this->doctor_model->selectAllCallsTotTeam($emps);
			$tot_wrkng_hrs_team = $this->doctor_model->selectwrknghrsTotTeam($emps);
			$wrk_in_sec_team  =strtotime("1970-01-01 ".$tot_wrkng_hrs_team['data'][0]['working_hours']." UTC");
			/*** individual ***/
		    $tot_apts = $this->doctor_model->selectAllAptsTotIndividual($this->user_id);
			$tot_calls = $this->doctor_model->selectAllCallsTotIndividual($this->user_id);
			$tot_wrkng_hrs = $this->doctor_model->selectwrknghrsTotIndividual($this->user_id);
		    $wrk_in_sec  =strtotime("1970-01-01 ".$tot_wrkng_hrs['data'][0]['working_hours']." UTC");
			//print_r($wrk_in_sec);exit;
			
			$aph_in_sec_team = bcmul($tot_apts_team['data'][0]['total_apts'],3600,2);
		    $cph_in_sec_team = bcmul($tot_calls_team['data'][0]['tot_calls'],3600,2);
			
			if($wrk_in_sec_team > 0){
			/*** team ***/
				$data['apht'] = ($aph_in_sec_team>0)?round(bcdiv($aph_in_sec_team,$wrk_in_sec_team,2)):0;
				$data['cpht'] = ($cph_in_sec_team>0)?round(bcdiv($cph_in_sec_team,$wrk_in_sec_team,2)):0;
			}else{
				$data['apht'] = 0;
				$data['cpht'] = 0;
			}
			
			$con_team = ($tot_apts_team['data'][0]['total_apts'] > 0)?bcdiv($tot_apts_team['data'][0]['total_apts'],$tot_calls_team['data'][0]['tot_calls'],2):0;
		    $data['con_per_team'] = bcmul($con_team,100,2);
		}
		
			$data['total_apts'] = $tot_apts['data'][0]['total_apts'];			
			$aph_in_sec = bcmul($tot_apts['data'][0]['total_apts'],3600,2);
			$cph_in_sec = bcmul($tot_calls['data'][0]['tot_calls'],3600,2);
			/*** team***/
			
			if($wrk_in_sec > 0){
			$data['aph'] = ($aph_in_sec>0)?round(bcdiv($aph_in_sec,$wrk_in_sec,2)):0;
			$data['cph'] = ($cph_in_sec>0)?round(bcdiv($cph_in_sec,$wrk_in_sec,2)):0;
			}else{
				$data['aph'] = 0;
				$data['cph'] = 0;
			}
			
			$con = ($tot_apts['data'][0]['total_apts'] > 0)?bcdiv($tot_apts['data'][0]['total_apts'],$tot_calls['data'][0]['tot_calls'],2):0;
			/*** team ***/
			
			$data['con_per'] = bcmul($con,100,2);
			
			$data['main_content2']='dashboard';	
			$this->load->view('template2/body',$data);
			
	}
}
?>