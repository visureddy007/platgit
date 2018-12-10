var currentuser={};
	var selecteduser = {};
	var socket = io('https://tele-collaboration.com:8136');
	
		/** chat code**/
	
	
	function connect() {
	
	
	socket.emit('login', currentuser.id);
	 
}
function sendio(channel, username, msg, eventype, callback) {

	var userMessage = { type: eventype, message: msg };

	var data = { from: username, to: channel, message: userMessage };

	//console.log('publish ' + channel + username + msg + eventype );
	if (socket != null) {
		socket.emit('message', data);
		
	}
}
socket.on('connect', function (data) {
        console.log(data);
        console.log('connected');
        socket.emit('login', currentuser.id);
    });

 socket.on('login', function (data) {
        console.log('connection successfull');
        connected = true;
        // Display the welcome message
        var message = "Welcome to Socket.IO Chat â€“ ";
    });

    socket.on('disconnect', function () {
        console.log('you have been disconnected');
    });

    socket.on('reconnect', function () {
        console.log('you have been reconnected');
        socket.emit('login', currentuser.name);
    });

    socket.on('reconnect_error', function () {
        console.log('attempt to reconnect has failed');
    });

    socket.on('online', function (data) {
        console.log(data);
        console.log('user online ' + data);
    });

    socket.on('offline', function (data) {
        console.log(data);
        console.log('user offline ' + data);
    });

	socket.on('message', function (data) {

		switch (data.message.type) {
		
			case 'chat':
				{ console.log(data.message.message)
					updatechat('chat', data.message.message);
					
				}
				break;
			
			
		}

        console.log(data);
    });
	function updatechat(ab,data){
	console.log(data);
	//var jsobobj = JSON.parse(data.msg);
	//outmessage(data.msg);
	$('<div class="m-b"><a href="#" class="pull-right w-40 m-l-sm"><img src="'+site_url+'/assets/images/a3.jpg" class="w-full img-circle" alt="..."></a><div class="clear text-right"><div class="p-a p-y-sm success inline text-left r">'+data.msg+'</div><div class="text-muted text-xs m-t-xs">1 minutes ago</div></div></div>').appendTo($('.p-a-md'));
		
	}
	function sendmsg(message){
		var chat = {
			name: currentuser.name, msg: message, 
			
		};
		sendio(selecteduser.id, currentuser.id, chat, "chat");
		$('<div class="m-b"><a href="#" class="pull-left w-40 m-r-sm"><img src="'+site_url+'/assets/images/a2.jpg" alt="..." class="w-full img-circle"></a><div class="clear"><div class="p-a p-y-sm dark-white inline r">'+message+' </div><div class="text-muted text-xs m-t-xs"><i class="fa fa-ok text-success"></i> 2 minutes ago</div></div></div>').appendTo($('.p-a-md'));
		
	}
	
	
$(document).ready(function(){
	
	currentuser.id=$("#current_id").val();
	currentuser.name=$("#current_name").val();
    connect();
	$('#chat').on('hidden.bs.modal', function () {
  // do something…
	
		
    })
	

	
	function formatDate (input) {
		var datePart = input.match(/\d+/g),
		year = datePart[0], // get only two digits
		month = datePart[1],
		day = datePart[2];
		return month+'-'+day+'-'+year;
	}
	$('.datetimepicker').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		format: "mm-dd-yyyy ",
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
		});
	$("#team_members").change(function(){
			var id = $(this).val();
		//	alert(id);
			$.ajax({
				url:site_url+'/team/ajGetTeamMem',
				data:{emp:id},
				type:'post',
				success:function(res){
					$('#team_lead').html(res);	
				}
			});
			
		});
	$("#add_emp_form").validate({
		rules:{
			'emp_phone':{
				required:true,
				number:true,
			},
			'zip':{
				required:true,
				number:true,
			},
			'emp_password':{
				required:true
			},
			'cnf_password':{
				required:true,
				equalTo:'#emp_password'
			}
		},
		/*messages:{
			emp_username:'Please enter parameter name',
		},*/
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_emp_msg").html(j.msg);
                             goTop();							
							if(j.status){	
							debugger;							
								$("#add_emp_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_emp_msg").html(j.msg);
									window.location=site_url+'/employee';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$("#add_timeoff_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_timeoff_msg").html(j.msg);
                             goTop();							
							if(j.status){	
							debugger;							
								$("#add_timeoff_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_timeoff_msg").html(j.msg);
									window.location=site_url+'/time_off_req';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$("#edit_emp_form").validate({
		rules:{
			'emp_phone':{
				required:true,
				number:true,
			},
			'zip':{
				required:true,
				number:true,
			},
		},
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#edit_emp_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#edit_emp_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#edit_emp_msg").html(j.msg);
									window.location=site_url+'/employee';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#add_doc_form").validate({
		rules:{
			'doc_password':{
				required:true
			},
			'cnf_password':{
				required:true,
				equalTo:'#doc_password'
			},
			'doc_phone':{
				required:true,
				number:true,
			},
			'zip':{
				required:true,
				number:true,
			},
			'doc_monthly_fee':{
				required:true,
				number:true,
			},
		},
		/*messages:{
			emp_username:'Please enter parameter name',
		},*/
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_doc_msg").html(j.msg);
                             goTop();							
							if(j.status){	
							debugger;							
								$("#add_doc_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_doc_msg").html(j.msg);
									window.location=site_url+'/doctor';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$("#edit_doc_form").validate({
		rules:{
			'doc_phone':{
				required:true,
				number:true,
			},
			'zip':{
				required:true,
				number:true,
			},
			'doc_monthly_fee':{
				required:true,
				number:true,
			},
		},
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#edit_doc_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#edit_doc_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#edit_doc_msg").html(j.msg);
									window.location=site_url+'/doctor';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#edit_spec_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#edit_spec_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#edit_spec_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#edit_spec_msg").html(j.msg);
									window.location=site_url+'/doctor';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#edit_ans_spec_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#edit_ans_spec_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#edit_ans_spec_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#edit_ans_spec_msg").html(j.msg);
									window.location=site_url+'/doctor';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#assn_empteam_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#assn_empteam_msg").html(j.msg);
                             goTop();							
							if(j.status){	
							debugger;							
								$("#assn_empteam_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#assn_empteam_msg").html(j.msg);
									window.location=site_url+'/team';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$("#edit_team_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#edit_team_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#edit_team_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#edit_team_msg").html(j.msg);
									window.location=site_url+'/team';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#edit_msg_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#edit_msg_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#edit_msg_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#edit_msg_msg").html(j.msg);
									window.location=site_url+'/dashboard';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#add_timpun_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_timpun_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#add_timpun_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_timpun_msg").html(j.msg);
									//window.location=site_url+'/dashboard';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$("#add_brkpun_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_brkpun_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#add_brkpun_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_brkpun_msg").html(j.msg);
									//window.location=site_url+'/dashboard';							
								}else {
							}
						}
					}); 
			return false;
		}
	});	
	$("#add_docsche_form").validate({
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_docsche_msg").html(j.msg);	
							 goTop();			
							if(j.status){	
							debugger;							
								$("#add_docsche_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_docsche_msg").html(j.msg);
									window.location=site_url+'/doctor';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$("#add_calllog_form").validate({
	
		submitHandler:function(form){
				$(form).ajaxSubmit({
						beforeSend: function() {	
							debugger;
						},
						uploadProgress: function(event, position, total, percentComplete) {
							debugger;
						},
						success: function() {
								debugger;
						},
						complete: function(xhr) {
						 debugger;					
							var j = JSON.parse(xhr.responseText);
							$("#add_calllog_msg").html(j.msg);
                             goTop();							
							if(j.status){	
							debugger;							
								$("#add_calllog_form").find("input[type=text],input[type=email],input[type=file],select,textarea").val("");
								$("#add_calllog_msg").html(j.msg);
									//window.location=site_url+'/doctor/calllog_view/'+j.cal_log_id;							
									window.location=site_url+'/doctor/addcall_log';							
								}else {
							}
						}
					}); 
			return false;
		}
	});
	$(document).on("click", ".ra-calllog", function(){ 
		var elm = $(this);
		var txt = elm.data('txt');
		if(confirm("Is this resolved ?")){			
			var e = elm.data('clid');
			if(e==undefined || e==0 || e==''){
				return false;
			}else if(e>0){
				var data = {e:e};
				var req = ajxReq(site_url+'/doctor/updateRaCall',data,'POST','json');
				req.done(function(data){
					debugger;
					if(data.success){			
						 window.location=site_url+'/doctor/reqAtt';													
						$("#msg").html(data.msg);
					}
				});
			}
			return false;
		}
     }); 
	$(document).on("click", ".del-emp", function(){ 
		var elm = $(this);
		var txt = elm.data('txt');
		if(confirm("Do you really want to delete ?")){			
			var e = elm.data('clid');
			if(e==undefined || e==0 || e==''){
				return false;
			}else if(e>0){
				var data = {e:e};
				var req = ajxReq(site_url+'/employee/del',data,'POST','json');
				req.done(function(data){
					debugger;
					if(data.success){			
						 window.location=site_url+'/employee';													
						$("#msg").html(data.msg);
					}
				});
			}
			return false;
		}
     });
	$(document).on("click", ".del-doctor", function(){ 
		var elm = $(this);
		var txt = elm.data('txt');
		if(confirm("Do you really want to delete ?")){			
			var e = elm.data('clid');
			if(e==undefined || e==0 || e==''){
				return false;
			}else if(e>0){
				var data = {e:e};
				var req = ajxReq(site_url+'/doctor/del',data,'POST','json');
				req.done(function(data){
					debugger;
					if(data.success){			
						 window.location=site_url+'/doctor';													
						$("#msg").html(data.msg);
					}
				});
			}
			return false;
		}
     });
	$(document).on("click", ".del-team", function(){ 
		var elm = $(this);
		var txt = elm.data('txt');
		if(confirm("Do you really want to delete ?")){			
			var e = elm.data('clid');
			if(e==undefined || e==0 || e==''){
				return false;
			}else if(e>0){
				var data = {e:e};
				var req = ajxReq(site_url+'/team/del',data,'POST','json');
				req.done(function(data){
					debugger;
					if(data.success){			
						 window.location=site_url+'/team';													
						$("#msg").html(data.msg);
					}
				});
			}
			return false;
		}
     }); 

if($("#timeclock").length>0){
	/**** Logic For Time Punches ***/
$(document).on('click',".timein, .timeout",function(){
  var tc_id = '';	
  var elm = $(this);
  var today_date = elm.attr('data-date');
   var today_date = formatDate (today_date);
  var tc_id = elm.attr('data-id');
  var emp_id = elm.attr('data-emp');
  var d = new Date(),
	  h = (d.getHours()<10?'0':'') + d.getHours(),
	  m = (d.getMinutes()<10?'0':'') + d.getMinutes();
	  t = h + ':' + m;
  var time = t;
	   $.ajax({
		url:site_url+'/timeclock/insertime',
		type: 'POST', 
		data: 'time='+time+'&tc_id='+tc_id+'&emp_id='+emp_id,
		async: false,
		success: function(s){
				j = JSON.parse(s);
				if(tc_id > 0){
					$("#btn-in").html('Time-In');
					elm.removeClass('timeout');
					elm.addClass('timein');
					elm.removeAttr('data-id');
					$("#out_"+j.tc_id).html(j.time+'&nbsp'+today_date);
				}else{
					$("#tc_id").val(j.id);
					$("#btn-in").html('Time-Out');
					elm.removeClass('timein');
					elm.addClass('timeout');
					$("button").attr("data-id",j.id);
					//$("#btn-start").removeAttr('disabled');
					$('<tr ><td id="in_'+j.id+'">'+j.time+'&nbsp'+today_date+'</td><td id="out_'+j.id+'"></td></tr>').appendTo("#my_table");
				}
			}
		});
  });
  /*** Logic For Break Timings ***/
  $(document).on('click',".breakstart, .breakstop",function(){
	var bp_id = '';	
	var elm = $(this);  
	var today_date = elm.attr('data-date');
	var tc_id = $("#tc_id").val();	
	var bp_id = elm.attr('data-id');
	var emp_id = elm.attr('data-emp');
	var break_type = $("#break_type option:selected").val();
	  if(break_type == ''){
		  alert("Please select the type of break");
	   }else{
	  var d = new Date(),
		  h = (d.getHours()<10?'0':'') + d.getHours(),
		  m = (d.getMinutes()<10?'0':'') + d.getMinutes();
		  t = h + ':' + m;
  var time = t;
	   $.ajax({
		url:site_url+'/timeclock/insertbreak',
		type: 'POST', 
		data: 'time='+time+'&tc_id='+tc_id+'&break_type='+break_type+'&bp_id='+bp_id+'&emp_id='+emp_id,
		async: false,
		success: function(s){
				j = JSON.parse(s);
				if(bp_id > 0){
					$("#btn-start").html('Start Break');
					elm.removeClass('breakstop');
					elm.addClass('breakstart');
					elm.removeAttr('data-id');
					$("#out_break"+j.bp_id).html(j.time+'&nbsp'+today_date);
				}else{
					//$("#tc_id").val(j.id);
					$("#btn-start").html('Stop Break');
					elm.removeClass('breakstart');
					elm.addClass('breakstop');
					elm.attr("data-id",j.bp_id);
					//$(".timeout").addAttr('disabled');
					$('<tr ><td id="start_'+j.bp_id+'">'+j.time+'&nbsp'+today_date+'</td><td id="out_break'+j.bp_id+'"></td><td id="type_'+j.break_type+'">'+j.break_type+'</td></tr>').appendTo("#break_table");
				}
			}
		});
  }
  });  
}

if($("#docassign").length>0){
	/**** Logic For Time Punches ***/
$(document).on('click',".assign",function(){
  var elm = $(this);
  var emp_id = elm.attr('data-emp');
  var doc_id = elm.attr('data-doc');
	   $.ajax({
		url:site_url+'/employee/assign_doc',
		type: 'POST', 
		data: 'emp_id='+emp_id+'&doc_id='+doc_id,
		async: false,
		success: function(s){
				j = JSON.parse(s);
				elm.closest('tr').remove();
				$('<tr><td>'+j.doc_office_name+'</td><td>'+j.city+'</td><td><a href="'+site_url+'/doctor/view/'+doc_id+'"><span class="label green pos-rlt m-r-xs delete">View</span></a></td><td><span data-id="'+j.id+'" data-emp="'+emp_id+'" data-doc="'+doc_id+'" class="label danger pos-rlt m-r-xs delete">Remove</span></td></tr>').appendTo("#assn_table");
			}
		});
  });
$(document).on('click',".delete",function(){
  var elm = $(this);
  var id = elm.attr('data-id');
  var emp_id = elm.attr('data-emp');
  var doc_id = elm.attr('data-doc');
	   $.ajax({
		url:site_url+'/employee/remove_doc',
		type: 'POST', 
		data: 'emp_id='+emp_id+'&doc_id='+doc_id+'&id='+id,
		async: false,
		success: function(s){
				j = JSON.parse(s);
				elm.closest('tr').remove();
				$('<tr><td>'+j.doc_office_name+'</td><td>'+j.city+'</td><td>'+j.state+'</td><td><span data-doc="'+doc_id+'" data-emp="'+emp_id+'" class="label success pos-rlt m-r-xs assign">Assign</span></td></tr>').appendTo("#doctor-table");
			}
		});
  });


}

if($("#managetimepunch").length>0){
	
	/**** Logic For Time Punches ***/
$(document).on('click',".gettimepunches",function(){
   var elm = $(this);
   var emp_id = $("#emp_id option:selected").val();
   var date = $("#date").val();
   $.ajax({
		url:site_url+'/managetime/getTimePunches',
		type: 'POST', 
		data: 'emp_id='+emp_id+'&date='+date,
		async: false,
		success: function(s){
				j = JSON.parse(s);
				if(j.num>0){
				$("#timepunchres").show();
				$("#timeRes").html(j.timepunches);
			}else{
					$("#timeRes").html('<tr ><th colspan="7" style="text-align:center;" >No time punches found on this particular date </th> </tr>');
				$("#timepunchres").show();
				}
			}
		});
  }); 
   $(document.body).delegate(".delTimePunch", "click", function(){
        var delRowBtn = $(this);
		var e = delRowBtn.attr('data-id');
		if(e==undefined){
			delRowBtn.closest('tr').remove();
		}else if(e>0){
			var data = {e:e};
			var req = ajxReqs(site_url+'/managetime/timepunchDel',data,'json','POST');
			req.done(function(data){
					debugger;
				if(data.success){			
					debugger;
					delRowBtn.closest('tr').remove();  
					$("#msg").html(data.msg);
				}
			});
		}
		return false;        
    });   
}

if($("#managebreakpunch").length>0){
	
	/**** Logic For Time Punches ***/
$(document).on('click',".getbreakpunches",function(){
   var elm = $(this);
   var emp_id = $("#emp_id option:selected").val();
   var date = $("#date").val();
   $.ajax({
		url:site_url+'/managebreak/getBreakPunches',
		type: 'POST', 
		data: 'emp_id='+emp_id+'&date='+date,
		async: false,
		success: function(s){
				j = JSON.parse(s);
				if(j.num>0){
				$("#breakpunchres").show();
				$("#breakRes").html(j.breakpunches);
			}else{
					$("#breakRes").html('<tr ><th colspan="7" style="text-align:center;" >No break punches found on this particular date </th> </tr>');
				$("#breakpunchres").show();
				}
			}
		});
  }); 
   $(document.body).delegate(".delBreakPunch", "click", function(){
        var delRowBtn = $(this);
		var e = delRowBtn.attr('data-id');
		if(e==undefined){
			delRowBtn.closest('tr').remove();
		}else if(e>0){
			var data = {e:e};
			var req = ajxReqs(site_url+'/managebreak/breakpunchDel',data,'json','POST');
			req.done(function(data){
					debugger;
				if(data.success){			
					debugger;
					delRowBtn.closest('tr').remove();  
					$("#msg").html(data.msg);
				}
			});
		}
		return false;        
    });   
}

});

function ldddd() {
	$('.mathedit').each(function() {
		var ele = this.id;
		tinymce.init({ 
			font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
			plugins: [
			"eqneditor advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste",
		"textcolor colorpicker" ],
			toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	",
			selector : '#'+ele,
			setup: function(instance) {
					instance.on('blur', function(id) {
						tinymce.remove('#'+ele);
					});
				}
			});
		});
}
/*ldddd();*/
$(function(){
	$(document).on("focus",".mathedit",function(){
		var ele = $(this).attr('id');
		tinymce.init({ 
		font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste",
		"textcolor colorpicker" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	 | forecolor backcolor",
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
	
	$(document).on("focusout",".mathedit",function(){
		var ele = $(this).attr('id');
		tinymce.init({ 
		font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n',
		plugins: [
		"eqneditor advlist autolink lists link image charmap print preview anchor",
		"searchreplace visualblocks code fullscreen",
		"insertdatetime media table contextmenu paste",
		"textcolor colorpicker" ],
		toolbar: "undo redo | eqneditor link image | styleselect | bold italic | bullist numlist outdent indent	 | forecolor backcolor",
		selector : '#'+ele,
		setup: function(instance) {
				instance.on('blur', function(id) {
					tinymce.remove('#'+ele);
				});
			}
		});
	});	
});
$(document).on('focus','.timepicker',function(){
	$(this).timepicker({showMeridian:false});

});
$(document).on('focus','.timepicker1',function(){
	$(this).timepicker();
});
$(document).ready(function(){
	 var tb = $("#tmgs"); 
	 var item = $(".daytmgs").length;
     $("#addTime").click(function(){
	 var newrow = item;
     $('<tr class="daytmgs"><td><select style="width:120px;" id="day'+newrow+'" data-index="'+newrow+'" name="day[]" type="text" class="form-control"></select></td><td><input type="text" data-index="'+newrow+'" name="in[]" id="in'+newrow+'" class="form-control timepicker in" value="" ></td><td><input type="text" name="out[]" data-index="'+newrow+'"  id="out'+newrow+'"  class="form-control timepicker out " value=""></td><td><button class="btn btn-icon waves-effect waves-light btn-danger delTimeBtn"> <i class="fa fa-remove"></i> </button></td><tr>').appendTo(tb);     
	 $("#day"+newrow).html(dayoptions);	 
	item++;
});	
  $(document.body).delegate(".delTimeBtn", "click", function(){
        var delRowBtn = $(this);
		var e = delRowBtn.attr('data');
		if(e==undefined){
			delRowBtn.closest('tr').remove();
		}else if(e>0){
			var data = {e:e};
			var req = ajxReqs(site_url+'/doctor/timeDel',data,'json','POST');
			req.done(function(data){
					debugger;
				if(data.success){			
					debugger;
					delRowBtn.closest('tr').remove();  
					$("#msg").html(data.msg);
				}
			});
		}
		return false;        
    }); 
 });
$(document).on('change',"#apt_book_date,#slot_duration",function(){
	var bDt = $("#apt_book_date").val();
	var doc_id = $("#doc_id").val();
	var slot_duration =  $("input[name='slot_duration']:checked"). val();
	var slots ='';
    var data = {doc_id:doc_id,bDt:bDt,slot_duration:slot_duration};
	var url = site_url+'/doctor/getSlots';
	if((bDt != "") &&(slot_duration != "")){
		var slotReq = ajxReqs(url,data,'json','post');
		slotReq.done(function(res){			
			if(res.num > 0){
				$('.slots').show();
				/*$("#emrBtn").show();*/
				slots+='<div class="col-sm-12"><div class="card-box">';
				var slotsCount =0;
				$.each(res.data,function(k,v){
					slotsCount+=v.slots;
					/*alert(v.slots);*/
					if(v.slots!=undefined && v.slots!=""){
						slots+='<h4 class="m-t-0 header-title"><i class="fa fa-user-md"></i> <b>'+v.doc_firstname+'</b> ('+v.doc_office_name+')('+v.in_time+'-'+v.out_time+')('+v.doc_office_name+')</h4><div class="row">'+v.slots+'</div><br>';
						
					}
					
				});
					if(slotsCount==0){
						slots+='<h4 class="m-t-0 header-title">Slots not available</h4>';
						
					}
				slots+='</div"></div">';
			
				$(".slots").html(slots);
			}else{
				$('.slots').hide();
				$("#emrBtn").hide();
			}
		});
	}else{
		
	}
});
$(document).on('click','.getData',function(){
	
	$(this).children('.fa').addClass('fa-spin');
	var report_type = $("#report_type").val();
	var emp_id = $("#emp_id").val();
	var doc_id = $("#doc_id").val();
	var team_id = $("#team_id").val();
	var cl_id = $("#doc_id").val();
	var start = $('#from').val();
	var end = $('#to').val();
	
	var action = site_url+'/reports/getdata';
	var searchReq = ajxReqs(action,{report_type:report_type,emp_id:emp_id,doc_id:doc_id,team_id:team_id,start:start,end:end},'json','post');
	searchReq.done(function(j){
		$('.getData').children('.fa').removeClass('fa-spin');
		if(j.success){
			$("table#dataTables-example").remove();
			$("table#tot_wrk").remove();
			$("div.dt-buttons").remove();
			$("div.dataTables_info").remove();
			$("div.dataTables_paginate").remove();
			$("div.repStats").append('</table><table id="dataTables-example" class="table table-striped table-bordered dt-responsive nowrap repOutput"></table><table id="tot_wrk"  class="table table-striped table-bordered dt-responsive nowrap repOutput1">');
			$(".repOutput").html(j.tbl);
			$(".repOutput1").html(j.tot);
			$('#dataTables-example').DataTable({
                dom: 'Brtip',
                buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				]
            });
			if(report_type=='ptentrspn'){
		
				$("#chart-div").show();
				var placeholder = $(".patpiechart");
				placeholder.unbind();
				var data = j.pechrt;
				$.plot(placeholder, data, { 
					series: {
						 pie: {
							 show: true,
							 label: {
								 show: true,
								 formatter: function(label,point){
									 return(point.label + '<br>'+ point.percent.toFixed(2) + '%');
									 
								 }
							 }
						}
					},        
					legend: {show: false}
				});
			}else{
				
				$("#chart-div").hide();
			}
		
			/*if ( $.fn.dataTable.isDataTable( '#dataTables-example' ) ) {
					table = $('#dataTables-example').DataTable();
				}
				else {
					table = $('#dataTables-example').DataTable( {
						"aaData": null,
						searching: false,
						responsive: true,
						dom: 'Bfrtip',
						buttons: [
							'excel', 'pdf', 'print'
						],
						"ordering": false
					} );
				}*/
		}else{
			
			$("#chart-div").hide();
			$(".repOutput").html(j.msg);
			$(".repOutput1").html('');
			$(".patpiechart").html('');
			
		}
	});
});
$(document).on('change','#report_type',function(){
	var keyword = $("#report_type").val();
	if(keyword=='timepunches' || keyword=='breakpunches'  || keyword=='empprfrm'){
		$('#empDiv').show();
	}else{
		$('#empDiv').hide();
		
	}
	if(keyword=='drgoal' || keyword=='ptentrspn'){
		$('#docDiv').show();
	}else{
		$('#docDiv').hide();
		
	}
	if(keyword=='tmprdct'){
		$('#teamDiv').show();
	}else{
		$('#teamDiv').hide();
		
	}
	
});
$(document).on('change','#call_result',function(){
	var call_result = $("#call_result option:selected").val();
	/*var patient_response = $("#patient_response option:selected").val();*/
	  if(call_result=='Contact'){
		$('#req_att').show();
		$('#pat_resp').show();
		$('#nts').show();
		/*if(patient_response =='Schedule Appointment'){
			$('#apt').show();
			$('#ac').show();
		}*/
	}else if(call_result=='Busy' || call_result=='Wrong Number' || call_result=='No Answer' || call_result=='Three Tone' || call_result=='Other' ){
		$('#req_att').hide();
		$('#pat_resp').hide();
		$('#nts').hide();
		$('#rfl').hide();
		$('#apt').hide();
		$('#ac').hide();
	}
});
$(document).on('change','#patient_response',function(){
	var patient_response = $("#patient_response option:selected").val();
	  if(patient_response=='Schedule Appointment' || patient_response=='Rescheduled Appointment'){
		$('#apt').show();
		$('#ac').show();
		$('#rfl').hide();
	}else if(patient_response=='Other' || patient_response=='PR Call back' || patient_response=='Patient Call back'){
		$('#rfl').hide();
		$('#apt').hide();
		$('#ac').hide();
	}else if(patient_response=='Discontinued Services'){
		$('#rfl').show();
		$('#apt').hide();
		$('#ac').show();
		
	}
});

$(document).on('click','.doActnForChat',function(){
		var that = $(this);
		var emp_id = that.attr('data-empid');
		var emp_name = that.attr('data-empname');
		$("#empName").html(emp_name);
		selecteduser = {id:emp_id,name:emp_name};
		console.log(selecteduser.name);
		$('.chatbox').empty();
		$('<div class="p-a-md"></div>').appendTo($('.chatbox'));
		 
		
});
function chatsubmit(){
	var msg = $('.chatmsg').val();
	sendmsg(msg);
	$('.chatmsg').val('');
}
$(document).on('click','.sentbutton',function(){
	chatsubmit();		
});

$(document).keypress(function(e) {
    if(e.which == 13) {
		chatsubmit();		

    }
});

