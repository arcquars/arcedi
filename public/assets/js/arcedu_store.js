/**
 * Created by angel on 6/29/16.
 */
var ProductModel = Backbone.Model.extend({
    defaults: {
    },
    initialize: function(){
    },
    validation: {
        name: {
            required: true,
            msg: 'Nombre requerido'
        },
        price_reference: [{
            required: true,
            msg: 'Precio requerido'
        },{
            min: 1,
            msg: 'Precio minimo 1'
        }],
        category: {
            required: true,
            msg: 'Categoria requerido'
        },
        factory: {
            required: true,
            msg: 'Fabrica requerido'
        }
    }
});

var ProductMovement = Backbone.Model.extend({
    defaults: {
        "id": 0,
        "quantity": 0,
        "coste": 0,
        "price": 0
    }
});

var ProductsMovement = Backbone.Collection.extend({
    model: ProductMovement
});

var ProductView = Backbone.View.extend({
    id: 'modalProduct',
    className: "modal fade",
    model: ProductModel,
    template: _.template($('#new_product_template').html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
        var view = this;

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
        "click .btn-close": "close"
    },
    doMethod: function(e){
        e.preventDefault();
        this.model.set({'code': $(this.el).find('input#code').val()});
        this.model.set({'name': $(this.el).find('input#name').val()});
        this.model.set({'price_reference': $(this.el).find('input#price_reference').val()});
        this.model.set({'category': $(this.el).find('input#category').val()});
        this.model.set({'factory': $(this.el).find('input#factory').val()});
        this.model.set({'description': $(this.el).find('input#description').val()});
        this.model.set({'_token': $('meta[name="csrf-token"]').attr('content')});

        $.each($(this.el).find(".form-control"), function(key, value){
            $(value).removeClass("error_input");
        });
        $.each($(this.el).find(".error_text_arcedi"), function(key, value){
            $(value).empty();
        });

        dd = this.model.validate();
        if (!this.model.isValid()) {
            var form = this.$el.find("#formNewProduct");
            $.each(dd, function(key, value){
                $(form).find('#'+key).addClass("error_input");
                $(form).find('.error_'+key).empty();
                $(form).find('.error_'+key).append(value);
            });
        }else{
            saveNewProduct(this.model, this.$el);
        }
    },
    close: function(){
        this.$el.modal('hide');

    }

});

var ProductEditView = Backbone.View.extend({
    id: 'modalProductEdit',
    className: "modal fade",
    model: ProductModel,
    template: _.template($('#edit_product_template').html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
        var view = this;

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
        "click .btn-close": "close"
    },
    doMethod: function(e){
        e.preventDefault();
        this.model.set({'code': $(this.el).find('input#code').val()});
        this.model.set({'name': $(this.el).find('input#name').val()});
        this.model.set({'price_reference': $(this.el).find('input#price_reference').val()});
        this.model.set({'category': $(this.el).find('input#category').val()});
        this.model.set({'factory': $(this.el).find('input#factory').val()});
        this.model.set({'description': $(this.el).find('input#description').val()});
        this.model.set({'product_id': $(this.el).find('input#product_id').val()});
        this.model.set({'_token': $('meta[name="csrf-token"]').attr('content')});

        $.each($(this.el).find(".form-control"), function(key, value){
            $(value).removeClass("error_input");
        });
        $.each($(this.el).find(".error_text_arcedi"), function(key, value){
            $(value).empty();
        });

        dd = this.model.validate();
        if (!this.model.isValid()) {
            var form = this.$el.find("#formEditProduct");
            $.each(dd, function(key, value){
                $(form).find('#'+key).addClass("error_input");
                $(form).find('.error_'+key).empty();
                $(form).find('.error_'+key).append(value);
            });
        }else{
            saveEditProduct(this.model, this.$el);
        }
    },
    close: function(){
        this.$el.modal('hide');

    }

});


