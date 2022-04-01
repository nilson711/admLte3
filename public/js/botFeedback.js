const puppeteer = require("puppeteer");     //faz o requerimento do puppeteer
const fs = require("fs");                   //
const { event } = require("jquery");

// nome do contato do whatsapp
var contatoWhats = "Miguelzinho";

// array com as linhas da mensagem que será enviada
var arrayMsg = [
    '*LINHA 1* \n', 
    'Linha 2 com _italico_ aplicado \n', 
    'Linha 3 ```monoespaçada``` \n'
];

// transforma o array em código html 
let txtMsg = arrayMsg;
    const codeHTML = txtMsg.reduce((html, item) => {    // reduce = Lista linha por linha e retorna um valor único com todas as linhas já montadas.
        return html + "<p>" + item + "</p>";
            }, "");

var imgGuia = "420.jpg";

// await espere até retornar sucesso ou erro
async function Bot() {
  const browser = await puppeteer.launch({ headless: false });  //headless abre uma instancia do navegador true=não abre / false=abre

    // abre uma nova página 
  const page = await browser.newPage();

    // determina o tamanho em pixeis que a página será aberta
  await page.setViewport({ width: 0, height: 0 });

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

  // Troque "eu" pelo nome do contato exibido na sua lista de conversas
  await page.waitForTimeout(10000);
  await page.click('._3m_Xw span[title="' + contatoWhats + '"]');
  
  await page.waitForTimeout(2000);
    //   var htmlTxt = document.getElementsByClassName('_13NKt copyable-text selectable-text');
  
    //   await page.type(htmlTxt.);
 

  await page.type("._1UWac._1LbR4 ._13NKt", txtMsg);
  
  await page.waitForTimeout(3000);

  await page.click('div[title="Anexar"]');
  await page.waitForTimeout(2000);

  const imageInput = await page.$("ul._1HnQz li:nth-child(1) input[type=file]");

  imageInput.uploadFile("./public/storage/guias/"+imgGuia);
  

  await page.waitForTimeout(2000);

  await page.click('span[data-icon="send"]');
  await page.waitForTimeout(3000);

    //   await page.screenshot({ path: 'example.png' });
    //   await page.close();
    await browser.close();
}

Bot();