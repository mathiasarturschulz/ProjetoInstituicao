
// window.onload = function(){
//     document.getElementById('btn_adicionar_linha').addEventListener('click', function(){
//         adicionarLinhaTabela()
//     })
// }

function adicionarLinhaTabela(){
    console.log('adicionarLinhaTabela')

    var tabelaListaAlunos = document.querySelector('#tabela_lista_alunos')
    var tabelaQtdLinhas = tabelaListaAlunos.rows.length
    var tabelaUltimaLinha = tabelaListaAlunos.insertRow(tabelaQtdLinhas)

    var colunaCodigo = tabelaUltimaLinha.insertCell(0)
    var colunaNome = tabelaUltimaLinha.insertCell(1)
    var colunaScore = tabelaUltimaLinha.insertCell(2)
    var colunaPosicao = tabelaUltimaLinha.insertCell(3)
    var colunaDesde = tabelaUltimaLinha.insertCell(4)
    var colunaResolvidos = tabelaUltimaLinha.insertCell(5)
    var colunaTentados = tabelaUltimaLinha.insertCell(6)
    var colunaSubmissoes = tabelaUltimaLinha.insertCell(7)
    var colunaInstituicao = tabelaUltimaLinha.insertCell(8)
    var colunaAcoes = tabelaUltimaLinha.insertCell(9)

    colunaCodigo.innerHTML = "<input type='text' id='input_tabela' name='arrayCodigos[]' value='" + document.getElementById("codigo").innerText + "' readonly/>"
    colunaNome.innerHTML = "<input type='text' id='input_tabela' name='arrayNomes[]' value='" + document.getElementById("nome").innerText + "' readonly/>"
    colunaScore.innerHTML = "<input type='text' id='input_tabela' name='arrayScores[]' value='" + document.getElementById("score").innerText + "' readonly/>"
    colunaPosicao.innerHTML = "<input type='text' id='input_tabela' name='arrayPosicoes[]' value='" + document.getElementById("posicao").innerText + "' readonly/>"
    colunaDesde.innerHTML = "<input type='text' id='input_tabela' name='arrayDesde[]' value='" + document.getElementById("desde").innerText + "' readonly/>"
    colunaResolvidos.innerHTML = "<input type='text' id='input_tabela' name='arrayResolvidos[]' value='" + document.getElementById("resolvidos").innerText + "' readonly/>"
    colunaTentados.innerHTML = "<input type='text' id='input_tabela' name='arrayTentados[]' value='" + document.getElementById("tentados").innerText + "' readonly/>"
    colunaSubmissoes.innerHTML = "<input type='text' id='input_tabela' name='arraySubmissoes[]' value='" + document.getElementById("submissoes").innerText + "' readonly/>"
    colunaInstituicao.innerHTML = "<input type='text' id='input_tabela' name='arrayInstituicoes[]' value='" + document.getElementById("instituicao").innerText + "' readonly/>"
    
    colunaAcoes.innerHTML = "<button class=\"btn btn-sm btn-danger\" type=\"button\" onclick='removerLinhaTabela(this)'><i class='fa fa-trash'></i> Excluir</button>"

    // atualizarSeqIndexes()
}

function removerLinhaTabela(indexLinha){
    var index = indexLinha.parentNode.parentNode.rowIndex;
    var tabelaListaAlunos = document.getElementById('tabela_lista_alunos')

    tabelaListaAlunos.deleteRow(index)
    // atualizarSeqIndexes()
}

function atualizarSeqIndexes(){
    var new_line_counter    = 1
    var tabela_salario  = document.querySelector('#tabela-salario')

    for (let i = 1; i < tabela_salario.rows.length; i++){
        tabela_salario.rows[i].cells[0].innerHTML = new_line_counter
        new_line_counter = new_line_counter + 1
    }
}