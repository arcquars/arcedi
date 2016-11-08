var ExtraPaymentView = Backbone.View.extend({
    model: ExtraPayment,
    template: extraPaymenttemplate,
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
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
    doMethod: function(e) {
        e.preventDefault();

        this.model.set({'concept': $(this.el).find('textarea#concept').val()});
        this.model.set({'total': $(this.el).find('input#total').val()});

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
            savePaymentExtra(modelo.attributes, this.$el);
        }
    }
});

function savePaymentExtra(model, modal){
    $.ajax({
        url: "/admin/paymentExtra",
        //data: {'obj': modelo.toJSON()},
        data: model,
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success:function (data) {
            window.open("/pdf/voucherExtra/"+data, "_blank");
            modal.modal('hide');
        }
    });
}