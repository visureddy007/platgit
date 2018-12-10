

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.0/socket.io.js"></script>
<!-- core -->
  <script src="<?=base_url('assets')?>/libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
  <script src="<?=base_url('assets')?>/libs/PACE/pace.min.js"></script>
  <!--script src="<?=base_url('assets')?>/libs/jquery-pjax/jquery.pjax.js"></script-->
  <script src="<?=base_url('assets')?>/libs/blockUI/jquery.blockUI.js"></script>
  <script src="<?=base_url('assets')?>/libs/jscroll/jquery.jscroll.min.js"></script>
<!---- Datatables Libs---->
  <script src="<?=base_url('assets')?>/libs/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url('assets')?>/libs/datatables/media/js/dataTables.bootstrap4.min.js"></script>
        <?php $this->load->view('datatbl_scripts'); ?>
<!---- Datatables Ends Here--->  
  <script src="<?=base_url('assets')?>/scripts/config.lazyload.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-load.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-jp.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-include.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-device.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-form.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-modal.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-nav.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-list.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-screenfull.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-scroll-to.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-toggle-class.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ui-taburl.js"></script>
  <script src="<?=base_url('assets')?>/scripts/app.js"></script>
  <script src="<?=base_url('assets')?>/scripts/ajax.js"></script>
  <script src="<?= base_url('assets') ?>/scripts/tinymce/tinymce.min.js" type="text/javascript"></script>
  <script src="<?= base_url('assets') ?>/scripts/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
  <!----- chosen jquery----------->
  <script src="<?=base_url('assets')?>/scripts/chosen.jquery.js"></script> 
  <script src="<?=base_url('assets')?>/scripts/prism.js"></script> 
  <!--- chosen jquery ends here---->
  <script src="http://malsup.github.com/jquery.form.js"></script>
  <script src="<?=base_url('assets')?>/scripts/comns.js" type="text/javascript"></script>
  <script src="<?=base_url('assets')?>/scripts/scripts.js" type="text/javascript"></script>
  <script src="<?=base_url('assets')?>/scripts/bootstrap-timepicker.min.js"></script>
  <script src="<?=base_url('assets')?>/scripts/bootstrap-datetimepicker.js"></script>
  <script src="<?=base_url('assets')?>/scripts/datatbl-inits.js"></script>
  <script src="<?=base_url('assets')?>/scripts/jquery.steps.js"></script>
  
	<script>
	var form = $("#example-form");
		form.validate({
			errorPlacement: function errorPlacement(error, element) { element.before(error); },
			rules: {
				confirm: {
					equalTo: "#password"
				}
			}
		});
		form.children("div").steps({
			headerTag: "h3",
			bodyTag: "section",
			transitionEffect: "slideLeft",
			onStepChanging: function (event, currentIndex, newIndex)
			{
				form.validate().settings.ignore = ":disabled,:hidden";
				return form.valid();
			},
			onFinishing: function (event, currentIndex)
			{
				form.validate().settings.ignore = ":disabled";
				return form.valid();
			},
			onFinished: function (event, currentIndex)
			{
				 $.ajax({
                type: "POST",
				url:site_url+'/doctor/modify_spec',
                data: $('#example-form').serialize(),
                dataType: 'json',
                cache: false,
                success: function(j) {
					//var j=JSON.parse(response);
					$("#fmsg").html(j.msg);
					if(j.status){
						$("#fmsg").html(j.msg);
						window.location=site_url+'/doctor/schespec/'+j.doc_id;							
					}else {
						
					}
                },
				
				
            }); 
			}
		});
		var close = document.getElementsByClassName("closebtn");
		var i;

		for (i = 0; i < close.length; i++) {
			close[i].onclick = function(){
				var div = this.parentElement;
				div.style.opacity = "0";
				setTimeout(function(){ div.style.display = "none"; }, 600);
			}
		}
		</script>
	<script type="text/javascript">
		var config = {
		  '.chosen-select'           : {},
		  '.chosen-select-deselect'  : {allow_single_deselect:true},
		  '.chosen-select-no-single' : {disable_search_threshold:10},
		  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		  '.chosen-select-width'     : {width:"95%"}
		}
		for (var selector in config) {
		  $(selector).chosen(config[selector]);
		}
	</script>
<!-- endbuild -->
</body>
</html>
