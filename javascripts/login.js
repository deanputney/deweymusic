   
function toggle_username(userid) {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest(); 	
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    handle = document.getElementById(userid);
    var url = 'ajax2.php?';
    if(handle.value.length > 0) {
        var fullurl = url + 'do=check_username_exists&username=' + encodeURIComponent(handle.value);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = statechange_username;
    }else{
        document.getElementById('username_exists').innerHTML = '';
    }
}

function statechange_username() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
       	
    if (html == 'That username already exists.'){
   		var newHTML = html;
    	document.getElementById('signup_button').disabled = true;
    
    }
    else if (html == 'That username has invalid length.'){
    	var newHTML = html;
    	document.getElementById('signup_button').disabled = true;
    }    
	else {
		var newHTML = "<span style='color:#66FF00'>" + html + "</span>";
		document.getElementById('signup_button').disabled = false;
	}
       
        document.getElementById('username_exists').innerHTML = newHTML;
    }

}

//if email already exists.   
function toggle_email(email) {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest(); 	
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    handle = document.getElementById(email);
    var url = 'ajax2.php?';
    if(handle.value.length > 0) {
        var fullurl = url + 'do=check_email_exists&email=' + encodeURIComponent(handle.value);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = statechange_email;
    }else{
        document.getElementById('email_exists').innerHTML = '';
    }
}

function statechange_email() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
        
    if (html == 'That email already exists.'){
    	var newHTML = html;
    	document.getElementById('signup_button').disabled = true;
    }
    else if (html == 'Invalid email'){
    	var newHTML = html;
    	document.getElementById('signup_button').disabled = true;
    }
	else {
		var newHTML = "<span style='color:#66FF00'>" + html + "</span>";
		document.getElementById('signup_button').disabled = false;
	}
        
        document.getElementById('email_exists').innerHTML = newHTML;
    }

}

//for forgot password

function toggle_lostusername(userid) {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest(); 	
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    handle = document.getElementById(userid);
    var url = 'ajax2.php?';
    if(handle.value.length > 0) {
        var fullurl = url + 'do=check_lostusername_exists&username=' + encodeURIComponent(handle.value);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = statechange_lostusername;
    }else{
        document.getElementById('lostusername_exists').innerHTML = '';
    }
}

function statechange_lostusername() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
       
    if (html == 'That username does not exist :('){
   		var newHTML = html;
    	document.getElementById('forgotpassword').disabled = true;
    }
   	else {
		var newHTML = "<span style='color:#003300'>" + html + "</span>";
		document.getElementById('forgotpassword').disabled = false;
	}
       
        document.getElementById('lostusername_exists').innerHTML = newHTML;
    }

}

//for forgot email   
function toggle_lostemail(email) {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest(); 	
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    handle = document.getElementById(email);
    var url = 'ajax2.php?';
    if(handle.value.length > 0) {
        var fullurl = url + 'do=check_lostemail_exists&email=' + encodeURIComponent(handle.value);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = statechange_lostemail;
    }else{
        document.getElementById('lostemail_exists').innerHTML = '';
    }
}

function statechange_lostemail() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
        
    if (html == 'That email does not exist :('){
    	var newHTML = html;
    	document.getElementById('forgotpassword').disabled = true;
    }
    else if (html == 'Invalid email'){
    	var newHTML = html;
    	document.getElementById('forgotpassword').disabled = true;
    }
	else {
		var newHTML = "<span style='color:#003300'>" + html + "</span>";
		document.getElementById('forgotpassword').disabled = false;
	}
        
        document.getElementById('lostemail_exists').innerHTML = newHTML;
    }

}






//for changing password1

function toggle_password1(userid) {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest(); 	
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    handle = document.getElementById(userid);
    var url = 'ajax2.php?';
    if(handle.value.length > 0) {
        var fullurl = url + 'do=check_password1_exists&username=' + encodeURIComponent(handle.value);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = statechange_password1;
    }else{
        document.getElementById('password1_exists').innerHTML = '';
    }
}

function statechange_password1() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
       
    if (html == 'That password is too short.'){
   		var newHTML = html;
    	document.getElementById('changepassword').disabled = true;
    }
   	else {
   		//light green 
		var newHTML = "<span style='color:#003300'>" + html + "</span>";
		document.getElementById('changepassword').disabled = false;
	}
       
        document.getElementById('password1_exists').innerHTML = newHTML;
    }

}

//for verifying old password    
function toggle_oldpassword(email) {
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest(); 	
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    handle = document.getElementById(email);
    var url = 'ajax2.php?';
    if(handle.value.length > 0) {
        var fullurl = url + 'do=check_oldpassword_exists&email=' + encodeURIComponent(handle.value);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = statechange_oldpassword;
    }else{
        document.getElementById('oldpassword_exists').innerHTML = '';
    }
}

function statechange_oldpassword() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
        
    if (html == 'This is not your password :('){
    	var newHTML = html;
    	document.getElementById('changepassword').disabled = true;
    }
	else {
		var newHTML = "<span style='color:#003300'>" + html + "</span>";
		document.getElementById('changepassword').disabled = false;
	}
        
        document.getElementById('oldpassword_exists').innerHTML = newHTML;
    }

}

function check_password(myvalue){

	if($("#password1").val() == myvalue){ 
	
		document.getElementById('password2_exists').innerHTML = 'The passwords entered do not match :(';
		
		html = 'the passwords match :)';
		var newHTML = "<span style='color:#003300'>" + html + "</span>";
		document.getElementById('password2_exists').innerHTML = newHTML;
		document.getElementById('changepassword').disabled = false;

	}
	else{
		document.getElementById('password2_exists').innerHTML = 'The passwords entered do not match :(';
		document.getElementById('changepassword').disabled = true;
			}
}





