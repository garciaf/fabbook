Ext.Loader.setConfig({
    enabled: true
});
Ext.require([
    'Ext.window.*',
    'Ext.ux.GMapPanel'
    ]);

// Define the model for a State
Ext.define('GareModel', {
    extend: 'Ext.data.Model',
    fields: [
    {
        type: 'string', 
        name: 'UID'
    },

    {
        type: 'string', 
        name: 'name'
    },

    {
        type: 'string', 
        name: 'codeDDG'
    },

    {
        type: 'float' , 
        name: 'x'
    }, 

    {
        type: 'float' , 
        name: 'y'
    }
    ]
});
var storeGares = Ext.create('Ext.data.JsonStore', {
    model: 'GareModel',
    proxy: {
        type: 'ajax',
        url: Routing.generate('liste_gare'),
        reader: {
            type: 'json',
            root: 'stations'
        }
    }
});

var markersGare = [];
storeGares.load(
{
    scope: this,
    callback: function(records, operation, success) {
        // the operation object
        // contains all of the details of the load operation
        records.forEach(function(gare){
            markersGare.push({
                lat: gare.data.x,
                lng: gare.data.y,
                title: gare.data.name,
                event: 'click',
                listener: function(e){
                    console.log(gare.data.codeDDG);
                }
            });
        });
    }
});
var mapGoogle = Ext.create('Ext.ux.GMapPanel', {
    center: {
        geoCodeAddr: 'Paris',
        marker: {
            title: 'Paris'
        }
    },
    markers: [markersGare,{
                        lat: 42.339419,
                        lng: -71.09077,
                        title: 'Northeastern University'
                    }]
});

var loadDataButton = new Ext.Button({
    text:"Refresh",
    handler: function() {
        mapGoogle.addMarkers(markersGare);
        mapGoogle.getLocation();
    }
});

Ext.onReady(function(){




    Ext.get('show-btn').on('click', function() {
        // create the window on the first click and reuse on subsequent clicks
        if(mapwin) {
            mapwin.show();
        } else {
            var mapwin = Ext.create('Ext.window.Window', {
                autoShow: true,
                layout: 'fit',
                title: 'GMap Window',
                closeAction: 'hide',
                width:750,
                height:750,
                border: false,
                x: 40,
                y: 60,
                items: [mapGoogle],
                dockedItems: [{
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [loadDataButton]
                }]
                
            });       

        }
    });

            
});