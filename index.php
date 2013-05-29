<?php 
include("header.php");
include("help.php");
?>

	
	<!-- [início] content -->
	<div id="content">
		<div class="wrap">
        
        <div class="meus-itens">Meus Itens</div>
			
			<?php require_once('sidebar.php'); ?>
           <?php if(empty($_GET["idSubItem"])){?>
           <img src="img/ajuda/centro-index.png" width="510" height="523" alt="Indicador" style="float: right; margin:-80px 4px 0 0;" />
			<?php }else{require_once('conteudo-fornecedores.php');} ?>
            </div>
        </div>
	
	<!-- [final] content --> 

  <div id="newfooter">
  	<div class="wrap">
    	
		<img src="img/backgrounds/chuva-de-arroz.png" class="chuva-de-arroz" />
		
		<div class="desc fleft">
			Assista ao programa no GNT <br />
			Veja os horários: <a href="http://www.gnt.com.br/chuvadearroz" target="_blank" title="veja os horários" rel="link">www.gnt.com.br/chuvadearroz</a>
		</div>
		
		<a class="compartilhe" href="#" onclick="postToFeed(); return false;">Compartilhe</a>
		
		<a href="http://gnt.globo.com/" target="_blank" rel="link-externo"><img src="img/icones/logo-footer-p.png" class="gnt-p" /></a>
        
    </div>
  </div>

</div> <!-- Fim div#tudo -->

    
    <?php require_once('modal.php'); ?> 

</body>
</html>