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
 * Função coletaDados busca na tabela o nome dos itens selecionados
 */

function coletaDados(){
    var ids = document.getElementsByClassName('checkbox');  //Seleciona todos os objetos da classe "checkbox"
    coletaIDs(ids);
 }

 function coletaIDs(dados){
    var array_dados = dados;                        //cria variável com os dados do array
    var q = 0;
    var newArray = [];                              //cria o array

    // var qtd_i = qtds;
    for(var x = 0; x <= array_dados.length; x++){
         if(typeof array_dados[x] == 'object'){     //typeof retorna o tipo de operando. verifica de o array_dados é um objeto
           if(array_dados[x].checked){              //verifica no array_dados se estão marcados
                q = qtd_solicitada;
                    newArray.push( q + array_dados[x].id)      //o push adiciona o dado selecionado ao array
            }
        }
    }
    console.log(newArray);
    // NomeEquipsSelecionados.innerHTML = newArray;    //exibe na página os elementos do array (nomes dos equipamentos)


 }

 /*********************************************************************************************************************************
 * Função busca a quantidade solicitada
 */
 function qtdSolicitada(value) {
    $(document).ready(function(){
        // alert(value);


    var array_qtd = value;                        //cria variável com os dados do array
        // var newArray = [];                              //cria o array

        // var qtd_i = qtds;
        // for(var x = 0; x <= array_qtd.length; x++){
            //  if(typeof array_qtd[x] == 'object'){     //typeof retorna o tipo de operando. verifica de o array_dados é um objeto
            //    if(array_qtd[x]>0){
                             //verifica no array_dados é maior que 0
                //   newArray.push(array_dados[x].id)      //o push adiciona o dado selecionado ao array
            //    }
            //  }
        // }
        // NomeEquipsSelecionados.innerHTML =  NomeEquipsSelecionados.innerHTML + value;    //exibe na página os elementos do array (nomes dos equipamentos)

        qtd_solicitada = value;
    });


}

