// Station Model
  // ----------

  // Our basic **Station** model has `name`, `x`, 'y', `done` attributes.
  var Station = Backbone.Model.extend({
    name: function(){},
    code: function(){},
    x: function(){},
    y: function(){},
    
    // Default attributes for the todo item.
    defaults: function() {
      return {
        name: "station",
        code: "AAA",
        x: 0,
	y: 0
      };
    },

    // Ensure that each todo created has `title`.
    initialize: function() {
     
    },

    // Remove this Todo from *localStorage* and delete its view.
    clear: function() {
      this.destroy();
    }

  });

// Station Collection
  // ---------------

  // The collection of todos is backed by *localStorage* instead of a remote
  // server.
  var StationList = Backbone.Collection.extend({

    // Reference to this collection's model.
    model: Station,
    // 
    url : Routing.generate('liste_gare'),
    initialize: function(options) {
        var me = this; 
        $.getJSON(me.url, function(data) {
        
        $.each(data, function(idx, stationJSON) {
        station = new Station();
        station.set('name', stationJSON.name);
        station.set('code', stationJSON.code_ddg);
        station.set('x', stationJSON.x);
        station.set('y', stationJSON.y);
        me.add(station);
        
//        console.log(x);
        });
        
        });
    },
    fetch: function(callBack){$.getJSON(this.url, callBack);
    },
    updateMap: function(map){
        this.fetch(function(data){
            console.log(data.y);
            $.each(data, function(idx, stationJSON) {
            map.addMarker({
            lat: stationJSON.x,
            lng: stationJSON.y,
            title: stationJSON.name,
            click: function(e) {
                console.log('You clicked on '+stationJSON.name);
            }
            });
            });
        });
        //map.createMarker();
        //console.log(map);
    },
    // Save all of the todo items under the `"todos"` namespace.
    //localStorage: new Store("stations-backbone"),
    locate: function(map){
            GMaps.geolocate({
            success: function(position) {
            map.setCenter(position.coords.latitude, position.coords.longitude);
        },
        error: function(error) {
            console.log('Geolocation failed: '+error.message);
        },
        not_supported: function() {
            console.log("Your browser does not support geolocation");
        },
        always: function() {
            console("Localization Done!");
        }
        });
    }

  });
  
  // Create our global collection of **Todos**.
  var Stations = new StationList();

  
