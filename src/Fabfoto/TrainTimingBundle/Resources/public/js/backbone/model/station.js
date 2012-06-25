// Station Model
  // ----------

  // Our basic **Station** model has `name`, `x`, 'y', `done` attributes.
  var Station = Backbone.Model.extend({
    name: function(){},
    code: function(){},
    x: function(){},
    y: function(){},
    
    // Default attributes for the todo item.
    defaults: function() {
      return {
        name: "station",
        code: "AAA",
        x: 0,
	y: 0
      };
    },

    // Ensure that each todo created has `title`.
    initialize: function() {
     
    },

    // Remove this Todo from *localStorage* and delete its view.
    clear: function() {
      this.destroy();
    }

  });

// Todo Collection
  // ---------------

  // The collection of todos is backed by *localStorage* instead of a remote
  // server.
  var StationList = Backbone.Collection.extend({

    // Reference to this collection's model.
    model: Station,
    // 
    url : Routing.generate('liste_gare'),
    initialize: function(options) {
            options || (options = {});
            this.date = options.date;
          },
    // Save all of the todo items under the `"todos"` namespace.
    localStorage: new Store("stations-backbone")

  });

  // Create our global collection of **Todos**.
  var Stations = new StationList();

  
