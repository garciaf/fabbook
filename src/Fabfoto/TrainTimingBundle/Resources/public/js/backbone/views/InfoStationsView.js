window.InfoStationsView = Backbone.View.extend({
    el: "#departure",
    initialize: function() {
        this.template = _.template($("#info-station-collection-template").html()), _.bindAll(this, "render"), this.collection.bind("infostation:refresh", this.render);
    },
    render: function() {
        var a = this;
        nameStation = this.collection.name(), collectionDepart = new InfoStationList, collectionDepart.add(this.collection.where({
            typeDeparture: "DEP"
        })), collectionArrival = new InfoStationList, collectionArrival.add(this.collection.where({
            typeDeparture: "ARR"
        }));
        var b = this.template({
            infos: collectionDepart.toJSON()
        }), c = this.template({
            infos: collectionArrival.toJSON()
        });
        $("#departure").html(b), $("#arrival").html(c), $("#title-station").html(nameStation);
        return this;
    }
});