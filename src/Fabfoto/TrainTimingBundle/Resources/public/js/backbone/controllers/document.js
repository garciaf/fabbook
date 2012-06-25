var DocumentsController = Backbone.Router.extend({

  routes: {
    "":                     "map",    // #help
    "search/:query":        "search",  // #search/kiwis
    "search/:query/p:page": "search"   // #search/kiwis/p7
  },

  map: function() {
    new GMaps({
    div: '#map',
    lat: -12.043333,
    lng: -77.028333
    });
  },

  search: function(query, page) {
      alert(query);
  }

});
