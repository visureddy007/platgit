<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
	<div id="msg">
		<?php
				if($this->session->flashdata('success')){
			?>
				<div class="alert alert-success alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <strong><?=$this->session->flashdata('success')?></strong>
				</div>
			<?php
				}
				if($this->session->flashdata('invalid')){
			?>
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <strong><?=$this->session->flashdata('invalid')?></strong>
				</div>
			<?php
				}
			?>
		
	</div>
      <form id="example-form" method="post" action="<?=base_url('doctor/modify_spec')?>">
    <div>
        <h3>Office Specifics</h3>
        <section>
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>Office Name</label>
				  <input type="hidden" name="doc_id" id="doc_id" value="<?=$this->uri->segment('3')?>">
                  <textarea type="text" name="ofc_name" id="ofc_name" class="form-control" ><?=(isset($record['ofc_name']))?$record['ofc_name']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Doctors Names (Pronunciation)</label>
                  <textarea type="text" name="doc_names" id="doc_names" class="form-control"  value="" ><?=(isset($record['doc_names']))?$record['doc_names']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Providers/ Specialists & Hours</label>
                   <textarea type="text" name="pro_spe_hrs" id="pro_spe_hrs" class="form-control"  value="" ><?=(isset($record['pro_spe_hrs']))?$record['pro_spe_hrs']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Hygienists & Hours</label>
                   <textarea type="text" name="hyg_hrs" id="hyg_hrs" class="form-control"  value="" ><?=(isset($record['hyg_hrs']))?$record['hyg_hrs']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Office Hours</label>
                   <textarea type="text" name="ofc_hrs" id="ofc_hrs" class="form-control"  value="" ><?=(isset($record['ofc_hrs']))?$record['ofc_hrs']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Insurances Accepted</label>
                   <textarea type="text" name="ins_acc" id="ins_acc" class="form-control"  value="" ><?=(isset($record['ins_acc']))?$record['ins_acc']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Insurances Not Accepted</label>
                   <textarea type="text" name="ins_not_acc" id="ins_not_acc" class="form-control"  value="" ><?=(isset($record['ins_not_acc']))?$record['ins_not_acc']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Adult Scheduling</label>
                   <textarea type="text" name="adult_sche" id="adult_sche" class="form-control"  value="" ><?=(isset($record['adult_sche']))?$record['adult_sche']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Child Scheduling</label>
                   <textarea type="text" name="child_sche" id="child_sche" class="form-control"  value="" ><?=(isset($record['child_sche']))?$record['child_sche']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Period Scheduling</label>
                   <textarea type="text" name="per_sche" id="per_sche" class="form-control"  value="" ><?=(isset($record['per_sche']))?$record['per_sche']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>New Patient Scheduling</label>
                   <textarea type="text" name="pat_sche" id="pat_sche" class="form-control"  value="" ><?=(isset($record['pat_sche']))?$record['pat_sche']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Operatories</label>
                   <textarea type="text" name="oper" id="oper" class="form-control"  value="" ><?=(isset($record['oper']))?$record['oper']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Scheduling Details</label>
                   <textarea type="text" name="sche_det" id="sche_det" class="form-control"  value="" ><?=(isset($record['sche_det']))?$record['sche_det']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Patient Inactivation</label>
                   <textarea type="text" name="pat_inactv" id="pat_inactv" class="form-control"  value="" ><?=(isset($record['pat_inactv']))?$record['pat_inactv']:''?></textarea>
                </div>
              </div> 
			 
			  
			  
        </section>
        <h3>Office Policy</h3>
        <section>
            <div class="row m-b">
                <div class="col-sm-6">
                  <label>Notes & Communication</label>
                  <textarea type="text" name="notes_comm" id="notes_comm" class="form-control" ><?=(isset($record['notes_comm']))?$record['notes_comm']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Scripting</label>
                  <textarea type="text" name="scrip" id="scrip" class="form-control"  value="" ><?=(isset($record['scrip']))?$record['scrip']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Cancellation Policy</label>
                   <textarea type="text" name="canc_poli" id="canc_poli" class="form-control"  value="" ><?=(isset($record['canc_poli']))?$record['canc_poli']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Pricing Details</label>
                   <textarea type="text" name="pric_det" id="pric_det" class="form-control"  value="" ><?=(isset($record['pric_det']))?$record['pric_det']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Office Reminders</label>
                   <textarea type="text" name="ofc_remi" id="ofc_remi" class="form-control"  value="" ><?=(isset($record['ofc_remi']))?$record['ofc_remi']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Balances</label>
                   <textarea type="text" name="balances" id="balances" class="form-control"  value="" ><?=(isset($record['balances']))?$record['balances']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Scheduling for Doctor</label>
                   <textarea type="text" name="schd_doc" id="schd_doc" class="form-control"  value="" ><?=(isset($record['schd_doc']))?$record['schd_doc']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Computer Access Times</label>
                   <textarea type="text" name="comp_acc_times" id="comp_acc_times" class="form-control"  value="" ><?=(isset($record['comp_acc_times']))?$record['comp_acc_times']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Computer Access Logins</label>
                   <textarea type="text" name="comp_acc_logins" id="comp_acc_logins" class="form-control"  value="" ><?=(isset($record['comp_acc_logins']))?$record['comp_acc_logins']:''?></textarea>
                </div>
               </div> 
			  </section>
        <h3>Office Contact Info</h3>
         <section>
            <div class="row m-b">
                <div class="col-sm-6">
                  <label>Location & Directions</label>
                  <textarea type="text" name="loc_dire" id="loc_dire" class="form-control" ><?=(isset($record['loc_dire']))?$record['loc_dire']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Address</label>
                  <textarea type="text" name="address" id="address" class="form-control"  value="" ><?=(isset($record['address']))?$record['address']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Phone Number</label>
                   <textarea type="text" name="phn_num" id="phn_num" class="form-control"  value="" ><?=(isset($record['phn_num']))?$record['phn_num']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Fax</label>
                   <textarea type="text" name="fax" id="fax" class="form-control"  value="" ><?=(isset($record['fax']))?$record['fax']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Office Manager Name</label>
                   <textarea type="text" name="ofc_mand_name" id="ofc_mand_name" class="form-control"  value="" ><?=(isset($record['ofc_mand_name']))?$record['ofc_mand_name']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Office Manager Number</label>
                   <textarea type="text" name="ofc_mang_num" id="ofc_mang_num" class="form-control"  value="" ><?=(isset($record['ofc_mang_num']))?$record['ofc_mang_num']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Email</label>
                   <textarea type="text" name="email" id="email" class="form-control"  value="" ><?=(isset($record['email']))?$record['email']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Emergency</label>
                   <textarea type="text" name="emergency" id="emergency" class="form-control"  value="" ><?=(isset($record['emergency']))?$record['emergency']:''?></textarea>
                </div>
              </div> 
			
			  </section>
		<h3>Schedule Specific</h3>
         <section>
             <div class="row m-b">
                <div class="col-sm-6">
                  <label>Procedures Services</label>
                  <textarea type="text" name="Procedures_Services" id="Procedures_Services" class="form-control" ><?=(isset($record['Procedures_Services']))?$record['Procedures_Services']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Treatment</label>
                  <textarea type="text" name="Treatment" id="Treatment" class="form-control"  value="" ><?=(isset($record['Treatment']))?$record['Treatment']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
			 <div class="col-sm-12">
                  <label>Pricing Promotions</label>
                   <textarea type="text" name="Pricing_Promotions" id="Pricing_Promotions" class="form-control"  value="" ><?=(isset($record['Pricing_Promotions']))?$record['Pricing_Promotions']:''?></textarea>
                </div>
              </div> 
			  <div class="row m-b">
			  <div class="col-sm-12">
                  <label>Cancellation Procedure</label>
                   <textarea type="text" name="Cancellation_Procedure" id="Cancellation_Procedure" class="form-control"  value="" ><?=(isset($record['Cancellation_Procedure']))?$record['Cancellation_Procedure']:''?></textarea>
                </div>
              </div>
              <div class="row m-b">
			  <div class="col-sm-6">
                  <label>Reschedule Procedure</label>
                  <textarea type="text" name="Reschedule_Procedure" id="Reschedule_Procedure" class="form-control mathedit"  value="" ><?=(isset($record['Reschedule_Procedure']))?$record['Reschedule_Procedure']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Scripting</label>
                   <textarea type="text" name="Scripting" id="Scripting" class="form-control mathedit"  value="" ><?=(isset($record['Scripting']))?$record['Scripting']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
			  <div class="col-sm-6">
                  <label>New Patient</label>
                  <textarea type="text" name="New_Patient" id="New_Patient" class="form-control"  value="" ><?=(isset($record['New_Patient']))?$record['New_Patient']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Pharmacy</label>
                   <textarea type="text" name="Pharmacy" id="Pharmacy" class="form-control"  value="" ><?=(isset($record['Pharmacy']))?$record['Pharmacy']:''?></textarea>
                </div>
              </div>
			
			  </section>
        </div>
</form></div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  