
function ocutarItensHistorico(num) {
    const Phistorico = document.getElementById('hist');
    const Bhistorico = document.getElementById('histBTN');
    const  historico = document.getElementById('contH');
    const estado =  Bhistorico.dataset.value;
    console.log(estado)
    if(estado == 'norm'){
        historico.classList.remove('cont');
        historico.classList.add('NVeiw');
        Bhistorico.dataset.value = 'ocuto';
        Bhistorico.textContent = 'Exibir';
    }else{
        historico.classList.add('cont');
        historico.classList.remove('NVeiw');
        Bhistorico.dataset.value = 'norm';
        Bhistorico.textContent = 'Ocutar';

    }
    
    
}

function ocutarItensCompartilhados(num){
    const Pcompart = document.getElementById('comp');
    const Bcompart = document.getElementById('compBTN');
    const  compart = document.getElementById('contC');
    const estado =  Bcompart.dataset.value;
    console.log(estado, 'gg')
    if(estado == 'norm'){
        compart.classList.remove('cont');
        compart.classList.add('NVeiw');
        Bcompart.dataset.value = 'ocuto';
        Bcompart.textContent = 'Exibir';
    }else{
        compart.classList.add('cont');
        compart.classList.remove('NVeiw');
        Bcompart.dataset.value = 'norm';
        Bcompart.textContent = 'Ocutar';

    }
    
}