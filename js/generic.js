function getterID(id) {
    return document.getElementById(id);
}


function makePost(url, params, accepted, error) {
    $.post(url, params).done(accepted).fail(error)
}
function makePostFile(url, params, accepted, error) {
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: url,
        data: params,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: accepted,
        error: error
    });
}

function makeGet(url, params, accepted, error) {
    $.get(url, params).done(accepted).fail(error)
}
function initialize(init) {
    $(init());
}

function addListener(id, func) {
    getterID(id).addEventListener("click", func)
}

function findGetParameter(parameterName) {
    var result = null, tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}
