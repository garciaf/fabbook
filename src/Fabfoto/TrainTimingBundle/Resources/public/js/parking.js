function pctChange(a) {
    return a >= 50 ? '<span style="color:green;">' + a + " %</span>" : a <= 30 ? '<span style="color:red;">' + a + " %</span>" : "<span>" + a + " %</span>";
}

function calculPercent(a, b) {
    freePlace = b.data.Grp_disponible, nbPlace = b.data.Grp_exploitation, percent = Math.round(freePlace / nbPlace * 100);
    return percent;
}

Ext.Loader.setConfig({
    enabled: !0
}), Ext.Loader.setPath("Ext.ux", "js/ux"), Ext.require([ "Ext.loader.*", "Ext.grid.*", "Ext.data.*", "Ext.layout.Layout", "Ext.panel.*", "Ext.form.field.ComboBox", "Ext.form.FieldSet", "Ext.tip.QuickTipManager", "Ext.ux.GMapPanel", "Ext.window.*" ]), Ext.define("ParkingPlaceModel", {
    extend: "Ext.data.Model",
    fields: [ {
        type: "integer",
        name: "id"
    }, {
        type: "string",
        name: "name"
    }, {
        type: "float",
        name: "longitude"
    }, {
        type: "float",
        name: "latitude"
    }, {
        type: "string",
        name: "category.name"
    } ]
});

var storePlaceParking = Ext.create("Ext.data.JsonStore", {
    model: "ParkingPlaceModel",
    proxy: {
        type: "ajax",
        url: Routing.generate("place_list"),
        reader: {
            type: "json"
        }
    }
}), mapGoogle = Ext.create("Ext.ux.GMapPanel", {
    height: 400,
    center: {
        geoCodeAddr: "Nantes",
        marker: {
            title: "Nantes"
        }
    },
    markers: []
}), markerPublic = [];

storePlaceParking.load({
    scope: this,
    callback: function(a, b, c) {
        a.forEach(function(a) {
            markerPublic = {
                lat: a.data.latitude,
                lng: a.data.longitude,
                title: a.data.name,
                listeners: {
                    click: function(a) {}
                }
            }, markerGoogle = mapGoogle.addMarker(markerPublic);
        });
    }
}), Ext.define("ParkingModel", {
    extend: "Ext.data.Model",
    fields: [ {
        type: "integer",
        name: "Grp_identifiant"
    }, {
        type: "string",
        name: "Grp_nom"
    }, {
        type: "integer",
        name: "Grp_disponible"
    }, {
        type: "integer",
        name: "Grp_exploitation"
    }, {
        type: "string",
        name: "Grp_horodatage"
    }, {
        type: "integer",
        name: "IdObj"
    }, {
        name: "percent",
        convert: calculPercent
    } ]
});

var storeParking = Ext.create("Ext.data.JsonStore", {
    model: "ParkingModel",
    proxy: {
        type: "ajax",
        url: Routing.generate("list_parking_free"),
        reader: {
            type: "json",
            root: "opendata.answer.data.Groupes_Parking.Groupe_Parking"
        }
    }
});

storeParking.load();

var refreshButton = new Ext.Button({
    text: "Refresh",
    iconCls: "x-tbar-loading",
    handler: function() {
        storeParking.load();
    }
}), listViewParking = Ext.create("Ext.grid.Panel", {
    resizable: !1,
    collapsible: !1,
    title: "Liste des parkings",
    height: 200,
    store: storeParking,
    multiSelect: !1,
    viewConfig: {
        emptyText: "Pas d'information disponible"
    },
    columns: [ {
        text: "Id",
        dataIndex: "IdObj",
        width: 100
    }, {
        text: "Nom parking",
        dataIndex: "Grp_nom",
        width: 300
    }, {
        text: "Nombre de place libre",
        dataIndex: "Grp_disponible",
        width: 200
    }, {
        text: "Nombre de place",
        dataIndex: "Grp_exploitation",
        width: 200
    }, {
        text: " % disponible",
        dataIndex: "percent",
        renderer: pctChange,
        width: 200
    }, {
        text: "Mis à jour",
        dataIndex: "Grp_horodatage",
        width: 200
    } ],
    dockedItems: [ {
        xtype: "toolbar",
        dock: "top",
        items: [ refreshButton ]
    } ]
});

Ext.onReady(function() {
    var a = Ext.create("Ext.Viewport", {
        layout: "border",
        title: "Ext Layout Browser",
        items: [ {
            xtype: "box",
            id: "header",
            html: "<h1>Where can I park my car in Nantes?</h1>",
            region: "north",
            height: "5%"
        }, {
            layout: "border",
            id: "layout-depart",
            region: "center",
            split: !0,
            border: !1,
            width: 500,
            minSize: 100,
            maxSize: 600,
            items: [ listViewParking ]
        }, {
            xtype: "panel",
            id: "layout-footer",
            collapsible: !0,
            title: "Where is the parking ?",
            region: "south",
            height: "30%",
            width: "100%",
            items: [ mapGoogle ]
        } ],
        renderTo: Ext.getBody()
    }), b = new Ext.LoadMask(a, {
        msg: "Please wait...",
        store: storePlaceParking
    }), b = new Ext.LoadMask(a, {
        msg: "Please wait...",
        store: storeParking
    });
});