$(function(){
	$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    var $radio = $('input[name="print-status"]').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    }).on('ifChanged', function(event){
    	if(event.target.value != "all")
    	{
    		if($("#selectEvent").find('option:selected').data('status') == "wholeday")
    		{
    			$("#printSession").removeClass('hidden');
    		}
    	}
    	else
    	{
    		$("#printSession").addClass('hidden');
    	}
    });

    $("#selectSchoolYear").on('change', function(){
    	$("#selectEvent").html('');
    	$("#selectEvent").prop('disabled', true);
    	var _this = $(this);
    	$.post(window.siteurl+'reports/loadEventsBySchoolYear', {"schoolyear": _this.val()}, function(response){
    		if(response.length == 0)
    		{
    			return;
    		}

    		$("#selectEvent").prop('disabled', false);

    		$.each(response, function(index, item){
    			$("#selectEvent").append('<option value="'+item.id+'">'+item.name+'</option>');
    		});    		
    	},'json');
    });
    
	$("#selectReportType").on('change', function(){
		var _this = $(this);

		$("#selectCourse").parent().addClass('hidden');
		$("#selectYear").parent().addClass('hidden');
		$("#selectDepartment").parent().addClass('hidden');
		$("#selectEvent").parent().addClass('hidden');
		$("#selectSection").parent().addClass('hidden');
		$("#printStatus").addClass('hidden');

		if(_this.val() == "print-student-attendance")
		{
			$("#selectDepartment").parent().removeClass('hidden');
			$("#selectCourse").parent().removeClass('hidden');
			$("#selectYear").parent().removeClass('hidden');
			$("#selectSection").parent().removeClass('hidden');
			$("#selectDepartment").change();
		}

		if(_this.val() == "print-event-attendance")
		{
			$("#selectEvent").parent().removeClass('hidden');
			$("#selectDepartment").parent().removeClass('hidden');
			$("#selectCourse").parent().removeClass('hidden');
			$("#selectYear").parent().removeClass('hidden');
			$("#selectSection").parent().removeClass('hidden');
			$("#printStatus").removeClass('hidden');
			$("#selectDepartment").change();
		}

		if(_this.val() == "print-student-barcode")
		{
			$("#frmPrintReport").find("button").prop("disabled", false);
			return;
		}

		$("#frmPrintReport").find("button").prop("disabled", true);
	});

	$("#selectDepartment").on('change', function(){
		var _this = $(this);

		$("#selectCourse").find('option').addClass('hidden');
		$("#selectCourse").find('option[data-departmentid="'+_this.val()+'"]').removeClass('hidden');
		$("#selectCourse").val($("#selectCourse").find('option[data-departmentid="'+_this.val()+'"]:first').val());

		$("#selectCourse").change();
	});

	$("#selectEvent").on('change', function(){
		var _this = $(this);

		$("#printSession").addClass('hidden');

		if($("input[name='print-status']:checked").val() != "all")
    	{
    		if($("#selectEvent").find('option:selected').data('status') == "wholeday")
    		{
    			$("#printSession").removeClass('hidden');
    		}
    	}
	});

	$("#selectCourse").on('change', function(){
		loadSection();
	});

	$("#selectYear").on('change', function(){
		loadSection();
	});

	function loadSection(courseId)
	{
		$("#selectSection").prop("disabled", true);
		$("#selectSection").html('');

		$.get(window.siteurl + 'reports/getCourseYearSection/' + $("#selectCourse").val() + "/" + $("#selectYear").val() + "/" + $("#selectSchoolYear").val(), function(response){
			if(response.results != null && response.results.length > 0)
			{
				$("#selectSection").prop("disabled", false);

				$.each(response.results, function(index, item){
					$("#selectSection").append('<option value="'+item+'">'+item+'</option>');
				});

				$("#frmPrintReport").find("button").prop("disabled", false);
				return;
			}

			$("#frmPrintReport").find("button").prop("disabled", true);
		},'json');
	}
});