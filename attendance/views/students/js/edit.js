$(function(){
	$("#frmUpdateStudent").on('change', 'select[name="departmentid"]', function(evt){
		var _this = $(this);

		$("#frmUpdateStudent").find('select[name="courseid"]').find('option').addClass('hidden');
		$("#frmUpdateStudent").find('select[name="courseid"]').find('option[value=""]').removeClass('hidden');
		$("#frmUpdateStudent").find('select[name="courseid"]').find('option[data-departmentid="'+_this.val()+'"]').removeClass('hidden');

		$("#frmUpdateStudent").find('select[name="courseid"]').val($("#frmUpdateStudent").find('select[name="courseid"]').find('option[value=""]').val());
	});
	
	$("#frmUpdateStudent").on('submit', function(evt){
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

	function takeSnapshot()
	{
		shutter.play();
		Webcam.snap( function(data_uri) {
			$("#mainModal").find("#imageCapture").addClass("hidden");
			$("#mainModal").find("#imageSnapshotPreview").removeClass("hidden");
			$("#mainModal").find("#imageSnapshotPreview").html('<img src="'+data_uri+'"/>');
			$("#mainModal").find("#captureSnapshot").addClass("hidden");
			$("#mainModal").find("#retrySnapshot").removeClass("hidden");
			$("#mainModal").find("#okSnapshot").removeClass("hidden");
		} );
	}

	var shutter = new Audio();
	shutter.autoplay = false;
	shutter.src = navigator.userAgent.match(/Firefox/) ? window.siteurl + 'public/assets/webcamjs/shutter.ogg' : window.siteurl + 'public/assets/webcamjs/shutter.mp3';

	$("#btnCapture").on("click", function(){
		$("#mainModal").modal('show');
		$("#mainModal .modal-body").html('<div id="imageCapture"></div><div id="imageSnapshotPreview" class="hidden"></div>');
		$("#mainModal .modal-content").prepend('<div class="modal-header"><h4 class="modal-title">Snapshot</h4></div>');
		$("#mainModal .modal-content").append('<div class="modal-footer" style="text-align:center;"><button id="captureSnapshot" class="btn btn-info">Capture</button><button id="retrySnapshot" class="btn btn-info hidden">Retry</button><button id="okSnapshot" class="btn btn-info hidden">OK</button></div>');

		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 100,
			flip_horiz: true
		});

		Webcam.attach( '#imageCapture' );
	});

	$("#mainModal").on("click", "#captureSnapshot", function(evt){
		takeSnapshot();
	});

	$("#mainModal").on("click", "#retrySnapshot", function(evt){
		$("#mainModal").find("#imageCapture").removeClass("hidden");
		$("#mainModal").find("#imageSnapshotPreview").addClass("hidden");
		$("#mainModal").find("#captureSnapshot").removeClass("hidden");
		$("#mainModal").find("#retrySnapshot").addClass("hidden");
		$("#mainModal").find("#okSnapshot").addClass("hidden");
	});

	$("#mainModal").on("click", "#okSnapshot", function(evt){
		$("#frmUpdateStudent").find('input[name="image"]').val($("#mainModal").find("#imageSnapshotPreview img").attr("src"));
		$("#frmUpdateStudent").find('.imagePreview img').remove();
		$("#frmUpdateStudent").find('.currentImagePreview').addClass('hidden');
		$("#frmUpdateStudent").find('.imagePreview').removeClass('hidden');
		$("#frmUpdateStudent").find('.imagePreview').append("<img style='margin: 0 auto;' class='img-responsive img-bordered' src='"+$("#mainModal").find("#imageSnapshotPreview img").attr("src")+"' />");
		
		$("#mainModal").modal('hide');
	});

	$("#mainModal").on("hidden.bs.modal", function(evt){
		$("#mainModal").find('.modal-body').html('');
		$("#mainModal").find('.modal-header').remove();
		$("#mainModal").find('.modal-footer').remove();
		Webcam.reset();
	});

	function loadImage(input)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();

			reader.onload = function(e)
			{
				$("#frmUpdateStudent").find('.imagePreview img').remove();
				$("#frmUpdateStudent").find('.currentImagePreview').addClass('hidden');
				$("#frmUpdateStudent").find('.imagePreview').removeClass('hidden');
				$("#frmUpdateStudent").find('.imagePreview').append("<img style='margin: 0 auto;' class='img-responsive img-bordered' src='"+e.target.result+"' />");
				$("#frmUpdateStudent").find('input[name="image"]').val(e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#selectFile").on('change', function(){
		if($(this).val() != "")
		{
			loadImage(this);
		}
	});
});