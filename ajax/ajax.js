
function iniciaAjax() { 
    var req; 
    try {
        req = new ActiveXObject("Microsoft.XMLHTTP");
    } catch(e) { 
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(ex) {
            try {
                req = new XMLHttpRequest();
            } catch(exc) { 
                alert("Esse browser não tem recursos para uso do Ajax!"); 
                req = null; 
            } 
        } 
    } 
    return req; 
}

function buscaDadosAluno() { 
    codigoParaBuscar = document.getElementById("codigoParaBuscar").value; 
    ajax = iniciaAjax(); 
    if(ajax) { 
        ajax.open("GET", "ajax/BuscaAluno.php?n=" + codigoParaBuscar, true); 
        ajax.onreadystatechange = function() { 
            if(ajax.readyState == 4) { 
                if(ajax.status == 200) {
                    var resposta = ajax.responseText; 
                    table_aluno_body = document.getElementById("table_aluno_body"); 
                    table_aluno_body.innerHTML = resposta;
                    // alert("Busca concluída com sucesso! ");
                } else { 
                    alert(ajax.statusText); 
                }
            } 
        } 
        ajax.send(null); 
    } else{
        alert("Erro Ajax"); 
    } 
} 
