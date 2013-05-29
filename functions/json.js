$(document).ready(function (){
	//
		setTimeout('$("#sidebar").reload();', 5000);
	//Cadastro de Item	
	$("#executarCadItem").click(function (){
		var nomeItem 	  = $("#nomeItem").attr('value');
		var orcamentoItem = $("#orcamentoItem").attr('value');
		
		if(nomeItem != ''){
			$("#formCadItem").slideUp();
			$(".lightbox-item").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
			
			$.getJSON("functions/insertItem.php", {nomeItem:nomeItem, orcamento:orcamentoItem}, function(x){
					$(".lightbox-item, center, img, p").fadeOut(500);
					$(".lightbox-item").append('<center><h1>Cadastrado com sucesso</h1></center>').fadeIn(1000);
					setTimeout("$('.lightbox-item, .ui-widget-overlay').fadeOut(500);", 1000);
					setTimeout("location.reload();", 2000);
			});
		
			}else{
			$("#formCadItem").fadeIn(1000);
			$(".lightbox-item").append('<p>Dê um nome para o Item</p>');
			}
		
		});
		
	//Cadastro de SubItem via Json
	$('#executarCadSubItem').click(function (){
		var nomeSubItem 		= $("#nomeSubItem").attr('value');
		var itemSubItem 		= $("#itemSubItem").attr('value');
		if(itemSubItem == '---'){
			alert("Selecione um item para esse subitem!");
			}
		if(nomeSubItem != ""){
		$("#formCadSubItem").slideUp();
		$(".lightbox-subitem").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
				
		$.getJSON("functions/insert.php", {nomeSubItem:nomeSubItem, itemID:itemSubItem}, function(x){
					var idCadastrado	=	x.idResult;					
					$(".lightbox-subitem, center, img, p").fadeOut(500);
					$(".lightbox-subitem").append('<center><h1>Cadastrado com sucesso</h1></center>').fadeIn(1000);
					window.location.href="index.php?idSubItem="+idCadastrado;
					setTimeout("location.reload();", 2000);
		});
		
		}else{
			$("#formCadSubItem").fadeIn(1000);
			$(".lightbox-subitem").append('<p>Preencha todos os Campos corretamente</p>');
			
			}
	});
	//Editar Item
	$(".editar").click(function(){
		var id	=	$(this).attr('rel');
		$.getJSON("functions/updateItem.php", {idItem:id}, function(result){
			var idDoItem		= result.idItemResult;
			var nomeDoItem		= result.nomeItemResult;
			var orcamentoDoItem	= result.orcamentoItemResult;
			var idDaNoiva	= result.idNoivaResutlt;
			$("#formEditItem #nomeItem").val(nomeDoItem);
			$("#formEditItem #orcamentoItem").val(orcamentoDoItem);
			$("#formEditItem #editIdItem").val(idDoItem);
			});
	});
	//Quando o cara clicar para salvar a edição
	$('#formEditItem #executarEditItem').click(function(){
		var nomeDoItem		=	$('#formEditItem #nomeItem').attr("value");
		var orcamentoDoItem	=	$('#formEditItem #orcamentoItem').attr("value");
		var idDoItem	    =	$('#formEditItem #editIdItem').attr("value");
        

		if(nomeDoItem != '' || orcamentoDoItem != ''){
			
			$("#formEditItem").slideUp();
			$(".lightbox-editar").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
			$.getJSON("functions/updateEditItem.php", {nomeDoItem:nomeDoItem, orcamentoDoItem:orcamentoDoItem, idDoItem:idDoItem}, function(x){
					$(".lightbox-editar, center, img, p").fadeOut(500);
					$(".lightbox-editar").append('<center><h1>Editado com sucesso</h1></center>').fadeIn(1000);
					setTimeout("location.reload();", 1000);
			});
		
			}else{
			$("#formEditItem").fadeIn(1000);
			$(".lightbox-editar").append('<p id="alerta-valida">Preencha todos os campos</p>');
            setTimeout("$('#alerta-valida').remove();", 2000);
			}
		
		});	
	//Editar Subitem
	$('#formEditSubItem #executarEditSubItem').click(function (){
		var idSubItem		=	 $("#formEditSubItem #editIdSubItem").attr("value");
		var nomeSubItem		=	 $("#formEditSubItem #editNomeSubItem").attr("value");
		
		if(nomeSubItem != ''){
			$("#formEditSubItem, p").slideUp();
			$(".lightbox-subitem-editar").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
			$.getJSON("functions/updateEditSubItem.php", {id:idSubItem, nome:nomeSubItem}, function(x){
				$(".lightbox-subitem-editar, center, img, p").fadeOut(500);
				$(".lightbox-subitem-editar").append('<center><h1>Editado com sucesso</h1></center>').fadeIn(1000);
				setTimeout("location.reload();", 1000);
				});
				
		}else{
			alert("Preencha todos os Valores");
			}
		
	});
	//Excluir Item - Parte 1 - Resgata o Valor para gerar um ID no form
	$('.excluir').click(function(){
		var id	=	$(this).attr('rel');
		
		$.getJSON("functions/deleteItem.php", {id:id}, function(result){
			var idDoItem	= result.idItemResult;
			$("#formDeleteItem").append('<input name="idItem" id="idItem" type="hidden" value="'+idDoItem+'">');
			});
		});
	// Excluit Item - Parte 2 - Executar o delete 
	$('#executarDelItem').click(function(){
		var id	=	$("#idItem").attr('value');
		
		$("p, #formDeleteItem").slideUp();
		
		$(".lightbox-excluir-item").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
		
		$.getJSON("functions/deleteExcluiItem.php",{id:id}, function(x){
					$(".lightbox-excluir-item, center, img, p").fadeOut(500);
					$(".lightbox-excluir-item .inside").append('<center><h1>Item Excluido com sucesso</h1></center>').fadeIn(500);
					setTimeout("location.reload();", 1000);
			
			});
		
		});
	//Exclui SubItem
	$('#executarDeleteSubItem').click(function(){
		var id	=	$("#idSubItemExcluir").attr("value");
		
		$("#formDeleteSubItem, p").slideUp();
		$(".lightbox-excluir-subitem").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
		$.getJSON("functions/deleteExcluiSubItem.php", {id:id}, function(x){});
			setTimeout('$(".lightbox-excluir-subitem, center, img, p").fadeOut(500);$(".lightbox-excluir-subitem").append("<center><h1>Subitem e fornecedores excluidos com sucesso</h1></center>").fadeIn(1000);', 2000);
			setTimeout('window.location.href="index.php";', 1000);		
		});
	
			
	//Adicionar Fornecedor
	$('#executarCadFornecedor').click(function(){
		var nomeFornecedor		=	$("#nomeFornecedor").attr("value");
		var contatoFornecedor 	=	$("#contatoFornecedor").attr("value");
		var emailFornecedor		=	$("#emailFornecedor").attr("value");
		var valorFornecedor		=	$("#valorFornecedor").attr("value");
		var obsFornecedor		=	$("#obsFornecedor").attr("value");
		var idSubItem			=	$("#idSubItem").attr("value");
		if(nomeFornecedor != '' && contatoFornecedor != '' && emailFornecedor != '' && valorFornecedor != ''){
		$("#formCadFornecedor").slideUp();
		$(".lightbox-fornecedor").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
		$.getJSON("functions/insertFornecedor.php", {nomeFornecedor:nomeFornecedor, contatoFornecedor:contatoFornecedor, emailFornecedor:emailFornecedor, valorFornecedor:valorFornecedor, obsFornecedor:obsFornecedor, idSubItem:idSubItem}, function(){});
		setTimeout('$(".lightbox-fornecedor, center, img, p").fadeOut(500);$(".lightbox-fornecedor").append("<center><h1>Cadastrado com sucesso</h1></center>").fadeIn(1000);', 3000);
		setTimeout("location.reload();", 4000);
		}else{
		alert("Preencha todos os campos");
		}
		});
	//Editar Fornecedor
	$(".editar-fornecedor").click(function(){
		var idFornecedor	=	$(this).attr('rel');
		
		$.getJSON("functions/updateFornecedor.php", {idFornecedor:idFornecedor}, function(x){
			var idFornecedorEdit	=	x.idFornecedor;
			var nomeFornecedor		=	x.nome;
			var contatoFornecedor	=	x.contato;
			var emailFornecedor		=	x.email;
			var valorFornecedor		=	x.valor;
			var obsFornecedor		=	x.obs;
			
			$('#formEditFornecedor #editId').val(idFornecedorEdit);
			$('#formEditFornecedor #editNome').val(nomeFornecedor);
			$('#formEditFornecedor #editContato').val(contatoFornecedor);
			$('#formEditFornecedor #editEmail').val(emailFornecedor);
			$('#formEditFornecedor #editValor').val(valorFornecedor);
			$('#formEditFornecedor #editObs').val(obsFornecedor);
			});
		});
	//Quando clicar para salvar a edição do fornecedor
	$('#executarEditFornecedor').click(function(){
			var idFEditar		=	$("#editId").attr('value');
			var nomeFEditar		=	$("#editNome").attr('value');
			var contatoFEditar	=	$("#editContato").attr('value');
			var emailFEditar	=	$("#editEmail").attr('value');
			var valorFEditar	=	$("#editValor").attr('value');
			var obsFEditar		=	$("#editObs").attr('value');
		$('#formEditFornecedor').slideUp();	
		$(".lightbox-fornecedor-editar").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
		
		$.getJSON("functions/updateEditFornecedor.php",{id:idFEditar, nomeFornecedor:nomeFEditar, contatoFornecedor:contatoFEditar, emailFornecedor:emailFEditar, valorFornecedor:valorFEditar, obsFornecedor:obsFEditar}, function(y){
			var sucesso	=	y.Mensagem;
			$('.lightbox-fornecedor-editar, center, img, p').fadeOut(1000);
			$('.lightbox-fornecedor-editar').append('<p align="center">'+sucesso+'</p>');
			setTimeout("location.reload();", 3000);
			
			});
		});
	//Enviar Fornecedor para um amigo - Parte 1 - Pegar dados do fornecedor
	$(".indicar-fornecedor").click(function(){
		var idFornecedor	=	$(this).attr('rel');
		
		$.getJSON("functions/indicarFornecedor.php", {idFornecedor:idFornecedor}, function(x){
			var idFornecedorIndica	=	x.idFornecedor;
			var nomeFornecedor		=	x.nome;
			var contatoFornecedor	=	x.contato;
			var emailFornecedor		=	x.email;
			var valorFornecedor		=	x.valor;
			var obsFornecedor		=	x.obs;
			
			$('#formIndicarFornecedor #indicaNome').val(nomeFornecedor);
			$('#formIndicarFornecedor #indicaContato').val(contatoFornecedor);
			$('#formIndicarFornecedor #indicaEmail').val(emailFornecedor);
			$('#formIndicarFornecedor #indicaValor').val(valorFornecedor);
			$('#formIndicarFornecedor #indicaObs').val(obsFornecedor);
			$('#formIndicarFornecedor #indicaId').val(idFornecedorIndica);
			});
		});
	//Enviar Forcenedor para um amigo - Parte 2 - Resgatar os dados via AJAX/JSON e mandar para o PHP enviar.
	$('#executarIndicar').click(
		function(){
			var nomeAmigo	=	$('#formIndicarFornecedor #indicaNomeAmigo').attr('value');
			var emailAmigo	=	$('#formIndicarFornecedor #indicaEmailAmigo').attr('value');
			var obsAmigo	=	$('#formIndicarFornecedor #indicaObsAmigo').attr('value');
			var nomeF		=	$('#formIndicarFornecedor #indicaNome').attr('value');
			var contatoF	=	$('#formIndicarFornecedor #indicaContato').attr('value');
			var emailF		=	$('#formIndicarFornecedor #indicaEmail').attr('value');
			var valorF 		=	$('#formIndicarFornecedor #indicaValor').attr('value');
			var obsF		=	$('#formIndicarFornecedor #indicaObs').attr('value');
			var idF			=	$('#formIndicarFornecedor #indicaId').attr('value');
			if(nomeAmigo == '' && emailAmigo == '' || nomeAmigo != '' && emailAmigo == ''){
				$("#formIndicarFornecedor").prepend('<span><strong>Informe o Nome e E-mail do seu amigo</strong></span>');
				setTimeout("$('.lightbox-indique-fornecedor span').remove();", 2000);
				return false;
				}			
			$("#formIndicarFornecedor").slideUp();
			$(".lightbox-indique-fornecedor").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
			
			//JSON que enviará os campos preenchidos para o PHP
			$.getJSON(
				"functions/sendFornecedor.php",
				{nomeAmigo:nomeAmigo, emailAmigo:emailAmigo, obsAmigo:obsAmigo, nomeF:nomeF, contatoF:contatoF, emailF:emailF, valorF:valorF, obsF:obsF},
				function(x){
					var msg	= x.sucesso;
					$(".lightbox-indique-fornecedor, center, img, p").fadeOut(500);
					$(".lightbox-indique-fornecedor").append("<center><h1>"+msg+"</h1></center>").fadeIn(1000);
					setTimeout('location.reload();', 3000);
					}
			);
		});
				
	//Exclui Fornecedor
	$('.excluir-fornecedor').click(function(){
		var id	=	$('.excluir-fornecedor').attr('rel');
		$('#executarDeleteFornecedor').click(function(){			
		$("#formExcluiFornecedor, p").slideUp();
		$(".lightbox-excluir-fornecedor").append('<center><img src="img/loader.gif" align="center" /></center><p align="center">Aguarde...</p>');
		$.getJSON("functions/deleteExcluiFornecedor.php", {id:id}, 
			function(x)
			{
				var subitem = x.subitem;
				setTimeout('$(".lightbox-excluir-fornecedor center, img, p").fadeOut(500);$(".lightbox-excluir-fornecedor").append("<center><h1>Fornecedor excluido com sucesso</h1></center>").fadeIn(1000);', 3000);
				setTimeout('window.location.href="index.php?idSubItem='+subitem+'&fornecedor=true"', 4000);
			});
		
			
		});
	});
	
	$('.cancelar-negocio').click(function(){
		var id	=	$(this).attr('href');
		var subitem	=	$(this).attr('rel');
		
		$.getJSON("functions/updateCancelarFornecedor.php", {id:id},function(x){});
		
		setTimeout('window.location.href="index.php?idSubItem='+subitem+'&fornecedor=true"', 2000);			
		});
	/////////////////////////////////////////////////		
	$('a#cadastrar-subitem').click(function(){
		var idItem	=	$(this).attr('class');
		var nome	=	$(this).attr('rel');
		$("#formCadSubItem #itemSubItem").html('<option value="'+idItem+'" selected>'+nome+'</option>');		
		});
	//Editar Perfil						
	$('#executarEditarPerfil').click(
		function()
			{
				var perfilEmail	=	$('#perfilEmail').attr('value');
				var perfilNome	=	$('#perfilNome').attr('value');
				var perfilData	=	$('#perfilData').attr('value');
				
				if(perfilNome == '' || perfilData == ''){
					$('#formEditarPerfil').prepend("<h4 id='alerta-erro-form'>Você deve informar o seu nome e a data do casamento</h4>");
					setTimeout('$("#alerta-erro-form").fadeOut(2000);', 4000);
					}else{
						$('#formEditarPerfil').slideUp();
						$('#lightbox12').append('<center><img src="img/loader.gif" align="center" /></center><p id="aguarde" align="center">Aguarde...</p>');	
						$.getJSON("functions/updatePerfil.php", {perfilEmail:perfilEmail, perfilNome:perfilNome, perfilData:perfilData}, 
							function(x){
								var sucesso	=	x.Sucesso;
								$('#lightbox12 center, img, #aguarde').fadeOut(500);
								$('#lightbox12').append('<br /><p>'+sucesso+'</p>');
								setTimeout('location.reload();', 3000);
								});
						}
			}
	);
	//Envio de relátório por E-mail
	$('#executaEnviarRelatorio').click(
		function(){
			var relatorioNome = $('#relatorioNome').attr('value');
			var relatorioEmail= $('#relatorioEmail').attr('value');
			
			if(relatorioNome == '' || relatorioEmail == ''){
				$('#formEnviaRelatorio').prepend('<p id="alerta-erro-form" style="color: red;">Você deve informar o nome e o e-mail de quem irá receber o relatório</p>');
				setTimeout('$("#alerta-erro-form").fadeOut(1000)', 4000);
				}else{
					$('p').remove();
					$('#formEnviaRelatorio').slideUp();
					$('#lightbox10').append('<center><img src="img/loader.gif" align="center" /></center><p id="aguarde" align="center">Aguarde...</p>');
					$.getJSON("functions/sendReport.php",{relatorioNome:relatorioNome, relatorioEmail:relatorioEmail}, function(x){
							var resultado = x.result;
							$('center, img, #aguarde').remove();
							$('#lightbox10').append('<p>Enviado com Sucesso</p>');
							setTimeout('location.reload();', 3000);
							});
/**
 * 					setTimeout('$("center, img, #aguarde").remove();', 2000);
 * 					$('#lightbox10').append('<p>Enviado com Sucesso</p>');
 * 					setTimeout('location.reload();', 3000);	
 */
					}	
		
		}
	);
	
	});//Final do Document Ready
	