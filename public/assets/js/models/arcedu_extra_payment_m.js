var ExtraPayment = Backbone.Model.extend({
    defaults: {
    },
    initialize: function(){
    },
    validation: {
        concept: {
            required: true,
            msg: 'Concepto requerido'
        },
        total: [{
            required: true,
            msg: 'Total requerido'
        },{
            pattern: /^(\d+|\d+,\d{1,2})$/,
            msg: 'Solo numeros con dos decimales.'
        }],
    }
});
