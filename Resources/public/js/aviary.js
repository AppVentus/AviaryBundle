<!-- Instantiate Feather -->

var featherEditor = new Aviary.Feather({
    apiKey: '7419e85d89af316d',
    apiVersion: 3,
    theme: 'dark', // Check out our new 'light' and 'dark' themes!
    tools: ['crop', 'resize', 'enhance', 'blemish'],
    appendTo: '',
    onSave: function(imageID, newURL) {
        postImage(imageID, newURL);
        featherEditor.close();
        return false;
    },
    onError: function(errorObj) {
        alert(errorObj.message);
    },
});
function launchEditor(id, src) {
    featherEditor.launch({
        image: id,
        url: src
    });
    return false;
}

function postImage(imageID, newURL) {
    var fn = $('img#'+imageID).attr('src');
    var date = new Date().getTime();
    var urlJFU = window.location.origin+Routing.generate('aviary_save_image');
    // var urlJFU = window.location.origin + '/bundles/aviary/jQuery-File-Upload-9.5.8/server/php/';
    $.ajax({
        type: 'POST',
        url: urlJFU,
        data: { urlFrom: newURL, urlTo: fn },
    });
}