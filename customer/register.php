<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/myjs.js"></script>
        <link href="../css/mycss.css" rel="stylesheet" media="screen">
        <script language="JavaScript">
            function busshow(){
                $('#business').collapse('show');
                $('#personal').collapse('hide');
            };
            function pershow(){
                $('#personal').collapse('show');
                $('#business').collapse('hide');
            };
        </script>
    </head>
    <body>
        <?php include("header.php");?>
        <div class="container" style="padding-top:70px">
            <h3>Register right Now!</h3>
            <form action="registerManagement.php" method="POST">
                <div class="row">
                    <div class="span4">
                        <h4>Personal Information</h4></br>
                        <input type="text" name="username" class="span3" placeholder="Username" required><font color="red">*</font> 
                        <input type="password" name="password1" id="password1" class="span3" placeholder="Password" required><font color="red">*</font> 
                        <input type="password" name="password2" id="password2" class="span3" placeholder="Enter Password again" onchange="checkPasswords()" required><font color="red">*</font> 
                        <input type="text" name="name" class="span3" placeholder="Your name" required><font color="red">*</font> 
                    </div>
                    <div class="span4">   
                        <h4>Address</h4></br>
                        <input type="text" name="street" class="span3" placeholder="Street" required><font color="red">*</font> 
                        <input type="text" name="city" class="span3" placeholder="City" required><font color="red">*</font> 
                        <input type="text" name="state" class="span3" placeholder="State(e.g.PA)" required><font color="red">*</font> 
                        <input type="text" name="zipcode" class="span3" placeholder="Zip Code" required><font color="red">*</font>  
                    </div>
                    <div class="span4">
                        <h4>Customer Type</h4>
                        <h6 style="padding-top:20px;">Personal&nbsp;&nbsp;<input type="radio" class="input-xxlarge" style="margin-top:-3px" checked="checked" name="type" value="H" onclick="pershow()">
                        &nbsp;&nbsp;Business&nbsp;&nbsp;<input type="radio" class="input-xxlarge" style="margin-top:-3px" name="type" value="B" onclick="busshow()"></h6>  
                        <div id="personal" class="collapse in">
                            <input type="text" name="gender" class="span3" placeholder="Gender(Female/Male)">
                            <input type="text" name="marriage_status" class="span3" placeholder="Married/Single">
                            <input type="text" name="age" class="span3" placeholder="Age"> 
                            <input type="text" name="income" class="span3" placeholder="income">
                        </div>
                        <div id="business" class="collapse">
                            <input type="text" name="Category" class="span3" placeholder="Category">
                            <input type="text" name="gross_income" class="span3" placeholder="Gross Income">
                            
                        </div>
                    </div>
                    <div class="span3">
                        
                    </div>
                </div>
                <button class="btn but-large btn-primary" type="submit">Register</button>
            </form>
        </div>
    </body>
 </html>




