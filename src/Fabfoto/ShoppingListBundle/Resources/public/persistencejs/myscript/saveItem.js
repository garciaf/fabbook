function saveItem(){
    var item = new Item();
    
    item.name = jQuery("#fabfoto_shoppinglistbundle_itemtype_name").val();
    
    persistence.add(item);
    persistence.flush();
    displayLocallyItem();
}

function editItem(){
    var item = new Item();
    item.name = jQuery("#fabfoto_shoppinglistbundle_itemtype_name").val();
    item.id = jQuery("#ItemRemoteId").val();
    persistence.add(item);
    persistence.flush();
    displayLocallyItem();
}
function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    return out;
}
function displayLocallyItem(){
    var itemsCollection = Item.all();
        jQuery("#listLocal").empty();
    itemsCollection.list('', function(items){
        items.forEach(function(item){
        writeToTheDomItem(item.toJSON());
        });
    });
}; 

function refreshDomListItem($objects){
    var content = '<li data-corners="false" data-shadow="false" data-iconshadow="true" data-inline="false" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="index.html" class="ui-link-inherit">'+$object.name+'</a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div></li>';
    jQuery("#listLocal").append(content);
}

function writeToTheDomItem($object){
    var content = '<li data-corners="false" data-shadow="false" data-iconshadow="true" data-inline="false" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c" class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-c"><div class="ui-btn-inner ui-li"><div class="ui-btn-text"><a href="index.html" class="ui-link-inherit">'+$object.name+'</a></div><span class="ui-icon ui-icon-arrow-r ui-icon-shadow"></span></div></li>';
    jQuery("#listLocal").append(content);
}
function removeAllEntry(){
    var itemsCollection = Item.all();
    itemsCollection.list('', function(items){
        items.forEach(function(item){
        persistence.remove(item);
        });
        persistence.flush();
    });
}

function sendStoreData(){
        var itemsCollection = Item.all();
        jQuery("#listLocal").empty();
    itemsCollection.list('', function(items){
        items.forEach(function(item){
            synchronizeToServer(item.toJSON());
            persistence.remove(item);
        });
        persistence.flush();
    });
}
