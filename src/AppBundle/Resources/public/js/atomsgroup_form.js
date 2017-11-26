var $collectionHolder;

// setup an "add a tag" link
var $addAtomLink = $('<a href="#" class="add_atoms_link btn btn-default btn-primary btn-sm"><span class="glyphicon glyphicon-plus"> </span> Add an atom</a>');
var $newLinkLi = $('<li class="adder-li"></li>').append($addAtomLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.tags');

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('li').each(function() {
        addAtomFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addAtomLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see next code block)
        addAtomForm($collectionHolder, $newLinkLi);
    });
    $(".AGAdder").click(function() {
        $("form[name='atoms_group']").submit();
    });
});

function addAtomForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);

    // add a delete link to the new form
    addAtomFormDeleteLink($newFormLi);
}

function addAtomFormDeleteLink($tagFormLi) {
    var $removeFormA = $('<a href="#"><span class="glyphicon glyphicon-trash pull-right"> </span></a>');
    $tagFormLi.prepend($removeFormA);

    $removeFormA.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $tagFormLi.remove();
    });
}