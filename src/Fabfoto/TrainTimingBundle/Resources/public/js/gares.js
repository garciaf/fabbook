Ext.Loader.setConfig({
    enabled: !0
}), Ext.require([ "Ext.window.*", "Ext.ux.GMapPanel" ]), Ext.define("GareModel", {
    extend: "Ext.data.Model",
    fields: [ {
        type: "string",
        name: "UID"
    }, {
        type: "string",
        name: "name"
    }, {
        type: "string",
        name: "codeDDG"
    }, {
        type: "float",
        name: "x"
    }, {
        type: "float",
        name: "y"
    } ]
});

var storeGares = Ext.create("Ext.data.JsonStore", {
    model: "GareModel",
    proxy: {
        type: "ajax",
        url: Routing.generate("liste_gare"),
        reader: {
            type: "json",
            root: "stations"
        }
    }
}), markersGare = [];

storeGares.load({
    scope: this,
    callback: function(a, b, c) {
        a.forEach(function(a) {
            markersGare.push({
                lat: a.data.x,
                lng: a.data.y,
                title: a.data.name,
                event: "click",
                listener: function(b) {
                    console.log(a.data.codeDDG);
                }
            });
        });
    }
});

var mapGoogle = Ext.create("Ext.ux.GMapPanel", {
    center: {
        geoCodeAddr: "Paris",
        marker: {
            title: "Paris"
        }
    },
    markers: [ markersGare, {
        lat: 42.339419,
        lng: -71.09077,
        title: "Northeastern University"
    } ]
}), loadDataButton = new Ext.Button({
    text: "Refresh",
    handler: function() {
        mapGoogle.addMarkers(markersGare), mapGoogle.getLocation();
    }
});

Ext.onReady(function() {
    Ext.get("show-btn").on("click", function() {
        if (a) a.show(); else var a = Ext.create("Ext.window.Window", {
            autoShow: !0,
            layout: "fit",
            title: "GMap Window",
            closeAction: "hide",
            width: 750,
            height: 750,
            border: !1,
            x: 40,
            y: 60,
            items: [ mapGoogle ],
            dockedItems: [ {
                xtype: "toolbar",
                dock: "top",
                items: [ loadDataButton ]
            } ]
        });
    });
});