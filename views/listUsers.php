<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/common-includes/header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>List Users</title>
    <link rel="stylesheet" href="../reckStatic/css/style.css">
</head>

<body>
<h2>HTML Table</h2>

<!-- <div id="listUser"></div> -->

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email Id</th>
            <th>Date of birth</th>
            <th width="20%">Action</th>
        </tr>
        </thead>
        <tbody id="listUser">
        </tbody>
    </table>
</div>

<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/common-includes/footer.php';
?>

<script>
      $(document).ready(async function () {
        let result = await listUser();
        const tableList = document.getElementById("listUser");
        // console.log("data is present ",result.data.length)
        if(result && result?.data?.length > 0){
           result.data.forEach((item, index)=>{
            let div = document.createElement("tr");
            div.innerHTML = `
                                       <td>${item.NAME}</td>
                                        <td>${item.EMAILID}</td>
                                        <td>${item.DOB}</td>
                                        <td class="admin-list-packages-action-tab">
                                            <a href="edit/user/${item.ID}" title="Edit" class="edit-action-btn" row-id="${item.ID}" row-action="1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                </svg>
                                            </a>
                                            <span title="Delete" class="delete-action-btn confirm-link" row-id="${item.ID}" row-action="3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </span>
                                        </td>`;
            tableList.appendChild(div);

           })
        }else{
            let tr = document.createElement("tr");
            tr.innerHTML = '<td colspan=6 class="text-center">Users are not added yet</td>'
            tableList.appendChild(tr);

            console.log("Error occurred Or data is not present")
        }

        $(document).on("click",".confirm-link",async function(){
            let userId = status = 0;
            userId = $(this).attr('row-id');
            status = $(this).attr('row-action');
            console.log("sds ",userId, status)
            const res = await changeUserStatus(userId, status);
            if(res && res.save == 1){
                setTimeout('redirect("/list")', 2000);  
                // $('.confirm-msg').html(`<p class="text-green text-center"> ${res.msg}</p>`)
            }
        })
    });
</script>
