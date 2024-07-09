$(function(){
	$("#frmUpdateOfficer").on('submit', function(evt){
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
			$("#generalModal").find("#imageCapture").addClass("hidden");
			$("#generalModal").find("#imageSnapshotPreview").removeClass("hidden");
			$("#generalModal").find("#imageSnapshotPreview").html('<img src="'+data_uri+'"/>');
			$("#generalModal").find("#captureSnapshot").addClass("hidden");
			$("#generalModal").find("#retrySnapshot").removeClass("hidden");
			$("#generalModal").find("#okSnapshot").removeClass("hidden");
		} );
	}

	var shutter = new Audio();
	shutter.autoplay = false;
	shutter.src = navigator.userAgent.match(/Firefox/) ? window.siteurl + 'public/assets/webcamjs/shutter.ogg' : window.siteurl + 'public/assets/webcamjs/shutter.mp3';

	$("#btnCapture").on("click", function(){
		$("#generalModal").modal('show');
		$("#generalModal .modal-body").html('<div id="imageCapture"></div><div id="imageSnapshotPreview" class="hidden"></div>');
		$("#generalModal .modal-content").prepend('<div class="modal-header"><h4 class="modal-title">Snapshot</h4></div>');
		$("#generalModal .modal-content").append('<div class="modal-footer" style="text-align:center;"><button id="captureSnapshot" class="btn btn-info">Capture</button><button id="retrySnapshot" class="btn btn-info hidden">Retry</button><button id="okSnapshot" class="btn btn-info hidden">OK</button></div>');

		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 100,
			flip_horiz: true
		});

		Webcam.attach( '#imageCapture' );
	});

	$("#generalModal").on("click", "#captureSnapshot", function(evt){
		takeSnapshot();
	});

	$("#generalModal").on("click", "#retrySnapshot", function(evt){
		$("#generalModal").find("#imageCapture").removeClass("hidden");
		$("#generalModal").find("#imageSnapshotPreview").addClass("hidden");
		$("#generalModal").find("#captureSnapshot").removeClass("hidden");
		$("#generalModal").find("#retrySnapshot").addClass("hidden");
		$("#generalModal").find("#okSnapshot").addClass("hidden");
	});

	$("#generalModal").on("click", "#okSnapshot", function(evt){
		$("#frmUpdateOfficer").find('input[name="image"]').val($("#generalModal").find("#imageSnapshotPreview img").attr("src"));
		$("#frmUpdateOfficer").find('.imagePreview img').remove();
		$("#frmUpdateOfficer").find('.imagePreview').removeClass('hidden');
		$("#frmUpdateOfficer").find('.imagePreview').append("<img style='margin: 0 auto;' class='img-responsive img-bordered' src='"+$("#generalModal").find("#imageSnapshotPreview img").attr("src")+"' />");
		
		$("#generalModal").modal('hide');
	});

	$("#generalModal").on("hidden.bs.modal", function(evt){
		$("#generalModal").find('.modal-body').html('');
		$("#generalModal").find('.modal-header').remove();
		$("#generalModal").find('.modal-footer').remove();
		Webcam.reset();
	});

	function loadImage(input)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();

			reader.onload = function(e)
			{
				$("#frmUpdateOfficer").find('.imagePreview img').remove();
				$("#frmUpdateOfficer").find('.imagePreview').removeClass('hidden');
				$("#frmUpdateOfficer").find('.imagePreview').append("<img style='margin: 0 auto;' class='img-responsive img-bordered' src='"+e.target.result+"' />");
				$("#frmUpdateOfficer").find('input[name="image"]').val(e.target.result);
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