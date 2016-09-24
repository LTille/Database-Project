function checkPasswords() {
        var pass1 = document.getElementById("password1");
        var pass2 = document.getElementById("password2");
 
        if (pass1.value != pass2.value){
        	pass2.setCustomValidity("password don't match!");
        	return false;
        }

        else{
        	pass2.setCustomValidity("");
        }
}
