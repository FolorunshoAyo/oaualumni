



function CreateSeoUrl(fieldName) {
	fieldName = fieldName.toLowerCase(); // lowercase
	fieldName = fieldName.replace(/^\s+|\s+$/g, ''); // remove leading and trailing whitespaces
	fieldName = fieldName.replace(/\s+/g, '-'); // convert (continuous) whitespaces to one -
	fieldName = fieldName.replace(/[^a-z-]/g, ''); // remove everything that is not [a-z] or -
	return fieldName;
}
$('#b_name').blur(function() {
	if ($('#b_url').val() == '') {
		$('#b_url').val(CreateSeoUrl($(this).val()));
	}

});
$('.edturl').click(function () {
	$('#b_url').removeAttr('readonly');
});
$('#b_url').blur(function() {
	$(this).attr('readonly','readonly');
	$('#b_url').val(CreateSeoUrl($(this).val()));
});

$(function () {
	$('.showProf').click(function () {
		var imgSrouce = $(this).data('text');
		var title = "Deposit Prof";
		var footer = "";
		var body = "";
		footer+='<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		body+='<div class="row">';
			body+='<div class="col-md-12">';
				body+='<img src="'+imgSrouce+'" class="img-fluid img-responsive">';
			body+='</div>';
		body+='</div>';
		$('#thmBody').addClass('eiip');
		$('#thmtitle').html(title);
		$('#thmfooter').html(footer);
		$('#thmBody').html(body);
		$('#thmModl').modal('show');
	})
});


$(function () {
	$('.prProf').click(function () {
		var iwthId = $(this).data('id');
		var title = "Perfect Money Prof";
		var footer = "";
		var body = "";
		footer+='<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
		body+='<div class="row">';
		body+='<div class="col-md-12">';
			body+='<form action="'+surl+'admin/prprof" method="post" enctype="multipart/form-data">';
				body+='<input type="file" name="image">';
				body+='<input type="hidden" name="withId" value="'+iwthId+'">';
				body+='<button class="btn btn-primary" type="submit">upload Now</button>';
			body+='</form>';
		body+='</div>';
		body+='</div>';
		$('#thmBody').addClass('eiip');
		$('#thmtitle').html(title);
		$('#thmfooter').html(footer);
		$('#thmBody').html(body);
		$('#thmModl').modal('show');
	})
});


function printdiv(printdivname) {
	var headstr = "<html><head><title>Booking Details</title></head><body>";
	var footstr = "</body>";
	var newstr = document.getElementById(printdivname).innerHTML;
	var oldstr = document.body.innerHTML;
	document.body.innerHTML = headstr+newstr+footstr;
	window.print();
	document.body.innerHTML = oldstr;
	return false;
}

$(function() {
	$("#exportasCSV").on('click', function() {
		var data = "";
		var tableData = [];
		var rows = $("table tr");
		rows.each(function(index, row) {
			var rowData = [];
			$(row).find("th, td").each(function(index, column) {
				rowData.push(column.innerText);
			});
			tableData.push(rowData.join(","));
		});
		data += tableData.join("\n");
		$(document.body).append('<a id="download-link" download="data.csv" href=' + URL.createObjectURL(new Blob([data], {
			type: "text/csv"
		})) + '/>');


		$('#download-link')[0].click();
		$('#download-link').remove();
	});
});


