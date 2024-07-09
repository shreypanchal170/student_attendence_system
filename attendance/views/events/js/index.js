$(function(){
	var table = $("#tblLists").DataTable({
		"ajax": window.siteurl + "events/tableLists",
		"order": [[ 0, "desc" ]],
		"columnDefs": [
			{
				"targets": [ 6, 7 ],
				"sortable": false,
				"searchable": false
			},
			{
				"targets": [ 0 ],
				"sortable": false,
				"searchable": false,
				"visible": false
			}
		]
	});

    $("#mainModal").on('change', "#eventStatus", function(){
    	var _this = $(this);

    	$(".timeArea").addClass('hidden');

    	if(_this.val() != "wholeday")
    	{
    		$("#time"+_this.val()).removeClass('hidden');
    	}
    	else
    	{
    		$(".timeArea").removeClass('hidden');
    	}
    });

    $("#mainModal").on("change", "#eventStatusEdit", function(){
    	var _this = $(this);

    	$("#frmUpdateEvent").find(".timeArea").addClass('hidden');

    	if(_this.val() != "wholeday")
    	{
    		$("#editTime"+_this.val()).removeClass('hidden');
    	}
    	else
    	{
    		$("#frmUpdateEvent").find(".timeArea").removeClass('hidden');
    	}
    });

    $("#mainModal").on("shown.bs.modal", function(){
    	$('#eventDateEdit').daterangepicker({timePicker: false, locale: { format: 'YYYY-MM-DD' }});

    	$(".timepickerMorning").timepicker({
			timeFormat: 'hh:mm',
	    	showInputs: false
	    });

	    $(".timepickerAfternoon").timepicker({
	    	timeFormat: 'hh:mm',
	    	showInputs: false
	    });

	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass: 'iradio_minimal-blue'
	    });

	    $('#eventDate').daterangepicker({minDate: new Date(), timePicker: false, locale: { format: 'YYYY-MM-DD' }});
    });

    $("#mainModal").on("change", ".changeAssignedStatus", function(){
    	var _this = $(this);

    	if(_this.val() == "unassigned")
    	{
    		_this.parent().parent().find('.assignDayArea').addClass('hidden');
    		_this.parent().parent().find('input[type="checkbox"]').prop("checked", false);

    		_this.parent().parent().find('input[type="checkbox"].minimal, input[type="radio"].minimal').each(function(i,item){
				$(item).iCheck("destroy");
				$(item).prop('checked', false);
			});

			_this.parent().parent().find('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		      checkboxClass: 'icheckbox_minimal-blue',
		      radioClass: 'iradio_minimal-blue'
		    });

    		return;
    	}

    	_this.parent().parent().find('.assignDayArea').removeClass('hidden');
    });

	$("#mainModal").on('submit',"#frmAddEvent", function(evt){
		evt.preventDefault();

		var _this = $(this);

		$.post(_this.attr('action'), _this.serialize(), function(response){
			if(response.result != 1)
			{
				swal({
		          title: "Error",
		          text: response.reason,
		          type: "error",
		          showCancelButton: false,
		          confirmButtonColor: "#DD6B55",
		          confirmButtonText: "OK",
		          closeOnConfirm: true
		        },
		        function(){
		            
		        });

				return false;
			}

			swal({
	          title: "Success",
	          text: response.reason,
	          type: "success",
	          showCancelButton: false,
	          confirmButtonColor: "#00a65a",
	          confirmButtonText: "OK",
	          closeOnConfirm: true
	        },
	        function(){
				$.post(window.siteurl + 'events/editOfficers/' + response.eventId, function(htmlData){
					$("#mainModal").html(htmlData);
				})
	        });

			table.ajax.reload();
			table.columns.adjust().draw();

			/*$("#frmAddEvent").find('input[name="event_name"]').val('');
			$("#frmAddEvent").find('input[name="event_place"]').val('');
			$("#frmAddEvent").find('select[name="status"]').val("wholeday");
			$("#frmAddEvent").find('input[name="event_date"]').val($("#frmAddEvent").find('input[name="event_date"]').attr("defaultDate"));
			$("#frmAddEvent").find('input[name="event_starttime_am"]').val("07:00 AM");
			$("#frmAddEvent").find('input[name="event_endtime_am"]').val("11:00 AM");
			$("#frmAddEvent").find('input[name="event_starttime_pm"]').val("01:00 PM");
			$("#frmAddEvent").find('input[name="event_endtime_pm"]').val("04:00 PM");
			$("#frmAddEvent").find('timeArea').removeClass('hidden');*/
		},'json');

		return false;
	});

	$("#mainModal").on('submit', "#frmUpdateEvent", function(evt){
		evt.preventDefault();

		var _this = $(this);

		$.post(_this.attr('action'), _this.serialize(), function(response){
			if(response.result != 1)
			{
				swal({
		          title: "Error",
		          text: response.reason,
		          type: "error",
		          showCancelButton: false,
		          confirmButtonColor: "#DD6B55",
		          confirmButtonText: "OK",
		          closeOnConfirm: true
		        },
		        function(){
		            
		        });

				return false;
			}

			swal({
	          title: "Success",
	          text: response.reason,
	          type: "success",
	          showCancelButton: false,
	          confirmButtonColor: "#00a65a",
	          confirmButtonText: "OK",
	          closeOnConfirm: true
	        },
	        function(){
	            
	        });

			table.ajax.reload();
			table.columns.adjust().draw();
		},'json');

		return false;
	});

    $("#mainModal").on("submit", "#frmAssignOfficer", function(evt){
    	evt.preventDefault();

		var _this = $(this);

		$.post(_this.attr('action'), _this.serialize(), function(response){
			if(response.result != 1)
			{
				swal({
		          title: "Error",
		          text: response.reason,
		          type: "error",
		          showCancelButton: false,
		          confirmButtonColor: "#DD6B55",
		          confirmButtonText: "OK",
		          closeOnConfirm: true
		        },
		        function(){
		            
		        });

				return false;
			}

			swal({
	          title: "Success",
	          text: response.reason,
	          type: "success",
	          showCancelButton: false,
	          confirmButtonColor: "#00a65a",
	          confirmButtonText: "OK",
	          closeOnConfirm: true
	        },
	        function(){
	            
	        });

			table.ajax.reload();
			table.columns.adjust().draw();
		},'json');

		return false;
    });
});