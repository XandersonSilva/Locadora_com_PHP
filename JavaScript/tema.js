function index(){
    let cookie = 'W';
    let valoresC = Object.values(document.cookie.split(';'));
    let valCont = valoresC.length;
    for(let i = 0; i< valCont; i++){
        if(valoresC[i] == ' tema=D'){
             cookie = 'D';
        } else if(valoresC[i] == ' tema=W'){
             cookie = 'W';
        }
    }

    console.log(cookie);

    var html = document.getElementById("html");
    var main = document.getElementById("main");
    var section = document.getElementById("conteudo");
    var pesq = document.getElementById("Pesquisa");
    var aviso = document.getElementById("avisoINF")
    var paragrafos = document.getElementsByTagName("p");
    var label = document.getElementsByTagName("label");
    if (html) {
        if (cookie === 'W') {
            console.log('White');
            tema.style.backgroundColor = "rgb(255,255,255)";
        }
        if (cookie === 'D') {
            console.log('Dark');
            html.style.backgroundColor = "rgb(44, 43, 43)";
            main.style.backgroundColor = "rgb(44, 43, 43)";
            main.style.color = 'rgb(255, 255, 255)';
            if (section){
                section.style.backgroundColor = "rgb(44, 43, 43)";
            }
            if(pesq){
                pesq.style.backgroundColor = "rgb(44, 43, 43)";
            }
            
            


            for (var i = 0; i < paragrafos.length; i++) {
                paragrafos[i].style.color = "rgb(255,255,255)";
            }
            for (var i = 0; i < label.length; i++) {
                label[i].style.color = "rgb(255,255,255)";
            }
            if(aviso){
             aviso.style.color = "rgb(255,255,255)";
        }
        }
    }
}
document.addEventListener("DOMContentLoaded", index);

function user(){
    let cookie = 'W';
    let valoresC = Object.values(document.cookie.split(';'));
    let valCont = valoresC.length;
    for(let i = 0; i< valCont; i++){
        if(valoresC[i] == ' tema=D'){
             cookie = 'D';
        } else if(valoresC[i] == ' tema=W'){
             cookie = 'W';
        }
    }

    console.log(cookie);

    var html = document.getElementById("main");
    var paragrafos = document.getElementsByTagName("p");
    var label = document.getElementsByTagName("label");
    if (html) {
        if (cookie === 'W') {
            console.log('White');
            tema.style.backgroundColor = "rgb(255,255,255)";
        }
        if (cookie === 'D') {
            console.log('Dark');
            html.style.backgroundColor = "rgb(44, 43, 43)";
            for (var i = 0; i < paragrafos.length; i++) {
                paragrafos[i].style.color = "rgb(255,255,255)";
            }
            for (var i = 0; i < label.length; i++) {
                label[i].style.color = "rgb(255,255,255)";
            }
        }
    }
}
document.addEventListener("DOMContentLoaded", user);
