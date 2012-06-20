Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '/bundles/fabfototraintiming/js/ux');
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
    'Ext.ux.GMapPanel',
    'Ext.ux.grid.FiltersFeature',
    'Ext.Date.*'
    
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
    function estimatedTime(v, record){
    datePlanned = new Date(record.data.heure);
    retard = record.data.retard;
    if(!isNaN(retard) && retard != ""){
        var hours = parseInt(retard.substring(0,2));
        var minutes = parseInt(retard.substring(2,4));
        dateCalculated = Ext.Date.add(datePlanned, Ext.Date.HOUR, hours);    
        dateCalculated = Ext.Date.add(dateCalculated, Ext.Date.MINUTE, minutes);
        datePlanned = dateCalculated;
    }
    return datePlanned;
    
}




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
    var markersGare = [];
//    var loadDataButton = new Ext.Button({
//    text:"Load",
//    handler: function() {
//        mapGoogle.addMarkers(markersGare);
//        }
//    });
    var myPositionButton = new Ext.Button({
    text:"Geolocalization",
    handler: function() {
        mapGoogle.getLocation();
        }
    });
    var filters = Ext.create('Ext.ux.grid.FiltersFeature',{
        // encode and local configuration options defined previously for easier reuse
        encode: false, // json encode the filter query
        local: true   // defaults to false (remote filtering)

    });
    var simpleCombo = Ext.create('Ext.form.field.ComboBox', {
        fieldLabel: 'Select station',
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
            },
            
            {name: 'calculated', convert: estimatedTime}
            ],
            remoteSort: false,
            pageSize: 15
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
        listViewDepart.setTitle('Liste depart '+nameGare.toLowerCase());
        listViewArrive.setTitle('Liste arrivé '+nameGare.toLowerCase());
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
//    storeDepart.load();
//    storeArrive.load();
    var listViewArrive = Ext.create('Ext.grid.Panel', {
        resizable: true,
        collapsible:true,
        title:'Liste arrivé',
        autoScroll : true,
        store: storeArrive,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },
        feature: [filters],
        columns: [{
            text: 'ligne',
            dataIndex: 'ligne',
            width: 30
        },{
            text: 'Num',
            dataIndex: 'num',
            width: 60
        },{
            text: 'Destination',
            dataIndex: 'origdest',
            filter: {
                type: 'string'
            }
            
        },{
            text: 'Heure',
            xtype: 'datecolumn',
            format: 'H:i',
            dataIndex: 'heure'
        },{
            text: 'Voie',
            dataIndex: 'voie',
            width: 60
        },{
            text: 'Retard',
            dataIndex: 'retard',
            width: 60
        }
        ,{
            text: 'Estimé',
            xtype: 'datecolumn',
            format: 'H:i',
            dataIndex: 'calculated'
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
        title:'Liste depart',
        autoScroll : true,
        store: storeDepart,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },
        feature: [filters],
        columns: [{
            text: 'ligne',
            dataIndex: 'ligne',
            width: 30
        },{
            text: 'Num',
            dataIndex: 'num',
            width: 60
        },{
            text: 'Destination',
            dataIndex: 'origdest',
            filter: {
                type: 'string'
            }
            
        },{
            text: 'Heure',
            xtype: 'datecolumn',
            format: 'H:i',
            dataIndex: 'heure'
        },{
            text: 'Voie',
            dataIndex: 'voie',
            width: 60
            
        },{
            text: 'Retard',
            dataIndex: 'retard',
            width: 60
        },{
            text: 'Estimé',
            xtype: 'datecolumn',
            format: 'H:i',
            dataIndex: 'calculated'
        }
        ,{
            text: 'Etat',
            dataIndex: 'etat'
            
        }],
     dockedItems: [{
            xtype: 'toolbar',
            items: [{
                iconCls: 'resfresh',
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
    changeStation('NTS', 'NANTES');

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
            html: '<h1>When is my train ?</h1>',
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
                items: [myPositionButton]
            }]

        }
        ],
        renderTo: Ext.getBody()
    });
    var myMask = new Ext.LoadMask(Panel, {msg:"Please wait...", store: storeArrive});
    var myMask = new Ext.LoadMask(Panel, {msg:"Please wait...", store: storeGares});

});
