# JX Veículos
###### _Projeto solicitado para obtenção de nota parcial na disciplina LP_II_
___
######  [![Tutorial de uso](https://img.shields.io/badge/YouTube-FF0000?style=for-the-badge&logo=youtube&logoColor=white)](https://www.youtube.com/watch?v=5RpwCQ_jcIY)[*- Tutorial de uso-*](https://www.youtube.com/watch?v=5RpwCQ_jcIY)
 ####  Tecnologias do projeto
 - ![Javascript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) 
 - ![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) 
 - ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)   
 - ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) 
 - ![Apache](https://badgen.net/badge/º/APACE/color=[black]) 
 - ![JSON](https://badgen.net/badge/{}/JSON/)


## Requisitos para o funcionamento
- Alterar os níveis de permissão de usuários. Para que o json possa escrever. [ Normalmente necessário ao executar em ambiente Linux ]
- A verificação de e-mail é feita através de SMTP, logo é necessário adicionar o e-mail e senha para o SMTP nas linhas 132 e 133 do arquivo `Locadora_com_PHP/ScriptsPHP/validarEmail.php`, além de outras informações da linha 128 a 142 (caso sejam necessárias alterações).
- A geração do QR code não funciona em PHP antigo, além de estar estática para a conta de um dos desenvolvedores. 

## Quanto a realização do pix
O capítulo 1.5 (Iniciação do Pix via QR Code Estático) do [Manual de Padrões para Iniciação do Pix](https://www.bcb.gov.br/content/estabilidadefinanceira/pix/Regulamento_Pix/II_ManualdePadroesparaIniciacaodoPix.pdf) foi utilizado como base para geração de chaves estáticas. O arquivo ` Locadora_com_PHP/lib/app/Pix
/Payload.php` é utilizado no script `Locadora_com_PHP/ScriptsPHP
/realizarPagamento.php` este último é responsável por para chamar o `Payload.php` passar as informações gerar a chave estática e a grava no arquivo `Locadora_com_PHP/Arquivos_json/Pagamentos.json` para ser usada no arquivo `PageQr_Pix.php`. 

## Quanto a realização da verificação de e-mail
Esta funcionalidade é realizada utilizando o serviço de SMTP da biblioteca PHPMailer chamada no arquivo `Locadora_com_PHP/ScriptsPHP/validarEmail.php` e as infanções necessárias do mesmo são preenchidas neste utilizando o host de servidor da Google `smtp.gmail.com` e uma conta Google dispõe de acesso ao mesmo. 

## Instalação
```sh
git clone https://github.com/XandersonSilva/Locadora_com_PHP.git
```

## Bibliotecas usadas

Dentro da pasta ```Locadora_com_PHP/lib``` estão localizadas as bibliotecas usadas no projeto.

| Biblioteca | Link |
| ------ | ------ |
| PHPMailer | https://github.com/mpdf/qrcode |
| mPDF | https://github.com/mpdf/qrcode |
|Paragonie|https://github.com/paragonie/random_compat|



## Licença
MIT 
