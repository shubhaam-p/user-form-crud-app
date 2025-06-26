<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/common-includes/header.php';
    $editUserDetails = $newUser = '';
    $userId = $editUserDetails = 0;

   if( isset( $_REQUEST['userId'] ) && $_REQUEST['userId']>0 ){
        $userId = (int) trim($_REQUEST['userId']);
        $editUserDetails = 1;
    }else{
        $newUser = true;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo $webURL?>/reckStatic/css/style.css">
        <title>Form</title>
    </head>
<body>

<input type="hidden" name="userId" id="userId" value="<?php echo $userId;?>" />
<input type="hidden" name="isEdit" id="isEdit" value="<?php echo $editUserDetails;?>" />
<input type="hidden" name="actionURL" id="actionURL" value="<?php echo $editUserDetails ? 'editUserDetails':'addUser'?>" />

<h3>Form</h3>

<div class="formDiv">
  <form action="" onsubmit="return false" id="addUserForm">
    <div>
        <label for="name">First Name</label>
        <input type="text" id="name" name="name" placeholder="Your name..">
    </div>
    
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="emailId" placeholder="Your email ID..">
    </div>
    
    <div>
        <label for="dob">Date of birth</label>
        <input type="date" id="dob" name="dob" placeholder="Your date of birth..">
    </div>

    <div>
        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd" placeholder="Password..">
    </div>
    <input type="submit" value="Submit" id="submitBtn">
  </form>
<div class="submit-response-msg text-center"></div>

</div>
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/common-includes/footer.php';
?>

<script>
    $(document).ready(async function () {
        let result = '';
        let userId = $('#userId').val();
        let isEdit = $('#isEdit').val();

        isEdit == true? $('#submitBtn').val('Edit'): '';
         if(userId != 0 && userId && isEdit){
            result = await listUser(userId, true);
        }else return

        if(result && result.data.length > 0){
            let userData = result.data[0];

            $('#name').val(userData.NAME)
            $('#email').val(userData.EMAILID)
            $('#dob').val(userData.DOB)

        }
    })
</script>

