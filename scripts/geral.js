$(document).ready(function() {

    $('#login-fb').click(function(e){
        e.preventDefault();
        facebookApp.statusFacebook();
        return false;
    });

$("a.ajuda").click(
function() {
	$('.tapume').show();
	$(".ajuda-animacao").slideDown();
	$( "#ajuda" ).delay(500).fadeIn();
	$("#novo-novoslide").append('<script>$("#slides-novo").slides({ preload: true, generateNextPrev: true, generatePagination: false, autoHeight: true, start:10 }); $(function(){ $("a.iniciar-agora,a.usar-ferramenta").click(function(){$(".ajuda-animacao").delay(500).slideUp();$( "#ajuda" ).fadeOut();$("#novo-novoslide").empty();$(".tapume").hide();}); });</script><div id="slides-novo"> <ul class="pagination"> <li class=""> <a href="#0" title="itens pré-cadastrados">1</a> </li> <li class=""> <a href="#1" title="Criação de itens">2</a> </li> <li class=""> <a href="#2" title="Criação de subitens">3</a> </li> <li class=""> <a href="#3" title="editar item">4</a> </li> <li class=""> <a href="#4" title="editar subitem">5</a> </li> <li class=""> <a href="#5" title="gerenciar fornecedores">6</a> </li> <li class=""> <a href="#6" title="Fechar Negócio">7</a> </li> <li class=""> <a href="#7" title="Relatório">8</a> </li> <li class=""> <a href="#8" title="vamos começar">9</a> </li> <li class="" style="display:none"> <a href="#9" title="vamos começar">10</a> </li> </ul> <div class="slides_container"> <div class="imagem"> <img src="img/ajuda/1.png" style="margin:100px 0 0 -18px"> </div> <div class="imagem"> <img src="img/ajuda/2.png" style="margin:3px 0 0 -19px"> </div> <div class="imagem"> <img src="img/ajuda/3.png" style="margin:28px 0 0 -15px"> </div> <div class="imagem"> <img src="img/ajuda/4.png" style="margin:26px 0 0 -15px"> </div> <div class="imagem"> <img src="img/ajuda/5.png" style="margin:9px 0 0 -15px"> </div> <div class="imagem"> <img src="img/ajuda/6.png" style="margin:50px 0 0 -36px"> </div> <div class="imagem"> <img src="img/ajuda/7.png" style="margin:72px 0 0 240px"> </div> <div class="imagem"> <img src="img/ajuda/10.png" style="margin:61px 0 0 -8px"> </div> <div class="imagem"> <div class="vamos-comecar"> <a class="iniciar-agora"></a> <a class="rever-passo next"></a> </div> </div> <div class="imagem"> <div class="bem-vindo"> <a class="passo-a-passo next"></a> <a class="usar-ferramenta"></a> </div> </div> </div> </div>');
	$('.pagination a').tooltip({ 
		track: true, 
		delay: 0, 
		showURL: false, 
		showBody: " - ", 
		fade: 250,
		extraClass: "pretty"
	});
	}	
);

$("a.fechar-btn").click(function() {
	$(".ajuda-animacao").delay(500).slideUp();
	$( "#ajuda" ).fadeOut();
	$('#novo-novoslide').empty();
	$('.tapume').hide();
	});	
	
	$('a[name=modal]').click(function(e) {
		e.preventDefault();
		
		var id = $(this).attr('href');
        var idElemento = $(this).attr('rel');
        
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});
        
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
    	
        //$("#lightbox6 #formExcluiFornecedor").html('<p>ID: '+idElemento+'</p>');
		
        $(id).fadeIn(2000); 
        
	});
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});	

$("#sidebar .body").hide();

$('.tooltipExpandir img').click(function() {
	$('.tooltipExpandir').hide();
});

$('#sidebar .head a.expandir').click(function() {
		$(this).parents('#sidebar').find('.body').slideUp("fast");
		$(this).parent().next().slideDown("fast");
		$('#sidebar .head').removeClass("ui-state-active");
		$(this).parent().addClass("ui-state-active");
		$('#sidebar .head a.expandir-novo').hide();
		$(this).parent().find('a.expandir-novo').show();
		$('#sidebar .head a.expandir').show();
		$(this).hide();
		//mostrar tooltip
		$('.tooltipExpandir').hide();
		$(this).parents('.head').find('.tooltipExpandir').show();
		$('#sidebar .head').css('background-position','0 0');
		$(this).parents('.head').css('background-position','0 -88px');
				
		return false;
	}).parent().next().hide();

$('a.expandir-novo').click(function(){
	$(this).parent().next().slideUp("fast");
	$(this).hide();
	$(this).parent().find('a.expandir').show();
	$(this).parents('.head').find('.titulo').css('color','#9C7A4D');
	//esconder tooltip
	$(this).parents('.head').find('.tooltipExpandir').hide();
	$(this).parents('.head').css('background-position','0 0');
});


$('#header a').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});

$('#content a').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});

$('a.att').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});

$('#slides').slides({
	preload: true,
	generateNextPrev: true,
	autoHeight: true
});

/*
$("#slides").corner("10px");
$("#fornecedor.fecha ul.corpo").corner("bottom 10px");
$(".fecha").corner("10px");
$(".lightbox-item").corner("10px");
$(".lightbox-subitem").corner("10px");
$(".lightbox-subitem-editar").corner("10px");
$(".lightbox-excluir-fornecedor").corner("10px");
$(".lightbox-excluir-item").corner("10px");
$(".lightbox-excluir-subitem").corner("10px");
$(".lightbox-editar").corner("10px");
$(".lightbox-fornecedor").corner("10px");
$(".lightbox-fornecedor-editar").corner("10px");
$(".lightbox-envie-email").corner("10px");
$(".lightbox-indique-fornecedor").corner("10px");
$(".submit").corner("5px");
$(".reset").corner("5px");
$(".frcd").corner("10px");
$(".frcd .titulo").corner("top 10px");
$("ul.linha li:last-child").corner("bottom 10px");
$(".menu-tabela a").corner("4px");
$(".orcamento").corner("4px");
$(".lightbox-percentual").corner("10px");
$("#lightbox12").corner("10px");
*/


/*$("a.iniciar-agora").click(function() { $(".ajuda-animacao").delay(500).slideUp(); $( "#ajuda" ).fadeOut();});
$("a.usar-ferramenta").click(function() { $(".ajuda-animacao").delay(500).slideUp(); $( "#ajuda" ).fadeOut();});*/


$('.frcd  a.expandir-fornecedor').toggle(
function() {$(this).parent().next().slideDown(); $(this).css("background-position","0 0"); $(this).parent().parent().find('.titulo').css('border-bottom','1px solid #f3ca94'); },
function() {$(this).parent().next().slideUp(); $(this).css("background-position","-52px 0"); $(this).parent().parent().find('.titulo').css('border-bottom','0'); }
	)
	
$('.frcd.fecha  a.expandir-fornecedor').toggle(
function() {$(this).parent().next().slideDown(); $(this).css("background-position","-52px 0"); },
function() {$(this).parent().next().slideUp(); $(this).css("background-position","0 0"); }
	)

$("a.cancelar-negocio").toggle(
function(){ $(this).removeClass("cancelar-negocio"); $(this).addClass("fechar-negocio"); $(this).parents("#fornecedor").find(".status-fornecedor").removeClass("fechado");},
function(){ $(this).addClass("cancelar-negocio"); $(this).removeClass("fechar-negocio"); $(this).parents("#fornecedor").find(".status-fornecedor").addClass("fechado"); }
);


$( "input.reset" ).click(function(){ $(this).parents().dialog( "close" ); });

$(".elementos span.titulo").hover(
	function(){ $(this).parents("li").find(".head").css("background","url(img/backgrounds/slide-head.png) 0 -44px no-repeat") },
	function(){ $(this).parents("li").find(".head").css("background","url(img/backgrounds/slide-head.png) 0 0 no-repeat") }
	);

//$('#fornecedor.fecha').before('<div class="linhafc ab"></div>').after('<div class="linhafc bl"></div>');

//menu esquerda no ie
$('#sidebar .body ul.linha li:nth-child(2n)').addClass('even');

});



function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){    
    var sep = 0;    
    var key = '';    
    var i = j = 0;    
    var len = len2 = 0;    
    var strCheck = '0123456789';    
    var aux = aux2 = '';    
    var whichCode = (window.Event) ? e.which : e.keyCode;    
    if (whichCode == 13 || whichCode == 8) return true;    
    key = String.fromCharCode(whichCode); // Valor para o código da Chave    
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida    
    len = objTextBox.value.length;    
    for(i = 0; i < len; i++)    
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;    
    aux = '';    
    for(; i < len; i++)    
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);    
    aux += key;    
    len = aux.length;    
    if (len == 0) objTextBox.value = '';    
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;    
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;    
    if (len > 2) {    
        aux2 = '';    
        for (j = 0, i = len - 3; i >= 0; i--) {    
            if (j == 3) {    
                aux2 += SeparadorMilesimo;    
                j = 0;    
            }    
            aux2 += aux.charAt(i);    
            j++;    
        }    
        objTextBox.value = '';    
        len2 = aux2.length;    
        for (i = len2 - 1; i >= 0; i--)    
        objTextBox.value += aux2.charAt(i);    
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);    
    }    
    return false;    
}

  
	//Limitar caracteres	
	//Itens
	$(function(){
      $("#nomeItem").keyup(function(){
         var limite  = 21
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contador").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	///////////////////////////////////////////
	$(function(){
      $("#formEditItem #nomeItem").keyup(function(){
         var limite  = 21
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#formEditItem #contador").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	//Subitens
	$(function(){
      $("#nomeSubItem").keyup(function(){
         var limite  = 15
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contadorSI").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	//Subitens
	$(function(){
      $("#editNomeSubItem").keyup(function(){
         var limite  = 15
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contadorEditNomeSubItem").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	//
	$(function(){
      $("#nomeFornecedor").keyup(function(){
         var limite  = 31
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contadorF").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	//Fornecedor
	$(function(){
      $("#obsFornecedor").keyup(function(){
         var limite  = 215
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contadorObs").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	//Fornecedor Editar
	$(function(){
      $("#editNome").keyup(function(){
         var limite  = 31
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contadorEditNome").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	//////////////////////////////////////////////
	$(function(){
      $("#editObs").keyup(function(){
         var limite  = 215
         var tamanho = $(this).val().length;
         if(tamanho > limite)
            tamanho -= 1;
         
         var contador = limite - tamanho
         $("#contadorEditObs").text(contador)
         
         if(tamanho >= limite){
            var txt = $(this).val().substring(0, limite)
            $(this).val(txt)
         }
      })     
	})
	
//Máscara Data
function Formatadata(Campo, teclapres)
			{
				var tecla = teclapres.keyCode;
				var vr = new String(Campo.value);
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				vr = vr.replace("/", "");
				tam = vr.length + 1;
				if (tecla != 8 && tecla != 8)
				{
					if (tam > 0 && tam < 2)
						Campo.value = vr.substr(0, 2) ;
					if (tam > 2 && tam < 4)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
					if (tam > 4 && tam < 7)
						Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
				}
			}     
			
//Imagens Dicas
$(document).ready(function() {
	$('.pag-dicas .post img').wrap('<div class="new" />');
	$('.pag-dicas .post img').load(function(){
		var largura = this.width;
		var novoAlinhamento = -((largura-91)/2);
		$(this).css('margin-left',novoAlinhamento+'px');
    }); 
//
$(".window input.reset").click(function(){
	$('#mask').hide();
	$('.window').hide();	
	});
	
//Máscara de Dinheiro
$(".money").maskMoney({symbol:'R$ ', thousands:'.', decimal:','});
//$('.money').mask('000.000.000.000.000,00', {reverse: true});
});

//Bordas
$(function() {
    if (window.PIE) {
        $('.frcd').each(function() {
            PIE.attach(this);
        });
		$('#fornecedor .titulo').each(function() {
            PIE.attach(this);
        });
		$('.pag-dicas .post .new').each(function() {
            PIE.attach(this);
        });
    }
});

var facebookApp = {

    statusFacebook: function(){
                FB.getLoginStatus(function(response){
                    if(response.status === 'connected'){
                        facebookApp.redirecionamento();
                    } else if (response.status === 'not_authorized'){
                        facebookApp.loginFacebook();// Não está autorizado
                    }else{
                        facebookApp.loginFacebook();
                    }
                });
        },

    loginFacebook: function(){
            FB.login(function(response){
                if(response.authResponse){
                    facebookApp.redirecionamento();
                }
            }, {scope: 'publish_stream, email'});
        }, 

    redirecionamento: function(){
        FB.api('/me', function(userInfo) {
            var emailDoCara = userInfo.email;
            var redirectUrl = 'http://gntapps.com.br/calculadora-de-casamentos/class/LoginSistema.php?user=';
            var urlMaldita = redirectUrl+emailDoCara;
            window.location.href = urlMaldita;
        });
    }


}