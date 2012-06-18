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
    
]);


    // Define the model for a State
    Ext.define('ParkingModel', {
        extend: 'Ext.data.Model',
        fields: [
            {type: 'integer', name: 'Grp_identifiant' },
            {type: 'string', name: 'Grp_nom' },
            {type: 'integer', name: 'Grp_disponible'},
            {type: 'integer', name: 'Grp_exploitation'},
            {type: 'string', name: 'Grp_horodatage'}
        ]
    });
    var storeParking = Ext.create('Ext.data.JsonStore', {
        model: 'ParkingModel',
        proxy: {
            type: 'ajax',
            url: Routing.generate('list_parking_free'),
            reader: {
                type: 'json',
                root: 'opendata.answer.data.Groupes_Parking.Groupe_Parking'
            }
        }
    });
    storeParking.load();
    var refreshButton = new Ext.Button({
    text:"Refresh",
    handler: function() {
       storeParking.load();
    }
});
    var listViewParking = Ext.create('Ext.grid.Panel', {
        resizable: true,
        collapsible:true,
        title:'Liste des parkings',

        store: storeParking,
        multiSelect: false,
        viewConfig: {
            emptyText: 'Pas d\'information disponible'
        },

        columns: [{
            text: 'Nom parking',
            dataIndex: 'Grp_nom',
            width: 300
        },{
            text: 'Nombre de place libre',
            dataIndex: 'Grp_disponible',
            width: 200
            
        },{
            text: 'Nombre de place',
            dataIndex: 'Grp_exploitation',
            width: 200
            
        },{
            text: 'Mis à jour',
            dataIndex: 'Grp_horodatage',
            width: 200
        }],
        dockedItems: [{
                xtype: 'toolbar',
                dock: 'top',
                items: [refreshButton]
                }]
    });



Ext.onReady(function(){
 var Panel = Ext.create('Ext.Viewport', {
        layout: 'border',
        title: 'Ext Layout Browser',
        items: [{
            xtype: 'box',
            id: 'header',
            html: '<h1>Where can I park My car ?</h1>',
            region: 'north',
            height: 30
        },{
            layout: 'border',
            id: 'layout-depart',
            region:'center',
            split:true,
            border: false,
            width: 500,
            minSize: 100,
            maxSize: 600,    
            items: [listViewParking]    
        },{
            xtype: 'box',
            id: 'layout-footer',
            region: 'south',
            height: 130

        }
        ],
        renderTo: Ext.getBody()
    });
});