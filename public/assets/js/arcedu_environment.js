var UploadFileModel = Backbone.Model.extend({
    defaults: {
        file: null,
        env_id: null
    },
    initialize: function(){
    },
    validation: {

    }
});

var DeleteEnvImageModel = Backbone.Model.extend({
    defaults: {
        env_image_id: null
    },
    initialize: function(){
    },
    validation: {

    }
});

var DeleteEnvModel = Backbone.Model.extend({
    defaults: {
        env_id: null
    },
    initialize: function(){
    },
    validation: {

    }
});

var UploadFileView = Backbone.View.extend({
    id: 'modalUploadFile',
    className: "modal fade",
    model: UploadFileModel,
    template: _.template($("#upload_file_template").html()),
    initialize: function() {
        _.bindAll(this, 'show', 'toggleCheckFriend', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
        var env_id = this.model.get("env_id");
        $(this.$el).on('shown.bs.modal', function (e) {
            $(function () {
                'use strict';
                // Change this to the location of your server-side upload handler:
                var url = window.location.hostname === 'blueimp.github.io' ?
                    '//jquery-file-upload.appspot.com/' : '/env/upload';
                $('#fileupload').fileupload({
                    url: url,
                    dataType: 'json',
                    add: function(e, data) {
                        var uploadErrors = [];
                        var acceptFileTypes = /^image\/(gif|jpe?g|png)$/i;
                        if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                            uploadErrors.push('Not an accepted file type');
                        }
                        if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
                            uploadErrors.push('Filesize is too big');
                        }
                        if(uploadErrors.length > 0) {
                            alert(uploadErrors.join("\n"));
                        } else {
                            data.submit();
                        }
                    },
                    maxNumberOfFiles: 10,
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            $('<p/>').text(file.name).appendTo('#files');
                        });
                    },
                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('#progress .progress-bar').css(
                            'width',
                            progress + '%'
                        );
                    }
                }).prop('disabled', !$.support.fileInput)
                    .parent().addClass($.support.fileInput ? undefined : 'disabled');
            });
        });
        $(this.$el).on('hidden.bs.modal', function (e) {
            $('#fileupload').fileupload('destroy');
            $(this).remove();
            $('.modal-backdrop').remove();
            appendEnvImages(env_id);
        });
    },
    toggleCheckFriend: function(){
        $(this.el).remove();
    },
    render: function() {
        $(this.el).html(this.template(this.model.attributes));
        return this;
    },
    events: {
        "submit form": "doMethod"
    },
    doMethod: function(e){

        e.preventDefault();
    },

});

var DeleteEnvImageView = Backbone.View.extend({
    id: 'modalDeleteEnvImage',
    className: "modal fade",
    model: DeleteEnvImageModel,
    template: _.template($("#delete_env_image_template").html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
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
    },
    doMethod: function(e){
        deleteEnvImage(this.model.get("env_image_id"));
        this.$el.modal('hide');
        e.preventDefault();
    },

});

var DeleteEnvView = Backbone.View.extend({
    id: 'modalDeleteEnv',
    className: "modal fade",
    model: DeleteEnvImageModel,
    template: _.template($("#delete_env_template").html()),
    initialize: function() {
        _.bindAll(this, 'show', 'teardown', 'render');
        this.render();
    },
    show: function(){
        this.$el.modal('show');
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
    },
    doMethod: function(e){
        e.preventDefault();
        deleteEnv(this.model.get("env_id"));
        //this.$el.modal('hide');
    },

});