<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="edit_spec_form" id="edit_spec_form" role="form" method="post" action="<?=base_url('doctor/modify_spec/'.$id)?>">
	  <div id="edit_spec_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Scheduling Specifics</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>Providers (names, #s)</label>
                  <textarea type="text" name="pro_names" id="pro_names" class="form-control" ><?=(isset($record['pro_names']))?$record['pro_names']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Doctor Schedule</label>
                  <textarea type="text" name="doc_sche" id="doc_sche" class="form-control"  value="" ><?=(isset($record['doc_sche']))?$record['doc_sche']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Hygiene Schedule</label>
                   <textarea type="text" name="hyg_sche" id="hyg_sche" class="form-control"  value="" ><?=(isset($record['hyg_sche']))?$record['hyg_sche']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Adult/Child Age</label>
                   <input type="text" name="adu_chi_age" id="adu_chi_age" class="form-control"  value="<?=(isset($record['adu_chi_age']))?$record['adu_chi_age']:''?>" >
                </div>
              </div> 
			  
			  <div class="row m-b">
			  <div class="col-sm-12">
                  <label>Insurance Providers</label>
                   <textarea type="text" name="insurance_prov" id="insurance_prov" class="form-control"  value="" ><?=(isset($record['insurance_prov']))?$record['insurance_prov']:''?></textarea>
                </div>
              </div>

			 <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Adult/Child Time</label>
                  <textarea type="text" name="adu_chi_time" id="adu_chi_time" class="form-control mathedit"  value="" ><?=(isset($record['adu_chi_time']))?$record['adu_chi_time']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>New Patients Time</label>
                   <textarea type="text" name="pat_time" id="pat_time" class="form-control mathedit"  value="" ><?=(isset($record['pat_time']))?$record['pat_time']:''?></textarea>
                </div>
              </div>
			  
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Scheduling Details - 
					(overlapping, accelerated hyg, 
					operatories to schedule in, etc)</label>
                  <textarea type="text" name="sch_det" id="sch_det" class="form-control mathedit"  value="" ><?=(isset($record['sch_det']))?$record['sch_det']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>“BUZZ” words</label>
                   <textarea type="text" name="buzz_word" id="buzz_word" class="form-control"  value="" ><?=(isset($record['buzz_word']))?$record['buzz_word']:''?></textarea>
                </div>
              </div>
			  
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>PERIO-Scheduling RP/Sc, 
						Perio maint, etc Time frames, 
						when to sched perio</label>
                  <textarea type="text" name="perio_sch" id="perio_sch" class="form-control mathedit"  value="" ><?=(isset($record['perio_sch']))?$record['perio_sch']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Do you work on days 
					where dr is not here? 
					(answer phones, etc)</label>
                   <textarea type="text" name="do_you_word" id="do_you_word" class="form-control"  value="" ><?=(isset($record['do_you_word']))?$record['do_you_word']:''?></textarea>
                </div>
              </div>
			  
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Do we call on 90 days 
					past due balance?</label>
                  <textarea type="text" name="do_we_call" id="do_we_call" class="form-control mathedit"  value="" ><?=(isset($record['do_we_call']))?$record['do_we_call']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>How do you answer 
					your phone?</label>
                   <textarea type="text" name="how_do_you_ans" id="how_do_you_ans" class="form-control"  value="" ><?=(isset($record['how_do_you_ans']))?$record['how_do_you_ans']:''?></textarea>
                </div>
              </div>
			  
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Bwx how often?</label>
                  <textarea type="text" name="bmx" id="bmx" class="form-control"  value="" ><?=(isset($record['bmx']))?$record['bmx']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Notes in Patient notes 
					(fam file) ok?</label>
                   <textarea type="text" name="pat_notes" id="pat_notes" class="form-control"  value="" ><?=(isset($record['pat_notes']))?$record['pat_notes']:''?></textarea>
                </div>
              </div>
			  
			
		
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Initials (*PR) in appts 
						and dateline</label>
                  <textarea type="text" name="initials_appts" id="initials_appts" class="form-control"  value="" ><?=(isset($record['initials_appts']))?$record['initials_appts']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Resetting recall dates</label>
                   <textarea type="text" name="resetting_recall" id="resetting_recall" class="form-control"  value="" ><?=(isset($record['resetting_recall']))?$record['resetting_recall']:''?></textarea>
                </div>
              </div>
			  
			
		
			<div class="row m-b">
			  <div class="col-sm-6">
                  <label>Passwords: Windows, 
						Computer Access Code, 
						Dentrix passwords</label>
                  <textarea type="text" name="passwords" id="passwords" class="form-control"  value="" ><?=(isset($record['passwords']))?$record['passwords']:''?></textarea>
                </div>
				 <div class="col-sm-6">
                  <label>Treatment to add 
to appointment</label>
                  <textarea type="text" name="treat_appt" id="treat_appt" class="form-control mathedit"  value="" ><?=(isset($record['treat_appt']))?$record['treat_appt']:''?></textarea>
                </div>
               
              </div>
			  
			
		
			<div class="row m-b">
			 
                <div class="col-sm-6">
                  <label>Other scheduling details:</label>
                   <textarea type="text" name="other_sche_det" id="other_sche_det" class="form-control mathedit"  value="" ><?=(isset($record['other_sche_det']))?$record['other_sche_det']:''?></textarea>
                </div>
              </div>
			  
			
		
			
		
			 
          </div>
          <div class=" p-a text-right">
            <button type="submit" class="btn black">Submit</button>
		<a class="btn danger" href="<?=base_url('doctor')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  