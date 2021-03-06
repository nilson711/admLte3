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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**Conta a quantidade de itens selecionados para recolhimento */
function ContarSelecionadosRecolhe(){
    var checkBoxes = document.querySelectorAll(".checkbox");                        //Seleciona todos os objetos da classe "checkbox"
    var QtdequipsSelecionadosRecolhe = document.getElementById("QtdequipsSelecionadosRecolhe");   //Seleciona o elemento pelo id
    var selecionados = 0;                                                           //cria uma variâvel chamada "selecionados" e atribui o valor 0 a ela

    //soma a quantidade de checkbox selecionados
    checkBoxes.forEach(function(el){                    //faz um forEach por todos os checkboxes da tabela
        if (el.checked) {                               //verifica que o checkbox está marcado
        selecionados++;                                 //se estiver marcado adiciona um incremento a variável
        }
    });
    //mostra a quantidade de checkboxes selecionados no elemento Html na página.
    QtdequipsSelecionadosRecolhe.innerHTML = "Total: " + selecionados + " equipamento(s) selecionado(s)";

    //torna visível o botão avançar

    
    if (selecionados > 0) {
        document.getElementById('btnAvancar').style.visibility = "visible";
        // document.getElementById('selectMotivo').style.visibility = "visible";
    } else {
        // document.getElementById('selectMotivo').style.visibility = "hidden";
        document.getElementById('btnAvancar').style.visibility = "hidden";
    }
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

    //Testa o tipo de solicitação
    var tipo = document.getElementById('type_solicit').value;
    switch (tipo) {
        case '1':
            // alert ("Esta solicitação é uma IMPLANTAÇÃO!");
            document.getElementById('btnConferido').style.visibility = "visible";
            break;
        case '3':
            alert ("Esta solicitação é um troca!");
            break;

        default:
            break;
    }
        // if (document.getElementById('type_solicit').value >= 3) {
            // alert ("Esta solicitação é um troca!");
        // };
    //Torna visível o Botão Conferido
    // if (document.getElementById('type_solicit').value == 1) {

        // if (document.getElementById('btnConferido').style.visibility = "hidden") {
        //     document.getElementById('btnConferido').style.visibility = "visible";
        // } else {
        //     document.getElementById('btnConferido').style.visibility = "hidden";
        // }
    // };

    //Torna visível o Botão Iniciar
    // if (document.getElementById('btnIniciar').style.visibility = "hidden") {
    //     document.getElementById('btnIniciar').style.visibility = "visible";
    // } else {
    //     document.getElementById('btnIniciar').style.visibility = "hidden";
    // }
}


/*********************************************************************************************************************************
 * Função BUSCA OS EQUIPAMENTOS DO PACIENTES QUE ESTÃO SELECIONADOS
 */
 function coletaDadosRecolhe(){
    var ids = document.getElementsByClassName('checkbox');  //Seleciona todos os objetos da classe "checkbox"
    var patrs = document.getElementsByClassName('checkbox');  //Seleciona todos os objetos da classe "checkbox"
    coletaIDsRecolhe(ids);
    coletaPatrRecolhe(patrs);
 }
 function coletaPatrRecolhe(dados){
    var array_dadosPatr = dados;                            //cria variável com os dados do array
    var newArrayPatr = [];                                  //cria o array
    for(var x = 0; x <= array_dadosPatr.length; x++){
         if(typeof array_dadosPatr[x] == 'object'){         //typeof retorna o tipo de operando. verifica de o array_dados é um objeto
           if(array_dadosPatr[x].checked){                  //verifica no array_dados se estão marcados
            newArrayPatr.push(array_dadosPatr[x].id)      //o push adiciona o dado (id) selecionado ao array
            }
        }
    }
    console.log(newArrayPatr);

    let sum = newArrayPatr;
    const codeHTML = sum.reduce((html, item) => {
        return html + "<li>" + item + "</li>";
            }, "");

    // var e = document.querySelector("#equipSelecionados").innerHTML = sum;
    document.querySelector("#enviarEquipRecolhe").value = sum;
    // document.querySelector("#enviarEquipRecolhe").innerHTML = sum;
    
  
 }

 //////////////////////////////////////////////////////////////////////
 function coletaIDsRecolhe(dados){
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
    // document.querySelector("#fooRecolhe").innerHTML = codeHTML;
    document.querySelector("#textEquipsRecolhe").innerHTML = sum;
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

    // console.log(sum.length);

    if (sum.length > 0) {
        document.getElementById("btnSolicita").style.display = "block";
    } else {
        document.getElementById("btnSolicita").style.display = "none";
    }

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

/********************************************************************************************************************************
 * Função Adiciona / Seleciona todos os equipamentos 
 */
function addTodosEquips(){
    document.getElementById('tableEquipsRecolhe').style.visibility = 'visible';
    var checkbox_recolhe = document.querySelectorAll(".checkbox-recolhe");                        //Seleciona todos os objetos da classe "checkbox-recolhe"
    var QtdequipsSelecionadosRecolhe = document.getElementById("QtdequipsSelecionadosRecolhe");   //Seleciona o elemento pelo id
    var selecionados = 0;  
    document.getElementById('obsSolicitacaoRecolhe').focus();

    //soma a quantidade de checkbox selecionados
    checkbox_recolhe.forEach(function(el){                    //faz um forEach por todos os checkboxes da tabela
            if (!el.checked) {                               //verifica que o checkbox não está marcado
            selecionados++;                                 //se não estiver estiver marcado adiciona um incremento a variável
            el.checked = true;                              //marca o checkbox como true (selecionado)
        }
        QtdequipsSelecionadosRecolhe.innerHTML = "Total: " + selecionados + " equipamento(s) selecionado(s)";
        document.getElementById('btnAvancar').style.visibility = "visible";
        document.getElementById('fotoEquip').style.visibility = "hidden";
        });
}

/********************************************************************************************************************************
 * Função Remove / Desmarca todos os equipamentos 
 */
function removeTodosEquips(){
    document.getElementById('tableEquipsRecolhe').style.visibility = 'visible';
    var checkbox_recolhe = document.querySelectorAll(".checkbox-recolhe");                        //Seleciona todos os objetos da classe "checkbox-recolhe"
    var QtdequipsSelecionadosRecolhe = document.getElementById("QtdequipsSelecionadosRecolhe");   //Seleciona o elemento pelo id
    var selecionados = 0;  

    //soma a quantidade de checkbox selecionados
    checkbox_recolhe.forEach(function(el){                    //faz um forEach por todos os checkboxes da tabela
        if (el.checked) {                               //verifica que o checkbox está marcado
            selecionados = 0;                                 //se não estiver estiver marcado tira um incremento a variável
            el.checked = false;                              //desmarca o checkbox como true (selecionado)
        }
        QtdequipsSelecionadosRecolhe.innerHTML = "Total: " + selecionados + " equipamento(s) selecionado(s)";
        document.getElementById('btnAvancar').style.visibility = "hidden";
    });
}

/*********************************************************************************************************************************
 * Função Deixa o botão SOLICITAR visivel se houver algum equipamento selecionado E o motivo da solicitação
 */
function habilitarBtnSolicitar(){
    let motivo = document.getElementById('motivo').value;
    switch (motivo) {
        case '1': case '2': 
            addTodosEquips();
            coletaDadosRecolhe();
            if (motivo == 1) {
                document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Alta";
            }else{
                document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Óbito";
            }
            break;
        case '3':
            removeTodosEquips();
            coletaDadosRecolhe();
            document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Sem uso";
            break;
        case '4':
            var resultado = confirm('PACIENTE INTERNADO. \n\nEm vez de fazer o recolhimento, você pode solicitar uma \n\nPAUSA de 10 dias nas cobranças.\n\n \u2611 Clique em "OK" se você quer fazer a PAUSA.\n \u274C Clique em "Cancelar" para continuar com o Recolhimento.\n');
                if (resultado == true) {
                    alert("OK! \n\nPAUSA aplicada na data de hoje!");
                    location.reload();     //recarrega a página atual
                }
                else{
                    alert("OK! \n\nVocê quer continuar com o Recolhimento.\n ");
                    addTodosEquips();
                    coletaDadosRecolhe();
                    document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Paciente internado";
                }
            break;
        case '5': case '7': case '9':
            if (motivo == 5) {
                alert('No campo "Observações" especifique o problema apresentado no equipamento para justificar a retirada.');
                document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Equipamento não atende a necessidade";
            }else if(motivo == 7){
                alert('No campo "Observações" especifique o problema apresentado no equipamento para justificar a troca.\nÉ recomendável enviar uma foto ou vídeo apresentando o problema.');
                document.getElementById('fotoEquip').style.visibility = "visible";
                document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Troca de Equipamento";
            }
                removeTodosEquips();
                coletaDadosRecolhe();
                document.getElementById('obsSolicitacaoRecolhe').focus();
            break;
        case '6':
                alert('No campo "Observações" informe para qual Home Care o paciente será migrado.');
                addTodosEquips();
                coletaDadosRecolhe();
                document.getElementById('txtMotivo').innerHTML = "Tipo: Recolhimento / Motivo: Troca de Home Care";
            break;
    }

}

function obsNotNull(){
    if (document.getElementById('motivo').value != 9) {
            //    document.getElementById('btnSolicitaRecolhe').style.visibility = "visible";
            document.getElementById('tableEquipsRecolhe').style.visibility = 'visible';
           
    } else {
        // document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
        document.getElementById('tableEquipsRecolhe').style.visibility = 'visible';

    }
}



function obsForNull(){
    if (document.getElementById('obsSolicitacaoRecolhe') = null) {
        document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
    }
}



/*********************************************************************************************************************************
 * Função MOSTRA O SPINNER rodando enquanto o email é enviado
 */

function habilitaSpinner(){
    document.getElementById('spinnerFinalizando').style.visibility = "visible";
    // document.getElementById('btnConclui').style.visibility = "hidden";
    // alert("mostrar o spinner");
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

/*********************************************************************************************************************************
 * Converte o texto do input em MAIUSCULAS
 */
function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}

  /**********************************************************
    *Seleciona a primeira opção do select horário
    O sle que será manipulado deve conter apenas class="form-control"
    outras classe aplicadas impedem que o código funcione.
    */
   function limpa_horas(){

       var text = 'Selecione';
       var select = document.querySelector('#horarios');
       for (var i = 0; i < select.options.length; i++) {
           if (select.options[i].text === text) {
               select.selectedIndex = i;
               break;
            }
        }
        // ====================================================
    }


/*********************************************************************************************************************************
 * Verifica A Data e Hora atuais e habilita ou desabilita horários
 */
function horasHoje(){
    
    var hora_sel =  document.getElementById('horarios').value;
    var dt_atual = new Date();
    var hr_atual = dt_atual.getHours();
    
    var hsValidas;
    var idselect;
    var horarios = document.querySelector("#horarios");
    var txtSelected = "Selecione";
    
    limpa_horas();

    for(var i = 0; i < horarios.length; i++) {
        // console.log(horarios.options[i].text);
        if (horarios[i].value > 1 ) {
            //Habilita apenas os horários maiores que o atual
            if(horarios[i].value > hr_atual) {
                hsValidas = horarios[i].value;
                // console.log("select_"+hsValidas);
                idselect = "select_"+hsValidas;
                document.getElementById(idselect).disabled = false;
            }else{
                hsValidas = horarios[i].value;
                // console.log("select_"+hsValidas);
                idselect = "select_"+hsValidas;
                document.getElementById(idselect).disabled = true;
            }
        }
    } 

    //Habilita a opção Manhã
    if (hr_atual < 11 ) {
        document.getElementById('select_2').disabled = false;
    }
    // Habilita a opção Tarde
    if (hr_atual < 17 ) {
        document.getElementById('select_3').disabled = false;
    }
    document.getElementById('hsAtual').value = hr_atual;
}

/*********************************************************************************************************************************
 * Habilita as todos os horários disponíveis
 */

function horasAmanha(){
    var hora_sel =  document.getElementById('horarios').value;
    var dt_atual = new Date();
    var hr_atual = dt_atual.getHours();

    var hsValidas;
    var horarios = document.getElementById("horarios");

    limpa_horas();

    for(var i = 0; i < horarios.length; i++) {
        if(horarios[i].value > 0) {
            hsValidas = horarios[i].value;
            // console.log("select_"+hsValidas);
            var idselect = "select_"+hsValidas;
            document.getElementById(idselect).disabled = false;
            
        };
    } 
}

/*********************************************************************************************************************************
 * Desabilita os horários menores que o atual
 */

function desabilitarHSanteriores(){

    var hora_sel =  document.getElementById('horarios').value;
    var dt_atual = new Date();
    var hr_atual = dt_atual.getHours();
   
    var hsValidas;
    var horarios = document.getElementById("horarios");
   
    for(var i = 0; i < horarios.length; i++) {
        // if(horarios[i].value < hr_atual) {
            hsValidas = horarios[i].value;
            console.log("select_"+hsValidas);
            var idselect = "select_"+hsValidas;
            document.getElementById(idselect).disabled = true;
            
            // };
        } 
        
}

/*********************************************************************************************************************************
 * Mensagem sobre a hora e motivo selecionados
 */

function msgHora(){
    var hora_sel =  document.getElementById('horarios').value;
    var motivo = document.getElementById('motivo').value;

    var dt_atual = new Date();
    var hr_atual = dt_atual.getHours();

    // if (hora_sel > 3) {
    //     if (hora_sel < hr_atual) {
    //         alert('O horário selecionado é anterior a hora atual!\nSelecione um horário válido.');
            
    //     } else {
    //         alert('ATENÇÃO!\nAvise os familiares\nPoderá ocorrer atrasos devido ao trânsito, excesso de demanda e outros imprevistos!');
    //     }
    // }
    // if (motivo < 5) {
    //     document.getElementById('btnSolicitaRecolhe').style.visibility = "visible";
    // }
    
    // if (hora_sel < '1') {
    //     document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
    //     document.getElementById('obsSolicitacaoRecolhe').style.visibility = 'hidden';
    // }else{
    //     document.getElementById('obsSolicitacaoRecolhe').style.visibility = 'visible';
    //     document.getElementById('btnSolicitaRecolhe').style.visibility = "visible";
    //     document.getElementById('obsSolicitacaoRecolhe').focus();
    // }
    console.log (hora_sel);
    
    document.getElementById('btnAvancar').style.visibility = "visible";

    var txtResumo = document.getElementById('txtMotivo').value;
    var txtEquips = document.getElementById('textEquipsRecolhe').value;
    var obs = document.getElementById('obsSolicitacaoRecolhe').value;
    var dtAgenda = document.getElementById('dtAgendamento').value;
    // var hsAgenda = document.getElementById('horarios').textContent;
    
    //Seleciona o texto do item selecionado nos horários
    var hsAgenda = document.getElementById('horarios');
    var hsSel = hsAgenda.children[hsAgenda.selectedIndex];
    var txtHsAgenda = hsSel.textContent;

   
    console.log(txtHsAgenda);

    /***************************************************************************************************************
     *Formatar data da agenda para padrão DD/MM/YYYY
     **************************************************************************************************************/
    function adicionaZero(numero){
        if (numero <= 9) 
            return "0" + numero;
        else
            return numero; 
    }

    let data = new Date(dtAgenda);
    let dataFormatada = (adicionaZero(data.getUTCDate().toString()) ) + "/" + (adicionaZero(data.getMonth()+1).toString()) + "/" + data.getFullYear(); 
    
    /***************************************************************************************************************/
    // console.log(dataFormatada);

    document.getElementById('resumoSolicit').innerHTML = "Dia: " +  dataFormatada + " - (" + txtHsAgenda + ")" + "\n" + txtResumo + "\n" + "Obs: "+ obs + "\n" + "Equipamento(s): " + txtEquips;
    // console.log(dtAgenda);
    
   
    // setTimeout(function() {
    //     document.getElementById('resumoSolicit').focus();
    // }, 5000);

}



function selMotivo(){
    var motivo = document.getElementById('motivo').value;
    switch (motivo) {
        case '5':
            alert('No campo "Observações" especifique o problema apresentado no equipamento para justificar a retirada.');
            document.getElementById('obsSolicitacaoRecolhe').focus();
            break;
        case '6':
            alert('No campo "Observações" informe para qual Home Care o paciente será migrado.');
            document.getElementById('obsSolicitacaoRecolhe').focus();
            break;
        case '7':
            alert('No campo "Observações" especifique o problema apresentado no equipamento para justificar a troca.');
            document.getElementById('obsSolicitacaoRecolhe').focus();
            break;
        case '8':
            alert('No campo "Observações" informe uma justificativa para retirada do equipamento.');
            document.getElementById('obsSolicitacaoRecolhe').focus();
            break;
    }
}
// document.getElementById('horarios').focus();
// alert('Selecione o horário previsto para solicitação.');

function selHora(){
    //dtAgendamento é o input que pega a data selecionada
    var sel_data = new Date( document.getElementById('dtAgendamento').value);
    // var sel_dia = sel_data.getUTCDate();
    var sel_dia = sel_data.getUTCDate();
    var sel_mes = sel_data.getUTCMonth();
    var sel_ano = sel_data.getUTCFullYear();
    var nr_day = sel_data.getUTCDay();

    var hoje = new Date();
    var atual_dia = hoje.getDate();
    var atual_mes = hoje.getUTCMonth();
    var atual_ano = hoje.getUTCFullYear();

    // console.log('nr '  + sel_data.getUTCDay());   //número do dia da semana (0=dom, 1=seg, 2=ter, 3=qua, 4=qui, 5=sex, 6=sab)
    // console.log(tem_cama);
    // console.log('dia ' + sel_dia);                //retorna o dia do mês (1 a 31)
    // console.log('dia atual ' + atual_dia);         //retorna o dia de hoje (1 a 31)
    // console.log('mes ' + sel_mes);                //retorna o mês (0=jan, 1=fev, 2=mar, 3=abr, 4=mai, 5=jun, 6=jul, 7=ago, 8=set, 9=out, 10=nov, 11=dez)
    // console.log('mes atual ' + atual_mes);        //retorna o mês atual (0=jan, 1=fev, 2=mar, 3=abr, 4=mai, 5=jun, 6=jul, 7=ago, 8=set, 9=out, 10=nov, 11=dez)
    // console.log('ano ' + sel_ano);                //retorna o ano
    // console.log('ano atual ' + atual_ano);        //retorna o ano atual

    //Busca dentro do input dos equipamentos selecionado se tem alguma CAMA
    var tem_cama = document.getElementById('textEquipsRecolhe').value;
    var test_cama = tem_cama.indexOf("CAMA");
    console.log(test_cama);

    //Verifica se o dia da semana é sábado ou domingo
    if (nr_day == 6 || nr_day == 0) {
        //Verifica se tem cama na solicitação
        if (test_cama > 0) {
            alert('\u274C Não recolhemos ou implantamos CAMAS aos finais de semana!\n\n Em casos de EXTREMA urgência favor entrar em contato \n com o Plantão de Intercorrências.')
            document.getElementById('dtAgendamento').value = null;
            document.getElementById('btnAvancar').style.visibility = "hidden";
        }else{
            alert('\u274C Não fazermos Recolhimentos aos finais de semana! \n\n Em casos de EXTREMA urgência favor entrar em contato \n com o Plantão de Intercorrências.');
            document.getElementById('dtAgendamento').value = null;
            document.getElementById('selhorarios').style.visibility = "hidden";

        }
    }else{

        if (sel_ano >= atual_ano) {
            if (sel_mes >= atual_mes) {
                if (sel_dia >= atual_dia) {
                    // alert('Selecione um horário!');
                    document.getElementById('selhorarios').style.visibility = "visible";
                    document.getElementById('horarios').focus();
                    
                    //Habilita os horários de hoje e de amanhã
                        if (sel_dia == atual_dia) {
                            horasHoje();
                        } else {
                            horasAmanha();
                        }

                    
                        
                }else{
                    if (sel_mes > atual_mes) {
                        // alert('O dia é menor mas o mês é maior!');
                        horasAmanha();
                        document.getElementById('selhorarios').style.visibility = "visible";
                        document.getElementById('horarios').focus();
                    }else{
                        alert('A data selecionada é anterior a data atual!');
                        document.getElementById('dtAgendamento').value = null;
                        document.getElementById('selhorarios').style.visibility = "hidden";
                        document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
                        document.getElementById('obsSolicitacaoRecolhe').style.visibility = 'hidden';
                    }
                }
            }else{
                alert('A data selecionada é anterior a data atual!');
                document.getElementById('dtAgendamento').value = null;
                document.getElementById('btnAvancar').style.visibility = "hidden";
                document.getElementById('obsSolicitacaoRecolhe').style.visibility = 'hidden';
            }
        }else{
            alert('A data selecionada é anterior a data atual!');
            document.getElementById('dtAgendamento').value = null;
            document.getElementById('btnAvancar').style.visibility = "hidden";
            document.getElementById('obsSolicitacaoRecolhe').style.visibility = 'hidden';
        }
    }
}

function viewBtnSolicita(){
    document.getElementById('btnSolicitaRecolhe').style.visibility = "visible";
}
function checkSolicit(){
    if (document.getElementById('checkSolicitOk').checked) {
        document.getElementById('btnSolicitaRecolhe').style.visibility = "visible";
    }else{
        document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
    }
    console.log(document.getElementById('checkSolicitOk').value);
}

function offBtnSolicita(){
    document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
}

function viewSpinner(){
    document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
    document.getElementById('spinnerFinalizandoRecolhe').style.visibility = "visible";
}


function desativaBtnSolicitar(){
    document.getElementById('btnSolicitaRecolhe').style.visibility = "hidden";
    document.getElementById('btnAvancar').style.visibility = "visible";
}


function desativarBtnAvancar(){
    document.getElementById('btnVoltar').style.visibility = "visible";
    document.getElementById('btnAvancar').style.visibility = "hidden";
}

function desativarBtnVoltar(){
    document.getElementById('btnVoltar').style.visibility = "hidden";
    document.getElementById('btnAvancar').style.visibility = "visible";
}

