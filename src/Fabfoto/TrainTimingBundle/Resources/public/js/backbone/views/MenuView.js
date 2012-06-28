    window.MenuView = Backbone.View.extend({
        el : $('#refresh-button'),

        initialize : function() {
            //Nothing to do now
        },
        events : {
            'click .refresh' : 'refresh'
        },
        refresh : function(e) {
            e.preventDefault();
            console.log("button clicked");
            this.collection.refresh();
            
        },
        error : function(model, error) {
            console.log(model, error);
            return this;
        }

    });
