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
	typeDeparture: true,
        picto: 0,
        attribut_voie: "",
        voie: 1,
        etat: 'OK',
        retard: 0,
        estimatedTime: "12"
      };
    },
    setTime: function(time){
        var date = new Date(time);
        this.set('heure', date.format('H:MM'));
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
    name: function(name){
        if(name){
            return this.set('name', name);
        }else{
            return this.get('name');
        }
    },
    url : function(){
        var me = this; 
        return Routing.generate('liste_timing_station', {"codeGare" : me.codeStation()});
    }
});

    _.extend(PropertiesInfoStation, Backbone.Events);
    
var properties = new PropertiesInfoStation();


// Station Collection
  // ---------------

  // The collection of todos is backed by *localStorage* instead of a remote
  // server.
  var InfoStationList = Backbone.Collection.extend({
    
    // Reference to this collection's model.
    model: InfoStation,
    codeStation: function(code){
        properties.codeStation(code)
        if(code){
            this.refresh();    
        }
        return properties.codeStation(code);
    }, 
    name: function(name){
        return properties.name(name)
    }, 
    url : function(){
        return properties.url();
    },
    clearList: function(){
        this.remove(this.models);
    },
    initialize: function(options) {
        this.url("NTS");
    }
    ,
    fetch: function(callBack){$.getJSON(this.url(), callBack);
        console.log('data-called');
    },
    refresh: function(){
        var me = this; 

        this.clearList();

        this.fetch(function(data){
        $.each(data.D, function(idx, stationJSON) {
        stationDeparture = new InfoStation();
        stationDeparture.set('voie', stationJSON.voie);
        stationDeparture.set('etat', stationJSON.etat);
        stationDeparture.setTime(stationJSON.heure);
        stationDeparture.set('ligne', stationJSON.ligne);
        stationDeparture.set('typeDeparture', 'DEP');
        stationDeparture.set('num', stationJSON.num);
        stationDeparture.set('origdest', stationJSON.origdest);
        stationDeparture.set('retard', stationJSON.retard);
        me.add(stationDeparture);

        });
        $.each(data.A, function(idx, stationJSON) {
        stationArrival = new InfoStation();
        stationArrival.set('voie', stationJSON.voie);
        stationArrival.set('etat', stationJSON.etat);
        stationArrival.setTime(stationJSON.heure);
        stationArrival.set('ligne', stationJSON.ligne);
        stationArrival.set('typeDeparture', 'ARR');
        stationArrival.set('num', stationJSON.num);
        stationArrival.set('origdest', stationJSON.origdest);
        stationArrival.set('retard', stationJSON.retard);
        me.add(stationArrival);
        me.trigger('infostation:refresh');
        });
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
InfoStations.on("all", function(eventName) {
  console.log(eventName);
});