/**
 * @class Ext.ux.GMapPanel
 * @extends Ext.Panel
 * @author Shea Frederick
 */Ext.define("Ext.ux.GMapPanel", {
    extend: "Ext.panel.Panel",
    alias: "widget.gmappanel",
    requires: [ "Ext.window.MessageBox" ],
    initComponent: function() {
        Ext.applyIf(this, {
            plain: !0,
            gmapType: "map",
            border: !1
        }), this.callParent();
    },
    afterFirstLayout: function() {
        var a = this.center;
        this.callParent(), a ? a.geoCodeAddr ? this.lookupCode(a.geoCodeAddr, a.marker) : this.createMap(a) : Ext.Error.raise("center is required");
    },
    createMap: function(a, b) {
        options = Ext.apply({}, this.mapOptions), options = Ext.applyIf(options, {
            zoom: 12,
            center: a,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }), this.gmap = new google.maps.Map(this.body.dom, options), b && this.addMarker(Ext.applyIf(b)), Ext.each(this.markers, this.addMarker, this);
    },
    addMarker: function(a) {
        a = Ext.apply({
            map: this.gmap
        }, a), a.position || (a.position = new google.maps.LatLng(a.lat, a.lng));
        var b = new google.maps.Marker(a);
        Ext.Object.each(a.listeners, function(a, c) {
            google.maps.event.addListener(b, a, c);
        });
        return b;
    },
    addMarkers: function(a) {
        var b = this;
        a.forEach(function(a) {
            var c = new google.maps.LatLng(a.lat, a.lng), d = new google.maps.Marker({
                position: c,
                map: b.gmap,
                title: a.title
            });
            google.maps.event.addListener(d, a.event, a.listener);
        });
    },
    setCenter: function(a) {
        var b = this;
        b.gmap.setCenter(a);
    },
    lookupCode: function(a, b) {
        this.geocoder = new google.maps.Geocoder, this.geocoder.geocode({
            address: a
        }, Ext.Function.bind(this.onLookupComplete, this, [ b ], !0));
    },
    onLookupComplete: function(a, b, c) {
        b != "OK" ? Ext.MessageBox.alert("Error", 'An error occured: "' + b + '"') : this.createMap(a[0].geometry.location, c);
    },
    afterComponentLayout: function(a, b) {
        this.callParent(arguments), this.redraw();
    },
    redraw: function() {
        var a = this.gmap;
        a && google.maps.event.trigger(a, "resize");
    },
    getLocation: function() {
        var a = this.gmap;
        navigator.geolocation && navigator.geolocation.getCurrentPosition(function(b) {
            pos = new google.maps.LatLng(b.coords.latitude, b.coords.longitude), a.panTo(pos);
        });
    }
});