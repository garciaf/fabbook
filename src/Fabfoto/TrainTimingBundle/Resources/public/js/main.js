Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', 'js/ux');
Ext.require([
    'Ext.loader.*',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.layout.Layout',
    'Ext.panel.*',
    'Ext.form.field.ComboBox',
    'Ext.form.FieldSet',
    'Ext.tip.QuickTipManager',
    'Ext.window.*',
    'Ext.ux.GMapPanel'
    
]);


    // Define the model for a State
    Ext.define('GareModel', {
        extend: 'Ext.data.Model',
        fields: [
            {type: 'float', name: 'x'},
            {type: 'float', name: 'y'},
            {type: 'string', name: 'UID'},
            {type: 'string', name: 'name'},
            {type: 'string', name: 'codeDDG'}
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


    var displayMapButton = new Ext.Button({
    text:"Refresh",
    handler: function() {
        mapwin.show();
        }
    });

    var mapGoogle = Ext.create('Ext.ux.GMapPanel', {
    height: 400,
    center: {
        geoCodeAddr: 'Paris',
        marker: {
            title: 'Paris'
        }
    },
    markers: []
});
    var loadDataButton = new Ext.Button({
    text:"Load",
    handler: function() {
        mapGoogle.addMarkers(markersGare);
        }
    });
    var myPositionButton = new Ext.Button({
    text:"Geolocalization",
    handler: function() {
        mapGoogle.getLocation();
        }
    });
   
    var simpleCombo = Ext.create('Ext.form.field.ComboBox', {
        fieldLabel: 'Select a single state',
        displayField: 'name',
        valueField: 'codeDDG',
        width: 320,
        labelWidth: 130,
        store: storeGares,
        queryMode: 'local',
        typeAhead: true
    });
    Ext.define('TrainModel', {
        extend: 'Ext.data.Model',
        fields: [
            {
                name: 'ligne'   
            }, 
            {
                name: 'origdest'
            }
            , 
            {
                name: 'num'
                
            },
            {
                name: 'type'
            
            },
            {
                name: 'picto'
            },
            {
                name: 'attribut_voie'
            },
            {
                name: 'voie'
            },
            {
                name: 'heure'
            },
            {
                name: 'etat'
            },
            {
                name: 'retard'
            }
            ]
    });
    
    function changeStation(codeGare, nameGare){
                            // empty record
        var old_proxy_arrive = storeArrive.getProxy();
        var old_proxy_depart = storeDepart.getProxy();

        old_proxy_arrive.url = Routing.generate('liste_timing_station', {"codeGare" : codeGare});
        old_proxy_depart.url = Routing.generate('liste_timing_station', {"codeGare" : codeGare});
        storeArrive.load({
            scope: this
        });
        storeDepart.load({
            scope: this
        });
        listViewDepart.setTitle('Liste Depart '+nameGare);
        listViewArrive.setTitle('Liste Arrivé '+nameGare);
    }
    storeGares.load({
            scope: this,
            callback: function(records, operation, success) {
            // the operation object
            // contains all of the details of the load operation
            records.forEach(function(gare){
                markerGare = {
                    lat: gare.data.x,
                    lng: gare.data.y,
                    title: gare.data.name,
                 listeners: {
                    click: function(e){
                        changeStation(gare.data.codeDDG, gare.data.name);
                        center = new google.maps.LatLng(gare.data.x, gare.data.y);
                        mapGoogle.setCenter(center);
                        }
                    }
                };
                markerGoogle = mapGoogle.addMarker(markerGare);
                ;
                

            });
        }
    });
    function newProxy(){
        return Ext.create('Ext.data.proxy.Proxy', {
            type: 'ajax',
            url: Routing.generate('liste_timing_station', {"codeGare" : "AAA"}),
            reader: {
                type: 'json',
                root: 'A'
        }
    });
}
    var storeArrive = Ext.create('Ext.data.JsonStore', {
        model: 'TrainModel',
        proxy: {
            type: 'ajax',
            url: Routing.generate('liste_timing_station', {"codeGare" : "NTS"}),
            reader: {
                type: 'json',
                root: 'A'
            }
        }
    });
    var storeDepart = Ext.create('Ext.data.JsonStore', {
        model: 'TrainModel',
        proxy: {
            type: 'ajax',
            url: Routing.generate('liste_timing_station', {"codeGare" : "NTS"}),
            reader: {
                type: 'json',
                root: 'D'
            }
        }
    });
    storeDepart.load();
    storeArrive.load();
    var listViewArrive = Ext.create('Ext.grid.Panel', {
        resizable: true,
        collapsible:true,
        title:'Liste Arrivé',

        store: storeArrive,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },

        columns: [{
            text: 'ligne',
            dataIndex: 'ligne'
        },{
            text: 'Destination',
            dataIndex: 'origdest'
            
        },{
            text: 'Heure',
            xtype: 'datecolumn',
            format: 'H:i',
            dataIndex: 'heure'
        },{
            text: 'Voie',
            dataIndex: 'voie'
            
        },{
            text: 'Retard',
            dataIndex: 'retard'
            
        }
        ,{
            text: 'Etat',
            dataIndex: 'etat'
            
        }],
     dockedItems: [{
            xtype: 'toolbar',
            items: [simpleCombo,{
                text: 'Change Station',
                handler: function(){
                    changeStation(simpleCombo.getValue(), simpleCombo.getDisplayValue());

                }
            }
        ]}]
    });
    var listViewDepart = Ext.create('Ext.grid.Panel', {
        resizable: true,
        collapsible:true,
        title:'Liste Depart',

        store: storeDepart,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },

        columns: [{
            text: 'ligne',
            dataIndex: 'ligne'
        },{
            text: 'Destination',
            dataIndex: 'origdest'
            
        },{
            text: 'Heure',
            xtype: 'datecolumn',
            format: 'H:i',
            dataIndex: 'heure'
        },{
            text: 'Voie',
            dataIndex: 'voie'
            
        },{
            text: 'Retard',
            dataIndex: 'retard'
            
        }
        ,{
            text: 'Etat',
            dataIndex: 'etat'
            
        }],
     dockedItems: [{
            xtype: 'toolbar',
            items: [{
                text: 'Resfresh',
                handler: function(){
                    // empty record
                    storeDepart.load();
                    storeArrive.load();
                }
            }]}]
    });

    // little bit of feedback
    var refreshButton = new Ext.Button({
    text:"Refresh",
    handler: function() {
       storeArrive.load();
       storeDepart.load();
    }
});

Ext.onReady(function(){

 var Panel = Ext.create('Ext.Viewport', {
        layout: 'border',
        title: 'Ext Layout Browser',
        items: [{
            xtype: 'box',
            id: 'header',
            region: 'north',
            height: 30,
            margins: '0 0 5 0',
            dockedItems: [{
                xtype: 'toolbar',
                dock: 'top',
                items: [displayMapButton]
                }]
        },{
            layout: 'border',
            id: 'layout-arrive',
            region:'west',
            split:true,
            border: false,
            width: "50%",
            minSize: 100,
            items: [listViewArrive ]
        },
        {
            layout: 'border',
            id: 'layout-depart',
            region:'center',
            split:true,
            border: false,
            width: "50%",
            minSize: 100,
            items: [listViewDepart]    
        },{
            xtype: 'panel',
            id: 'layout-footer',
            region: 'south',
            height: 380,
            width: 800,
            items: [mapGoogle],
            dockedItems: [{
                xtype: 'toolbar',
                dock: 'top',
                items: [loadDataButton,myPositionButton]
            }]

        }
        ],
        renderTo: Ext.getBody()
    });

});

