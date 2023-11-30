
document.addEventListener('DOMContentLoaded', function () {
    const estrelas = document.querySelectorAll('.estrela');
    const ratingContainer = document.getElementById('avaliacao-container');
    let valorSelecionado = 0;

    ratingContainer.addEventListener('mouseover', function (e) {
        const selectedValue = e.target.getAttribute('data-value');
        
        estrelas.forEach(estrela => {
            const estrelaValue = estrela.getAttribute('data-value');
            estrela.classList.toggle('preenchido', estrelaValue <= selectedValue);
        });
    });

    ratingContainer.addEventListener('mouseout', function () {
        estrelas.forEach(estrela => {
            estrela.classList.toggle('preenchido', estrela.getAttribute('data-value') <= valorSelecionado);
        });
    });

    ratingContainer.addEventListener('click', function (e) {
        valorSelecionado = e.target.getAttribute('data-value');
        document.getElementById('estrelasSlc').value=valorSelecionado;
        if( document.getElementById('estrelasSlc').value < 1){
            document.getElementById('valugarBTN').type = 'button'
        }else{
            document.getElementById('alugarBTN').type = 'submit'
        }
    });

});
function verificarValor(){
    if( document.getElementById('alugarBTN').value < 1){
        alert("Preencha o campo de avaliação");
    }
}
