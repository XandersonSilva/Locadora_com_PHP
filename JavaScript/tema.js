document.addEventListener("DOMContentLoaded", function() {
    var cookie = document.cookie.split(';')[5].charAt(6);
    console.log(cookie);

    var tema = document.getElementById("main");
    if (tema) {
        if (cookie === 'W') {
            console.log('White');
            tema.style.backgroundColor = "rgb(255,255,255)";
        }
        if (cookie === 'D') {
            console.log('Dark');
            tema.style.backgroundColor = "rgb(54, 54, 54)";
        }
    }
});
