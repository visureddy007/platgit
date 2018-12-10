<div class="app-body">

<!-- ############ PAGE START-->
<div class="padding">
  
  <div class="row">
    <div class="col-sm-9">
      <form data-ui-jp="parsley" name="edit_msg_form" id="edit_msg_form" role="form" method="post" action="<?=base_url('message/modify/'.$record['msg_id'])?>">
	  <div id="edit_msg_msg"></div>
        <div class="box">
          <div class="box-header">
            <h2>Messages</h2>
          </div>
          <div class="box-body">
            <p class="text-muted">Please fill the fields below.</p>                        
              <div class="row m-b">
                <div class="col-sm-6">
                  <label>Message on default</label>
                  <textarea type="text" name="msg_default" id="msg_default" class="form-control mathedit" ><?=(isset($record['msg_default']))?$record['msg_default']:''?></textarea>
                </div>
              </div>
			  <div class="row m-b">
                <div class="col-sm-6">
                  <label>Message on doctor</label>
                  <textarea type="text" name="msg_doctor" id="msg_doctor" class="form-control mathedit"  value="" ><?=(isset($record['msg_doctor']))?$record['msg_doctor']:''?></textarea>
                </div>
              </div>
			 <div class=" p-a text-right">
            <button type="submit" class="btn black">Save</button>
			<a class="btn danger" href="<?=base_url('dashboard')?>">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
 
</div>

<!-- ############ PAGE END-->

    </div>
  