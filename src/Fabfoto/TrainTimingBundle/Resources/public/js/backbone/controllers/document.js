var DocumentsController = Backbone.Router.extend({
    routes: {
        "": "map",
        "search/:query": "search",
        "search/:query/p:page": "search"
    },
    initialize: function(a) {
        map = new GMaps({
            div: "#map",
            lat: 48.857035,
            lng: 2.352362
        }), Stations.map(map), Stations.updateMap(), Stations.locate();
        var b = new InfoStationsView({
            collection: InfoStations
        }), c = new MenuView({
            collection: InfoStations
        });
    },
    map: function() {},
    search: function(a, b) {
        alert(a);
    }
});