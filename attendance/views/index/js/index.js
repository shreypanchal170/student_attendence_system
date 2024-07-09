$(function(){

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {
			today: 'today',
			month: 'month',
			week: 'week',
			day: 'day'
		},
		eventSources: [
			{
				url: window.siteurl + 'index/loadEventsJSON',
				type: 'GET',
				error: function(){
					$(".overlay").addClass('hidden');
					$("#calendar").html('<p class="alert alert-danger no-margin">Sorry! There was an error in loading the data. Kindly reload the page.</p>').parent().removeClass('no-padding');
				},
				success: function(){
					$(".overlay").addClass('hidden');
				}
			}
		]
    });
});