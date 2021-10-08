<div class="about-inner-wrapper">
    <div class="container">
        <div class="row">
             <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="brudcrum-wrapper"><?php echo $this->breadcrumbs->show(); ?></div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 printbtn-wrapper">
                <button type="button" class="btn btn-warning btn-print" onclick="$('#ele1').print();">
     <span class="fa fa-print"></span> Print</button>
            </div>
        </div>
        <div class="row">

            <div class="col-md-9 no-padding" id="ele1">
                <div class="aboutus-midinner-wrapper">
                   
                    <h2><?php echo $this->lang->line('events_activity'); ?></h2>
					
                   <div id="calendar"></div><!--End calendar--> 

                </div>
            </div>
			<div id="eventContent" title="Event Details" style="display:none;">
				Start: <span id="startTime"></span><br>
				End: <span id="endTime"></span><br><br>
				<p id="eventInfo"></p>
				<p><strong><a id="eventLink" href="javascript:void(0);" target="_blank">Read More</a></strong></p>
			</div>
            <div class="col-md-3 no-padding">

                <?php echo getWhatsNew(); ?>

                <?php echo EmergencyContact(); ?>

            </div>

        </div> 
    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#calendar').fullCalendar({
		header: {
		  left: 'prev,next today',
		  center: 'title',
		  right: 'month,agendaWeek,agendaDay'
		},
		eventLimit: true, // allow "more" link when too many events
		navLinks: true,
		defaultDate:'<?php echo date("Y-m-d"); ?>',
		locale: jQuery('.switchLang').attr('hreflang'),
		eventSources: [
         {
             events: function(start, end, timezone, callback) {
                 $.ajax({
                 type: 'POST',
                 url: '<?php echo base_url("Events/get_events") ?>',
                 dataType: 'json',
                 data: {
                 // our hypothetical feed requires UNIX timestamps
                 start: start.unix(),
                 end: end.unix()
                 },
                 success: function(msg) {
                     var events = msg.events;
                     callback(events);
                 }
                 });
             }//end events
             
         }//end eventSources
     ],
    eventRender: function (event, element) {
        element.attr('href', 'javascript:void(0);');
        element.click(function() {
            $("#startTime").html(moment(event.start).format('DD/MM/YYYY h:mm A'));
            $("#endTime").html(moment(event.end).format('DD/MM/YYYY h:mm A'));
            $("#eventInfo").html(event.description);
            $("#eventLink").attr('href', event.url);
            $("#eventContent").dialog({ modal: true, title: event.title, width:450});
        });
    },
    loading: function (bool) {
        $('#ajaxloading').modal('show'); // Add your script to show loading
    },
    eventAfterAllRender: function (view) {
        $('#ajaxloading').modal('hide'); // remove your loading 
    }
    });
});
</script>