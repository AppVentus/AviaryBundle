function launchEditor(id, src, callback) {
    if (typeof callback !== "undefined") {
        window.aviaryCallback = callback;
    }
    featherEditor.launch({
        image: id,
        url: src
    });
    return false;
}

function postImage(imageID, newURL) {
    var image = $('img#'+imageID);
    var fn = image.attr('src');
    var date = new Date().getTime();
    var urlJFU = window.location.origin+Routing.generate('aviary_save_image');

    $.ajax({
        type: 'POST',
        url: urlJFU,
        data: { urlFrom: newURL, urlTo: fn },
    }).done(function(file) {
        if (typeof aviaryCallback !== "undefined") {
            aviaryCallback(file, image)
        }
    });
}

