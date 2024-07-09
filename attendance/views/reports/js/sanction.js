$(function(){
	var table = $("#tblLists").DataTable({
		"ajax": window.siteurl + "reports/tableLists"
	});
});