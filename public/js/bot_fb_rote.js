const puppeteer = require("puppeteer");     
const fs = require("fs");                  
const { event } = require("jquery");

const express = require("express");
const { toArray } = require("lodash");
const rotaex = express();

rotaex.get("/msg/:id/:nome/:hc/:obs/:type/:equips/:contato", function(req, res){
    res.sendFile(__dirname + "/enviarMsg.html");

    // nome do contato do whatsapp
    var contatoWhats = "Miguelzinho";
    
    // busca as informações dos equipamentos e coloca na const equips
    const equips = req.params.equips;
    
    // converte para formato json
    const equipsJson = JSON.parse(equips);

    // retorna um array com os valores das propriedades
    const eqArr = Object.values(equipsJson);

    // faz o mapeamento utilizando a função
    eqArr.map(getFullName);
    
    // função que concatena o patr com o nome do equipamento
    function getFullName(item) {
      return [item.patr,item.name_equip].join(" ")+ '\n';
    }
    
    var listEquip = eqArr.map(getFullName);

    // console.log(listEquip);

    var teste = `This is DelftStack 
    We make cool How to Tutorials 
    & 
    Make the life of other developers easier.
    `;

    // // array com as linhas da mensagem que será enviada
    // var arrayMsg = [
    //     req.params.hc, 
    //     '\n',
    //     '*' + req.params.type + ' nº: ' + req.params.id + '*' + '\n',
    //     '*Solicitação CONCLUÍDA!*', 
    //     '✅' + '\n',
    //     'PCT: ' + req.params.nome + '\n', 
    //     'Equipamento(s):' + '\n'

    // ] 
    

    // array com as linhas da mensagem que será enviada
    var arrayMsg = [
      req.params.hc + '\n',
      '*' + req.params.type + ' nº: ' + req.params.id + '*' + '\n',
      '*Solicitação CONCLUÍDA!* ',
      '✅',
      ' \n',
      'PCT: ' + req.params.nome + '\n', 
      ' \n',
      'Equipamento(s):' + '\n',
      listEquip + '\n',
      // arrays + '\n',
      // '\n',
      req.params.obs == "N"? "" : 'Obs: _' + req.params.obs  +'_' + '\n'
   
  ]
  ;




    // req.params.obs == "N"? "" : 'Obs: _' + req.params.obs  +'_' 
    
  var txtEnvio = ( arrayMsg + listEquip + (req.params.obs == "N"? "" : 'Obs: _' + req.params.obs  +'_' ));

    // console.log(teste);
    
    // transforma o array em código html 
    // let txtMsg = arrayMsg;
    //     const codeHTML = txtMsg.reduce((html, item) => {    // reduce = Lista linha por linha e retorna um valor único com todas as linhas já montadas.
    //         return html + "<p>" + item + "</p>";
    //             }, "");

    var imgGuia = req.params.id+".jpg";


    // await espere até retornar sucesso ou erro
    // async function Bot() {
    async function Bot() {
      const browser = await puppeteer.launch({ headless: false });  //headless abre uma instancia do navegador true=não abre / false=abre

        // abre uma nova página 
      const page = await browser.newPage();
      
        // determina o tamanho em pixeis que a página será aberta
      await page.setViewport({ width: 0, height: 0 });


// ==============================================

      // vai para a página web informada
      await page.goto("https://web.whatsapp.com", { waitUntil: "networkidle0" });   //waitUntil: espera os arquivos da páginas serem carregados networkidle0 (css, js, scripts, etc)

      // Gerenciando sessão do WhatsApp
      try {
        const sessionContent = fs.readFileSync("./session.txt");
        const sessionObject = JSON.parse(sessionContent);

        await page.evaluate((sessionObject) => {
          const keys = Object.keys(sessionObject);
          let keysLength = keys.length;

          while (keysLength--) {
            let key = keys[keysLength];

            window.localStorage.setItem(key, sessionObject[key]);
          }
        }, sessionObject);

        await page.reload({ waitUntil: "networkidle0" });
        await page.waitForTimeoutSelector("div.app-wrapper-web .two", { timeout: 30000 });
        await page.waitForSelector("div.app-wrapper-web .two", 60000)
      } catch (error) {
        await page.waitForSelector("div.app-wrapper-web .two", 30000);

        const sessionObject = await page.evaluate(() => {
          let response = {};

          const keys = Object.keys(window.localStorage);
          let keysLength = keys.length;

          while (keysLength--) {
            let key = keys[keysLength];

            if (key.includes("==")) {
              continue;
            }

            response[key] = window.localStorage.getItem(key);
          }

          return response;
        });

        fs.writeFileSync("./session.txt", JSON.stringify(sessionObject), "UTF-8");
      }

      // clica no contato 
      await page.waitForTimeout(10000);
      await page.click('._3m_Xw span[title="' + contatoWhats + '"]');
      await page.waitForTimeout(3000);
      
      // escreve a mensagem no input
      await page.type("._1UWac._1LbR4 ._13NKt", arrayMsg);
      await page.waitForTimeout(20000);

      // clica no botão anexar
      await page.click('div[title="Anexar"]');
      // await page.waitForTimeout(1000);
      
      // seleciona o primeiro item para anexar (imagem)
      const imageInput = await page.$("ul._1HnQz li:nth-child(1) input[type=file]");
      
      // seleciona o arquivo de imagem desejado
      imageInput.uploadFile("./public/storage/guias/"+imgGuia);
      await page.waitForTimeout(15000);
      
      
      
      // clica no botão enviar
      await page.click('span[data-icon="send"]');
      await page.waitForTimeout(5000);

      // fecha a guia atual
      await page.close();
      
      // await browser.close();
      
    }
    
    Bot();
});

rotaex.listen(8001, function(){
  console.log("Servidor rodando na url http://localhost:8001");
});
