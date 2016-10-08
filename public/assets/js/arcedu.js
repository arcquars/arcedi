_.extend(Backbone.Validation.patterns, {
    		arcedu: /\d{4}-\d{2}/
    		});

    		_.extend(Backbone.Validation.messages, {
    			arcedu: 'This is an error message'
    		});
var Cliente = Backbone.Model.extend({
    initialize: function(){
       alert('Esta funcion se llamará en la creación de cada instancia')
    }
});

var findHistory = Backbone.Model.extend({
	defaults: {
		'code': null,
		'contracts': []
	}
});

var ContractMonth = Backbone.Model.extend({
	defaults: {
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
        		pattern: /^\d+(\.\d{1,2})?$/,
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
			dateContract: [
			{
				required: true,
				msg: 'Fecha requerida'
			},{
				pattern: /\d{4}-\d{2}/,
				msg: 'Formato incorecto'
			}],
        	dateStart: 
	        	function(value) {
	        		if(value == ""){
	        	    	return "Fecha Requerida";
	        	    }
	        		var dStart = moment(value, "DD-MM-YYYY");
	        		var dEnd = moment("01-"+$(dateEnd).val(), "DD-MM-YYYY");
	        		//console.log("validar start:: "+dStart+"; end: "+dEnd);
	        	    if(dStart >= dEnd) {
	        	    	return 'Fecha de inicio del contrato tiene que ser mayor a Fecha de Fin';
	        	    }
	        	}
        	,
        	dateEnd: [
        	          {
    	      required: true,
    	      msg: 'Fecha requerida'
        	},{
        		pattern: /\d{4}-\d{2}/,
        		msg: 'Formato incorecto'
        	}],
        	monthPayment: {
        	      required: true,
        	      msg: 'Campo requerido'
        	},
        	despensas: {
      	      required: true,
      	      msg: 'Campo requerido'
        	},
        	penalty_fee: {
        	      required: true,
        	      msg: 'Campo requerido'
          	},
        	
    }
});
	
var PaymentMonth = Backbone.Model.extend({
	defaults: {
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
        	dateEnd: [
        	          {
        	    	      required: true,
        	    	      msg: 'Fecha requerida'
        	        	},{
        	        		pattern: 'arcedu',
        	        		msg: 'Formato incorecto'
        	        	}],
    }
});

var PaymentAnti = Backbone.Model.extend({
	defaults: {
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
        	dateEnd: [
        	          {
        	    	      required: true,
        	    	      msg: 'Fecha requerida'
        	        	},{
        	        		pattern: 'arcedu',
        	        		msg: 'Formato incorecto'
        	        	}],
    }
});

var ContractAnti = Backbone.Model.extend({
	defaults: {
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
			dateContract: [
			{
				required: true,
				msg: 'Fecha requerida'
			},{
				pattern: /\d{4}-\d{2}/,
				msg: 'Formato incorecto'
			}],
        	dateStart: 
	        	function(value) {
	        		if(value == ""){
	        	    	return "Fecha Requerida";
	        	    }
	        		var dStart = moment(value, "YYYY-MM-DD");
	        		var dEnd = moment($(dateEnd).val(), "YYYY-MM-DD");
	        		//console.log("validar start:: "+dStart+"; end: "+dEnd);
	        	    if(dStart >= dEnd) {
	        	    	return 'Fecha de inicio del contrato tiene que ser mayor a Fecha de Fin';
	        	    }
	        	}
        	,
        	dateEnd: [
        	          {
    	      required: true,
    	      msg: 'Fecha requerida'
        	},{
        		pattern: /\d{4}-\d{2}/,
        		msg: 'Formato incorecto'
        	}],
        	anticretico: {
        	      required: true,
        	      msg: 'Campo requerido'
        	},
        	despensas: {
      	      required: true,
      	      msg: 'Campo requerido'
        	},
        	penalty_fee: {
        	      required: true,
        	      msg: 'Campo requerido'
          	},
        	
    }
});

var PaymentWarrantyMonth = Backbone.Model.extend({
	defaults: {
	}
});

var PaymentWarrantyAnti = Backbone.Model.extend({
	defaults: {
	}
});

ContractMonthView = Backbone.View.extend({
	model: ContractMonth,
    template: _.template($('#contractMes_template').html()),
    render: function(){
        $(this.el).html(this.template(this.model.attributes));
        return this;
    },
    events: {
        "submit form": "doMethod",
        "click .button-search": "searchPerson"
     }, 
     doMethod: function(e) {
         e.preventDefault();  
         var ci = $(this.el).find('input#ci').val();
         this.model.set({'ci': ci});
         this.model.set({'expedido': $(this.el).find('select#expedido').val()});
         this.model.set({'names': $(this.el).find('input#names').val()});
         this.model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
         this.model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
         this.model.set({'phone': $(this.el).find('input#phone').val()});
         this.model.set({'phone_cel': $(this.el).find('input#phone_cel').val()});
         this.model.set({'email': $(this.el).find('input#email').val()});
         
         this.model.set({'warranty': $(this.el).find('input#warranty').val()});
         this.model.set({'penalty_fee': $(this.el).find('input#penalty_fee').val()});
		 this.model.set({'dateContract': $(this.el).find('input#dateContract').val()});
         this.model.set({'dateStart': $(this.el).find('input#dateStart').val()});
         this.model.set({'dateEnd': $(this.el).find('input#dateEnd').val()});
         this.model.set({'monthPayment': $(this.el).find('input#monthPayment').val()});
         this.model.set({'despensas': $(this.el).find('input#despensas').val()});
         
         $.each($(this.el).find(".form-control"), function(key, value){
        	 $(value).removeClass("error_input");
         });
         $.each($(this.el).find(".error_text_arcedi"), function(key, value){
        	 $(value).empty();
         });
         dd = this.model.validate();
         modelo = this.model;
         el = this.el;
         if (!this.model.isValid()) {
        	 var form = this.el;
        	 $.each(dd, function(key, value){
        		 $(form).find('#'+key).addClass("error_input");
        		 $(form).find('.error_'+key).empty();
        		 $(form).find('.error_'+key).append(value);
        		 
        	 });
         }else{        	 
        	 $.ajax({
	       		  url: "/admin/contrato",
	       		  //data: {'obj': modelo.toJSON()},
	       		  data: modelo.toJSON(),
	       		  type: "post",
	       		  headers: {
		       	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		       	        'Content-Type': 'application/x-www-form-urlencoded'
		       	  },
	       		  success:function (data) {
	       			  if(data == 'true'){
	       				  location.reload();
	       			  }else{
	       				  alert("Algo Fallo");
	       			  }
	       			  
	       		  }
        	 });
         }
         //console.log('ci: '+this.model.get('ci')+"; environmentName: "+this.model.get('environmentName'));
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
    			$('#formContractMont')[0].reset();
    			$(form).find('input#ci').val(ci);
    		  });
     }
});

var PaymentMonthView = Backbone.View.extend({
	id: 'modalPayment',
	className: "modal fade",
	model: PaymentMonth,
	template: _.template($('#paymentMonth_template').html()),
	initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
	    this.render();
	  },
	  show: function(){
		  this.$el.modal('show');
		  var modelA =  this.model;
		  var view = this;
		  $(this.$el).on('shown.bs.modal', function (e) {
			  var dateRange = modelA.get("dateStart1");
        var dateDd = moment(modelA.get("dateStart"), "YYYY-MM-DD");
			  if($('.datetimepickerEndM').data("DateTimePicker") !== undefined){
				  $('.datetimepickerEndM').data("DateTimePicker").destroy();
				  $('.datetimepickerEndM').datetimepicker({
					  	locale: moment.locale('es'),
		    	    	format: 'YYYY-MM',
		    	    	viewMode: "months",
		    	    	defaultDate: dateRange,
		    	    	maxDate: moment($("#dateEndContract").val(), "YYYY-MM"),
		    	    	minDate: dateDd.add(1, 'month').calendar()
				  });
			  }else{
				  $('.datetimepickerEndM').datetimepicker({
					  	locale: moment.locale('es'),
		    	    	format: 'YYYY-MM',
		    	    	viewMode: "months",
		    	    	defaultDate: dateRange,
		    	    	maxDate: moment($("#dateEndContract").val(), "YYYY-MM"),
		    	    	minDate: dateDd.add(1, 'month').calendar()
				  });

			  }
			  $(".datetimepickerEndM").on("dp.change", function(e) {
				  var number_month = numberMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), e.date);
				  setNumberMonth(number_month);
				  setTotalRentalMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("payment"));
				  setTotalLarderMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("larder"));
				  calcGranTotal(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("payment"), modelA.get("larder"), modelA.get("fee"), modelA.get("penalty_fee"));
			  });
			  var number_month = numberMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), moment(modelA.get("dateStart1"), "YYYY-MM-DD"));
			  setNumberMonth(number_month);
			  setTotalRentalMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("payment"));
			  setTotalLarderMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("larder"));
			  calcGranTotal(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("payment"), modelA.get("larder"), modelA.get("fee"), modelA.get("penalty_fee"));
		  });

		  $(this.$el).on('hidden.bs.modal', function (e) {
			  view.remove();
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
	        "click .button-search": "searchPerson",
	        "click .btn-close": "close"
	     }, 
	  doMethod: function(){
		  this.model.set({'ci': $(this.el).find('input#ci').val()});
		  this.model.set({'expedido': $(this.el).find('select#expedido').val()});
		  this.model.set({'names': $(this.el).find('input#names').val()});
		  this.model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
		  this.model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
		  this.model.set({'dateStart': $(this.el).find('input#dateStart').val()});
		  this.model.set({'dateEnd': $(this.el).find('input#dateEnd_cl').val()});
		  this.model.set({'total': $(this.el).find('span#mpm_gran_total').text()});
		  this.model.set({'month_total': $(this.el).find('span#numberMonth_id').text()});
		  this.model.set({'payment_rental': $(this.el).find('span#mpm_total_month').text()});
		  this.model.set({'payment_larder': $(this.el).find('span#mpm_total_larder').text()});
		  this.model.set({'penalty_fee': $(this.el).find('span#mpm_total_multa').text()});
		  
		  $.each($(this.el).find(".form-control"), function(key, value){
	        	 $(value).removeClass("error_input");
	         });
	         $.each($(this.el).find(".error_text_arcedi"), function(key, value){
	        	 $(value).empty();
	         });
	         
		  dd = this.model.validate();
		  if (!this.model.isValid()) {
			  var form = this.$el.find("#formPaymentMonth");
			  $.each(dd, function(key, value){
				  $(form).find('#'+key).addClass("error_input");
				  $(form).find('.error_'+key).empty();
				  $(form).find('.error_'+key).append(value);
			  });
		  }else{
			  savePaymentMonth(this.model, this.$el);
		  }
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
	    				model.set({'expedido': $(this.el).find('select#expedido').val()});
	    				model.set({'names': $(this.el).find('input#names').val()});
	    				model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
	    				model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
	    			}
	    		}).fail(function(jqXHR, textStatus) {
	    			model.set({'expedido': $(this.el).find('select#expedido').val()});
    				model.set({'names': $(this.el).find('input#names').val()});
    				model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
    				model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
	    		  });
	  },
	  close: function(){
		 this.$el.modal('hide');
		 
	  }

});

var PaymentAntiView = Backbone.View.extend({
	id: 'modalPaymentAnti',
	className: "modal fade",
	model: PaymentMonth,
	template: _.template($('#paymentAnti_template').html()),
	initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
	    this.render();
	  },
	  show: function(){
		  this.$el.modal('show');
		  var modelA =  this.model;
		  var view = this;
		  $(this.$el).on('shown.bs.modal', function (e) {
			  var dateRange = modelA.get("dateStart1");
			  var dd = moment(modelA.get("dateStart1"), 'YYYY-MM-DD');
			  //dd.subtract(2, 'months');
			  if($('.datetimepickerEndM').data("DateTimePicker") !== undefined){
				  $('.datetimepickerEndM').data("DateTimePicker").destroy();
				  $('.datetimepickerEndM').datetimepicker({
					  	locale: moment.locale('es'),
		    	    	format: 'YYYY-MM',
		    	    	viewMode: "months",
		    	    	defaultDate: dateRange,
		    	    	maxDate: moment($("#dateEndContract").val(), "YYYY-MM"),
		    	    	minDate: dd
				  });
			  }else{
				  $('.datetimepickerEndM').datetimepicker({
					  	locale: moment.locale('es'),
		    	    	format: 'YYYY-MM',
		    	    	viewMode: "months",
		    	    	defaultDate: dateRange,
		    	    	maxDate: moment($("#dateEndContract").val(), "YYYY-MM"),
		    	    	minDate: dd
				  });
				  
			  }
			  $(".datetimepickerEndM").on("dp.change", function(e) {
				  var number_month = numberMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), e.date);
				  setNumberMonth(number_month);
				  //setTotalRentalMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("payment"));
				  setTotalLarderMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("larder"));
				  calcGranTotalAnti(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("larder"), modelA.get("fee"), modelA.get("penalty_fee"));
			  });
			  var number_month = numberMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), moment(modelA.get("dateStart1"), "YYYY-MM-DD"));
			  setNumberMonth(number_month);
			  setTotalLarderMonth(moment(modelA.get("dateStart"), "YYYY-MM-DD"), number_month, modelA.get("larder"));
			  calcGranTotalAnti(
					  moment(modelA.get("dateStart"), "YYYY-MM-DD"), 
					  number_month, 
					  modelA.get("larder"), 
					  modelA.get("fee"), 
					  modelA.get("penalty_fee"));
		  });
		  
		  $(this.$el).on('hidden.bs.modal', function (e) {
			  view.remove();
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
	        "click .button-search": "searchPerson",
	        "click .btn-close": "close"
	     }, 
	  doMethod: function(){
		  this.model.set({'ci': $(this.el).find('input#ci').val()});
		  this.model.set({'expedido': $(this.el).find('select#expedido').val()});
		  this.model.set({'names': $(this.el).find('input#names').val()});
		  this.model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
		  this.model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
		  this.model.set({'dateStart': $(this.el).find('input#dateStart').val()});
		  this.model.set({'dateEnd': $(this.el).find('input#dateEnd_cl').val()});
		  this.model.set({'total': $(this.el).find('span#mpm_gran_total').text()});
		  this.model.set({'month_total': $(this.el).find('span#numberMonth_id').text()});
		  this.model.set({'payment_larder': $(this.el).find('span#mpm_total_larder').text()});
		  this.model.set({'penalty_fee_total': $(this.el).find('span#mpm_total_multa').text()});
		  
		  this.model.set({'month_total': $(this.el).find('span.numberMonth').attr('data-number')});
		  
		  $.each($(this.el).find(".form-control"), function(key, value){
	        	 $(value).removeClass("error_input");
	         });
	         $.each($(this.el).find(".error_text_arcedi"), function(key, value){
	        	 $(value).empty();
	         });
	         
		  dd = this.model.validate();
		  if (!this.model.isValid()) {
			  var form = this.$el.find("#formPaymentMonth");
			  $.each(dd, function(key, value){
				  $(form).find('#'+key).addClass("error_input");
				  $(form).find('.error_'+key).empty();
				  $(form).find('.error_'+key).append(value);
			  });
		  }else{
			  savePaymentAnti(this.model, this.$el);
		  }
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
	    				model.set({'expedido': $(this.el).find('select#expedido').val()});
	    				model.set({'names': $(this.el).find('input#names').val()});
	    				model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
	    				model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
	    			}
	    		}).fail(function(jqXHR, textStatus) {
	    			model.set({'expedido': $(this.el).find('select#expedido').val()});
    				model.set({'names': $(this.el).find('input#names').val()});
    				model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
    				model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
	    		  });
	  },
	  close: function(){
		 this.$el.modal('hide');
		 
	  }

});

var ContractAntiView = Backbone.View.extend({
	id: 'modalContractAnti',
	className: "modal fade",
	model: PaymentMonth,
	template: _.template($('#contractAnti_template').html()),
	initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
	    this.render();
	  },
	  show: function(){
		  $('#modalSelectTypeContract').modal('hide');
		  this.$el.modal('show');
		  var modelA =  this.model;
		  var view = this;
		  $(this.$el).on('shown.bs.modal', function (e) {
			  var dateStart = moment(modelA.get('dateStart'), "YYYY-MM-DD");
			  var dateEnd = moment(modelA.get('dateStart'), "YYYY-MM-DD");
			  var dateMax = moment(modelA.get('dateStart'), "YYYY-MM-DD");
			  var dateMinContract = moment(modelA.get('dateStart'), "YYYY-MM-DD");
			  dateMinContract.subtract(20, 'days');
			  dateMax.add(3, "years");
			  dateEnd.add(1, "years");
			  $('.datetimepickerContract').datetimepicker({
				  locale: moment.locale('es'),
				  format: 'YYYY-MM-DD',
				  defaultDate: dateStart,
				  maxDate: dateMax,
				  minDate: dateMinContract
			  });
			  $('.datetimepickerStart').datetimepicker({
				  	locale: moment.locale('es'),
	    	    	format: 'YYYY-MM-DD',
	    	    	defaultDate: dateStart,
	    	    	maxDate: dateMax,
	    	    	minDate: dateStart
			  });
			  $('.datetimepickerEnd').datetimepicker({
				  	locale: moment.locale('es'),
	    	    	format: 'YYYY-MM-DD',
	    	    	defaultDate: dateEnd,
	    	    	maxDate: dateMax,
	    	    	minDate: dateStart
			  });
		  });
		  
		  $(this.$el).on('hidden.bs.modal', function (e) {
			  view.remove();
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
	        "click .button-search": "searchPerson",
	        "click .btn-close": "close"
	     }, 
	  doMethod: function(e){
		  model =  this.model;
		  this.model.set({'ci': $(this.el).find('input#ci').val()});
		  this.model.set({'expedido': $(this.el).find('select#expedido').val()});
		  this.model.set({'names': $(this.el).find('input#names').val()});
		  this.model.set({'last_name_f': $(this.el).find('input#last_name_f').val()});
		  this.model.set({'last_name_m': $(this.el).find('input#last_name_m').val()});
		  this.model.set({'phone': $(this.el).find('input#phone').val()});
	      this.model.set({'phone_cel': $(this.el).find('input#phone_cel').val()});
	      this.model.set({'email': $(this.el).find('input#email').val()});

		  this.model.set({'dateContract': $(this.el).find('input#dateContract').val()});
		  this.model.set({'dateStart': $(this.el).find('input#dateStart').val()});
		  this.model.set({'dateEnd': $(this.el).find('input#dateEnd').val()});
		  this.model.set({'anticretico': $(this.el).find('input#anticretico').val()});
		  this.model.set({'penalty_fee': $(this.el).find('input#penalty_fee').val()});
		  this.model.set({'despensas': $(this.el).find('input#despensas').val()});
		  
		  $.each($(this.el).find(".form-control"), function(key, value){
	        	 $(value).removeClass("error_input");
	         });
	         $.each($(this.el).find(".error_text_arcedi"), function(key, value){
	        	 $(value).empty();
	         });
	         
		  dd = this.model.validate();
		  if (!this.model.isValid()) {
			  var form = this.$el.find("#formContractAnti");
			  $.each(dd, function(key, value){
				  $(form).find('#'+key).addClass("error_input");
				  $(form).find('.error_'+key).empty();
				  $(form).find('.error_'+key).append(value);
			  });
		  }else{
			  $.ajax({
	       		  url: "/admin/contratoAnti",
	       		  //data: {'obj': modelo.toJSON()},
	       		  data: model.toJSON(),
	       		  type: "post",
	       		  headers: {
		       	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		       	        'Content-Type': 'application/x-www-form-urlencoded'
		       	  },
	       		  success:function (data) {
	       			  if(data == 'true'){
	       				  location.reload();
	       			  }else{
	       				  alert("Algo Fallo");
	       			  }
	       			  
	       		  }
        	 });
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
	    				$(form).find('form')[0].reset();
	    			}
	    		}).fail(function(jqXHR, textStatus) {
	    			alert("Persona no encontrada.");
	 				$(form).find('form')[0].reset();
	    		});
	  },
	  close: function(){
		 this.$el.modal('hide');
	  }

});

var PaymentMonthWarrantyView = Backbone.View.extend({
	id: 'modalPaymentWarranty',
	className: "modal fade",
	model: PaymentWarrantyMonth,
	template: _.template($('#paymentWMonth_template').html()),
	initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
		this.render();
	},
	show: function(){
		this.$el.modal('show');

		$(this.$el).on('hidden.bs.modal', function (e) {
			//view.remove();
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
		"click .btn-close": "close"
	},
	doMethod: function(event){
		event.preventDefault();
		savePaymentWMonth(this.model, this.$el);
	},
	close: function(){
		this.$el.modal('hide');

	}

});

var PaymentAntiWarrantyView = Backbone.View.extend({
	id: 'modalPaymentWarrantyA',
	className: "modal fade",
	model: PaymentWarrantyAnti,
	template: _.template($('#paymentWAnti_template').html()),
	initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
		this.render();
	},
	show: function(){
		this.$el.modal('show');

		$(this.$el).on('hidden.bs.modal', function (e) {
			//view.remove();
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
		"click .btn-close": "close"
	},
	doMethod: function(){
		savePaymentWAnti(this.model, this.$el);
	},
	close: function(){
		this.$el.modal('hide');

	}

});

var ContractHistoryView = Backbone.View.extend({
	id: 'modalContractHistory',
	className: "modal fade",
	model: findHistory,
	template: _.template($('#history_env_template').html()),
	initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
		this.render();
	},
	show: function(){
		this.$el.modal('show');

		$(this.$el).on('hidden.bs.modal', function (e) {
			//view.remove();
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
		"click .btn-close": "close"
	},
	doMethod: function(){
		savePaymentWAnti(this.model, this.$el);
	},
	close: function(){
		this.$el.modal('hide');

	}

});

function bindingVM(model, inputs, data){
	model.set({
		'ci': data.ci,
		'names': data.names, 
		'expedido': data.expedido, 
		'last_name_f': data.last_name_f,
		'last_name_m': data.last_name_m,
		'phone': data.phone,
		'phone_cel': data.phone_cel,
		'email': data.email
	});
	
	$(inputs).find('input#names').val(data.names);
	$(inputs).find('select#expedido').val(data.expedido);
	$(inputs).find('input#names').val(data.names);
	$(inputs).find('input#last_name_f').val(data.last_name_f);
	$(inputs).find('input#last_name_m').val(data.last_name_m);
	$(inputs).find('input#phone').val(data.phone);
	$(inputs).find('input#phone_cel').val(data.phone_cel);
	$(inputs).find('input#email').val(data.email);
}

function numberMonth(dateStart, dateEnd){
	var date11 = new Date(dateStart.year(), dateStart.month(), "1"); // "18/03/2015", month is 0-index
	var date22 = new Date(dateEnd.year(), dateEnd.month(), "1"); // "20/03/2015"
	  var msDiff = date22 - date11; // 172800000, this is time in milliseconds
	  var monthAux =(msDiff / 1000 / 60 / 60 / 24 / 30);
	  if(monthAux >= 0 && monthAux <1)
		  return 1;
	  else
		  return Math.floor(monthAux);
}

function calcGranTotal(startDate, number_month1, paymentMonth, paymentLarder, paymentFee, penalty_fee){
	var _number_month = parseFloat(number_month1);
	var _payment_month = parseFloat(paymentMonth);
	var _payment_larder = parseFloat(paymentLarder);
	var _payment_fee = parseFloat(paymentFee);
	var _penalty_fee = parseFloat(penalty_fee);
	
	var _payment_month_total = parseFloat(totalMonth(startDate, _number_month, _payment_month));
	var _payment_lader_total = parseFloat(totalMonth(startDate, _number_month, _payment_larder));
	
	var totalG = ( _payment_month_total+ _payment_lader_total + (_payment_fee*penalty_fee));
	$("span#mpm_gran_total").empty();
	$("span#mpm_gran_total").text(totalG.toFixed(2));
}

function calcGranTotalAnti(startDate, number_month1, paymentLarder, paymentFee, penalty_fee){
	var _number_month = parseFloat(number_month1);
	var _payment_larder = parseFloat(paymentLarder);
	var _payment_fee = parseFloat(paymentFee);
	var _penalty_fee = parseFloat(penalty_fee);
	
	var _payment_lader_total = parseFloat(totalMonth(startDate, _number_month, _payment_larder));
	
	var totalG = (_payment_lader_total + (_payment_fee*penalty_fee));
	$("span#mpm_gran_total").empty();
	$("span#mpm_gran_total").text(totalG.toFixed(2));
}


function totalMonth(startDate, number_month, paymentByMonth){
	var day = startDate.get('date');
	var total_month = 0;
	if(day > 1){
		var firtsmonth = (30-day)*(paymentByMonth/30);
		if(number_month > 1){
			total_month = firtsmonth + ((number_month-1)*paymentByMonth);
		}else
			total_month = firtsmonth;
		console.log("firtsmonth: "+firtsmonth+"; day: "+day+"; number_month: "+number_month+"; payment: "+paymentByMonth+"; startDate: "+startDate);
	}else{
		total_month = number_month*paymentByMonth;
	}
	
	return total_month.toFixed(2);
}

function savePaymentMonth(modelPaymentMonth, modal){
	//console.log(modelPaymentMonth);
	$.ajax({
 		  url: "/admin/paymentMonth",
 		  //data: {'obj': modelo.toJSON()},
 		  data: modelPaymentMonth.toJSON(),
 		  type: "post",
 		  headers: {
     	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     	        'Content-Type': 'application/x-www-form-urlencoded'
     	  },
 		  success:function (data) {
 			 modal.modal('hide');
 			 if($.isNumeric(data))
 				window.open("/pdf/voucher/"+data, "_blank");
 			 else
 				 alert("Hubo un error");
 		  }
	 });
}

function savePaymentWMonth(modelPaymentWMonth, modale){
	$.ajax({
		url: "/admin/paymentWMonth",
		//data: {'obj': modelo.toJSON()},
		data: {"rm_id": modelPaymentWMonth.get("rm_id")},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			if(data == "true"){
				//alert("grabo correctamente");
				window.open("/pdf/voucherWarrantyMonth/"+modelPaymentWMonth.get("rm_id"), "_blank");
				console.log("xxxxxxx");

			}
			else
				alert("Hubo un error");
			modale.modal('hide');
		}
	});
}

function savePaymentWAnti(modelPaymentWAnti, modal){
	$.ajax({
		url: "/admin/paymentWAnti",
		//data: {'obj': modelo.toJSON()},
		data: {"ra_id": modelPaymentWAnti.get("anticrisis_id")},
		type: "post",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		success:function (data) {
			modal.modal('hide');
			if(data == "true")
				window.open("/pdf/voucherWarrantyAnti/"+modelPaymentWAnti.get("anticrisis_id"), "_blank");
			else
				alert("Hubo un error");
		}
	});
}

function savePaymentAnti(modelPaymentAnti, modal){
	//console.log(modelPaymentMonth);
	$.ajax({
 		  url: "/admin/paymentAnti",
 		  //data: {'obj': modelo.toJSON()},
 		  data: modelPaymentAnti.toJSON(),
 		  type: "post",
 		  headers: {
     	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
     	        'Content-Type': 'application/x-www-form-urlencoded'
     	  },
 		  success:function (data) {
 			 modal.modal('hide');
 			 if($.isNumeric(data))
 				window.open("/pdf/voucherAnti/"+data, "_blank");
 			 else
 				 alert("Hubo un error");
 		  }
	 });
}

function setNumberMonth(number_month){
	$(".numberMonth").attr("data-number", number_month);
	$(".numberMonth").empty();
	$(".numberMonth").text(number_month);
}
function setTotalRentalMonth(startDate, number_month, paymentByMonth){			  
	var total_month = totalMonth(startDate, number_month, paymentByMonth);
	$(".mpm_total_month").empty();
	$(".mpm_total_month").text(total_month);
}

function setTotalLarderMonth(startDate, number_month, paymentByLarder){			  
	var total_month = totalMonth(startDate, number_month, paymentByLarder);
	$("#mpm_larder_month").empty();
	$("#mpm_larder_month").text(paymentByLarder);
	
	$("#mpm_total_larder").empty();
	$("#mpm_total_larder").text(total_month);
}

function clearPerson(){
	$("#expedido").val("");
	$("#names").val("");
	$("#last_name_f").val("");
	$("#last_name_m").val("");
}

function openPaymentAnti(data){
	var paymentAntiModel = new PaymentAnti();
	paymentAntiModel.set('contract_id', data.data.contract_id);
	paymentAntiModel.set('ci', data.data.ci);
	paymentAntiModel.set('expedido', data.data.expedido);
	paymentAntiModel.set('names', data.data.names);
	paymentAntiModel.set('last_name_f', data.data.last_name_f);
	paymentAntiModel.set('last_name_m', data.data.last_name_m);
	paymentAntiModel.set('payment', data.data.payment);
	paymentAntiModel.set('larder', data.data.larder);
	paymentAntiModel.set('penalty_fee', data.data.penalty_fee);
	paymentAntiModel.set('fee', data.fee);

	paymentAntiModel.set('anticrisis_id', data.data.anticrisis_id);

	if(data.lastPaymentA == null)
		paymentAntiModel.set('dateStart', data.data.date_admission);
	else
		paymentAntiModel.set('dateStart', data.lastPaymentA.date_end);

	//paymentMonthModel.set('dateStart', data.data.date_admission);
	var dataNow = moment(data.dateNow, "YYYY-MM-DD");
	dataNow.add("1", "months");
	dataNow.set('date', 1);
	paymentAntiModel.set('dateStart1', dataNow.format("YYYY-MM-DD"));
	paymentAntiModel.set('dateEnd', data.data.date_end);

	var modalView = new PaymentAntiView({model: paymentAntiModel});
	Backbone.Validation.bind(modalView);
	modalView.show();
}

function openPaymentMonth(data){
	var paymentMonthModel = new PaymentMonth();
	paymentMonthModel.set('contract_id', data.data.contract_id);
	paymentMonthModel.set('rental_m_id', data.data.rental_m_id);
	paymentMonthModel.set('ci', data.data.ci);
	paymentMonthModel.set('expedido', data.data.expedido);
	paymentMonthModel.set('names', data.data.names);
	paymentMonthModel.set('last_name_f', data.data.last_name_f);
	paymentMonthModel.set('last_name_m', data.data.last_name_m);
	paymentMonthModel.set('payment', data.data.payment);
	paymentMonthModel.set('larder', data.data.larder);
	paymentMonthModel.set('penalty_fee', data.data.penalty_fee);
	paymentMonthModel.set('fee', data.fee);
	paymentMonthModel.set('rental_state', data.data.rental_state);

	if(data.lastPaymentM == null)
		paymentMonthModel.set('dateStart', data.data.date_admission);
	else
		paymentMonthModel.set('dateStart', data.lastPaymentM.date_end);

	//paymentMonthModel.set('dateStart', data.data.date_admission);
	var dataNow = moment(data.dateNow, "YYYY-MM-DD");
	dataNow.add("1", "months");
	dataNow.set('date', 1);
	paymentMonthModel.set('dateStart1', dataNow.format("YYYY-MM-DD"));
	paymentMonthModel.set('dateEnd', data.data.date_end);
	var modalView = new PaymentMonthView({model: paymentMonthModel});
	Backbone.Validation.bind(modalView);
	modalView.show();
}

function openPaymentWarrantyMonth(data){
	var paymentWMonthModel = new PaymentWarrantyMonth();
	paymentWMonthModel.set('rm_id', data.data.rm_id);
	paymentWMonthModel.set('ci', data.data.ci);
	paymentWMonthModel.set('code', data.data.code);
	paymentWMonthModel.set('expedido', data.data.expedido);
	paymentWMonthModel.set('names', data.data.names);
	paymentWMonthModel.set('last_name_f', data.data.last_name_f);
	paymentWMonthModel.set('last_name_m', data.data.last_name_m);
	paymentWMonthModel.set('warranty', data.data.warranty);

	var modalView = new PaymentMonthWarrantyView({model: paymentWMonthModel});
	//Backbone.Validation.bind(modalView);
	modalView.show();
}

function openPaymentWarrantyAnti(data){
	var paymentWAntiModel = new PaymentWarrantyAnti();
	paymentWAntiModel.set('anticrisis_id', data.data.anticrisis_id);
	paymentWAntiModel.set('ci', data.data.ci);
	paymentWAntiModel.set('code', data.data.code);
	paymentWAntiModel.set('expedido', data.data.expedido);
	paymentWAntiModel.set('names', data.data.names);
	paymentWAntiModel.set('last_name_f', data.data.last_name_f);
	paymentWAntiModel.set('last_name_m', data.data.last_name_m);
	paymentWAntiModel.set('anticretico', data.data.anticretico);

	var modalView = new PaymentAntiWarrantyView({model: paymentWAntiModel});
	//Backbone.Validation.bind(modalView);
	modalView.show();
}

function openUploadFile(env_id){
	var model = new UploadFileModel();
	model.set('env_id', env_id);
	var modalView = new UploadFileView({'model': model});
	//Backbone.Validation.bind(modalView);
	modalView.show();
}

function openViewDeleteEnvImage(env_image_id){
	var model = new DeleteEnvImageModel();
	model.set('env_image_id', env_image_id);
	var modalView = new DeleteEnvImageView({'model': model});
	//Backbone.Validation.bind(modalView);
	modalView.show();
}

function productCodeIsValid(value){
	$.ajax({
		url: "/store/validCodeProduct/"+value,
		type: "get",
		dateType: "json",
		success:function (data) {
			if(data.data === "true")
				return true;
			else
				return false;
		}
	});
}