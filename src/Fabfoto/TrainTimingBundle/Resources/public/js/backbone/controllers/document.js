var DocumentsController = Backbone.Router.extend({

  routes: {
    "":                     "map",    // #help
    "search/:query":        "search",  // #search/kiwis
    "search/:query/p:page": "search"   // #search/kiwis/p7
  },
    initialize: function(options) {
    map = new GMaps({
    div: '#map',
    lat: 48.857035,
    lng: 2.352362
    });
    Stations.map(map);
    Stations.updateMap();
    Stations.locate();
    
    var viewDeparture = new InfoStationsView({ collection: InfoStations});
    var viewMenu = new MenuView({collection: InfoStations})
    //viewDeparture.render();


    },
map: function() {
  },
  
  search: function(query, page) {
      alert(query);
  }

});
