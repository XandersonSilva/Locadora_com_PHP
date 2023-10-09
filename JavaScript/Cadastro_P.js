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

function validaC() {
    var cpf = document.getElementById("cpf").value;
    var cpfValido = 0;

    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        cpfValido = -1;
    }

    let soma = 0;
    let resto;

    for (let i = 1; i <= 9; i++) {
        soma += parseInt(cpf.charAt(i - 1)) * (11 - i);
    }

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== parseInt(cpf.charAt(9))) {
        cpfValido = -1;
    }

    soma = 0;

    for (let i = 0; i <= 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }

    resto = (soma * 10) % 11;

    if (resto === 10 || resto === 11) {
        resto = 0;
    }

    if (resto !== parseInt(cpf.charAt(10))) {
        cpfValido = -1;
    }


    if (cpfValido == 0){
        document.getElementById("erroCPF").innerHTML="";
        validacao[6] = 1;
        frc =  validacao[0] + validacao[1] + validacao[2] + validacao[3] + validacao[4] + validacao[5] + validacao[6] + validacao[7];

        if (frc == 8){
            desabilitaBotaoCadastrar(false);

        }
    }else{
        document.getElementById("erroCPF").innerHTML="Para prosseguir informe um CPF válido! Não informe pontos ou traços";
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


