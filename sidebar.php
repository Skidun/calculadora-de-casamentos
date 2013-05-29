<script>
$(function(){
	$('#sortable').sortable({
		revert:true,
        cursor: 'move',
        update: function (){
            var order = $(this).sortable("serialize") + '&action=updateRecordsListings';
            $.post("functions/updateOrderItem.php", order, function(theResponse){
			});
        }
		});
	});
    
</script>

            <div id="sidebar">
			<!--<div id="tooltipExpandir">
					<p> Estimado para este item: R$ 80.000,00 </p>
					<p> Realizado para este item:  R$ 56.750,00 </p>
					<img src="img/buttons/alerta-fechar.png" width="15" height="15" />
				</div>-->
            
            <div class="adicionar-sidebar">
                    <a class="adicionar item" name="modal" href="#lightbox1" rel="interna"><span>adicionar item</span></a>                
                    <a class="adicionar subitem" name="modal" href="#lightbox2" rel="interna"><span>Adicionar subitens</span></a>
             </div>
            
            <ul id="sortable">
             <?php 
				//Seleciona os Itens padrões no sistema
				$idNoivaMenu   = $_SESSION["EMAIL"];
				$sqlGetItemDefault = "SELECT * FROM cn_itens WHERE idNoiva = :idNoiva ORDER BY ordemItem ASC";
				try{
					$queryGetItemDefault = $conecta->prepare($sqlGetItemDefault);
					$queryGetItemDefault->bindValue(':idNoiva',$idNoivaMenu, PDO::PARAM_STR);
					$queryGetItemDefault->execute();
					
					$resultGetItemDefault = $queryGetItemDefault->fetchAll(PDO::FETCH_ASSOC);
					}catch(PDOexception $error_getItemDefault){
						echo "Não foi possível executar a consulta SQL".$error_getItemDefault->getMessage();
						}
					foreach($resultGetItemDefault as $itensDefault){
						$idItemMenu		=	$itensDefault["idItem"];
						$nomeItemMenu	=	$itensDefault["nomeItem"];
						$idNoivaItem	=	$itensDefault["idNoiva"];
                        $valorOrcItem   =   number_format($itensDefault["orcamentoItem"],2,',','.');	
			?>
            
            <?php 
						$idGetSubItem = $_GET["idSubItem"];
						$sqlGetSubItemSelect = "SELECT * FROM cn_subitens WHERE idItem = :idItem AND idNoiva = :idNoiva";
						try{
							$queryGetSubItemSelect = $conecta->prepare($sqlGetSubItemSelect);
							$queryGetSubItemSelect->bindValue(':idItem', $idItemMenu, PDO::PARAM_STR);
							$queryGetSubItemSelect->bindValue(':idNoiva', $idNoivaMenu, PDO::PARAM_STR);
							$queryGetSubItemSelect->execute();
							
							//Gera resultados da Consulta
							$resultGetSubItemSelect = $queryGetSubItemSelect->fetchAll(PDO::FETCH_ASSOC);
							$countGetSubItemSelect  = $queryGetSubItemSelect->rowCount(PDO::FETCH_ASSOC);
							
							}catch(PDOexception $errorGetSubItemSelect){echo "Erro ao realizar consulta SQL ".$errorGetSubItemSelect->getMessage();}
							foreach($resultGetSubItemSelect as $subItemSelect){
								$idSubItemSelect	=	$subItemSelect["idSubItem"];
								$idItemSelect		= 	$subItemSelect["idItem"];
							}
                            
                         //SQL para selecionar o campo valorFornecedores e calcular o orçamento realizado
                $sqlGetOrcItemMenu = "SELECT SUM(valorFornecedor) AS soma FROM cn_fornecedores WHERE idItem = :idItem AND statusNegocio = :statusNegocio";
            	//PDO que realiza a consulta no banco
            	try{
            		$queryGetOrcItemMenu	=	$conecta->prepare($sqlGetOrcItemMenu);
            		$queryGetOrcItemMenu->bindValue(':idItem',$idItemMenu,PDO::PARAM_STR);
            		$queryGetOrcItemMenu->bindValue(':statusNegocio',"Fechado",PDO::PARAM_STR);
            		$queryGetOrcItemMenu->execute();
            		$resultGetOrcItemMenu = $queryGetOrcItemMenu->fetchAll(PDO::FETCH_ASSOC);
            		$countGetOrcItemMenu  = $queryGetOrcItemMenu->rowCount(PDO::FETCH_ASSOC);
            		}catch(PDOexception $errorGetOrcItemMenu){echo "Erro na consulta dos valores de orçamento";}
             	//Extrai o valor total orçamento dos fornecedores cadastrado na categoria
            	foreach($resultGetOrcItemMenu as $GetOrcItemMenu){
            		$valorFechadoItem	=	number_format($GetOrcItemMenu["soma"],2,',','.');
            	}   
				?>
            	<li id="recordsArray_<?php echo $idItemMenu;?>">
<!--                <a title="arraste para mudar de posição" class="crux">
                <img src="img/spacer.png" width="20" height="42" />
                </a>-->
                
            	<div class="head">
					<div class="tooltipExpandir">
						<p> Estimado para este item: R$ <?php echo $valorOrcItem;?> </p>
						<p> Realizado para este item: <span> R$ <?php echo $valorFechadoItem;?> </span> </p>
						<img src="img/buttons/alerta-fechar.png" width="15" height="15" />
					</div>
				
                	<div class="elementos">
						
                        <table style="height: 42px;"><tr><td style="vertical-align:middle;">
                        	
                        <a title="arraste para mudar de posição">
	                        <span class="titulo" style="cursor:move"><?php echo htmlentities($nomeItemMenu, ENT_COMPAT, 'utf-8');?></span>                  
                        </a>
                        <a class="excluir" title="Excluir" name="modal" href="#lightbox8" rel="<?php echo $idItemMenu;?>"></a>
                        <a class="editar" title="Editar" name="modal" href="#lightbox7" rel="<?php echo $idItemMenu;?>"></a>
                        
                        </td></tr></table>
                        
                	</div>
                    <a class="expandir" href="?idItem=<?php echo $idItemMenu;?>" ></a>
                    <a class="expandir-novo"></a>
                </div>
   				
                <div class="body" id="<?php echo $idSubItemSelect;?>" <?php if(isset($idGetSubItem)&& $idGetSubItem == $idSubItemSelect && $idItemSelect == $idItemMenu){ echo "style=\"display: block !important;\"";}?>>
                	<ul class="linha">
                    <?php 
					
					if(isset($_GET["fornecedor"]) && $_GET["fornecedor"] == "true"){
								echo "<script>window.location.href='index.php?idSubItem=".$_GET["idSubItem"]."'</script>";
								}
						$sqlGetSubItemMenu = "SELECT * FROM cn_subitens WHERE idItem = :idItem AND idNoiva = :idNoiva";
						try{
							$queryGetSubItemMenu = $conecta->prepare($sqlGetSubItemMenu);
							$queryGetSubItemMenu->bindValue(':idItem', $idItemMenu, PDO::PARAM_STR);
							$queryGetSubItemMenu->bindValue(':idNoiva', $idNoivaMenu, PDO::PARAM_STR);
							$queryGetSubItemMenu->execute();
							
							//Gera resultados da Consulta
							$resultGetSubItemMenu = $queryGetSubItemMenu->fetchAll(PDO::FETCH_ASSOC);
							$countGetSubItemMenu  = $queryGetSubItemMenu->rowCount(PDO::FETCH_ASSOC);
							
							}catch(PDOexception $errorGetSubItemMenu){echo "Erro ao realizar consulta SQL ".$errorGetSubItemMenu->getMessage();}
							//Verifica se existe no mínimo 1 subitem para aquela categoria
							if($countGetSubItemMenu >= 1){
							 foreach($resultGetSubItemMenu as $subItemMenu){
								 $idSubItem			=	$subItemMenu["idSubItem"];
								 $nomeSubItem		=	$subItemMenu["nomeSubItem"];
								 $orcamentoSubItem	=	$subItemMenu["orcamentoSubItem"];
								 $idItemSubItem		=	$subItemMenu["idItem"];
								 $idUserSubItem		=	$subItemMenu["idUser"];
								 $statusSubItem		=	$subItemMenu["statusSubItem"];
								 
							$sqlGetFornecedorSI = "SELECT * FROM cn_fornecedores WHERE idSubItem = :idSubItem AND statusNegocio = :statusFornecedor";
							//PDO que realiza a consulta no banco
							try{
								$queryGetFornecedorSI	=	$conecta->prepare($sqlGetFornecedorSI);
								$queryGetFornecedorSI->bindValue(':idSubItem', $idSubItem,PDO::PARAM_STR);
								$queryGetFornecedorSI->bindValue(':statusFornecedor', "Fechado",PDO::PARAM_STR);
								$queryGetFornecedorSI->execute();
								$resultGetFornecedorSI = $queryGetFornecedorSI->fetchAll(PDO::FETCH_ASSOC);
								$countGetFornecedorSI  = $queryGetFornecedorSI->rowCount(PDO::FETCH_ASSOC);
								}catch(PDOexception $errorGetFornecedorSI){echo "Erro na consulta dos Fornecedores ".$errorGetFornecedorSI->getMessage();}
							//Extrai o valor total orçamento dos fornecedores cadastrado na categoria
							foreach($resultGetFornecedorSI as $getFornecedorFechadoSI){
												$idFornecedorSI	=	$getFornecedorFechadoSI["idFornecedor"];
												$statusSI		=	$getFornecedorFechadoSI["statusNegocio"];
												$fornecedorSI	=	$getFornecedorFechadoSI["idSubItem"];
												$valorSI		=	$getFornecedorFechadoSI["valorFornecedor"];
						
							}	 	
					?>
                    	<li><span class="item"><a href="?idSubItem=<?php echo $idSubItem;?>"><?php echo htmlentities($nomeSubItem, ENT_COMPAT, 'utf-8');?></a></span><?php /*?><span class="preco">R$ <?php if($statusSubItem == "Aberto"){echo number_format($orcamentoSubItem, 2,',','.');}elseif(isset($fornecedorSI) && $fornecedorSI == $idSubItem){echo number_format($valorSI, 2,',','.');}?></span><?php */?><span class="<?php if($statusSubItem == "Fechado"){echo 'status fechado';}else{echo 'status mais';}?>"></span></li>
                    <?php }}
						$sqlGetItemCadSI = "SELECT * FROM cn_itens WHERE idItem = :idItem AND idNoiva = :idNoiva";
						try{
							$queryGetItemCadSI = $conecta->prepare($sqlGetItemCadSI);
							$queryGetItemCadSI->bindValue(':idItem', $idItemMenu, PDO::PARAM_STR);
							$queryGetItemCadSI->bindValue(':idNoiva', $idNoivaMenu, PDO::PARAM_STR);
							$queryGetItemCadSI->execute();
							
							//Gera resultados da Consulta
							$resultGetItemCadSI = $queryGetItemCadSI->fetchAll(PDO::FETCH_ASSOC);
							$countGetItemCadSI = $queryGetItemCadSI->rowCount(PDO::FETCH_ASSOC);
							
							}catch(PDOexception $errorGetItemCadSI){echo "Erro ao realizar consulta SQL ".$errorGetItemCadSI->getMessage();}
							//Verifica se existe no mínimo 1 subitem para aquela categoria
							 foreach($resultGetItemCadSI as $ItemCadSI){
								 $idItemCadSI		=	$ItemCadSI["idItem"];
								 $nomeItemCadSI		=	$ItemCadSI["nomeItem"];
							 }
						?>
                    
                    	<?php /*?><li><span class="vazio">Você ainda não possui nenhum subitem. <a href="<?php echo $idItemCadSI;?>" id="cadastrar-subitem" title="Cadastrar subitem" rel="<?php echo $nomeItemCadSI;?>" onClick="return false;">Clique aqui</a> para adicionar um.</span></li><?php */?>
                        <li class="adicione-subitem"><span class="vazio"><a id="cadastrar-subitem" title="Cadastrar subitem" rel="<?php echo $nomeItemCadSI;?>" class="<?php echo $idItemCadSI;?>" onClick="return false;" name="modal" href="#lightbox2"><div class="maismais">+</div> Adicionar subitem</a></span></li>
                    </ul>                   
                </div>
                
                </li>
                <?php }?>
                
                </ul>
                
            </div><!--sidebar-->