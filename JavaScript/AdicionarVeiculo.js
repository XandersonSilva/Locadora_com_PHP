const cidadesPorEstado = {
    
    
    AC: [
        "Rio Branco", "Cruzeiro do Sul", "Sena Madureira"
    ],
    AL: [
        "Maceió", "Arapiraca", "Palmeira dos Índios"
    ],
    AP: [
        "Macapá", "Santana", "Laranjal do Jari"
    ],
    AM: [

    ],
    BA: [

    ],
    CE: [

    ],
    DF: [

    ],
    ES: [

    ],
    GO: [

    ],
    MA: [

    ],
    MT: [

    ],
    MS: [

    ],
    MG: [

    ],
    PA: [

    ],
    PB: [

    ],
    PR: [

    ],
    PE: [

    ],
    PI: [

    ],
    RJ: [

    ],
    RN: [

    ],
    RS: [

    ],
    RO: [

    ],
    RR: [

    ],
    SC: [

    ],
    SP: [

    ],
    SE: [

    ],
    TO: [

    ],
    

    
};





function teste(){
    var marca = $("select#marca").val();
    $("select#modelo").html(
        "<option value='Não informado'>-</option>" 
    );
    $("select#passageiros").html(
        '<option value="Não informado">-</option><option value="1">1 Pessoa</option><option value="2">2 Pessoas</option><option value="4">4 Pessoas</option><option value="6">6 Pessoas</option><option value="8">8 Pessoas</option>'
    );
    $("select#combustivel").html(
        '<option value="Não informado">-</option><option value="Gasolina">Gasolina</option><option value="Alcool">Alcool</option><option value="Disel">Disel</option><option value="Eletrico">Eletrico</option><option value="Outro">Outro</option>'
    );
    $("input#placa").val("")

    
    
    fetch("../Arquivos_json/Carros_Brasileiros.json").then((response) => {
        response.json().then((dados)  => {
            dados.map((veiculo) => {
                if (veiculo["Marca"] == marca){
                    var quant = veiculo["Modelos"].length;
                    for (var i = 0; i != quant; i++){
                        $("select#modelo").append('<option value="' +veiculo["Modelos"][i] + '">' + veiculo["Modelos"][i] + '</option>' );
                        
                    }
                }
            }
            )
        }
        )
    }
    );
}



var inputImagemA = $("input#fotoA");
var inputImagemB = $("input#fotoB");
var inputImagemC = $("input#fotoC");

function uploadImgA(){
    inputImagemA.trigger('click'); // Simula o clique no botão de input
}

function uploadImgB(){
    inputImagemB.trigger('click'); 
}
function uploadImgC(){
    inputImagemC.trigger('click');
}

inputImagemA.on('change',function(e){
    var Ft1 = $("div#fotoA");
    var AddIMG = '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" width="5" height="25" fill="#322C91"/><rect y="15" width="5" height="25" transform="rotate(-90 0 15)" fill="#322C91"/></svg>';
    var inputTarget = e.target;
    var file = inputTarget.files[0];
    
    if (file){
        const reader = new FileReader();
        reader.addEventListener("load", function(e){
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src=readerTarget.result;// Atribui a imagem que está na memória do computador para uma variável da página web
            img.classList.add("CarroIMG");

            
            Ft1.html("");
            Ft1.append(img);    
        });
        reader.readAsDataURL(file);
    }else{
        Ft1.html(AddIMG);
    }
});

inputImagemB.on('change',function(e){
    var Ft2 = $("div#fotoB");
    var AddIMG = '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" width="5" height="25" fill="#322C91"/><rect y="15" width="5" height="25" transform="rotate(-90 0 15)" fill="#322C91"/></svg>';
    var inputTarget = e.target;
    var file = inputTarget.files[0];
    
    if (file){
        const reader = new FileReader();
        reader.addEventListener("load", function(e){
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src=readerTarget.result;// Atribui a imagem que está na memória do computador para uma variável da página web
            img.classList.add("CarroIMG");

            
            Ft2.html("");
            Ft2.append(img);    
        });
        reader.readAsDataURL(file);
    }else{
        Ft2.html(AddIMG);
    }
});

inputImagemC.on('change',function(e){
    var Ft3 = $("div#fotoC");
    var AddIMG = '<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="10" width="5" height="25" fill="#322C91"/><rect y="15" width="5" height="25" transform="rotate(-90 0 15)" fill="#322C91"/></svg>';
    var inputTarget = e.target;
    var file = inputTarget.files[0];
    
    if (file){
        const reader = new FileReader();
        reader.addEventListener("load", function(e){
            const readerTarget = e.target;

            const img = document.createElement("img");
            img.src=readerTarget.result;// Atribui a imagem que está na memória do computador para uma variável da página web
            img.classList.add("CarroIMG");

            
            Ft3.html("");
            Ft3.append(img);    
        });
        reader.readAsDataURL(file);
    }else{
        Ft3.html(AddIMG);
    }
});

// VALIDAR PLACA

//A placa deve começar com 3 numeros
//Em seguida a placa deve ter uma letras minúsculas
//Em seguida a placa pode ter ou não um número
//Em seguida a placa deve ter 2 letras maiúsculas

const placa = $("#placa"); 
placa.on('blur', function vrifcPlaca() {
  const Pmercosul = /[A-Z]{3}[0-9][A-Z][0-9]{2}/;
  const Pvelha = /[A-Z]{3}[0-9]{4}/;
  const placaVal = placa.val().toUpperCase();
  
  if(placaVal.match(Pmercosul) || placaVal.match(Pvelha) ) {
    console.log('Placa correta')
  } else {
    alert("placa incorreta")
  }
});

function exibirCity(){
    let estado = document.getElementById("uf").value;
    let cidadesExist = document.getElementById("cidade");
    let cidades = cidadesPorEstado[estado];
    preencherCidades(cidadesExist, cidades)
    function preencherCidades(cidadesExist, cidades){
        cidadesExist.innerHTML = "<option value='Nao informado'> - </option>";
        cidades.forEach(opcao => {
            const optionElement = document.createElement("option");
            optionElement.value = opcao;
            optionElement.textContent = opcao;
            cidadesExist.appendChild(optionElement);
            
        });
    }
    
}

function esconderAviso(){
    $("#erroReg").toggle();
}