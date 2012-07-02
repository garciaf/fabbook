window.MenuView = Backbone.View.extend({
    el: $("#refresh-button"),
    initialize: function() {},
    events: {
        "click .refresh": "refresh"
    },
    refresh: function(a) {
        a.preventDefault(), console.log("button clicked"), this.collection.refresh();
    },
    error: function(a, b) {
        console.log(a, b);
        return this;
    }
});