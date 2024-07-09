$(function(){
	$("#updateProfile").on('click',function(evt){
		evt.preventDefault();
		$("#mainModal").modal('show');
		var returnUrl = window.location.href;
		$.post(window.siteurl+'index/manageProfile',{"returnUrl": returnUrl}).done(function(htmlData){
			$("#mainModal").find('.modal-content').html(htmlData);
		});
	});

	$("body").on("click", ".modalMode", function(evt){
		evt.preventDefault();
		var _this = $(this);

		$("#mainModal").modal({ backdrop: 'static', keyboard: false });

		$.post(_this.attr('href'), function(htmlData){
			$("#mainModal").html(htmlData);
		}).fail(function(response){
			swal({
			  title: "Error",
			  text: "There is an issue loading the given url",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes",
			  cancelButtonText: "Cancel",
			  closeOnConfirm: true
			});
		});
	});

	$("#mainModal").on("click", ".processModalMode", function(evt){
		evt.preventDefault();
		var _this = $(this);

		$("#processModal").modal({ backdrop: 'static', keyboard: false });

		$.post(_this.attr('href'), function(htmlData){
			$("#processModal").html(htmlData);
		}).fail(function(response){
			swal({
			  title: "Error",
			  text: "There is an issue loading the given url",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes",
			  cancelButtonText: "Cancel",
			  closeOnConfirm: true
			});
		});
	});

	$(".content").on("click", ".btnDelete", function(evt){
		evt.preventDefault();
		var _this = $(this);

		swal({
		  title: "Warning",
		  text: "Are you sure you want to perform delete?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes",
		  cancelButtonText: "Cancel",
		  closeOnConfirm: false
		},
		function(){
			$.get(_this.attr('href'), function(response){
				swal({
				  title: "Success",
				  text: "Item Deleted",
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes",
				  cancelButtonText: "Cancel",
				  closeOnConfirm: true
				},
				function(){
					window.location.reload();
				});
			},'json').fail(function(response){
				swal({
				  title: "Error",
				  text: "There is an issue loading the given url",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes",
				  cancelButtonText: "Cancel",
				  closeOnConfirm: true
				});
			});
		});
	});
	
	$("#mainModal").on("hidden.bs.modal", function(){
		window.file = null;
		$("#mainModal").html('<div class="modal-dialog"><div class="modal-content"><div class="modal-body"><p class="text-center no-margin"><i class="fa fa-refresh fa-spin"></i></p></div></div></div>');
	});

	$("#mainModal").on('change', '#userImage', function(){
		if($(this).val() != "")
		{
			parseFileData(this);
		}
	});

	function parseFileData(input)
	{
		if (input.files && input.files[0])
		{
			var reader = new FileReader();

			reader.onload = function (e)
			{
				window.file = input.files[0];
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#mainModal").on('submit', '#updateUserProfile', function(evt){
		evt.preventDefault();
		var _this = $(this);

		var formData = new FormData(_this[0]);
    
	    if(window.file != undefined)
	    {
	    	formData.append("image", window.file);
	    }

	    $.ajax({
	      url: _this.attr('action'),
	      type: 'POST',
	      dataType: 'json',
	      data: formData,
	      success: function(response){
	        if(response.result == 1)
			{
				swal({
				  title: "Success",
				  text: "User successfully updated!",
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK",
				  cancelButtonText: "Cancel",
				  closeOnConfirm: true
				},
		        function(){
		             window.location.reload();
		        });
			}
			else
			{
				swal({
				  title: "Error",
				  text: response.reason,
				  type: "error",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK",
				  cancelButtonText: "Cancel",
				  closeOnConfirm: true
				},
		        function(){
		            
		        });
			}
	      },
	      error: function(response){
		      	swal({
				  title: "Error",
				  text: response.reason,
				  type: "error",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK",
				  cancelButtonText: "Cancel",
				  closeOnConfirm: true
				},
		        function(){
		            
		        });
	      },
	      statusCode: {
	            500: function() {
	              swal("Error", "There was an error! Sorry please retry the process", "error");
	            }
	        },
	      async: true,
	      cache: false,
	      contentType: false,
	      processData: false
	    });
	});

	$("body").on("click", ".btnRestore", function(evt){
		evt.preventDefault();
		var _this = $(this);

		swal({
		  title: "Warning",
		  text: "Are you sure you want to perform this action?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes",
		  cancelButtonText: "No",
		  closeOnConfirm: true
		}, function(){
			$("#mainModal").modal({ backdrop: 'static', keyboard: false });

			$.post(_this.attr('href'), function(response){
				$("#mainModal").modal('hide');
				if(response.result == 1)
				{
					swal({
					  title: "Success",
					  text: response.reason,
					  type: "success",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "OK",
					  closeOnConfirm: true
					}, function(){
						window.location.reload();
					});
				}
				else
				{
					swal({
					  title: "Error",
					  text: response.reason,
					  type: "error",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "OK",
					  closeOnConfirm: true
					});
				}
			},'json').fail(function(response){

				$("#mainModal").modal('hide');

				swal({
				  title: "Error",
				  text: "There is an issue loading the given url",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes",
				  cancelButtonText: "Cancel",
				  closeOnConfirm: true
				});
			});
		});
	});
});