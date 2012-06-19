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
    'Ext.ux.GMapPanel',
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
    console.log(retard);
    if(!isNaN(retard) && retard != ""){
        var hours = parseInt(retard.substring(0,2));
        var minutes = parseInt(retard.substring(2,4));
        dateCalculated = Ext.Date.add(datePlanned, Ext.Date.HOUR, hours);

        console.log(dateCalculated);
    
        dateCalculated = Ext.Date.add(dateCalculated, Ext.Date.MINUTE, minutes);
        
        console.log(dateCalculated);
        
        console.log(dateCalculated);
        datePlanned = dateCalculated;
            console.log (datePlanned);

    }
    return datePlanned;
    
}

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
            },
            
            {name: 'calculated', convert: estimatedTime}
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
        autoScroll : true,
        store: storeArrive,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },

        columns: [{
            text: 'ligne',
            dataIndex: 'ligne',
            width: 20
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
        title:'Liste Depart',
        autoScroll : true,
        store: storeDepart,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No information available'
        },

        columns: [{
            text: 'ligne',
            dataIndex: 'ligne',
            width: 10
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

//Ext.require([
//    'Ext.grid.*',
//    'Ext.data.*',
//    'Ext.util.*',
//    'Ext.state.*'
//]);
//
//// Define Company entity
//// Null out built in convert functions for performance *because the raw data is known to be valid*
//// Specifying defaultValue as undefined will also save code. *As long as there will always be values in the data, or the app tolerates undefined field values*
//Ext.define('Company', {
//    extend: 'Ext.data.Model',
//    fields: [
//       {name: 'company'},
//       {name: 'price',      type: 'float', convert: null,     defaultValue: undefined},
//       {name: 'change',     type: 'float', convert: null,     defaultValue: undefined},
//       {name: 'pctChange',  type: 'float', convert: null,     defaultValue: undefined},
//       {name: 'lastChange', type: 'date',  dateFormat: 'n/j h:ia', defaultValue: undefined}
//    ],
//    idProperty: 'company'
//});
//
//Ext.onReady(function() {
//    Ext.QuickTips.init();
//    
//    // setup the state provider, all state information will be saved to a cookie
//    Ext.state.Manager.setProvider(Ext.create('Ext.state.CookieProvider'));
//
//    // sample static data for the store
//    var myData = [
//        ['3m Co',                               71.72, 0.02,  0.03,  '9/1 12:00am'],
//        ['Alcoa Inc',                           29.01, 0.42,  1.47,  '9/1 12:00am'],
//        ['Altria Group Inc',                    83.81, 0.28,  0.34,  '9/1 12:00am'],
//        ['American Express Company',            52.55, 0.01,  0.02,  '9/1 12:00am'],
//        ['American International Group, Inc.',  64.13, 0.31,  0.49,  '9/1 12:00am'],
//        ['AT&T Inc.',                           31.61, -0.48, -1.54, '9/1 12:00am'],
//        ['Boeing Co.',                          75.43, 0.53,  0.71,  '9/1 12:00am'],
//        ['Caterpillar Inc.',                    67.27, 0.92,  1.39,  '9/1 12:00am'],
//        ['Citigroup, Inc.',                     49.37, 0.02,  0.04,  '9/1 12:00am'],
//        ['E.I. du Pont de Nemours and Company', 40.48, 0.51,  1.28,  '9/1 12:00am'],
//        ['Exxon Mobil Corp',                    68.1,  -0.43, -0.64, '9/1 12:00am'],
//        ['General Electric Company',            34.14, -0.08, -0.23, '9/1 12:00am'],
//        ['General Motors Corporation',          30.27, 1.09,  3.74,  '9/1 12:00am'],
//        ['Hewlett-Packard Co.',                 36.53, -0.03, -0.08, '9/1 12:00am'],
//        ['Honeywell Intl Inc',                  38.77, 0.05,  0.13,  '9/1 12:00am'],
//        ['Intel Corporation',                   19.88, 0.31,  1.58,  '9/1 12:00am'],
//        ['International Business Machines',     81.41, 0.44,  0.54,  '9/1 12:00am'],
//        ['Johnson & Johnson',                   64.72, 0.06,  0.09,  '9/1 12:00am'],
//        ['JP Morgan & Chase & Co',              45.73, 0.07,  0.15,  '9/1 12:00am'],
//        ['McDonald\'s Corporation',             36.76, 0.86,  2.40,  '9/1 12:00am'],
//        ['Merck & Co., Inc.',                   40.96, 0.41,  1.01,  '9/1 12:00am'],
//        ['Microsoft Corporation',               25.84, 0.14,  0.54,  '9/1 12:00am'],
//        ['Pfizer Inc',                          27.96, 0.4,   1.45,  '9/1 12:00am'],
//        ['The Coca-Cola Company',               45.07, 0.26,  0.58,  '9/1 12:00am'],
//        ['The Home Depot, Inc.',                34.64, 0.35,  1.02,  '9/1 12:00am'],
//        ['The Procter & Gamble Company',        61.91, 0.01,  0.02,  '9/1 12:00am'],
//        ['United Technologies Corporation',     63.26, 0.55,  0.88,  '9/1 12:00am'],
//        ['Verizon Communications',              35.57, 0.39,  1.11,  '9/1 12:00am'],
//        ['Wal-Mart Stores, Inc.',               45.45, 0.73,  1.63,  '9/1 12:00am']
//    ];
//
//    /**
//     * Custom function used for column renderer
//     * @param {Object} val
//     */
//    function change(val) {
//        if (val > 0) {
//            return '<span style="color:green;">' + val + '</span>';
//        } else if (val < 0) {
//            return '<span style="color:red;">' + val + '</span>';
//        }
//        return val;
//    }
//
//    /**
//     * Custom function used for column renderer
//     * @param {Object} val
//     */
//    function pctChange(val) {
//        if (val > 0) {
//            return '<span style="color:green;">' + val + '%</span>';
//        } else if (val < 0) {
//            return '<span style="color:red;">' + val + '%</span>';
//        }
//        return val;
//    }
//
//    // create the data store
//    var store = Ext.create('Ext.data.ArrayStore', {
//        model: 'Company',
//        data: myData
//    });
//
//    // create the Grid
//    var grid = Ext.create('Ext.grid.Panel', {
//        store: store,
//        stateful: true,
//        collapsible: true,
//        multiSelect: true,
//        stateId: 'stateGrid',
//        columns: [
//            {
//                text     : 'Company',
//                flex     : 1,
//                sortable : false,
//                dataIndex: 'company'
//            },
//            {
//                text     : 'Price',
//                width    : 75,
//                sortable : true,
//                renderer : 'usMoney',
//                dataIndex: 'price'
//            },
//            {
//                text     : 'Change',
//                width    : 75,
//                sortable : true,
//                renderer : change,
//                dataIndex: 'change'
//            },
//            {
//                text     : '% Change',
//                width    : 75,
//                sortable : true,
//                renderer : pctChange,
//                dataIndex: 'pctChange'
//            },
//            {
//                text     : 'Last Updated',
//                width    : 85,
//                sortable : true,
//                renderer : Ext.util.Format.dateRenderer('m/d/Y'),
//                dataIndex: 'lastChange'
//            },
//            {
//                menuDisabled: true,
//                sortable: false,
//                xtype: 'actioncolumn',
//                width: 50,
//                items: [{
//                    icon   : '../shared/icons/fam/delete.gif',  // Use a URL in the icon config
//                    tooltip: 'Sell stock',
//                    handler: function(grid, rowIndex, colIndex) {
//                        var rec = store.getAt(rowIndex);
//                        alert("Sell " + rec.get('company'));
//                    }
//                }, {
//                    getClass: function(v, meta, rec) {          // Or return a class from a function
//                        if (rec.get('change') < 0) {
//                            this.items[1].tooltip = 'Hold stock';
//                            return 'alert-col';
//                        } else {
//                            this.items[1].tooltip = 'Buy stock';
//                            return 'buy-col';
//                        }
//                    },
//                    handler: function(grid, rowIndex, colIndex) {
//                        var rec = store.getAt(rowIndex);
//                        alert((rec.get('change') < 0 ? "Hold " : "Buy ") + rec.get('company'));
//                    }
//                }]
//            }
//        ],
//        height: 350,
//        width: 600,
//        title: 'Array Grid',
//        renderTo: 'grid-example',
//        viewConfig: {
//            stripeRows: true,
//            enableTextSelection: true
//        }
//    });
//});