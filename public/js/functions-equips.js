// const { functionsIn } = require("lodash");

function locacaoSelecionada() {
    var rent_equip = document.getElementById("rent_equip");
    var rent_empresa = document.getElementById("rent_empresa");
    var dataRent = document.getElementById("data_rent");
    var selectPctList = document.getElementById("selectPctList");
    var guia_loc = document.getElementById("guia_loc");
    var selectEmpresaRent = document.getElementById("selectEmpresaRent");
    // Get the checkbox


    var str_data = new Date();
    var dia = String(str_data.getDate()).padStart(2, '0');
    var mes = String(str_data.getMonth() + 1).padStart(2, '0');
    var ano = str_data.getFullYear();

    var hoje = String(str_data.getDate()).padStart(2, '0');
    dataAtual = dia + '/' + mes + '/' + ano;

    // // Mostra o resultado
    // alert('Hoje é ' + dataAtual);

    // If the checkbox is checked, display the output text
    if (rent_equip.checked == true){
        // alert('Selecione a empresa que alugou o equipamento!')
        selectPctList.style.visibility = "visible";
        rent_empresa.style.visibility = "visible";
        dataRent.style.visibility = "visible";
        guia_loc.style.visibility = "visible";

        selectEmpresaRent.focus();

    } else {
        dataRent.style.visibility = "hidden";
        rent_empresa.style.visibility = "hidden";
        selectPctList.style.visibility = "hidden";
        guia_loc.style.visibility = "hidden";

    }
  }


  function data_rentSelecionada() {
    // Get the checkbox
    var checkBox = document.getElementById("rent_equip");
    var textPct = document.getElementById("textoPct");
    var textomsg = document.getElementById("textomsg");
    var selectPctList = document.getElementById("selectPctList");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        textomsg.innerHTML = "Data selecionada com sucesso!";
        textomsg.style.color = "green";
        selectPct.style.visibility = "visible";
        textPct.style.display = "block";
        selectPctList.focus();
    } else {
      text.style.display = "none";
    }
  }

  function pctSelecionado() {
    // Get the checkbox
    var checkBox = document.getElementById("rent_equip");
    var guia_loc = document.getElementById("guia_loc");
    var dataRent = document.getElementById("data_rent");

    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
        alert('Selecione a data de início de locação!')
        dataRent.focus();
    } else {

    }
  }

  function guiaSelecionada (){
    var guia_loc = document.getElementById("guia_loc");
    var textoguia = document.getElementById("textoguia");
    var desc_equip = document.getElementById("desc_equip");
    var btn_salvar = document.getElementById("btn_salvar");

    if (guia_loc =!null) {
        textoguia.style.color = "green";
        textoguia.innerHTML = "Guia adicionada com sucesso!"
        desc_equip.focus();
        btn_salvar.style.visibility = "visible";
    }
  }

 /*********************************************************************************************************************************
  Função conta a quantidade de itens selecionados com o checkbox nas linhas da tabela
   */
  function ContarSelecionados (){
    var checkBoxes = document.querySelectorAll(".checkbox");                        //Seleciona todos os objetos da classe "checkbox"
    var QtdequipsSelecionados = document.getElementById("QtdequipsSelecionados");   //Seleciona o elemento pelo id
    var selecionados = 0;                                                           //cria uma variâvel chamada "selecionados" e atribui o valor 0 a ela

    //soma a quantidade de checkbox selecionados
    checkBoxes.forEach(function(el){                    //faz um forEach por todos os checkboxes da tabela
        if (el.checked) {                               //verifica que o checkbox está marcado
        selecionados++;                                 //se estiver marcado adiciona um incremento a variável
        }
    });
    //mostra a quantidade de checkboxes selecionados no elemento Html na página.
    QtdequipsSelecionados.innerHTML = "Total: " + selecionados + " equipamento(s) selecionado(s)";
}

/*********************************************************************************************************************************
 * Função coletaProdutoSelecionado busca na tabela o id dos itens selecionados
 */

 function coletaProdutoSelecionado(){
    var idsEquip = document.getElementsByClassName('selectEquip');  //Seleciona todos os objetos da classe "selectEquip"
    coletaIDsEquip(idsEquip);
    
 }
 function coletaIDsEquip(dados){
    var array_dados_equip = dados;                                  //cria variável com os dados do array
    var newArrayEquip = [];                                         //cria o array
    var somaSelecionados = 0; 
    for(var x = 0; x <= array_dados_equip.length; x++){
         if(typeof array_dados_equip[x] == 'object'){               //typeof retorna o tipo de operando. verifica de o array_dados_equip é um objeto
           newArrayEquip.push(array_dados_equip[x].value)           //o push adiciona o dado selecionado ao array
            if (array_dados_equip[x].value =='') {                  //se o valor for vazio ele não soma
                //não faz nada
            } else {
                somaSelecionados++;                                 //soma se o valor for diferente de vazio
            }
        }
       
    }
    
    let sum = newArrayEquip;
    const codeHTML = sum.reduce((html, item) => {
        return html + "<li>" + item + "</li>";
            }, "");
  
    var e = document.querySelector("#equipSelecionados").innerHTML = sum;
    document.querySelector("#enviarEquip").value = e;
    
    console.log(newArrayEquip);
    console.log(somaSelecionados);
    

    // Se a quantidade de equipamentos selecionados for diferente do tamanho do newArrayEquip(equipamentos solicitados)
        if (somaSelecionados !== sum.length ) {                                 
            document.getElementById('txtAvisoQtd').style.display = "block"; //torna visível a mensagem de quantidade diferente
        } else{
            document.getElementById('txtAvisoQtd').style.display = "none";
        }
    

    //Torna visível o Botão Conferido
    if (document.getElementById('btnConferido').style.visibility = "hidden") {
        document.getElementById('btnConferido').style.visibility = "visible";
    } else {
        document.getElementById('btnConferido').style.visibility = "hidden";
    }

    //Torna visível o Botão Iniciar
    if (document.getElementById('btnIniciar').style.visibility = "hidden") {
        document.getElementById('btnIniciar').style.visibility = "visible";
    } else {
        document.getElementById('btnIniciar').style.visibility = "hidden";
    }
}


    


/*********************************************************************************************************************************
 * Função coletaDados busca na tabela o nome dos itens selecionados
 */

function coletaDados(){
    var ids = document.getElementsByClassName('checkbox');  //Seleciona todos os objetos da classe "checkbox"
    coletaIDs(ids);
 }

 function coletaIDs(dados){
    var array_dados = dados;                            //cria variável com os dados do array
    var newArray = [];                                  //cria o array
    for(var x = 0; x <= array_dados.length; x++){
         if(typeof array_dados[x] == 'object'){         //typeof retorna o tipo de operando. verifica de o array_dados é um objeto
           if(array_dados[x].checked){                  //verifica no array_dados se estão marcados
                newArray.push(array_dados[x].name)      //o push adiciona o dado selecionado ao array
            }
        }
    }
    // console.log(newArray);
    // NomeEquipsSelecionados.innerHTML = newArray;    //exibe na página os elementos do array (nomes dos equipamentos)

    //CRIA UMA LISTA A PARTIR DO ARRAY ///////////////////////////////////////////////////////////////////////////////////////////
    let sum = newArray;
    const codeHTML = sum.reduce((html, item) => {
        return html + "<li>" + item + "</li>";
            }, "");
    document.querySelector("#foo").innerHTML = codeHTML;

    document.querySelector("#textEquips").innerHTML = sum;

 }

 /*********************************************************************************************************************************
 * Função busca a quantidade solicitada
 */
 function qtdSolicitada(value) {
    var array_qtd = value;                        //cria variável com os dados do array
        var newArrayQtd = [];                              //cria o array
        for(var x = 0; x <= array_qtd.length; x++){
            //  if(typeof array_qtd[x] == 'object'){     //typeof retorna o tipo de operando. verifica de o array_dados é um objeto
            if(array_qtd[x]>0){                       //verifica no array_dados é maior que 0
                // alert('entrou');
                newArrayQtd.push(array_qtd[x])      //o push adiciona o dado selecionado ao array
               }
            //  }
        }
        NomeEquipsSelecionados.innerHTML =  NomeEquipsSelecionados.innerHTML + value;    //exibe na página os elementos do array (nomes dos equipamentos)

        // qtd_solicitada = value;

        // console.log(value);
        console.log(newArrayQtd);

    // });
}

function buscaSelecionados(ClassQtdDoItem, ClassCheckbox){
let qtd = document.getElementsByClassName(ClassQtdDoItem).value;
let name = document.getElementsByClassName(ClassCheckbox);

var array_dados = qtd + name;                        //cria variável com os dados do array
    var newArray = [];                              //cria o array
    for(var x = 0; x <= array_dados.length; x++){
         if(typeof array_dados[x] == 'object'){     //typeof retorna o tipo de operando. verifica de o array_dados é um objeto
        //    if(array_dados[x].checked){              //verifica no array_dados se estão marcados
                    newArray.push(array_dados[x])      //o push adiciona o dado selecionado ao array
            // }
        }
    }
    console.log(name);
}

function urgente() {
    // Get the checkbox
    var checkUrgente = document.getElementById("checkUrgente");

    // If the checkbox is checked, display the output text
    if (checkUrgente.checked == true){
        alert('ATENÇÃO! \nAo marcar uma solicitação como "Urgente" ela aparecerá como prioridade na lista de atendimentos. \nIsso afetará a logística das demais solicitações. \nPortanto só marque se for realmente necessário!' )
    }

  }
  /*********************************************************************************************************************************
 * Função cancela uma solicitação
 */
function func_cancelar(){
    let status = document.getElementById('status').value;
    status = 3;
}

 /*********************************************************************************************************************************
 * Função Deixa o input com preenchimento obrigatório ou não
 */
function txtCancelRequired(){
    document.getElementById('txtCancel').required = true;
}
function txtCancelNoRequired(){
    document.getElementById('txtCancel').required = false;
}

/*********************************************************************************************************************************
 * Função Deixa o botão FINALIZAR visivel somente se houver algum equipamento selecionado
 */

function habilitarBtnFinalizar(){

    if (document.getElementById('linkBtnFinalizar').style.visibility = "hidden") {
        document.getElementById('linkBtnFinalizar').style.visibility = "visible";
        
    } else {
        document.getElementById('linkBtnFinalizar').style.visibility = "hidden";
        
    }
    
}

/*********************************************************************************************************************************
 * Habilitar botão conferido
 */
function btnConferido(){
 if (document.getElementById('btnConferido').style.visibility = "hidden") {
    document.getElementById('btnConferido').style.visibility = "visible";
    
} else {
    document.getElementById('btnConferido').style.visibility = "hidden";
    
}

}



