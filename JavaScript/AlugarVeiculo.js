function Anterior(ind0, ind1, ind2){
    let IMGAtu = $(".imgVisvel").attr('src');


    var url =  window.location.href;
    var mercosulP = /[A-Z]{3}[0-9][A-Z][0-9]{2}/; // Expressão regular para encontrar placa no padrão mercosul 
    var velhaP = /([A-Z]{3}\d{4})/; // Expressão regular para encontrar placa no padrão utilizado no Brasil antes do padrão mercosul 

    var mercosulP = url.match(mercosulP); 
    var velhaP = url.match(velhaP);       

    if (mercosulP !== null) {
        var placa = mercosulP[0];
    }else if(velhaP !== null ){
        var placa = velhaP[0];
    }
     
    fetch("../Arquivos_json/Veiculos_Registrados.json").then((response) => {
        response.json().then((dados)  => {
            dados.map((veiculo) => {
                if (veiculo["placa"] == placa){
                    var IMGs = veiculo["imagens"];
                    
                    let IndxReceb = [ind0, ind1, ind2];
                    indexAtu = IMGs.indexOf(IMGAtu);
                    if(indexAtu == 0){
                        for (i = 2; i >= 0; i--){
                            if (IndxReceb[i]){

                                let UltimaIMG  = IndxReceb[i] - 1;
                                $(".imgVisvel").attr('src', IMGs[UltimaIMG]);
                                break;
                            }
                        } 
                    } else {
                        if (IMGs[indexAtu - 1]){
                            $(".imgVisvel").attr('src', IMGs[indexAtu - 1])
                        }else{
                            for (i = indexAtu - 1; i >= 0; i--){
                                if (IndxReceb[i] != 0){
                                    //console.log(IndxReceb[i]);
                                    let UltimaIMG  = IndxReceb[i] - 1;
                                    $(".imgVisvel").attr('src', IMGs[UltimaIMG]);
                                    break;
                                }
                            }
                        }
                    }
                }
            })
        })
    })
    ;
    

}


function Proximo(ind0, ind1, ind2){
    let IMGAtu = $(".imgVisvel").attr('src');


    var url =  window.location.href;
    var mercosulP = /[A-Z]{3}[0-9][A-Z][0-9]{2}/; // Expressão regular para encontrar placa no padrão mercosul 
    var velhaP = /([A-Z]{3}\d{4})/; // Expressão regular para encontrar placa no padrão utilizado no Brasil antes do padrão mercosul 

    var mercosulP = url.match(mercosulP); 
    var velhaP = url.match(velhaP);       

    if (mercosulP !== null) {
        var placa = mercosulP[0];
    }else if(velhaP !== null ){
        var placa = velhaP[0];
    }
     
    fetch("../Arquivos_json/Veiculos_Registrados.json").then((response) => {
        response.json().then((dados)  => {
            dados.map((veiculo) => {
                if (veiculo["placa"] == placa){
                    var IMGs = veiculo["imagens"];
                    
                    let IndxReceb = [ind0, ind1, ind2];
                    indexAtu = IMGs.indexOf(IMGAtu);
                    if(indexAtu == 2){
                        for (i = 0; i < 3; i++){
                            if (IndxReceb[i]){

                                let UltimaIMG  = IndxReceb[i] - 1;
                                $(".imgVisvel").attr('src', IMGs[UltimaIMG]);
                                break;
                            }
                        } 
                    } else {
                        if (IMGs[indexAtu + 1]){
                            $(".imgVisvel").attr('src', IMGs[indexAtu + 1])
                        }else{
                            for (i = indexAtu + 1; i < 3; i++){
                                if (IndxReceb[i] != 0){
                                    let UltimaIMG  = IndxReceb[i] - 1;
                                    $(".imgVisvel").attr('src', IMGs[UltimaIMG]);
                                    break;
                                }
                            }
                        }
                    }
                }
            })
        })
    })
    ;
    

}