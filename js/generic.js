function getterID(id) {
    return document.getElementById(id);
}


function makePost(url, params, accepted, error) {
    $.post(url, params).done(accepted).fail(error)
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
