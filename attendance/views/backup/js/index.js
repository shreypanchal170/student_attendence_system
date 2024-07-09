$(function(){
	var table = $(".table").DataTable({
		"order": [[ 0, "desc" ]],
		"columnDefs": [
			{
				"targets": [ 0 ],
				"sortable": false,
				"searchable": false,
				"width": "40%"
			},
			{
				"targets": [ 1 ],
				"width": "25%"
			},
			{
				"targets": [ 2 ],
				"width": "35%"
			}
		]
	});
});