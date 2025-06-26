$(document).ready (function () {  
    delayInSec = 10000;
    
    // user - add review
    $('form[id="addUserForm"]').validate({  
        rules: {  
            name: 'required',
            pwd: 'required',
            dob: 'required',
            emailid: {
                email: true,  
            }
        },  
        messages: {  
            name: 'This field is required',
            pwd: 'This field is required',
            dob: 'This field is required',
            custEmailId: 'Enter a valid email',
        },  
        submitHandler: async function(form) {
            onclickLoading('submitBtn', webURL);
            $('.submit-response-msg').empty()
            $('.submit-response-msg').show();
            // Constants for XML parameters
            const XML_PARAMETER_NAME = "name";
            const XML_PARAMETER_EMAILID = "emailId";
            const XML_PARAMETER_DOB = "dob";
            const XML_PARAMETER_PWD = "pwd";
            const XML_PARAMETER_EDIT = "edit";
            const XML_PARAMETER_NID = "nid";

            const actionURL = $("#actionURL").val();

            let uName = $("#name").val();
            let dob = $("#dob").val();
            let emailId = $("#email").val();
            let pwd = $("#pwd").val();
            const isEdit = $("#isEdit").val();
            const nid = $("#userId").val();

            const queryXML = `<?xml version='1.0'?>`
                + `<query>`
                + `<action>${actionURL}</action>`
                + getXMLString(XML_PARAMETER_NAME, () => uName)
                + getXMLString(XML_PARAMETER_EMAILID, () => emailId )
                + getXMLString(XML_PARAMETER_DOB, () => dob)
                + getXMLString(XML_PARAMETER_PWD, () => pwd )
                + getXMLString(XML_PARAMETER_EDIT, () => isEdit )
                + getXMLString(XML_PARAMETER_NID, () => nid )
                + `</query>`;

            await makeAjaxCall({
                url: `${webURL}/new-cont-reg`,
                method: "POST",
                data: { xmlData: queryXML, action: actionURL },
            }).then((res)=>{
                if (res.save === 1) {
                    $("#addUserForm")[0].reset();
                    //uncheck stars
                    $('label').removeClass('active');
                    console.log("reset form")
                    let msg = 'Form submitted successfully!';
                    if(isEdit == '1'){
                        msg = "Record updated successfully!"
                        setTimeout('redirect("/list")', 2000);  
                    }
                    $('.submit-response-msg').empty().show().html("<h5 class='bg-white my-3 py-2 text-success'>"+msg+"<h5>").delay(delayInSec).fadeOut(300);
                } else if(res.error === 1){
                    $('.submit-response-msg').empty().show().html("<h5 class='my-3 py-2 text-red'>Error while submitting the form!!<h5>").delay(delayInSec).fadeOut(300);

                } else {
                    throw new Error("Empty response");
                }
                onclickError('submitBtn');
        })
        }  
    });

});  