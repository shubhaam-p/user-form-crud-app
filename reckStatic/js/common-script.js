function onclickError(clickid) {
    $('#'+clickid).show();
    $('#submit_error').remove();
}

function onclickLoading(clickid, webURL) {
    $('#'+clickid).hide();
    $('<div id="submit_error"><image width="18" height="18" src="'+webURL+'/reckStatic/img/loading.gif"/></div>').insertAfter($('#'+clickid));
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

function redirect(path="/list") {  
    window.location=path; 
} 

async function listUser(userId = '', userDetails = false){  
    let getUser = '';
    if(userDetails && userId != '' && userId ){
        getUser = '&userDetails=true&userId='+userId+'';
    }
    let res = await makeAjaxCall({
        url: `${webURL}/new-cont-reg?action=listUserDetails${getUser}`,
        method: "GET",
        });
    return res;
}


// action - 2- inactive ,  3 - remove package
async function changeUserStatus(userId = 0, action = 0){  
    let nid = userId;
    let remove = 0;
    if(action == 3)
        remove = 1;
    else
        return 'invalid action';
    const actionURL = 'editUserDetails';
    const XML_PARAMETER_NID = "nid";
    const XML_PARAMETER_REMOVE = "remove";
    const queryXML = `<?xml version='1.0'?>`        
    + `<query>`
    + `<action>${actionURL}</action>`
    + getXMLString(XML_PARAMETER_NID, () => nid )
    + getXMLString(XML_PARAMETER_REMOVE, () => remove )
    + `</query>`;

    let res = await makeAjaxCall({
    url: `${webURL}/new-cont-reg`,
    method: "POST",
    data: { xmlData: queryXML, action: actionURL },
    });

    return res;
}
