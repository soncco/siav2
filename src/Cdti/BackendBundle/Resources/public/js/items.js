// Get the div that holds the collection of tags
var collectionHolder = $('tbody.detalles');

// setup an "add a tag" link
var $addTagLink = $('<td colspan="2" class="align-right"><a href="#" class="button"><div class="icon add"></div>Añadir detalle</a></td>');
var $newLinkTd = $('<tr></tr>').append($addTagLink);

jQuery(document).ready(function() {
    // add the "add a tag" anchor and li to the tags ul
    collectionHolder.append($newLinkTd);

    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addTagForm(collectionHolder, $newLinkTd);
    });
    
    /*collectionHolder.find('.autocomplete').each(function() {
        addTagFormDeleteLink($(this));
    });*/
});

function addTagForm(collectionHolder, $newLinkTd) {
    // Get the data-prototype explained earlier
    var prototype = collectionHolder.attr('data-prototype');

    // count the current form inputs we have (e.g. 2), use that as the new index (e.g. 2)
    var newIndex = collectionHolder.find('.autocomplete').length;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, newIndex);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormTd = $('<tr></tr>').append(newForm);
    
    // autoComplete.
    var cache = {};
    $newFormTd.find(".autocomplete").autocomplete({
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
    
    $newLinkTd.before($newFormTd);
    
    addTagFormDeleteLink($newFormTd.find('.autocomplete'));
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#" class="icon_button delete"><div class="icon"></div></a>');
    $tagFormLi.after($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.parent().parent().remove();
    });
}