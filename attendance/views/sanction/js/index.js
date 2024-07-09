$(function(){
	var table = $("#tblLists").DataTable({
		"ajax": window.siteurl + "sanction/tableLists",
		"order": [[ 0, "desc" ]],
		"columnDefs": [
			{
				"targets": [ 2 ],
				"sortable": false,
				"searchable": false
			}
		]
	});

	$("#frmAddSanction").on('submit', function(evt){
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
			$("#frmAddSanction").find('input').val('');
		},'json');

		return false;
	});

	$("#mainModal").on('submit', "#frmUpdateSanction", function(evt){
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