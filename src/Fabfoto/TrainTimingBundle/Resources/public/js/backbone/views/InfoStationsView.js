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
            collectionDepart = new InfoStationList();
            collectionDepart.add(this.collection.where({typeDeparture: 'DEP'}));
            collectionArrival = new InfoStationList();
            collectionArrival.add(this.collection.where({typeDeparture: 'ARR'}));
            
            var renderedContentDeparture = this.template({ infos : collectionDepart.toJSON() });
            var renderedContentArrival = this.template({ infos : collectionArrival.toJSON() });
            console.log(me.el);
            $('#departure').html(renderedContentDeparture);
            $('#arrival').html(renderedContentArrival);
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
            console.log();
            var renderedContent = this.template({ infos : this.collection.where({typeDeparture: true}).toJSON() });
            $('#departure').html(renderedContent);
            $('#arrival').html(renderedContent);
            
            return this;
        }

    });
