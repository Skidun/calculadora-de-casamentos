<?php 
include("header.php");
include("help.php");
?>

<script type="text/javascript">
$(document).ready(function(){
	
	$('table.TabelaItem .overview') .click(
		function() {
			$(this).parents('table.TabelaItem').find('.new').slideToggle(150);
		}
	)
	

	$('a.recolher').click(function(){
		$('table.TabelaItem').find('.new').slideUp(150);
		});
		
	$('a.expandir').click(function(){
		$('table.TabelaItem').find('.new').slideDown(150);
		});
	
});
</script>
	
	<!-- [início] content -->
	<div id="content">
		<div class="wrap">
        
            	<a class="voltar-gerenciador" href="index.php"></a>
            	
                <div class="dicas-banner">
                	<h1>Dicas do <span style="text-transform:uppercase">GNT</span></h1>
                    <!--<p>Tudo sobre noivas e casamentos direto do canal Noivas no site do GNT.</p>-->
                </div>
                
                <div class="pag-dicas">
                
                	<?php include("class/feedNews.php");?>
               
                </div>
                
                <div class="veja-mais">Veja mais em <a href="http://www.gnt.com.br/noivas" target="_blank">www.gnt.com.br/noivas</a></div>

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