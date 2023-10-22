function index(){
    var cookie = document.cookie.split(';')[5].charAt(6);
    console.log(cookie);

    var html = document.getElementById("html");
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
            section.style.backgroundColor = "rgb(44, 43, 43)";
            pesq.style.backgroundColor = "rgb(44, 43, 43)";
            for (var i = 0; i < paragrafos.length; i++) {
                paragrafos[i].style.color = "rgb(255,255,255)";
            }
            for (var i = 0; i < label.length; i++) {
                label[i].style.color = "rgb(255,255,255)";
            }
            aviso.style.color = "rgb(255,255,255)";
        }
    }
}
document.addEventListener("DOMContentLoaded", index);

function user(){
    var cookie = document.cookie.split(';')[5].charAt(6);
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
