
function ocutarItensHistorico(num) {
    const Phistorico = document.getElementById('hist');
    const  historico = document.getElementById('contH');
    if(estado == 'norm'){
        historico.classList.remove('cont');
        historico.classList.add('Nveiw');
    }else{
        historico.classList.remove('down');
        historico.classList.add('up');
    }
    
    
}