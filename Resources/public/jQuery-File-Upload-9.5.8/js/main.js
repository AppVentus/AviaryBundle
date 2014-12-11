/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

function initAviary(options, callback) {
    window.aviaryCallback = callback;
    options = $.extend(
        {'url': window.location.origin + Routing.generate('aviary_upload_image')},
        options
    );

    $('#fileupload').fileupload(
        options
    ).on('fileuploadsubmit', function (e, data) {
        data.formData = data.context.find(':input').serializeArray();
    });
}
