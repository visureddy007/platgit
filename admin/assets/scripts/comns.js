/*var site_url = window.location.protocol+'://'+window.location.hostname;*/
var site_url = window.location.origin+'/platgit/admin';
console.log(site_url);
function goTop(){
	 $('body, html').animate({scrollTop: $("#app").offset().top	});
}
function ajxReq(url,data,type,dataType){
	return $.ajax({
		url:url,
		data:data,
		type:type,
		dataType:dataType,
		success:function(res){
			debugger;
			return res;
		}
	});	
}
function ajxReqs(url,data,dataType,type){
	return $.ajax({
		url:url,
		data:data,
		dataType:dataType,
		type:type,
		success:function(res){
			return res;
		}
	});
}
function days(){
var days='<option value="">Select Day</option><option value="mon">Monday</option><option value="tue">Tuesday</option><option value="wed">Wednesday</option><option value="thu">Thursday</option><option value="fri">Friday</option><option value="sat">Saturday</option><option value="sun">Sunday</option>';
return days;
}
var dayoptions = days();