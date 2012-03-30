if (window.openDatabase) {
    persistence.store.websql.config(persistence, "shoppinglist", 'database', 5 * 1024 * 1024);
} else {
    persistence.store.memory.config(persistence);
}
var Item = persistence.define("Item", {
    name:"TEXT"
});
persistence.schemaSync();
// or, with a callback:
