/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.onReady(function(){
Ext.require([
    'Ext.loader.*',
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.layout.Layout',
    'Ext.panel.*'
]);
 Ext.define('GareModel', {
        extend: 'Ext.data.Model',
        fields: [
            {
                name: 'UID'   
            }, 
            {
                name: 'name'
            }
            , 
            {
                name: 'codeDDG'
                
            },
            {
                name: 'codeQLT'
            
            },
            {
                name: 'codeUIC'
            },
            {
                name: 'x'
            },
            {
                name: 'y'
            },
            {
                name: 'stationType'
            },
            {
                name: 'stationCat'
            }
            ]
    });

var storeGares = Ext.create('Ext.data.JsonStore', {
        model: 'TrainModel',
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
    
    var listViewGare = Ext.create('Ext.grid.Panel', {
        resizable: true,
        width:600,
        height:350,
        collapsible:true,
        title:'Liste Gare',

        store: storeGares,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No images to display'
        },

        columns: [{
            text: 'Nom',
            dataIndex: 'name'
        },{
            text: 'code DDG',
            dataIndex: 'codeDDG'
            
        },{
            text: 'Voie',
            dataIndex: 'voie'
            
        },{
            text: 'X',
            dataIndex: 'x'
            
        }
        ,{
            text: 'Y',
            dataIndex: 'y'
            
        }],
    renderTo: Ext.getBody()
    });    
});