$(document).ready(function() {

// AutoComplete.
  var cache = {};
  $( ".autocomplete" ).autocomplete({
    minLength: 1,
    source: function( request, response ) {
      var term = request.term;
      if ( term in cache ) {
        response( cache[ term ] );
        return;
      }
      $.getJSON( "../producto/searchJSON/" + request.term, request, function( data, status, xhr ) {
        cache[ term ] = data;
        response( data );
      });
    },
    select: function (event, ui){
      $(this).parent().find('input[type="hidden"]').val(ui.item.id);      
    }   
  });

});