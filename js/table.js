
window.onload = function(){
    document.getElementById('btn_adicionar_linha').addEventListener('click', function(){
        adicionarLinhaTabela()
    })
}

function adicionarLinhaTabela(){
    console.log('adicionarLinhaTabela')

    var tabelaListaAlunos = document.querySelector('#tabela_lista_alunos')
    var tabelaQtdLinhas = tabelaListaAlunos.rows.length
    var tabelaUltimaLinha = tabelaListaAlunos.insertRow(tabelaQtdLinhas)

    var colunaNome = tabelaUltimaLinha.insertCell(0)
    var colunaScore = tabelaUltimaLinha.insertCell(1)
    var colunaPosicao = tabelaUltimaLinha.insertCell(2)
    var colunaDesde = tabelaUltimaLinha.insertCell(3)
    var colunaResolvidos = tabelaUltimaLinha.insertCell(4)
    var colunaTentados = tabelaUltimaLinha.insertCell(5)
    var colunaSubmissoes = tabelaUltimaLinha.insertCell(6)
    var colunaInstituicao = tabelaUltimaLinha.insertCell(7)
    var colunaAcoes = tabelaUltimaLinha.insertCell(8)

    colunaNome.innerHTML = document.getElementById("nome").innerText
    colunaScore.innerHTML = document.getElementById("score").innerText
    colunaPosicao.innerHTML = document.getElementById("posicao").innerText
    colunaDesde.innerHTML = document.getElementById("desde").innerText
    colunaResolvidos.innerHTML = document.getElementById("resolvidos").innerText
    colunaTentados.innerHTML = document.getElementById("tentados").innerText
    colunaSubmissoes.innerHTML = document.getElementById("submissoes").innerText
    colunaInstituicao.innerHTML = document.getElementById("instituicao").innerText
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