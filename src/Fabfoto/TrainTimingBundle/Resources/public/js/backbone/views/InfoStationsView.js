   window.InfoStationsView = Backbone.View.extend({
        el : '#departure',

        initialize : function() {
            this.template = _.template($('#info-station-collection-template').html());

            /*--- binding ---*/
            _.bindAll(this, 'render');
            this.collection.bind('infostation:refresh', this.render);
            /*---------------*/

        },

        render : function() {
            var me = this;
            nameStation = this.collection.name();
            collectionDepart = new InfoStationList();
            collectionDepart.add(this.collection.where({typeDeparture: 'DEP'}));
            collectionArrival = new InfoStationList();
            collectionArrival.add(this.collection.where({typeDeparture: 'ARR'}));
            $('#title-station').html(nameStation);
            var renderedContentDeparture = this.template({ infos : collectionDepart.toJSON() });
            var renderedContentArrival = this.template({ infos : collectionArrival.toJSON() });
            $('#departure').html(renderedContentDeparture);
            $('#arrival').html(renderedContentArrival);
            return this;
        }

    });

