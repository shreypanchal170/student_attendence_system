$(function(){
	var table = $("#tblLists").DataTable({
		"ajax": window.siteurl + "officers/tableLists",
		"order": [[ 0, "desc" ]],
		"columnDefs": [
			{
				"targets": [ 3 ],
				"width": "10%",
				"sortable": false,
				"searchable": false
			}
		]
	});
});