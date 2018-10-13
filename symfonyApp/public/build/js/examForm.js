var $collectionHolder;

// setup an "add ques" link
var $addQuestionBtn = $('<button type="button" class="btn btn-link btn-sm add_question_link">Add new question</button>');
var $newLinkLi = $('<li></li>').append($addQuestionBtn);
var liId;

jQuery(document).ready(function() {
    // Get the ul that holds the collection of answers
    $collectionHolder = $('ul.questions');

    /*/ add a delete link to all of the existing ans form li elements*/

    $collectionHolder.find('li').each(function() {
        deleteQuestionFormLink($(this));
    });

    // add the "add new answer" anchor and li to the answers ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addQuestionBtn.on('click', function(e) {
        // add a new tag form (see next code block)
        addQuestionForm($collectionHolder, $newLinkLi);
    });
});

function addQuestionForm($collectionHolder, $newLinkLi) {
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
    var indexQ = newForm.match(/\d+/)[0];
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append("Question " + indexQ.toString() ).append(newForm);
    deleteQuestionFormLink($newFormLi);
    $newLinkLi.before($newFormLi);
    // get the id of field select to add ajax
    var eleId = $($newFormLi[0].firstElementChild).attr('id') + "_category";

    console.log($(this).closest('form'));
}

function deleteQuestionFormLink($questionLi) {
    var $removeFormButton = $('<button class="btn btn-link btn-sm" type="button">Delete this question</button>');
    $questionLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $questionLi.remove();
    });
}