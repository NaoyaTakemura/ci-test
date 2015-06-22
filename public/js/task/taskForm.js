$(function () {
	$("#datepickerS").datetimepicker({
		format: 'Y-m-d G:i',
		lang: 'ja',
		value: dateStrS
	});

	$("#datepickerE").datetimepicker({
		format: 'Y-m-d G:i',
		lang: 'ja',
		value: dateStrE
	});

	if((dateStrS == '' && dateStrE == '') || $("#datepickerS").val() == '' || $("#datepickerE").val() == '' ){
		$("#dateUnfixed").attr("checked", "checked");
	}

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$("#company_id").change(function () {
		$.ajax({
			url: pUrl,
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
	
	$("#holder_company_id").change(function () {
		$.ajax({
			url: hUrl,
			type: 'POST',
			data: {
				id: $("#holder_company_id option:selected").val(),
			},
			dataType: 'json'
		})
			.done(function (data) {
				$("#holder_id").empty();
				for (var i in data) {
					$("#holder_id").append("<option value=\"" + data[i].id + "\">" + data[i].name + "</option>");
				}
			})
			.fail(function (data) {
				alert("データの取得に失敗しました。");
			});
	});
});

