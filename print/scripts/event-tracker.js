
// Autor: Skidun - Agência hiperativa - http://skidun.com.br

// A Skidun se empenha para obter os melhores resultados para os seus clientes e por isso mensuramos cada interação do usuário nos sites que desenvolvemos.
// Números são incontestáveis e nos ajudam a criar experiências ótimas às necessidades específicas dos nossos clientes.

$(document).ready(function(){

	//cria um evento no analytics pra cada link/botão clicado
	$('a[rel!="nao-trackear"]').click(function(){
		
		//links dos projetos em destaque
		if($(this).hasClass('')){
			var categoria = '';
			var acao = '';
			var marcador = '';
			var target = $(this).attr('href');
			//alert('categoria:' + categoria + ', ' + 'ação:' + acao + ', ' + 'marcador:' + marcador + ', ' + 'target:' + target);			
			_gaq.push(['_trackEvent', categoria, acao, marcador]);
		}
		
		//demais links
		else{
			var marcador = $(this).attr("title");
			var categoria = $(this).attr("rel");
			var acao = 'clique';
			var target = $(this).attr('href');
			_gaq.push(['_trackEvent', categoria, acao, marcador]);
		};
	});
	
}); //fim do $(document).ready();