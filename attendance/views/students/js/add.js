$(function(){
	$("#frmAddStudent").on('change', 'select[name="departmentid"]', function(evt){
		var _this = $(this);

		$("#frmAddStudent").find('select[name="courseid"]').find('option').addClass('hidden');
		$("#frmAddStudent").find('select[name="courseid"]').find('option[value=""]').removeClass('hidden');
		$("#frmAddStudent").find('select[name="courseid"]').find('option[data-departmentid="'+_this.val()+'"]').removeClass('hidden');

		$("#frmAddStudent").find('select[name="courseid"]').val($("#frmAddStudent").find('select[name="courseid"]').find('option[value=""]').val());
	});

	$("#frmAddStudent").on('submit', function(evt){
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
	          text: "Student successfully added",
	          type: "success",
	          showCancelButton: false,
	          confirmButtonColor: "#00a65a",
	          confirmButtonText: "OK",
	          closeOnConfirm: true
	        },
	        function(){
				$("#frmAddStudent").find('input').val('');
				$("#frmAddStudent").find('select').val('');
				$("#frmAddStudent").find('.imagePreview img').remove();
				$("#frmAddStudent").find('.imagePreview').removeClass('hidden');
	        });
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
		$("#frmAddStudent").find('input[name="image"]').val($("#mainModal").find("#imageSnapshotPreview img").attr("src"));
		$("#frmAddStudent").find('.imagePreview img').remove();
		$("#frmAddStudent").find('.imagePreview').removeClass('hidden');
		$("#frmAddStudent").find('.imagePreview').append("<img style='margin: 0 auto;' class='img-responsive img-bordered' src='"+$("#mainModal").find("#imageSnapshotPreview img").attr("src")+"' />");
		
		$("#mainModal").modal('hide');
	});

	$("#mainModal").on("hidden.bs.modal", function(evt){
		$("#mainModal").find('.modal-body').html('');
		$("#mainModal").find('.modal-header').remove();
		$("#mainModal").find('.modal-footer').remove();
		Webcam.reset();
	});

	$("#frmImportStudent").on("submit", function(evt){
		evt.preventDefault();
		var _this = $(this);

		$(".overlay").removeClass('hidden');

		var formData = new FormData();
		var fileData = _this.find('input[type="file"]').prop('files')[0];
		formData.append("csv",fileData);

		$.ajax({
			url: _this.attr('action'),
			type: 'post',
			data: formData,
			dataType: 'json',
			success: function(response){
				$(".overlay").addClass('hidden');

				if(response.result == 1)
				{
					var msgStr = "Student(s) successfully imported.";
					var title = "Success";
					var type = "success";
					var btnColor = "#00a65a";
					if(response.errors > 0)
					{
						if(response.errors == response.total)
						{
							title = "Error";
							type = "error";
							msgStr = "It seems all items in the list are not imported properly.";
							btnColor = "#DD6B55";
						}
						else
						{
							msgStr = "Student(s) successfully imported but there are " + response.errors + " items not imported out of " + response.total + " items.";
						}
					}

					swal({
			          title: title,
			          text: msgStr,
			          type: type,
			          showCancelButton: false,
			          confirmButtonColor: btnColor,
			          confirmButtonText: "OK",
			          closeOnConfirm: true
			        },
			        function(){
			            
			        });

					$("#frmImportStudent").find('input').val('');
				}

				if(response.result == 0)
				{
					swal({
			          title: "Error",
			          text: "Invalid File Type",
			          type: "error",
			          showCancelButton: false,
			          confirmButtonColor: "#DD6B55",
			          confirmButtonText: "OK",
			          closeOnConfirm: true
			        },
			        function(){
			            
			        });
				}

				if(response.result == -1)
				{
					swal({
			          title: "Error",
			          text: "File Error",
			          type: "error",
			          showCancelButton: false,
			          confirmButtonColor: "#DD6B55",
			          confirmButtonText: "OK",
			          closeOnConfirm: true
			        },
			        function(){
			            
			        });
				}
			},
			async: true,
			cache: false,
			contentType: false,
			processData: false
		}).done(function(response){
			console.log("done");
			console.log(response);
		}).fail(function(response){
			console.log("fail");
			console.log(response);
		});

		return false;
	});

	function loadImage(input)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();

			reader.onload = function(e)
			{
				$("#frmAddStudent").find('.imagePreview img').remove();
				$("#frmAddStudent").find('.imagePreview').removeClass('hidden');
				$("#frmAddStudent").find('.imagePreview').append("<img style='margin: 0 auto;' class='img-responsive img-bordered' src='"+e.target.result+"' />");
				$("#frmAddStudent").find('input[name="image"]').val(e.target.result);
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