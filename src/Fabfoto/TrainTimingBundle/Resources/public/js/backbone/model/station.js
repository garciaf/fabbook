// Station Model
// ----------
// Our basic **Station** model has `name`, `x`, 'y', `done` attributes.
var Station = Backbone.Model.extend({
    name: function() {},
    code: function() {},
    x: function() {},
    y: function() {},
    defaults: function() {
        return {
            name: "station",
            code: "AAA",
            x: 0,
            y: 0
        };
    },
    initialize: function() {},
    clear: function() {
        this.destroy();
    }
}), PropertiesStation = Backbone.Model.extend({
    initialize: function() {},
    map: function(a) {
        return a ? this.set("map", a) : this.get("map");
    }
}), propertiesStation = new PropertiesStation, StationList = Backbone.Collection.extend({
    map: function(a) {
        return propertiesStation.map(a);
    },
    model: Station,
    url: Routing.generate("liste_gare"),
    initialize: function(a) {
        var b = this;
        $.getJSON(b.url, function(a) {
            $.each(a, function(a, c) {
                station = new Station, station.set("name", c.name), station.set("code", c.code_ddg), station.set("x", c.x), station.set("y", c.y), b.add(station);
            });
        });
    },
    fetch: function(a) {
        $.getJSON(this.url, a);
    },
    updateMap: function() {
        var a = this.map();
        this.fetch(function(b) {
            console.log(b.y), $.each(b, function(b, c) {
                a.addMarker({
                    lat: c.x,
                    lng: c.y,
                    icon: "/bundles/fabfototraintiming/js/backbone/images/steamtrain.png",
                    title: c.name,
                    click: function(a) {
                        InfoStations.codeStation(c.code_ddg), InfoStations.name(c.name), console.log("stationList changed to " + InfoStations.codeStation());
                    }
                });
            });
        });
    },
    locate: function() {
        var a = this.map();
        GMaps.geolocate({
            success: function(b) {
                a.setCenter(b.coords.latitude, b.coords.longitude);
            },
            error: function(a) {
                console.log("Geolocation failed: " + a.message);
            },
            not_supported: function() {
                console.log("Your browser does not support geolocation");
            },
            always: function() {
                console.log("Localization Done!");
            }
        });
    }
}), Stations = new StationList;