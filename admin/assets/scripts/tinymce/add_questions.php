<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Questions</h1>
                </div>
				
				
				
                <!-- /.col-lg-12 -->
            </div>
			
			
			
			
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add New Question
                        </div>
                        <div class="panel-body">
                            <div class="row">
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
                                <div class="col-lg-12">
                                   <form id="prod_form" role="form" action="<?=base_url('question/create')?>" method="post" enctype="multipart/form-data">
                                       
									
										
									<table id="hrtable" border="1"  align="center" class="table table-striped table-bordered table-hover dataTable no-footer">
											<thead>
											<tr>	
												<th>Questions</th>
												
												<th><button type="button" id="addRowBtn">Add Row</button></th>
											</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
										</br>
										
                                       
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                       
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                               
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
<script src="http://code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?= base_url('assets') ?>/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets') ?>/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>		
<script type="text/javascript">

function ldddd() {
tinymce.init({ 
plugins: [
"eqneditor advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen",
"insertdatetime media table contextmenu paste" ],
toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	",
selector : ".mathedit"
});
}
ldddd();
$(function(){
    var tbl = $("#hrtable");    
	var tbl_rows = 1;
    $("#addRowBtn").click(function(){
        $('<tr><td>Question:<textarea class="mathedit" placeholder="Enter text" name="ques_desc[]" id="ques_desc_'+tbl_rows+'"></textarea><br>Answer Description:<textarea class="mathedit" placeholder="Enter text" name="ans_desc[]" id="ans_desc_'+tbl_rows+'"></textarea><br><td><button class="delRowBtn">Delete</button></td></tr>').appendTo(tbl);  
		$("#ques_desc_"+tbl_rows).focus();
		tbl_rows++;
		//ldddd();
    });
	
	$("body").on("focus",".mathedit",function(){
		var ele = $(this).attr('id');
		
		tinymce.init({ 
		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	",
		selector : '#'+ele,
		setup: function(instance) {
				instance.on('blur', function(id) {
					tinymce.remove('#'+ele);
				});
			}
		});
		
	});
	
	/*$("body").on("blur",".mathedit",function(){
		var ele = $(this).attr('id');
		tinymce.init({ 
		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	",
		selector : '#'+ele,
		setup: function(instance) {
				instance.on('blur', function(id) {
					tinymce.remove('#'+ele);
				});
			}
		});
	});*/
	
	$("body").on("focusout",".mathedit",function(){
		var ele = $(this).attr('id');
		tinymce.init({ 
		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	",
		selector : '#'+ele,
		setup: function(instance) {
				instance.on('blur', function(id) {
					tinymce.remove('#'+ele);
				});
			}
		});
	});
        
    $(document.body).delegate(".delRowBtn", "click", function(){
        $(this).closest("tr").remove();        
    });    
    
});
	
</script>		