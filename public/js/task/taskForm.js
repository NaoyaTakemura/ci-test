$(function () {
	$("#datepicker").datetimepicker({
		format: 'Y-m-d G:i',
		lang: 'ja',
		value: dateStr
	});

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#company_id").change(function () {
		$.ajax({
			url: url,
			type: 'POST',
			data: {
				id: $("#company_id option:selected").val(),
			},
			dataType: 'json'
		})
			.done(function (data) {
				$("#project_id").empty();
				for (var i in data) {
					$("#project_id").append("<option value=\"" + data[i].id + "\">" + data[i].name + "</option>");
				}
			})
			.fail(function (data) {
				alert("データの取得に失敗しました。");
			});
	});
});

