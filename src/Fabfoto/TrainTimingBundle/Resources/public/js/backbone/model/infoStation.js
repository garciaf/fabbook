// Station Model
// ----------
// Our basic **Station** model has `name`, `x`, 'y', `done` attributes.
var InfoStation = Backbone.Model.extend({
    name: function() {},
    code: function() {},
    x: function() {},
    y: function() {},
    defaults: function() {
        return {
            ligne: "station",
            origdest: "AAA",
            num: 0,
            typeDeparture: !0,
            picto: 0,
            attribut_voie: "",
            voie: 1,
            etat: "OK",
            retard: 0,
            estimatedTime: "12"
        };
    },
    setTime: function(a) {
        var b = new Date(a);
        this.set("heure", b.format("H:MM"));
    },
    initialize: function() {},
    clear: function() {
        this.destroy();
    }
}), PropertiesInfoStation = Backbone.Model.extend({
    initialize: function() {
        var a = this;
        a.codeStation("NTS");
    },
    codeStation: function(a) {
        return a ? this.set("codeStation", a) : this.get("codeStation");
    },
    name: function(a) {
        return a ? this.set("name", a) : this.get("name");
    },
    url: function() {
        var a = this;
        return Routing.generate("liste_timing_station", {
            codeGare: a.codeStation()
        });
    }
});

_.extend(PropertiesInfoStation, Backbone.Events);

var properties = new PropertiesInfoStation, InfoStationList = Backbone.Collection.extend({
    model: InfoStation,
    codeStation: function(a) {
        properties.codeStation(a), a && this.refresh();
        return properties.codeStation(a);
    },
    name: function(a) {
        return properties.name(a);
    },
    url: function() {
        return properties.url();
    },
    clearList: function() {
        this.remove(this.models);
    },
    initialize: function(a) {
        this.url("NTS");
    },
    fetch: function(a) {
        $.getJSON(this.url(), a), console.log("data-called");
    },
    refresh: function() {
        var a = this;
        this.clearList(), this.fetch(function(b) {
            $.each(b.D, function(b, c) {
                stationDeparture = new InfoStation, stationDeparture.set("voie", c.voie), stationDeparture.set("etat", c.etat), stationDeparture.setTime(c.heure), stationDeparture.set("ligne", c.ligne), stationDeparture.set("typeDeparture", "DEP"), stationDeparture.set("num", c.num), stationDeparture.set("origdest", c.origdest), stationDeparture.set("retard", c.retard), a.add(stationDeparture);
            }), $.each(b.A, function(b, c) {
                stationArrival = new InfoStation, stationArrival.set("voie", c.voie), stationArrival.set("etat", c.etat), stationArrival.setTime(c.heure), stationArrival.set("ligne", c.ligne), stationArrival.set("typeDeparture", "ARR"), stationArrival.set("num", c.num), stationArrival.set("origdest", c.origdest), stationArrival.set("retard", c.retard), a.add(stationArrival), a.trigger("infostation:refresh");
            });
        });
    },
    locate: function(a) {
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
}), InfoStations = new InfoStationList;

InfoStations.on("all", function(a) {
    console.log(a);
});