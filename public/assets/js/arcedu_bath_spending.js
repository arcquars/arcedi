var BathSpendingModel = Backbone.Model.extend({
    defaults: {
        bs_id: null,
        date_spending: null,
        code_envoice: null,
        outgo: 0,
        detail: null
    },
    initialize: function(){
    },
    validation: {
        detail: {
            required: true,
            msg: 'Campo requerido'
        },
        date_spending: {
            required: true,
            msg: 'fecha requerida'
        },
        outgo: [{
            required: true,
            msg: 'Cantidad requerida'
        },{
            min: 0,
            msg: 'Valor minimo 0.1'
        }],


    }
});

var BathSpendingView = Backbone.View.extend({
    id: 'modalBathSpinding',
    className: "modal fade",
    model: BathSpendingModel,
    template: _.template($("#bath_spending_template").html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');

        var modelA =  this.model;
        $(this.$el).on('shown.bs.modal', function (e) {
            //getDateEntry($("#date_entry"), modelA);
            //alert(modelA.get("date_spending"));
            var dateNow = moment(modelA.get("date_spending"), "YYYY-MM-DD");
            var dateMax = moment(modelA.get("date_spending"), "YYYY-MM-DD").add(7, 'days');
            var dateMin = moment(modelA.get("date_spending"), "YYYY-MM-DD").subtract(8, 'days');
            //alert(dateNow.add(7, 'days'));
            $('.datetimepicker').datetimepicker({
                locale: moment.locale('es'),
                format: 'YYYY-MM-DD',
                //viewMode: "months",
                defaultDate: dateNow,
                maxDate: dateMax,
                minDate: dateMin
            });
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
        this.model.set({'code_envoice': $(this.el).find('input#code_envoice').val()});
        this.model.set({'detail': $(this.el).find('input#detail').val()});
        this.model.set({'date_spending': $(this.el).find('input#date_spending').val()});
        this.model.set({'outgo': $(this.el).find('input#outgo').val()});

        $.each($(this.el).find(".form-control"), function(key, value){
            $(value).removeClass("error_input");
        });
        $.each($(this.el).find(".error_text_arcedi"), function(key, value){
            $(value).empty();
        });
        dd = this.model.validate();
        if (!this.model.isValid()) {
            var form = this.$el.find("#formBathSpending");
            $.each(dd, function(key, value){
                $(form).find('#'+key).addClass("error_input");
                $(form).find('.error_'+key).empty();
                $(form).find('.error_'+key).append(value);
            });
        }else{
            saveBathSpeding(this.model);
            this.$el.modal('hide');
        }
        e.preventDefault();
    }
});

