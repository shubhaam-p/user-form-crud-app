function onclickError(clickid) {
    $('#'+clickid).show();
    $('#submit_error').remove();
}

function onclickLoading(clickid) {
    $('#'+clickid).hide();
    $('<div id="submit_error"><image width="18" height="18" src="../img/loading.gif"/></div>').insertAfter($('#'+clickid));
}

function getXMLString(parameter, valueFn) {
    return `&lt;${parameter}&gt;&lt;![CDATA[${valueFn()}]]&gt;&lt;/${parameter}&gt;`;
}

async function makeAjaxCall({url, method = "GET", data}) {
    return new Promise((resolve, reject) => {
        const ajaxOptions = {
            url: url,
            method: method,
            data: data,
            success: function(data) {
                resolve(JSON.parse(data));
            },
            error: function(error) {
                reject(error);
            },
        };
        $.ajax(ajaxOptions).fail(function(error) {
            reject(error);
        });
    });
}