var $collectionHolder;

// setup an "add a tag" link
var $addAnswerBtn = $('<button type="button" class="btn btn-link btn-sm add_answer_link">Add new answer</button>');
var $newLinkLi = $('<li></li>').append($addAnswerBtn);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of answers
    $collectionHolder = $('ul.answers');

    /*/ add a delete link to all of the existing ans form li elements*/

    $collectionHolder.find('li').each(function() {
        deleteAnswerFormLink($(this));
    });

    // add the "add new answer" anchor and li to the answers ul
    $collectionHolder.append($newLinkLi);
    console.log("ques form js");

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addAnswerBtn.on('click', function(e) {
        // add a new tag form (see next code block)
        addAnswerForm($collectionHolder, $newLinkLi);
    });
});

function addAnswerForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    deleteAnswerFormLink($newFormLi);
    $newLinkLi.before($newFormLi);
}

function deleteAnswerFormLink($answerLi) {
    var $removeFormButton = $('<button class="btn btn-link btn-sm" type="button">Delete this answer</button>');
    $answerLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $answerLi.remove();
    });
}