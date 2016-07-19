var ExpenseModel = Backbone.Model.extend({
	defaults: {
		exp_id: null,
		date_expense: null,
		concept: "",
		expense: 0,
		amount: 0,
		code_envoice: null
	},
    initialize: function(){
    },
    validation: {
    	concept: {
    	      required: true,
  	      msg: 'Concepto requerida'
      	},
      	expense: [{
    		required: true,
    	      msg: 'Gasto requerida'
        	},{
        		min: 1,
        		msg: 'Valor minimo 1'
        	}],
        amount: [{
    		required: true,
    	      msg: 'Cantidad requerida'
        	},{
        		min: 1,
        		msg: 'Valor minimo 1'
        	}],
    	
        		
    }
});

var ExpenseView = Backbone.View.extend({
	id: 'modalExpense',
	className: "modal fade",
	model: ExpenseModel,
    template: _.template($("#expense_template").html()),
    initialize: function() {
		_.bindAll(this, 'show', 'teardown', 'render');
	    this.render();
    },
    show: function(){
    	this.$el.modal('show');
    	var modelA =  this.model;
    	$(this.$el).on('shown.bs.modal', function (e) {
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
    	this.model.set({'concept': $(this.el).find('input#concept').val()});
    	this.model.set({'amount': $(this.el).find('input#amount').val()});
    	this.model.set({'expense': $(this.el).find('input#expense').val()});
    	this.model.set({'code_envoice': $(this.el).find('input#code_envoice').val()});
    	
    	$.each($(this.el).find(".form-control"), function(key, value){
          	 $(value).removeClass("error_input");
           });
           $.each($(this.el).find(".error_text_arcedi"), function(key, value){
          	 $(value).empty();
           });
   		dd = this.model.validate();
   		if (!this.model.isValid()) {
   			var form = this.$el.find("#formExpense");
   			$.each(dd, function(key, value){
   				$(form).find('#'+key).addClass("error_input");
   				$(form).find('.error_'+key).empty();
   				$(form).find('.error_'+key).append(value);
   			});
   		}else{
   			saveExpense(this.model);
   			this.$el.modal('hide');
   		}
		e.preventDefault();
    }
});