<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="add_docsche_form" id="add_docsche_form" role="form" method="post" action="">
	  <div id="add_doc_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Book Appointment</h2>
          </div>
          <div class="box-body">
            <p class="text-muted"></p>                        
              <div class="row m-b">
                 <div class="col-lg-9">
					<div class="panel panel-default">
						<div class="panel-heading">											
							
						</div>
						
						<!-- /.panel-heading -->
						<div id="err"></div>
						<div class="panel-body">
						 <div class="col-lg-6">																
							<div class="form-group">
								<label>Appointment Date:</label>
								<input class="form-control datetimepicker" id="apt_book_date" name= "apt_book_date" value="" data-date-startDate='<?=date('Y-m-d')?>' data-date-endDate='<?=date('Y-m-d',strtotime(" +7 days"))?>'>
							</div>
																						
							<div class="form-group">
								<label>Slot Time:</label></br>								
								<label class="radio-inline">
								  <input type="radio" name="slot_duration" id="slot_duration" value="15" checked> 15 Min
								</label>
								<label class="radio-inline">
								  <input type="radio" name="slot_duration" id="slot_duration" value="30"> 30 Min
								</label>
								<label class="radio-inline">
								  <input type="radio" name="slot_duration" id="slot_duration" value="60"> 60 Min
								</label>							
							</div>
							<div class="form-group">
								
								  <input type="hidden" name="doc_id" id="doc_id" value="<?=$record['doc_id']?>"> 
									
							</div>	
						</div>								
								<!-- /.table-responsive -->
						</div>
							<!-- /.panel-body -->
				   </div>
				</div>	
              </div>
			<!--<div class=" p-a text-right">
            <button type="submit" class="btn black">Submit</button>
			<a class="btn danger" href="<?=base_url('doctor')?>">Cancel</a>
          </div>-->
        </div>
      </form>
    </div>
  </div>
 
</div>
	<div class="row slots box" style="display:none;">
						</div>


<!-- ############ PAGE END-->

    </div>
  