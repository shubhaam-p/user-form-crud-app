<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Constants.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../reckStatic/css/style.css">
        <title>Form</title>
    </head>
<body>

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
        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd" placeholder="Password..">
    </div>
    
    <div>
        <label for="dob">Date of birth</label>
        <input type="date" id="dob" name="dob" placeholder="Your dob..">
    </div>

    <input type="submit" value="Submit" id="submitBtn">
  </form>
<div class="submit-response-msg text-center"></div>

</div>
<script>
    webURL = "<?php echo $webURL?>";
</script>
    <script src="<?php echo $webURL?>/reckStatic/js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $webURL?>/reckStatic/js/jquery.validate.min.js"> </script> 
    <script src="<?php echo $webURL?>/reckStatic/js/common-script.js?ver"></script>
    <script src="<?php echo $webURL?>/reckStatic/js/validate-form.js?ver"></script>
</body>
</html>


