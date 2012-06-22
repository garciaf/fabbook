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
    'Ext.Date.*'
    
]);


    // Define the model for a State
    Ext.define('GareModel', {
        extend: 'Ext.data.Model',
        fields: [
            {type: 'float', name: 'x'},
            {type: 'float', name: 'y'},
            {type: 'string', name: 'uid'},
            {type: 'string', name: 'name'},
            {type: 'string', name: 'code_ddg'}
        ]
    });
    var storeGares = Ext.create('Ext.data.JsonStore', {
        model: 'GareModel',
        proxy: {
            type: 'ajax',
            url: Routing.generate('liste_gare'),
            reader: {
                type: 'json'
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
    var markerGare = [];
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
                        changeStation(gare.data.code_ddg, gare.data.name);
                        center = new google.maps.LatLng(gare.data.x, gare.data.y);
                        //mapGoogle.setCenter(center);
                        }
                    }
                };
                markerGoogle = mapGoogle.addMarker(markerGare);
                
            });
        }
    });
    
    var myPositionButton = new Ext.Button({
    text:"Geolocalization",
    handler: function() {
        mapGoogle.getLocation();
        }
    });
    
    var simpleCombo = Ext.create('Ext.form.field.ComboBox', {
        fieldLabel: 'Select station',
        displayField: 'name',
        valueField: 'code_ddg',
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
            remoteSort: false
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
        listViewDepart.setTitle('<b>'+nameGare.charAt(0).toUpperCase()+nameGare.slice(1).toLowerCase()+'</b>');
        listViewArrive.setTitle('<b>'+nameGare.charAt(0).toUpperCase()+nameGare.slice(1).toLowerCase()+'</b>');
    }

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
    var listViewArrive = Ext.create('Ext.grid.Panel', {
        resizable: false,
        collapsible:false,
        height: 200,
        autoScroll: true,
        title:'Liste arrivé',
        store: storeArrive,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },
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
        resizable: false,
        collapsible:false,
        title:'Liste depart',
        height: 200,
        autoScroll: true,
        store: storeDepart,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },
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
                iconCls: 'x-tbar-loading',
                text: 'Resfresh',
                handler: function(){
                    // empty record
                    storeDepart.load();
                    storeArrive.load();
                }
            }]}]
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
            height: '5%',
            html: '<h1>When is my train ?</h1>'
        },{
            layout: 'border',
            id: 'layout-depart',
            title: 'Departure',
            region:'west',
            split: false,
            border: false,
            width: "50%",
            minSize: 100,
            items: [listViewDepart]
        },
        {
            layout: 'border',
            id: 'layout-arrive',
            title: 'Arrival',
            region:'center',
            split: false,
            border: false,
            width: "50%",
            minSize: 100,
            items: [listViewArrive]    
        },{
            xtype: 'panel',
            id: 'layout-footer',
            collapsible: true,
            title: 'Where is the station ?',
            region: 'south',
            height: '50%',
            width: '100%',
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
