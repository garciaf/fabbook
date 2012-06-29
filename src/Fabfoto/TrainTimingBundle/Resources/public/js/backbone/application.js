var App = {
    Views: {},
    Controllers: {},
    init: function() {
        new DocumentsController();
        Backbone.history.start();
    }
};
