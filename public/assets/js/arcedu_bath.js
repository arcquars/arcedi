var BathModel = Backbone.Model.extend({
    defaults: {
        be_id: null,
        date_entry: null,
        detail: "",
        ci: 0,
        amount: 0
    },
    initialize: function(){
    },
    validation: {
        date_entry: {
            required: true,
            msg: 'fecha requerida'
        },
        amount: [{
            required: true,
            msg: 'Cantidad requerida'
        },{
            min: 0,
            msg: 'Valor minimo 0'
        }],


    }
});

var BathView = Backbone.View.extend({
    id: 'modalBath',
    className: "modal fade",
    model: BathModel,
    template: _.template($("#bath_template").html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');

        var modelA =  this.model;
        $(this.$el).on('shown.bs.modal', function (e) {
            //getDateEntry($("#date_entry"), modelA);
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
        "submit form": "doMethod"
    },
    doMethod: function(e){
        //this.model.set({'date_entry': $(this.el).find('input#date_entry').val()});
        this.model.set({'amount': $(this.el).find('input#amount').val()});
        this.model.set({'ci': $(this.el).find('input#ci').val()});
        this.model.set({'detail': $(this.el).find('input#detail').val()});

        $.each($(this.el).find(".form-control"), function(key, value){
            $(value).removeClass("error_input");
        });
        $.each($(this.el).find(".error_text_arcedi"), function(key, value){
            $(value).empty();
        });
        dd = this.model.validate();
        if (!this.model.isValid()) {
            var form = this.$el.find("#formBath");
            $.each(dd, function(key, value){
                $(form).find('#'+key).addClass("error_input");
                $(form).find('.error_'+key).empty();
                $(form).find('.error_'+key).append(value);
            });
        }else{
            saveBath(this.model);
            this.$el.modal('hide');
        }
        e.preventDefault();
    }
});

