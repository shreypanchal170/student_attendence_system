$(function(){
	var table = $(".table").DataTable({
		"order": [[ 0, "desc" ]],
		"columnDefs": [
			{
				"targets": [ 0 ],
				"sortable": false,
				"searchable": false,
				"visible": false
			},
			{
				"targets": [ 1 ],
				"width": "40%"
			},
			{
				"targets": [ 2 ],
				"width": "35%"
			},
			{
				"targets": [ 3 ],
				"width": "25%"
			}
		]
	});
});