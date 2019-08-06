

function iniciaAjax() { 
var req; 

try {req = new ActiveXObject("Microsoft.XMLHTTP");} 
catch(e){ 
try {req = new ActiveXObject("Msxml2.XMLHTTP");} 
catch(ex){	
try {req = new XMLHttpRequest();} 
catch(exc) { 
alert("Esse browser não tem recursos para uso do Ajax!"); 
req = null; 
} 
} 
} 
return req; 
} 

function calcula() { 

valIni = document.getElementById("valorIni").value; 
ajax = iniciaAjax(); 
if(ajax) { 
ajax.open("GET", "arquivophp.php?n=" + valIni, true); 
ajax.onreadystatechange = function() { 
if(ajax.readyState == 4) { 
if(ajax.status == 200) { 
document.getElementById("resultado").value = ajax.responseText; 
var xx = ajax.responseText; 
alert("RESULTADO DA CHAMADA PHP: " + xx); 
} else { 
alert(ajax.statusText); 
} 
} 
} 
ajax.send(null); 
} 
else{ 
alert("O Ajax nao funcionou corretamente"); 
} 
} 
