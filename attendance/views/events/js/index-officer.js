$(function(){
	var table = $("#tblLists").DataTable({
		"ajax": window.siteurl + "events/officersTableLists",
		"order": [[ 0, "desc" ]]
	});
});