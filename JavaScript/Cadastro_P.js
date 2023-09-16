// Função que desabilita e habilita o botão de cadastro 
function desabilitaBotaoCadastrar(value) {
    var botaoCadastrar = document.getElementById("botaoCadastrar");
    if(value === true) {
        botaoCadastrar.setAttribute('disabled', 'true');
        $("#botaoCadastrar").removeClass('ativado');
        $("#botaoCadastrar").addClass('desativado');

    } else {
        $("#botaoCadastrar").addClass('ativado');
        botaoCadastrar.removeAttribute("disabled");
        $("#botaoCadastrar").removeClass('desativado');
    }
}



// Inicialmente o botão de cadastro estará desabilitado
desabilitaBotaoCadastrar(true);

// Função que verifica se as senhas informadas pelo usuário são iguais
function verifica(){
    var senha1 = document.getElementById("senha").value;
    var senha2 = document.getElementById("senhaIgual").value;
    if (senha1 != senha2){
        window.alert('Senhas diferentes');
    }else{
        desabilitaBotaoCadastrar(false);   
    }
}


