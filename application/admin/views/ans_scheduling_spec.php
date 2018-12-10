<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="edit_ans_spec_form" id="edit_ans_spec_form" role="form" method="post" action="<?=base_url('doctor/modify_ans_spec/'.$id)?>">
	  <div id="edit_spec_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Scheduling Specifics</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
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
			  <div class="col-sm-6">
                  <label>Emergency</label>
                   <textarea type="text" name="Emergency" id="Emergency" class="form-control"  value="" ><?=(isset($record['Emergency']))?$record['Emergency']:''?></textarea>
                </div>
                <div class="col-sm-6">
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
                  <textarea type="text" name="New_Patient" id="New_Patient" class="form-control mathedit"  value="" ><?=(isset($record['New_Patient']))?$record['New_Patient']:''?></textarea>
                </div>
                <div class="col-sm-6">
                  <label>Pharmacy</label>
                   <textarea type="text" name="Pharmacy" id="Pharmacy" class="form-control"  value="" ><?=(isset($record['Pharmacy']))?$record['Pharmacy']:''?></textarea>
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
  