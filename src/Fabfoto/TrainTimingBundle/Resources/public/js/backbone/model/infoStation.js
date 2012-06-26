// Station Model
  // ----------

  // Our basic **Station** model has `name`, `x`, 'y', `done` attributes.
  var InfoStation = Backbone.Model.extend({
    name: function(){},
    code: function(){},
    x: function(){},
    y: function(){},
    // Default attributes for the todo item.
    defaults: function() {
      return {
        ligne: "station",
        origdest: "AAA",
        num: 0,
	type: 0,
        picto: 0,
        attribut_voie: "",
        voie: 1,
        etat: 'OK',
        retard: 0,
        estimatedTime: "12"
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
var PropertiesInfoStation = Backbone.Model.extend({
    initialize: function() {
        var me = this; 
        me.codeStation('NTS');
    },
    codeStation: function(code){
        if(code){
            return this.set('codeStation', code);
        }else{
            return this.get('codeStation');
        }
    }, 
    url : function(){
        var me = this; 
        return Routing.generate('liste_timing_station', {"codeGare" : me.codeStation()});
    }
});

var properties = new PropertiesInfoStation();

// Station Collection
  // ---------------

  // The collection of todos is backed by *localStorage* instead of a remote
  // server.
  var InfoStationList = Backbone.Collection.extend({
      
    // Reference to this collection's model.
    model: InfoStation,
    codeStation: function(code){
        return properties.codeStation(code);
    }, 
    url : function(){
        return properties.url();
    },
    clearList: function(){
        this.remove(this.models);
    },
    initialize: function(options) {
        var me = this; 
        $.getJSON(me.url(), function(data) {
        console.log(data);
        $.each(data, function(idx, stationJSON) {
        station = new InfoStation();
        station.set('name', stationJSON.name);
        station.set('code', stationJSON.code_ddg);
        station.set('x', stationJSON.x);
        station.set('y', stationJSON.y);
        me.add(station);
        
//        console.log(x);
        
        
        });
    });
    }
    ,
    fetch: function(callBack){$.getJSON(this.url, callBack);
    },
    refresh: function(){
        this.fetch(function(data){
            
        });
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
            console.log("Localization Done!");
        }
        });
    }

  });
  
  // Create our global collection of **Todos**.
  var InfoStations = new InfoStationList();

  
