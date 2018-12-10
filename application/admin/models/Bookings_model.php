<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class bookings_model extends CI_Model{
	
	//private $mem_tbl='members';
	private $tbl_name='bookings';
	
	function getDetailsByDate($date){
		$this->db->select('b.*');
		$this->db->where('b.booking_date',$date);	
		$this->db->where_in('b.booking_status',array('PENDING','DONE'));	
		$q = $this->db->get("$this->tbl_name as b");
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			foreach($q->result() as $r){
				$data[$r->doc_id][]=date('H:i',strtotime($r->slot_time));
			}
		}
		return array('num'=>$num,'bookSlots'=>$data);
	}
	
	
	
	function selectByDocIdStatus($doc_id,$status,$date){
		if($date!=""){
			$this->db->where('b.booking_date',$date);				
		}
		$this->db->select('b.*,l.location_name,d.doc_name,u.user_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','d.user_id = u.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$this->db->where('b.dr_id',$doc_id);	
		$this->db->where('b.booking_status',$status);	
			$q = $this->db->get("$this->tbl_name as b");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function getBkngsFrReports(){
		$this->db->where('b.other_charges !=', "0"); 
		$this->db->where('b.booking_status',"DONE");
		$this->db->select('b.*,l.location_name,d.doc_name,u.user_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','d.user_id = u.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$this->db->order_by('b.booking_date','desc');
			$q = $this->db->get("$this->tbl_name as b");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function selectByLocIdStatus($loc,$status,$date){
		$this->db->where('b.loc_id',$loc);
		$this->db->where('b.booking_status',$status);
		if($date!=""){
		$this->db->where('b.booking_date',$date);
			
		}
		$this->db->where('b.booking_status',$status);
		$this->db->select('b.*,l.location_name,d.doc_name,u.user_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','d.user_id = u.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
			$q = $this->db->get("$this->tbl_name as b");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function selectAllBkngs($status,$date){
		/*$this->db->where('b.loc_id',$loc);*/
		$this->db->where('b.booking_status',$status);
		if($date!=""){
		$this->db->where('b.booking_date',$date);
			
		}
		$this->db->where('b.booking_status',$status);
		$this->db->select('b.*,l.location_name,d.doc_name,u.user_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','d.user_id = u.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$this->db->order_by('b.booking_date','desc');
			$q = $this->db->get("$this->tbl_name as b");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function bookingsCount(){
		$sql ="SELECT count(*) as counts,`booking_status` FROM $this->tbl_name group by `booking_status`";
		$q = $this->db->query($sql);		
		$num =  $q->num_rows();
		$data=array('pending'=>0,'completed'=>0,'cancelled'=>0,'total'=>0);
		$total = $data['total'];
		if ($num > 0) {
			foreach($q->result() as $r){
				if($r->booking_status=='PENDING'){
					$data['pending']=$r->counts;
				}else if($r->booking_status=='DONE'){
					$data['completed']=$r->counts;
					
				}else if($r->booking_status=='REJECTED'){
					$data['cancelled']=$r->counts;					
				}
				$total = bcadd($total,$r->counts,0);
			}
		}
		$data['total']=$total;
		return $data;
	}
	
	function getDrDateVisits($dr_id,$date){
		$this->db->where('b.dr_id',$dr_id);	
		$this->db->where('b.booking_date',$date);	
		$this->db->select('b.*,d.doc_name,m.*');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		
		$q = $this->db->get("$this->tbl_name as b");
		$num = $q->num_rows();
		$data=array();
		if ($num > 0) {
			$data = $q->result();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function memCount(){
		$sql ="SELECT count(*) as counts,mem_type FROM `members` group by`mem_type`";
		$q = $this->db->query($sql);		
		$num =  $q->num_rows();
		$data=array('mem'=>0,'non'=>0,'total'=>0);
		$total = $data['total'];
		if ($num > 0) {
			foreach($q->result() as $r){
				if($r->mem_type==1){
					$data['mem']=$r->counts;
				}else if($r->mem_type==0){
					$data['non']=$r->counts;					
				}
				$total = bcadd($total,$r->counts,0);
			}
		}
		$data['total']=$total;
		return $data;
	}
	function memrCount($from,$to){
		$sql ="SELECT sum(amount + oc_amount) as counts,mem_type FROM `bookings` where booking_date>=? and booking_date<=? and booking_status='DONE' group by`mem_type`";
		$q = $this->db->query($sql,array($from,$to));		
		$num =  $q->num_rows();
		$data=array('mem'=>0,'non'=>0,'total'=>0);
		$total = $data['total'];
		if ($num > 0) {
			foreach($q->result() as $r){
				if($r->mem_type==1){
					$data['mem']=$r->counts;
				}else if($r->mem_type==0){
					$data['non']=$r->counts;					
				}
				$total = bcadd($total,$r->counts,2);
			}
		}
		$data['total']=$total;
		return $data;
	}
	function revenueCount(){
		$sql ="SELECT sum(`amount` + oc_amount + reg_fee) as counts,`booking_status` FROM `bookings` group by `booking_status`";
		$q = $this->db->query($sql);		
		$num =  $q->num_rows();
		$data=array('pending'=>0,'completed'=>0,'cancelled'=>0,'total'=>0);
		$total = $data['total'];
		if ($num > 0) {
			foreach($q->result() as $r){
				if($r->booking_status=='PENDING'){
					$data['pending']=$r->counts;
					$total = bcadd($total,$r->counts,2);
				}else if($r->booking_status=='DONE'){
					$data['completed']=$r->counts;
					
					$total = bcadd($total,$r->counts,2);
				}else if($r->booking_status=='REJECTED'){
					$data['cancelled']=$r->counts;					
				}
			}
		}
		$data['total']=$total;
		return $data;
	}
	function thisMonthRevenue(){
		$sql ="SELECT sum(`amount` + oc_amount + reg_fee) as counts FROM `bookings` where booking_status='DONE' and month(booking_date)='".date('m')."'";
		$q = $this->db->query($sql);		
		$num =  $q->num_rows();		
		$data = $q->result_array();
		$data = ($data['0']['counts']!= NULL || $data['0']['counts']!='')?$data['0']['counts']:0;
		return $data;
	}
	function drRevenue($from,$to){
		$sql ="SELECT 
					count(b.booking_id) as count,sum(b.amount + b.oc_amount) as amt,sum(b.cli_share) as cli_share,sum(b.dr_share) as dr_share,sum(b.reg_fee) as reg_fee,u.user_name as doc_name,b.dr_id
				FROM 
					`bookings` as b 
				join 
					doctors as d on d.doc_id=b.`dr_id` 
				join 
					users as u on d.user_id=u.`user_id` 
				where  
					b.booking_date >= ? and 
					b.booking_date <= ? and  
					b.booking_status='DONE' 
				group by 
					d.doc_id";
		$q = $this->db->query($sql,array($from,$to));		
		$num =  $q->num_rows();		
		$data = array();
		if($num>0){			
			$data = $q->result();
		}
		return array('num'=>$num,'data'=>$data);
	}
	function locRevenue($from,$to){
		$sql ="SELECT 
					sum(b.`amount` + b.oc_amount) as amt,sum(b.cli_share) as cli_share,sum(b.dr_share) as dr_share,sum(b.reg_fee) as reg_fee,l.location_name,b.loc_id 
				FROM 
					`bookings` as b 
				join 
					locations as l on b.loc_id =l.`location_id` 
				where  b.booking_date >= ? and b.booking_date <= ? and  b.booking_status='DONE'
				group by 
				l.location_name";
		$q = $this->db->query($sql,array($from,$to));		
		$num =  $q->num_rows();		
		$data = array();
		if($num>0){			
			$data = $q->result();
		}
		return array('num'=>$num,'data'=>$data);
	}
	function selectAllBetween($from,$to,$where){
		/*$sql ="SELECT 
					b.*,l.location_name
				FROM 
					`bookings` as b 
				join 
					locations as l on b.loc_id =l.`location_id` 
				where  b.booking_date >= ? and b.booking_date <= ? and  b.booking_status='DONE' ";
		$q = $this->db->query($sql,array($from,$to));		*/
		$this->db->select('b.*,l.location_name,d.doc_bill_share as doc_share');
		$this->db->join("locations as l","b.loc_id =l.`location_id`");
		$this->db->join("doctors as d","d.doc_id =b.`dr_id`");
		$this->db->where("b.booking_date >=",$from);
		$this->db->where("b.booking_date <=",$to);
		$this->db->where("b.booking_status","DONE");
		if(!empty($where)){
			$this->db->where($where);
		}
		$q = $this->db->get("$this->tbl_name as b");
		$num =  $q->num_rows();		
		$data = array();
		if($num>0){			
			$data = $q->result();
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function drCount($from,$to,$dr){
		$sql ="SELECT 
					sum(b.`amount` + b.oc_amount) as amt,b.booking_date,sum(b.cli_share) as cli_share,sum(b.dr_share) as dr_share,sum(b.reg_fee) as reg_fee
				FROM 
					`bookings` as b 				
				where 
					b.dr_id=? and  b.booking_date >= ? and b.booking_date <= ? and b.booking_status='DONE'
				group by 
				b.booking_date";
		$q = $this->db->query($sql,array($dr,$from,$to));		
		$num =  $q->num_rows();		
		$data = array();
		if($num>0){			
			$data = $q->result();
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function cancelledAppointments(){
		$sql ="SELECT 					b.*,e.event_type,d.doc_name,u.user_name,l.location_name,m.mem_name,m.mem_dob,m.mem_sex,m.mem_mother_name,m.mem_mob_num,m.mem_blood_group,m.mem_email,m.mem_father_name,m.mem_emer_num,m.mem_age,m.mem_address,m.mem_regnum,m.mem_validupto,m.mem_reg_date,m.mem_status
				FROM 
					`bookings` as b 
				join  
					events as e on b.dr_id=e.doc_id 
				join  
					doctors as d on b.dr_id=d.doc_id 
					
				join  
					users as u on u.user_id=d.user_id 

				join  
					locations as l on l.location_id=d.location_id 
				join  
					members as m on m.mem_id = b.mem_id
				where b.`booking_date`=e.leave_date and b.`booking_status`!='DONE'";
		$q = $this->db->query($sql);		
		$num =  $q->num_rows();		
		$data = array();
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	function selectAll($mem_id){
		if($mem_id>0){
			$this->db->where('b.mem_id',$mem_id);
		}
		
		$this->db->select('b.*,u.user_name,l.location_name,d.doc_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','u.user_id = d.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$this->db->order_by('b.booking_id','desc');
		$q = $this->db->get("$this->tbl_name as b");
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	function selectAllAry($where){
		if(!empty($where)){
			$this->db->where($where);
		}
		
		$this->db->select('b.*,u.user_name,l.location_name,d.doc_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','u.user_id = d.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$this->db->order_by('b.booking_id','desc');
			$q = $this->db->get("$this->tbl_name as b");
			
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $data) {
			$result[] = $data;
			}
			return $result;
		}
	}
	
	function SelectByDr($id){
		$this->db->where('b.dr_id',$id);
		$this->db->select('b.*,u.user_name,l.location_name,d.doc_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','u.user_id = d.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$q = $this->db->get("$this->tbl_name as b");
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			foreach ($q->result() as $r) {
			$data[] = $r;
			}
			return array('num'=>$num,'data'=>$data,'recordsTotal'=>$num,'recordsFiltered'=>$num);
		}
	}
	
	/*function SelectByDr($id){
		
	$this->db->where('b.dr_id',$id);
		$this->db->select('b.*,u.user_name,l.location_name,d.doc_name,m.mem_name,m.mem_id');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('users as u','u.user_id = d.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$q = $this->db->get("$this->tbl_name as b");
		$num=$q->num_rows();
		$data="";
		if($num>0){
			foreach($q->result() as $r){
				
				$data[]=array(
					'sno'=>'',
					'booking_date'=>$r->booking_date,
					'slot_time'=>$r->slot_time,
					'location_name'=>$r->location_name,
					'user_name'=>$r->user_name,
					'mem_name'=>$r->mem_name,
					'amount'=>$r->amount,
					'booking_status'=>$r->booking_status,
				);
			}
		}
		
		return array('data'=>$data);
	}*/
	
	
	function getDetailsByMem($mem_id){
		$this->db->select('b.*');
		
		$this->db->where('b.mem_id',$mem_id);		
		$q = $this->db->get("$this->tbl_name as b");
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			foreach($q->result() as $r){
			
				$data[$r->dr_id][]=date('H:i',strtotime($r->slot_time));
						
				
			}
		}
		return array('num'=>$num,'bookSlots'=>$data);
	}
	
	
	function getDetails($id){
		$this->db->select('b.*,l.location_name,dp.dept_name,u.user_name,d.doc_name,m.mem_name,m.mem_reg_date,m.mem_dob,m.mem_sex,m.mem_mother_name,m.mem_mob_num,m.mem_blood_group,m.mem_email,m.mem_father_name,m.mem_emer_num,m.mem_age,m.mem_address,m.mem_regnum,m.mem_validupto,m.mem_reg_date,m.mem_status');
		$this->db->join('locations as l','l.location_id = b.loc_id');
		$this->db->join('doctors as d','d.doc_id = b.dr_id');
		$this->db->join('departments as dp','dp.dept_id = d.dept_id');
		$this->db->join('users as u','d.user_id = u.user_id');
		$this->db->join('members as m','m.mem_id = b.mem_id');
		$this->db->where('b.booking_id',$id);	
		$q = $this->db->get("$this->tbl_name as b");
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	function memLastBooking($mem){
		$sql = "SELECT * FROM $this->tbl_name WHERE `mem_id`=$mem and booking_status='DONE' order by `booking_date` desc limit 1";		
		
		$q = $this->db->query($sql);
		$num = $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function memBookingsNum($mem){
		$sql = "SELECT * FROM $this->tbl_name WHERE `mem_id`=$mem";				
		$q = $this->db->query($sql);
		return  $q->num_rows();		
	}
	
	
	function getDetailsByNameLocation($mem_name,$location_id){
		
		$query = "select * from $this->mem_tbl where mem_name=? and location_id=?";
		$q = $this->db->query($query,array($mem_name,$location_id));		
		$num =  $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDetailsByEmailLocation($mem_email,$location_id){
		
		$query = "select * from $this->mem_tbl where mem_email=? and location_id=?";
		$q = $this->db->query($query,array($mem_email,$location_id));		
		$num =  $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDetailsByMobileLocation($mem_mob_num,$location_id){
		
		$query = "select * from $this->mem_tbl where mem_mob_num=? and location_id=?";
		$q = $this->db->query($query,array($mem_mob_num,$location_id));		
		$num =  $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function getDetailsByRegLocation($mem_regnum,$location_id){
		
		$query = "select * from $this->mem_tbl where mem_regnum=? and location_id=?";
		$q = $this->db->query($query,array($mem_regnum,$location_id));		
		$num =  $q->num_rows();
		$data="";
		if ($num > 0) {
			$data = $q->result_array();		
		}
		return array('num'=>$num,'data'=>$data);
	}
	
	function create($data) {
		$q = $this->db->insert($this->tbl_name,$data);
		return $q;
	}
	
	function modify($data,$id){
		$this->db->where('booking_id',$id);
		$q = $this->db->update($this->tbl_name,$data);
		return $q;
		
	}
	
	function del($id){
		$this->db->where('mem_id',$id);
		$q = $this->db->delete($this->mem_tbl);
		return $q;
		
	}
}
?>