  function getCookie(cookiename) {
	var result;
	var mycookie = document.cookie;
	var start2 = mycookie.indexOf(cookiename + "=");
	if (start2 > -1) {
	start = mycookie.indexOf("=", start2) + 1;
	var end = mycookie.indexOf(";", start);
	
	if (end == -1) {
	end = mycookie.length;
	}
	
	result = unescape(mycookie.substring(start, end));
	}
	
	return result;
}  
function setCookie(name,value) 
{ 
	var Days = 30; 
	var exp = new Date(); 
	exp.setTime(exp.getTime() + Days*24*60*60*1000); 
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString(); 
} 

function delCookie(name)  
{   
    var exp = new Date();   
    exp.setTime (exp.getTime() - 100);   
    var cval = getCookie(name);   
    window.document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString()+";path=/";  
}     
function showpwd()  
{  
     var p=getCookie(document.getElementById("uid").value);  
     if(p!=null)  
    document.getElementById("pwd").value= p;  
}  


function TjUrl (name,urls)  
{   
    var cval = getCookie(name); 
	if(cval=="" || cval=='undefined' || cval==null){
		document.location.href=urls;
	}
} 
 