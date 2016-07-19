/**
 * Created by angel on 4/28/16.
 */
var EnvImage = Backbone.Model.extend({
    defaults: {
    }
});

var EnvImageView = Backbone.View.extend({
    id: 'modalEnvImages',
    className: "modal fade",
    model: EnvImage,
    template: _.template($('#envImages_template').html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
        $(this.$el).on('shown.bs.modal', function (e) {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails",
                start: function(slider){
                    $('body').removeClass('loading');
                }
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
        "click .btn-close": "close"
    },
    close: function(){
        this.$el.modal('hide');

    }

});