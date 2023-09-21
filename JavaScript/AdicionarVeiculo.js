function teste(){
    var marca = $("select#marca").val();
    $("select#modelo").html(
        "<option value='Não informado'>-</option>" 
    )
    $("select#passageiros").html(
        '<option value="Não informado">-</option><option value="1">1 Pessoa</option><option value="2">2 Pessoas</option><option value="4">4 Pessoas</option><option value="6">6 Pessoas</option><option value="8">8 Pessoas</option>'
    )
    $("select#combustivel").html(
        '<option value="Não informado">-</option><option value="Gasolina">Gasolina</option><option value="Alcool">Alcool</option><option value="Disel">Disel</option><option value="Eletrico">Eletrico</option><option value="Outro">Outro</option>'
    )
    
    
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

