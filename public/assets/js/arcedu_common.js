function selectTime(td){
	if($(td).hasClass("t_time_td")){
		alert("No puede seleccionar esta hora");
	}else{
		if($(td).hasClass("t_time_td_select")){
			$(td).removeClass("t_time_td_select");
		}else{
			$(td).addClass("t_time_td_select");
		}
	}
}

function getTotalTime(table){
	var count=0;
	$(table).each(function(index){
		if($(this).hasClass("t_time_td_select")){
			count++;
		}
	});
	return count;
}

function setDetailTime(table, inputRental, modelA){
	$.ajax({
		url: "/admin/dataRentTime/"+modelA.get("environmentId")+"/"+modelA.get("dateStart"),
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			clearTimeDetail(table);
			modelA.set("rental", data.rental);
			$(inputRental).val(data.rental);
			var times = data.detail_time.split("-");
			for (var i = 0; i < times.length; i++) {
				setTimeDetailByTime(table, times[i]);
			}
		}
  	 });
}

function clearTimeDetail(table){
	$(table).each(function(index){
		if($(this).hasClass("t_time_td_select"))
			$(this).removeClass("t_time_td_select");
		if($(this).hasClass("t_time_td"))
			$(this).removeClass("t_time_td");
	});
}

function setTimeDetailByTime(table, time){
	$(table).each(function(index){
		if($(this).attr("data-id") == time){
			$(this).addClass("t_time_td");
			return;
		}
	});
}

function getTimeDetail(table){
	var detail = "";
	$(table).each(function(index){
		if($(this).hasClass("t_time_td_select"))
			detail += "-"+$(this).attr("data-id");
	});
	return detail;
}

function saveContractTime(model){
	$.ajax({
 		  url: "/admin/contratoTime",
 		  //data: {'obj': modelo.toJSON()},
 		  data: model.toJSON(),
 		  type: "post",
 		  headers: {
     	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     	        'Content-Type': 'application/x-www-form-urlencoded'
     	  },
 		  success:function (data) {
 			 if($.isNumeric(data))
 				window.open("/pdf/voucherTime/"+data, "_blank");
 			 else
 				 alert("Hubo un error");
 		  }
	 });
}

function saveExpense(model){
	$.ajax({
 		  url: "/expenses/save",
 		  //data: {'obj': modelo.toJSON()},
 		  data: model.toJSON(),
 		  type: "post",
 		  headers: {
     	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     	        'Content-Type': 'application/x-www-form-urlencoded'
     	  },
 		  success:function (data) {
 			 location.reload();
 		  }
	 });
}

function saveBath(model){
	$.ajax({
		url: "/bath/save",
		data: model.toJSON(),
		type: "post",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			location.reload();
		}
	});
}

function saveBathSpeding(model){
	$.ajax({
		url: "/bath/saveSpending",
		data: model.toJSON(),
		type: "post",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			location.reload();
		}
	});
}

function actionEditExpense(link){
	var id= $(link).attr("data-id");
	$.ajax({
		url: "/expenses/"+id,
		type: "get",
		dataType: "json",
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			var expenseMode = new ExpenseModel({
				exp_id: data.data.exp_id,
				concept: data.data.concept,
				amount: data.data.amount,
			    expense: data.data.expense,
			    total: data.data.total,
			    code_envoice: data.data.code_envoice,
		    	});
			
			alert("ddd"+expenseMode.get("code_envoice"));
			var modalView = new ExpenseView({model: expenseMode});
			Backbone.Validation.bind(modalView);
			modalView.show();
		}
	 });
}

function clearNavActive(){
	var lis = $("#ul_menu_nav li");
	$.each(lis, function(index, item){
		$(this).removeClass("active");
	});
}

function setNavActive(index){
	var lis = $("#ul_menu_nav li");
	$.each(lis, function(i, item){
		if(index != i)
			$(this).removeClass("active");
		else
			$(this).addClass("active");
	});
}

function setMenuItemActive(index){
	var lis = $("#d_menu_bath a");
	$.each(lis, function(i, item){
		if(index != i)
			$(this).removeClass("active");
		else
			$(this).addClass("active");
	});
}

function setMenuArchingItemActive(index){
	var lis = $("#dMenuArching a");
	$.each(lis, function(i, item){
		if(index != i)
			$(this).removeClass("active");
		else
			$(this).addClass("active");
	});
}

function getDateEntry(input, model){
	$.ajax({
		url: "/bath/getDateEntry",
		type: "get",
		dataType: "json",
		success:function (data) {
			$(input).val(data.date_last);
			model.set("date_entry", data.date_last);
			console.log("data: "+data.date_last);
		}
	});
}

function getDateEntryA(){
	var ddaa = null;
	$.ajax({
		url: "/bath/getDateEntry",
		type: "get",
		dataType: "json",
		success:function (data) {
			ddaa = data.date_last;
		}
	});

	return ddaa;
}

function actionEditBath(link){
	var bathModel = new BathModel({
		be_id: $(link).attr("data-id"),
		detail: $(link).attr("data-detail"),
		amount: $(link).attr("data-amount"),
		ci: $(link).attr("data-ci"),
		date_entry: $(link).attr("data-date_entry"),
	});

	var modalView = new BathView({model: bathModel});
	Backbone.Validation.bind(modalView);
	modalView.show();
}

function actionEditBathSpending(link){
	var bathModel = new BathSpendingModel({
		bs_id: $(link).attr("data-id"),
		detail: $(link).attr("data-detail"),
		outgo: $(link).attr("data-outgo"),
		code_envoice: $(link).attr("data-code_envoice"),
		date_spending: $(link).attr("data-date_spending"),
	});

	var modalView = new BathSpendingView({model: bathModel});
	Backbone.Validation.bind(modalView);
	modalView.show();
}

function actionDeleteBathSpending(link){
	$('#modalDeleteBathS').modal('show');

	$('#modalDeleteBathS').on('shown.bs.modal', function (e) {
		$("#sDateSpending").text($(link).attr("data-date_spending"));
		$("#sDetail").text($(link).attr("data-detail"));
		$("#sOutgo").text($(link).attr("data-outgo"));

		$("#bDeleteBathSpending").click(function(){
			deleteBathSpending($(link).attr("data-id"), $("#hToken").val());
		});


	});
}

function deleteBathSpending(id, token){
	$.ajax({
		url: "/bath/deleteSpending/"+id,
		type: "delete",
		data: { "_token": token },
		dataType: "json",
		success:function (data) {
			alert(data);
		}
	});
}

function saveArchingBath(form){
	$(form).submit(function(e){
		e.preventDefault();
		$.ajax({
			url: "/arching/saveArchingBath",
			data: $(form).serialize(),
			type: "post",
			dataType: "json",
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			success:function (data) {
				location.reload();
				//alert(data);
			}
		});
	});
}

function saveArchingEnvironment(form){
	$(form).submit(function(e){
		e.preventDefault();
		$.ajax({
			url: "/arching",
			data: $(form).serialize(),
			type: "post",
			dataType: "json",
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			},
			success:function (data) {
				location.reload();
				//alert(data);
			}
		});
	});
}

function deleteEnvImage(env_image){
	$.ajax({
		url: "/env/"+env_image,
		type: "delete",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			appendEnvImages(data.env_id);

		}
	});
}

function appendEnvImages(env_id){
	$.ajax({
		url: "/env/env_images/"+env_id,
		type: "get",
		dataType: "json",
		success:function (data) {
			$("#d_panel_envimages").empty();
			$("#d_panel_envimages").append(addHtmlInvImages(data.envImages));
			console.log(data);
		}
	});
}

function addHtmlInvImages(data){
	var html = "";
	var env_id;
	var colum = 0;
	_.each(data, function(envIMage){
		env_id = envIMage.env_id;
		if(colum == 0){
			html += "<div class='row'>";
			html += "<div class='col-md-4'>";
			html += "<a href='#' onclick='openViewDeleteEnvImage("+envIMage.env_image_id+"); return false;' style='display: block;'><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
			html += "<img class='img-thumbnail' style='width: 140px;' src='/assets/images/"+envIMage.url_image+"'>";
			html += "</div>";
			colum++;
		}else{
			if(colum == 2){
				html += "<div class='col-md-4'>";
				html += "<a href='#' onclick='openViewDeleteEnvImage("+envIMage.env_image_id+"); return false;' style='display: block;'><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
				html += "<img class='img-thumbnail' style='width: 140px;' src='/assets/images/"+envIMage.url_image+"'>";
				html += "</div>";
				html += "</div>";
				colum=0;
			}else{
				html += "<div class='col-md-4'>";
				html += "<a href='#' onclick='openViewDeleteEnvImage("+envIMage.env_image_id+"); return false;' style='display: block;'><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></a>";
				html += "<img class='img-thumbnail' style='width: 140px;' src='/assets/images/"+envIMage.url_image+"'>";
				html += "</div>";
				colum++;
			}
		}
	});
	$("#d_panel-heading").empty();
	var link = "";
	//alert(env_id);
	if(data.length<=10){
		link = "<div id='d_panel-heading' class='panel-heading'>Imagenes <a href='#' onclick='openUploadFile("+env_id+"); return false;'><span class='glyphicon glyphicon-cloud-upload'></span></a></div>"
	}else{
		link = "<div id='d_panel-heading' class='panel-heading'>Imagenes <span class='glyphicon glyphicon-cloud-upload' style='color: #000;' title='Se llego al limite de imagenes'></span></div>"
	}
	$("#d_panel-heading").append(link);

	return html;
}

function openModelHistoryEnv(env_id, code){
	$.ajax({
		url: "/env/listContract/"+env_id,
		type: "get",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		dataType: "json",
		success:function (data) {
			var findHistoryModel = new findHistory();
			findHistoryModel.set('code', code);
			findHistoryModel.set('contracts', data.contract);
			var modalView = new ContractHistoryView({model: findHistoryModel});
			//Backbone.Validation.bind(modalView);
			modalView.show();
		}
	});
}

function deleteEnv(env_id){
	$.ajax({
		url: "/env/del/"+env_id,
		type: "delete",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			if(data.message === "true"){
				location.reload();
			}else{
				alert(data.message);
			}

		}
	});
}

function redirectByPath(href){
	window.location = href;
}

function setActiveMenuStore(menu, i){
	var links = $(menu).find("a");

	$.each(links, function(index, item){
		$(item).removeClass("active");
	});

	$.each(links, function(index, item){
		if(index == i)
			$(item).addClass("active");
	});
}