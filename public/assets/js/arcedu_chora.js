var ContractTimeModel = Backbone.Model.extend({
	defaults: {
		ci: null,
		expedido: null,
		names: null,
		last_name_f: null,
		last_name_m: null,
			
	},
    initialize: function(){
    },
    validation: {
    	ci: [{
    		required: true,
    	      msg: 'CI requerido'
        	},{
        		min: 1,
        		msg: 'Valor minimo 1'
        	},{
        		pattern: 'digits',
        		msg: 'Solo digitos.'
        	}],
        	names: {
    	      required: true,
    	      msg: 'Nombres requerido'
        	},
        	expedido: {
      	      required: true,
      	      msg: 'Campo requerido'
          	},
        	last_name_f: {
        		required: true,
      	      	msg: 'Apellido Paterno requerido'
        	},
        	phone: [{
        		required: false
        	},{
        		pattern: /^\d+$/,
        		msg: 'Solo Digitos'
        	}],
        	phone_cel: [{
        		required: false
        	},{
        		pattern: /^\d+$/,
        		msg: 'Solo Digitos'
        	}],
        	email: [{
        		required: false
        	},{
        		pattern: 'email',
        		msg: 'Solo Digitos'
        	}],
			dateContract:
				function(value) {
					if(value == ""){
						return "Fecha Requerida";
					}
			},
        	dateStart: 
	        	function(value) {
	        		if(value == ""){
	        	    	return "Fecha Requerida";
	        		}
        	},
        	alq_hora_total:
        		function(value) {
        		if(value <= 0){
        	    	return "Hora tiene que ser mayor a 1";
        	}
    	},
        		
    }
});

var ContractTimeView = Backbone.View.extend({
	id: 'modalContractTime',
	className: "modal fade",
	model: ContractTimeModel,
    template: _.template($("#contractTime_template").html()),
    initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
	    this.render();
    },
    show: function(){
    	$('#modalSelectTypeContract').modal('hide');
    	this.$el.modal('show');
    	var modelA =  this.model;
    	$(this.$el).on('shown.bs.modal', function (e) {
    		$(".t_time tr td").click(function(e){
    			selectTime(this);
    			var totalTime = getTotalTime($(".t_time tr td"));
    			var rental = $("#alq_hora").val();
    			$("#alq_hora_total").val(totalTime);
    			$("#alq_hora_gran_total").val(totalTime*rental);
    			
    		});
    		
    		$("#alq_hora").change(function(e){
    			var rentalTime = $(this).val();
    			if(!isNaN(parseFloat(rentalTime)) && isFinite(rentalTime)){
    				var totalTime = getTotalTime($(".t_time tr td"));
        			$("#alq_hora_gran_total").val(totalTime*rentalTime);
    			}else{
    				var totalTime = getTotalTime($(".t_time tr td"));
    				var rental = $(this).val("0");
        			$("#alq_hora_gran_total").val("0");
    			}
    		});
    		
    		var dateRange = modelA.get("dateStart");
			$('.datetimepickerContract').datetimepicker({
				locale: moment.locale('es'),
				format: 'YYYY-MM-DD',
				minDate: dateRange
			});
    		$('.datetimepickerStart').datetimepicker({
			  	locale: moment.locale('es'),
    	    	format: 'YYYY-MM-DD',
    	    	defaultDate: dateRange,
    	    	//maxDate: ,
    	    	minDate: dateRange
    		});
    		
    		$(".datetimepickerStart").on("dp.change", function(e) {
    			modelA.set("dateStart", e.date.format("YYYY-MM-DD"));
				$("#alq_hora_total").val("0");
				$("#alq_hora_gran_total").val("0");
    			setDetailTime($(".t_time tr td"), $("#alq_hora"), modelA);
    		});
    		
    		setDetailTime($(".t_time tr td"), $("#alq_hora"), modelA);
    	});

		$(this.$el).on('hidden.bs.modal', function (e) {
			this.remove();
			clearTimeDetail($(".t_time tr td"));
		});
    },
    teardown: function(){
		  this.$el.data('modal', null);
		  this.remove();
    },
    render: function() {
		  $(this.el).html(this.template(this.model.attributes));
		  return this;
    },
    events: {
    	"submit form": "doMethod",
    	"click .button-search": "searchPerson"
    }, 
    doMethod: function(e){
    	this.model.set({'ci': $(this.el).find('input#ci').val()});
    	this.model.set({'expedido': $(this.el).find('select#expedido').val()});
    	this.model.set({'names': $(this.el).find('input#names').val()});
		this.model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
		this.model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
		this.model.set({'phone': $(this.el).find('input#phone').val()});
		this.model.set({'phone_cel': $(this.el).find('input#phone_cel').val()});
		this.model.set({'dateContract': $(this.el).find('input#dateContract').val()});
		this.model.set({'dateStart': $(this.el).find('input#dateStart').val()});
		this.model.set({'alq_hora': $(this.el).find('input#alq_hora').val()});
		this.model.set({'alq_hora_total': $(this.el).find('input#alq_hora_total').val()});
		this.model.set({'warranty': $(this.el).find('input#warranty').val()});
		
		this.model.set({'alq_hora_detail': getTimeDetail($(".t_time tr td"))});
		
		$.each($(this.el).find(".form-control"), function(key, value){
       	 $(value).removeClass("error_input");
        });
        $.each($(this.el).find(".error_text_arcedi"), function(key, value){
       	 $(value).empty();
        });
        
		dd = this.model.validate();
		if (!this.model.isValid()) {
			var form = this.$el.find("#formContracTime");
			$.each(dd, function(key, value){
				$(form).find('#'+key).addClass("error_input");
				$(form).find('.error_'+key).empty();
				$(form).find('.error_'+key).append(value);
			});
		}else{
			saveContractTime(this.model);
			this.$el.modal('hide');
		}
		e.preventDefault();
    },
    searchPerson: function(){
   	 model =  this.model;
   	 form = this.el;
   	 $.ajax({
   		  url: "/person/"+$(this.el).find('input#ci').val(),
   		  dataType: "json",
   		  context: document.body
   		}).done(function(data) {
   			if(data !== null){
   				bindingVM(model, form, data);
   			}else{
   				alert("No hay nada");
   			}
   		}).fail(function(jqXHR, textStatus) {
   			var ci = $(form).find('input#ci').val();
   			//$('#formContracTime')[0].reset();
   			$(form).find('input#ci').val(ci);
   			$(form).find('input#names').val('');
   			$(form).find('input#last_name_f').val('');
   			$(form).find('input#last_name_m').val('');
   			$(form).find('input#phone').val('');
   			$(form).find('input#phone_cel').val('');
   			$(form).find('input#email').val('');
   		  });
    }
});