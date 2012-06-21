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
    'Ext.ux.GMapPanel',
    'Ext.window.*',
    
]);

    // Define the model for a State
    Ext.define('ParkingPlaceModel', {
        extend: 'Ext.data.Model',
        fields: [
            {type: 'integer', name: 'id'},
            {type: 'string', name: 'name'},
            {type: 'float', name: 'longitude'},
            {type: 'float', name: 'latitude'},
            {type: 'string', name: 'category.name'}
        ]
    });
    var storePlaceParking = Ext.create('Ext.data.JsonStore', {
        model: 'ParkingPlaceModel',
        proxy: {
            type: 'ajax',
            url: Routing.generate('place_list'),
            reader: {
                type: 'json'
            }
        }
    });
    
    var mapGoogle = Ext.create('Ext.ux.GMapPanel', {
    height: 400,
    center: {
        geoCodeAddr: 'Nantes',
        marker: {
            title: 'Nantes'
        }
    },
    markers: []
});

    var markerPublic = [];
    storePlaceParking.load({
            scope: this,
            callback: function(records, operation, success) {
            // the operation object
            // contains all of the details of the load operation
            records.forEach(function(parking){
                
                markerPublic = {
                    lat: parking.data.latitude,
                    lng: parking.data.longitude,
                    title: parking.data.name,
                 listeners: {
                    click: function(e){
                        }
                    }
                };
                markerGoogle = mapGoogle.addMarker(markerPublic);
                

            });
        }
    });

    function calculPercent(v, record){
    freePlace = record.data.Grp_disponible;
    nbPlace = record.data.Grp_exploitation;
    percent = Math.round((freePlace/nbPlace)*100);
    return percent;
}
    /**
     * Custom function used for column renderer
     * @param {Object} val
     */
    function pctChange(val) {
        if (val >= 50) {
            return '<span style="color:green;">' + val + ' %</span>';
        } else if (val <= 30) {
            return '<span style="color:red;">' + val + ' %</span>';
        } else {
            return '<span>' + val + ' %</span>';
        }
        return val;
    }

    // Define the model for a State
    Ext.define('ParkingModel', {
        extend: 'Ext.data.Model',
        fields: [
            {type: 'integer', name: 'Grp_identifiant' },
            {type: 'string', name: 'Grp_nom' },
            {type: 'integer', name: 'Grp_disponible'},
            {type: 'integer', name: 'Grp_exploitation'},
            {type: 'string', name: 'Grp_horodatage'},
            {type: 'integer', name: 'IdObj'},
            {name: 'percent', convert: calculPercent}
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
    iconCls: 'x-tbar-loading',
    handler: function() {
       storeParking.load();
    }
});
    var listViewParking = Ext.create('Ext.grid.Panel', {
        resizable: false,
        collapsible:false,
        title:'Liste des parkings',
        height: 200,
        store: storeParking,
        multiSelect: false,
        viewConfig: {
            emptyText: 'Pas d\'information disponible'
        },

        columns: [
        {
            text: 'Id',
            dataIndex: 'IdObj',
            width: 100
        },{
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
            
        }
        ,{
            text: ' % disponible',
            dataIndex: 'percent',
            renderer : pctChange,
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
            html: '<h1>Where can I park my car in Nantes?</h1>',
            region: 'north',
            height: '5%'
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
            xtype: 'panel',
            id: 'layout-footer',
            collapsible: true,
            title: 'Where is the parking ?',
            region: 'south',
            height: '30%',
            width: '100%',
            items: [mapGoogle]

        }
        ],
        
        renderTo: Ext.getBody()
    });
    var myMask = new Ext.LoadMask(Panel, {msg:"Please wait...", store: storePlaceParking});
    var myMask = new Ext.LoadMask(Panel, {msg:"Please wait...", store: storeParking});
});