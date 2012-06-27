var DocumentsController = Backbone.Router.extend({

  routes: {
    "":                     "map",    // #help
    "search/:query":        "search",  // #search/kiwis
    "search/:query/p:page": "search"   // #search/kiwis/p7
  },

  map: function() {
    map = new GMaps({
    div: '#map',
    lat: 48.857035,
    lng: 2.352362
    });
    Stations.map(map);
    Stations.updateMap();
    Stations.locate();
  },
  
  search: function(query, page) {
      alert(query);
  }

});
