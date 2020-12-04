var backUrl = "http://localhost:8080/api/";

//CÓDIGOS DE STATUS
let STR = 0;
let AGL = 1;
let DEF = 2;
let DEX = 3;
let VIT = 4;
let VIDA_MAXIMA = 5;
let VIDA_ATUAL = 6;
let MANA_MAXIMA = 7;
let MANA_ATUAL = 8;

//CÓDIGOS DE ERRO
let FORMULA_INVALIDA = -10;
let ITEMS_INSUFICIENTES_PARA_CRIACAO = -11;
let ITENS_INSUFICIENTES_CONSUMO = -12;

//TIPOS DE ITEM
let CRIACAO = "CRIACAO";
let CONSUMIVEL = "CONSUMIVEL";

$(window).ready(function(){
  
});

$(document).ready(function(){
  localStorage.setItem("apiToken", $("#apiToken").val());
  let bearer = 'Bearer ' + $("#apiToken").val();

  $.ajaxSetup({
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      Authorization: bearer
    },
    crossOrigin: true,
  });

  atualizarDados();
  associarAcoes();  

});

var telaConsumirItem = function(){
  removerSelecoes();

  let consumivel = $(this);
  let img = consumivel.find("img");

  fecharOpcoesCriacoes();

  Swal.fire({
      title: '<div class="text-center"><img class="img-fluid" src="'+img.attr("src")+'"> <h3>Desejar utilizar: ' + consumivel.attr("nome") + "?</h3></div>",
      text: consumivel.attr("desc"),
      showCancelButton: true,
      confirmButtonColor: '#67d559',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim',
      cancelButtonText: 'Não'
    }).then((result) => {
      let dataJson = { "id": consumivel.attr("idConsumivel") };

      if (result.isConfirmed) {
        consumirItem(consumivel.attr("nome"), consumivel.attr("idConsumivel"));
      }
    })
}

var consumirItem = function(nomeConsumivel, idConsumivel){
  $.ajax({
    url: backUrl + "Items/ConsumirItem",
    method: "POST",
    data: JSON.stringify({"idConsumivel": idConsumivel}),
    
    success: function(response){
      let messageText = nomeConsumivel + " utilizada(o) com sucesso!";
      let icon = 'success';

      if(response.codeReturn == ITENS_INSUFICIENTES_CONSUMO){
        messageText = "Você não possui unidades do item para ser consumido!";
        icon = 'error';
      }else{ 
        atualizarDados();
      }

      Swal.fire({
        position: 'top-end',
        icon: icon,
        title: messageText,
        showConfirmButton: false,
        timer: 1500
      });
    },

    error: function(response){
      console.log(response);
    }
  });
}

var abrirOpcoesCriacoes = function(){
  fecharOpcoesCriacoes();

  let item = $(this);
  let posicaoItem = item.offset();

  criarTelaOpcoesCriacoes(item, posicaoItem.top, posicaoItem.left);
}

var criarTelaOpcoesCriacoes = function(item, posicaoTop, posicaoLeft){
  console.log(item);

  let opcoesTela = $("<div>",{
    class: "criacaoOpcoes"
  }).html("<ul class='list-group'>"
            + "<li id='combinarItem' class='list-group-item'><a class='list-group-link' href='#'><i class='fa fa-bong'></i> Combinar com...</a></li>"
            + "<li id='descartarItem' class='list-group-item'><a class='list-group-link' href='#'><i class='fa fa-trash'></i> Descartar</a></li>"
        + "</ul>");

  opcoesTela.offset({top: posicaoTop, left: posicaoLeft + 90});

  $.when(opcoesTela.appendTo("body")).then(function(){
    let combinarItemButton = $("#combinarItem");
    let descartarItem = $("#descartarItem");

    descartarItem.click(function(){
      if(item.attr("quantidade") <= 0){
        Swal.fire(
          'Você não possui unidades do item para remover!',
          '',
          'error'
        );
      }else{
        removerSelecoes();
        fecharOpcoesCriacoes();

        Swal.fire({
          title: '<div class="text-center">'
                    +'<img class="img-fluid" src="'+item.find("img").attr("src")+'">'
                    +'<h4>Deseja descartar quantos(as) '+item.attr("nome")+'?</h4>'
                    +'<input id="quantidadeRemocao" type="number" min="1" max="'+item.attr("quantidade")+'" value="1"/>'
                  +'</div>',
          text: '',
          showCancelButton: true,
          confirmButtonColor: '#67d559',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Remover',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          let dataJson = { "idItem": parseInt(item.attr("idCriacao")), "quantidade": parseInt($("#quantidadeRemocao").val()), "tipoItem": CRIACAO };

          if (result.isConfirmed) {
            $.ajax({
              url: backUrl + 'Items/DescartarItems',
              method: 'POST',
              data: JSON.stringify(dataJson),

              success: function(){
                Swal.fire(
                  'O item foi removido!',
                  '',
                  'success'
                );

                fecharOpcoesCriacoes();
                removerSelecoes();
                atualizarDados();
              },

              error: function(){
                
              }
            });
          }
        });
      }
    });
  

    combinarItemButton.click(function(){
      item.attr("itemSelected", true);

      $(".item.criacao").unbind("click").click(function(){
        removerSelecoes();
      });

      $(".item.criacao[itemSelected='false']").unbind().click(function(){
        $(this).attr("itemSelected", true);

        let itemsSelecionados = $(".item.criacao[itemSelected='true']");

        if(itemsSelecionados.length > 1){
          combinarItems(itemsSelecionados);
        }
      });

      fecharOpcoesCriacoes();
    });
  })
}

var combinarItems = function(itemsSelecionados){
  Swal.fire({
    title: '<div class"text-center">'
          + '<div>'
          + '<img src="' + itemsSelecionados.eq(0).find("img").attr("src") + '">'
          + '<img src="' + itemsSelecionados.eq(1).find("img").attr("src") + '">'
          + '</div>'
          + '<p class="text-center">Deseja combinar os items: <br>' + itemsSelecionados.eq(0).find("h3").html() + " + " + itemsSelecionados.eq(1).find("h3").html() + '</p>'
          + '</div>',
    text: "",
    showCancelButton: true,
    confirmButtonColor: '#67d559',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim',
    cancelButtonText: 'Não'
  }).then((result) => {
    let dataJson = { };

    if (result.isConfirmed) {
      let idItemPrimario = itemsSelecionados.eq(0).attr("idCriacao");
      let idItemSecundario = itemsSelecionados.eq(1).attr("idCriacao");

      $.ajax({
        url: backUrl + "Items/CriarConsumiveis/"+idItemPrimario+"/"+idItemSecundario,
        method: "GET",

        success: function(response){
          console.log(response)
          if(response.codeReturn == FORMULA_INVALIDA){
            Swal.fire(
              'Fórmula Inválida!',
              'Os itens selecionados não criam nenhum item consumível',
              'error'
            )
          }else if(response.codeReturn == ITEMS_INSUFICIENTES_PARA_CRIACAO){
            Swal.fire(
              'Quantidade inválida para criação!',
              'Você não possui unidades dos items da fórmula para criar um novo item de consumo.',
              'error'
            )
          }else{
            Swal.fire('<div class="text-center"><img class="img-fluid" src="'+response.consumivel.img+'"> <h3>Você criou um(a)' + response.consumivel.nome + '</h3></div>');
            atualizarDados();
          }
        },

        error: function(response){
          console.log(response);
        }
      })
    }
    
    fecharOpcoesCriacoes();
    removerSelecoes();
  })
}

var fecharOpcoesCriacoes = function(){
  $(".criacaoOpcoes").remove();
}

var removerSelecoes = function(){
  $(".item.criacao").attr("itemSelected", false).click(abrirOpcoesCriacoes);
}

var atualizarDados = function(){
  let consumivelDiv = $("#ListaConsumivel");
  let criacaoDiv = $("#ListaCriacao");

  consumivelDiv.html("");
  criacaoDiv.html("");

  $.ajax({
    url: backUrl + "Usuarios/BuscarDadosUsuario/",
    method: "GET",

    success: function(response){  
      $("#NomeUsuario").html(response.nomeUsuario);
      $("#NomePersonagem").html(response.nomePersonagem);

      $("#VidaAtual").html(response.atributos[VIDA_ATUAL].valor);
      $("#VidaTotal").html(response.atributos[VIDA_MAXIMA].valor);
      let porcentagemVida = (100 * response.atributos[VIDA_ATUAL].valor) / response.atributos[VIDA_MAXIMA].valor;
      $(".bar-status-background.bar-life-background").css("width", porcentagemVida+"%");

      $("#ManaAtual").html(response.atributos[MANA_ATUAL].valor);
      $("#ManaTotal").html(response.atributos[MANA_MAXIMA].valor);
      let porcentagemMana = (100 * response.atributos[MANA_ATUAL].valor) / response.atributos[MANA_MAXIMA].valor;
      $(".bar-status-background.bar-mana-background").css("width", porcentagemMana+"%");

      $("#JogadorImagem").attr("src", response.img);

      $("#Str").html(response.atributos[STR].valor);
      $("#Def").html(response.atributos[DEF].valor);
      $("#Agl").html(response.atributos[AGL].valor);
      $("#Vit").html(response.atributos[VIT].valor);
      $("#Dex").html(response.atributos[DEX].valor);

      //LISTANDO CONSUMIVEIS
      $.each(response.consumiveis, (function(index, consumivel){
        let item = '<div class="item consumivel" idConsumivel="'+consumivel.id+'" nome="'+consumivel.nome+'" desc="'+consumivel.descricao+'">'
                      +'<div class="w-100 text-center">'
                          +'<img class="img-fluid item-img" src="'+consumivel.img+'" alt="'+consumivel.nome+'">'
                          +'<h3 class="item-titulo mb-0">'+consumivel.nome+'</h3>'
                      +'</div>'
                      +'<div class="item-quantidade">'+consumivel.quantidade+'</div>'
                  +'</div>'

        consumivelDiv.append(item);
      }));

      //LISTANDO CRIACOES
      $.each(response.criacoes, (function(index, criacao){
        let item = '<div class="item criacao" itemSelected="false" idCriacao="'+criacao.id+'" quantidade="'+criacao.quantidade+'" nome="'+criacao.nome+'">'
                      +'<div class="w-100 text-center">'
                          +'<img class="img-fluid item-img" src="'+criacao.img+'" alt="'+criacao.nome+'">'
                          +'<h3 class="item-titulo mb-0">'+criacao.nome+'</h3>'
                      +'</div>'
                      +'<div class="item-quantidade">'+criacao.quantidade+'</div>'
                  +'</div>'

        criacaoDiv.append(item);
      }));
    },
  }).then(function(){
    associarAcoes();
  });
}

var associarAcoes = function(){
  //variaveis
  let btnConsumiveis = $('.item.consumivel');
  let btnCriacoes = $(".item.criacao");

  //funções
  btnConsumiveis.click(telaConsumirItem);
  btnCriacoes.click(abrirOpcoesCriacoes);
}