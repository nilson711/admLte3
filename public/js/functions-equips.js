

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

  function ContarSelecionados (){
    var checkBoxes = document.querySelectorAll(".checkbox");
    var QtdequipsSelecionados = document.getElementById("QtdequipsSelecionados");
    var selecionados = 0;

    //soma a quantidade de checkbox selecionados
    checkBoxes.forEach(function(el){
        if (el.checked) {
        selecionados++;
        }
    });

      QtdequipsSelecionados.innerHTML = "Total: " + selecionados + " equipamento(s) selecionado(s)";

    // console.log(selecionados);
    // console.log(QtdequipsSelecionados);

}

function coletaDados(){
    var ids = document.getElementsByClassName('checkbox');
    coletaIDs(ids);
 }

 function coletaIDs(dados){
    var array_dados = dados;
    var newArray = [];
    for(var x = 0; x <= array_dados.length; x++){
         if(typeof array_dados[x] == 'object'){
           if(array_dados[x].checked){
              newArray.push(array_dados[x].id)
           }
         }
    }
//    if(newArray.length <= 0){
//      alert("Selecione um pelo menos 1 item!");
//    }else{
//      alert("Seu novo array de IDs tem os seguites ids [ "+newArray+" ]");
//    }
console.log(newArray);

NomeEquipsSelecionados.innerHTML = newArray;
 }
