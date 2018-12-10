<?php
if(!defined('BASEPATH'))exit('No direct script access allowed'); 
class Comm_fun {
    public $adminPerms = array();
    public $userAccess = array(
            'EMPLOYEE'=>array(
                'dashboard'=>array(),
                'doctor'=>array(),
                'employee'=>array(),
                'book_apt'=>array(),
              //'locations'=>array('todayhrtimings'),
                'managebreak'=>array(),
                'team'=>array(),
                'timeclock'=>array(),
                'managetime'=>array()
            )
        );
	public function accessControl($memType,$cntrl,$mthd){
		$cntrl = strtolower($cntrl);
		$mthd = strtolower($mthd);
        if($memType=='EMPLOYEE'){            
            if(isset($this->userAccess[$memType][$cntrl])){
                if(!empty($this->userAccess[$memType][$cntrl]) && !in_array($mthd,$this->userAccess[$memType][$cntrl])){
					
					echo $mthd; exit;
                    redirect('dashboard');
                }
            }else{
					/*print_r($this->userAccess[$memType]);
					echo $memType.'/'.$cntrl.'/'.$mthd; exit;*/
                redirect('dashboard');
            }
        }
    }
	function warning_msg($msg){
		return '<div class="alert alert-warning alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<span class="alert-link">'.$msg.'</span>.
										</div>';
	}
	function success_msg($msg){
		return '<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<span class="alert-link">'.$msg.'</span>.
										</div>';
	}
	/*PHP Mail*/
	function sendEMAIL($to,$subject,$message){
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: noreply@dollarstaffing.com Dollar-Staffing';
		 mail($to, $subject, $message, $headers);
	}
}
?>