<div class="app-body">
  <!--<script src="<?=base_url('assets')?>/scripts/fullcalendar.js"></script>-->
  <!---->

<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script>
<script src="http://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script>
<script src='http://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script>
<script>
$(document).ready(function() {
	
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		var calendar = $('#calendar').fullCalendar({
			 header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listWeek'
		  },
			selectable: true,
			selectHelper: true,
			
				eventRender: function(event, element){
				  element.popover({
					  animation:true,
					  delay: 300,
					  content: 'Time:'+event.time,
					  trigger: 'hover'
				  });
				},
				/*eventDragStart: function( event, jsEvent, ui, view ){
					 $.ajax({
						type: "POST",
						url:site_url+'/calender/updateDate',
						data: "&id=" + event.id,
						 success: function(json) {
							 $('#calendar').fullCalendar('removeEvents', event.id);
							  alert("Updated successfully");}
					});
					//alert();
				 
				},*/
				eventDrop: function(event, delta, revertFunc) {

					//alert(event.title + " was dropped on " + event.start.format());

					if (confirm("Are you sure about this change?")) {
						 $.ajax({
							type: "POST",
							url:site_url+'/calender/updateDate',
							data: "&cl_id=" + event.cl_id+"&start_date="+event.start.format("YYYY-MM-DD"),
							 success: function(json) {
								// $('#calendar').fullCalendar('removeEvents', event.id);
								  //alert("Updated successfully");
								  }
						});
					  /*revertFunc();*/
					}

				  },
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			editable: true,
			events: [
				<?php  foreach ($ev_bind as $k=>$v) { ?>
					{
					  title: '<?=$v['patient_response']?>',
					  time: '<?=$v['appt_time']?>',
					  start: '<?=$v['appt_date']?>T<?=$v['appt_time']?>',
					  cl_id: '<?=$v['cl_id']?>',
				   // end: '<?=$v['appt_date']?>'

					},
				<?php } ?>	
			]
		});
		
	});

</script>
  <script>

  /*document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
	
	

    var calendar = new FullCalendar.Calendar(calendarEl, {
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
	  	
	 
      defaultDate: '2018-12-01',
	
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
	 
      select: function(arg) {
        var title = prompt('Event Title:');
        if (title) {
          calendar.addEvent({
            title: title,
            start: arg.start,
            end: arg.end,
            allDay: arg.allDay
          })
        }
        calendar.unselect()
      },
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
	<?php  foreach ($ev_bind as $k=>$v) { ?>
        {
          title: '<?=$v['patient_response']?>',
          start: '<?=$v['appt_date']?>',
		  end: '<?=$v['appt_date']?>'

        },
		

	<?php } ?>	
      /*  {
          title: 'Long Event',
          start: '2018-10-07',
          end: '2018-10-10'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2018-10-09T16:00:00'
        },
        {
          groupId: 999,
          title: 'Repeating Event',
          start: '2018-10-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2018-10-11',
          end: '2018-10-13'
        },
        {
          title: 'Meeting',
          start: '2018-10-12T10:30:00',
          end: '2018-10-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2018-10-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2018-10-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2018-10-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2018-10-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2018-10-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2018-10-28'
        }
      ],
	  
    });

    calendar.render();
  });*/
  

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

</style>

<body>

  <div id='calendar'></div>

</body>