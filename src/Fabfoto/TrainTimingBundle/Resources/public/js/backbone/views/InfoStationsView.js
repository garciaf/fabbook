   window.InfoStationsView = Backbone.View.extend({
        el : $('#departure'),

        initialize : function() {
            this.template = _.template($('#info-station-collection-template').html());

            /*--- binding ---*/
            _.bindAll(this, 'render');
            this.collection.bind('infostation:refresh', this.render);
            /*---------------*/

        },

        render : function() {
            var me = this;
            var renderedContent = this.template({ infos : this.collection.toJSON() });
            console.log(me.el);
            $('#departure').html(renderedContent);
            return this;
        }

    });
   window.InfoStationsArrivalView = Backbone.View.extend({
        el : $('#arrival'),

        initialize : function() {
            this.template = _.template($('#info-station-collection-template').html());

            /*--- binding ---*/
            _.bindAll(this, 'render');
            this.collection.bind('infostation:refresh', this.render);
            /*---------------*/

        },

        render : function() {
            var me = this;
            var renderedContent = this.template({ infos : this.collection.toJSON() });
            console.log(me.el);
            $('#departure').html(renderedContent);
            return this;
        }

    });
