<?php 
$dbhost							= "localhost";
$dbuser							= "calcnoiva_adm";
$dbpass							= "c8*HlBn6*JF0";
$dbname							= "calcnoiva_db";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
////////////////////////////////////////////////////////////////////////////////////////
include("header.php");
include("help.php");

$idUsuario  =   $_SESSION["EMAIL"];
?>



<script type="text/javascript">
$(document).ready(function(){
	
	$('table.TabelaItem .overview') .click(
		function() {
			$(this).parents('table.TabelaItem').find('.new').slideToggle(150);
		}
	)
	
	$('.new').css('display','none');

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
            
            <div class="overview-banner">
            	<h1>relatório completo dos orçamentos</h1>
            </div>
            
            <div class="menu-tabela">
            	<a class="fleft exportar" href="functions/sendExcel.php" target="_blank"><span>Exportar</span></a>
                <a class="fleft imprimir" href="print/index.php" target="_blank"><span>Imprimir</span></a>
                <a class="fleft enviar" name="modal" href="#lightbox10"><span>Enviar por e-mail</span></a>
                <a class="fright recolher" href="#"><span>Recolher tudo</span></a>
                <a class="fright expandir" href="#"><span>Expandir tudo</span></a>
            </div>
            
            <table class="TabelaConjunto" rules="all" cellpadding="0" cellspacing="0">
               <thead>
                  <tr class="statetablerow">
                     <th style="width:31%">Item</th>
                     <th style="width:34%">status</th>
                     <th style="width:35%">valor</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="nopad" colspan="3">
                      <?php 
				        $SQL = "SELECT * FROM cn_itens WHERE idNoiva = '$idUsuario' ORDER BY ordemItem ASC ";
                        $query       = mysql_query($SQL) or die("Error".mysql_error());
                        //$result      = mysql_fetch_assoc($query);
                        $countResult = mysql_num_rows($query);
                        
                            while($result = mysql_fetch_assoc($query))
                                {
                        			$idItem = $result["idItem"];
                        			//Pega o valor fechado para o item
                        			$SQLCalc 	= "SELECT SUM(valorFornecedor) AS soma3 FROM cn_fornecedores WHERE statusNegocio = 'Fechado' AND idItem = '$idItem'";
                        			$queryCalc	= mysql_query($SQLCalc) or die ("Erro ao selecionar valor do item");
                        			$resultCalc = mysql_fetch_assoc($queryCalc);
                        			$valorItem = number_format($resultCalc["soma3"],2,',','.');
                        			//Faz a contagem dos Subitens em aberto	
                        			$SQLSubStatus 	= "SELECT statusSubItem FROM cn_subitens WHERE idItem = '$idItem'";
                        			$querySubStatus	= mysql_query($SQLSubStatus);
                        			$resultSubStatus= mysql_fetch_assoc($querySubStatus);
                        			$countSubStatus	= mysql_num_rows($querySubStatus);
                        			$statusAtual 	= $resultSubStatus["statusSubItem"];
                                               
                                    $nomeDoItem = htmlentities($result["nomeItem"], ENT_COMPAT);
                                    
                                    $sqlSubItemP = "SELECT statusSubItem, idItem FROM cn_subitens WHERE idItem = '$idItem' AND statusSubItem = 'Aberto'";
                                    $querySubItemP = mysql_query($sqlSubItemP) or die("Erro ao selecionar a quantidade de SubItem Pendente");
                                    $listSIP       = mysql_fetch_assoc($querySubItemP);
                                    $countSIP      = mysql_num_rows($querySubItemP);
                        			//Cria os Estilos das Colunas
        				            //Seta quantidade de itens pendentes ou resolvido		
                    			    if(isset($listSIP)){
                        				if($countSIP > 1){
		        		                $quantidadeSubItem	=	$countSIP." subitens pendentes";
                                        $classItem = "desligado";
                        				}elseif($countSIP <= 1){
		        		                $quantidadeSubItem	=	$countSIP." subitem pendente";
                                        $classItem = "desligado";	
                        					}
                        			}
                                    
                                    if($statusAtual == "Fechado" && $countSIP == 0){
                        				$quantidadeSubItem  = "<span class=\"status\">resolvido</span>";
                                        $classItem = "ligado";
                        				}
                    						
									
			?>
                        <table class="TabelaItem <?php echo $classItem;if($countSubStatus == 0){echo ' vazio';}?>" rules="all" cellpadding="0" cellspacing="0">
                           <thead>
                              <tr>
                                 <th style="width:33%"><div class="icone-tabela"></div><?php echo $nomeDoItem;?></th>
                                 <th style="width:33%"><?php echo $quantidadeSubItem;?></th>
                                 <th style="width:33%">R$ <?php echo $valorItem;?> <div class="overview"></div></th>
                              </tr>
                           </thead>
                           <tbody <?php if($countSubStatus == 0){ echo 'style="display:none"'; } ?> >
                           	 <tr>
                             	<td colspan="3" class="wrap">
                                	<div class="new">
                                	<table>
								
								<?php
                                      $idItem   = $result["idItem"];
                                      $SQL2     = "SELECT * FROM cn_subitens WHERE idItem = '$idItem'";
                                      $query2   = mysql_query($SQL2) or die ("Erro nas consultas dos Subitens".mysql_error());
                                      $count2   = mysql_num_rows($query2);
                                      //////////
                            
                                        while($dataSubItem = mysql_fetch_assoc($query2)){
                            				$idSubItem	=	$dataSubItem["idSubItem"];
                            				$SQLCalc2 	= "SELECT valorFornecedor, statusNegocio FROM cn_fornecedores WHERE idSubItem = '$idSubItem' AND statusNegocio = 'Fechado'";
                            				$queryCalc2	= mysql_query($SQLCalc2) or die ("Erro ao recuperar dados de valor do subitem ".mysql_error());
                            				$resultCalc2= mysql_fetch_assoc($queryCalc2);
                            				$statusFornecedor = $resultCalc2["statusNegocio"];
                                            $nomeSubItem      = "<span class=\"item-um\">".htmlentities($dataSubItem["nomeSubItem"], ENT_COMPAT)."</span>";
                                            if($statusFornecedor == "Fechado"){
												$nomeSubItem      = "<span class=\"link-fechado\">".htmlentities($dataSubItem["nomeSubItem"], ENT_COMPAT)."</span>";
                            					$statusSubItem	=	"<span class=\"fechado\">fechado</span>";
                            					$valorSubItem	=	"<span>".number_format($resultCalc2["valorFornecedor"], 2, ',','.')."</span>";
                                                $classSubItem   =   "sub-item-fechado";
                            					}else{
                            					$statusSubItem	=	"<span class=\"aberto\">em aberto</span>";	
                            					$valorSubItem	=	"--x--";
                                                $classSubItem   =   "sub-item";	
						}      
							
                                ?>   
                                          <tr>
                                             <td style="width:33%"><span class="inativo"><a href="index.php?idSubItem=<?php echo $idSubItem;?>"><?php echo $nomeSubItem;?></a></span></td>
                                             <td style="width:33%"><?php echo $statusSubItem?></td>
                                             <td style="width:33%"><?php echo $valorSubItem;?></td>
                                          </tr>
                                     <?php }?>       
									</table>
									</div>
								</td>
                            </tr>                             
                          </tbody>
                       </table>
                       <?php }?>
                    </td>
                 </tr>
               </tbody>
               <tfoot>
                    <tr>
                        <td colspan="3" class="foot"></td>
                    </tr>
               </tfoot>
            </table>

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