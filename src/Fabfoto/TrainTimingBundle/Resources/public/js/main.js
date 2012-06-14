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
    'Ext.tip.QuickTipManager'
    
]);


    // Define the model for a State
    Ext.define('GareModel', {
        extend: 'Ext.data.Model',
        fields: [
            {type: 'string', name: 'UID'},
            {type: 'string', name: 'name'},
            {type: 'string', name: 'codeDDG'}
        ]
    });
    var stationFilter = new Ext.util.Filter({
                        property: 'stationType',
                        value   : /\.X/,
                        root: 'stations'
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
    storeGares.load();
    
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
        width:600,
        height:350,
        collapsible:true,
        title:'Liste Arrivé Nantes',

        store: storeArrive,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No images to display'
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
            format: 'm-d h:i a',
            flex: 35,
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
                text: 'Change Station',
                handler: function(){
                    // empty record
                    var old_proxy_arrive = storeArrive.getProxy();
                    var old_proxy_depart = storeDepart.getProxy();

                    old_proxy_arrive.url = Routing.generate('liste_timing_station', {"codeGare" : simpleCombo.getValue()});
                    old_proxy_depart.url = Routing.generate('liste_timing_station', {"codeGare" : simpleCombo.getValue()});
                    storeArrive.load({
                        scope: this
                    });
                    storeDepart.load({
                        scope: this
                    });
                }
            },simpleCombo
        ]}]
    });
    var listViewDepart = Ext.create('Ext.grid.Panel', {
        resizable: true,
        width:600,
        height:350,
        collapsible:true,
        title:'Liste Depart Nantes',

        store: storeDepart,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No images to display'
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
            format: 'm-d h:i a',
            flex: 35,
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
            html: '<h1> When is my Train ?</h1>',
            height: 30
        },{
            layout: 'border',
            id: 'layout-arrive',
            region:'west',
            split:true,
            border: false,
            width: 500,
            minSize: 100,
            maxSize: 500,
            items: [listViewArrive ]
        },
        {
            layout: 'border',
            id: 'layout-depart',
            region:'center',
            split:true,
            border: false,
            width: 500,
            minSize: 100,
            maxSize: 500,    
            items: [listViewDepart]    
        }
        ],
        renderTo: Ext.getBody()
    });
});