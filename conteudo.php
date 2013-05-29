            <?php 
				$idNoiva = $_SESSION["EMAIL"];
				// SELECT dos SubItens
				$sqlGetOrcEstimado = "SELECT orcamentoSubItem FROM cn_subitens WHERE idNoiva = :idNoiva";
				try{
					$querGerOrcamentoEstimado	=	$conecta->prepare($sqlGetOrcEstimado);
					$querGerOrcamentoEstimado->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
					$querGerOrcamentoEstimado->execute();
					$resultGetOrcamentoEstimado = $querGerOrcamentoEstimado->fecthAll(PDO::FETCH_ASSOC);
					$countGetOrcamentoEstimado	= $queryGetItemCadSubItem->fecthAll(PDO::FETCH_ASSOC);
					}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de orçamento";}
				foreach($resultGetOrcamentoEstimado as $getOracmentoEstimado){
					$valorEstimado	=	$getOracmentoEstimado["orcamentoSubItem"];
					}
			?>
            
            <div id="principal">
            	<div class="itens">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto" class="item">
                       	<thead>                        	
                           	<tr>
                            	<td>&nbsp;</td>
                                <td><span>Orçamento</span> ESTIMADO</td>
                                <td><span>Orçamento</span> REALIZADO</td>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                            	<td class="topo"></td>
                                <td colspan="2" class="topo-dois"></td>                                
                            </tr>
                        	<tr>
                               	<td>som e luz</td>
                                <td><span>R$</span> 
                                <?php 
									$soma = 0;
									do{
										$soma += $valorEstimado;
										
										//echo number_format($soma,2,',','.');
										}while($countGetOrcamentoEstimado = $resultGetOrcamentoEstimado);
								
								?>
                                </td>
                                <td><span>R$</span> 56.750,00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                        	<tr>
                            	<td class="topo"></td>
                                <td colspan="2" class="topo-dois"></td>
                            </tr>
                        	<tr>
                            	<td>
                                	Decoração Festa
                                	<a class="excluir" title="Excluir"></a>
			                        <a class="editar" title="Editar"></a>
                                </td>
                                <td><span>R$</span> 45.480,00</td>
                                <td><span>R$</span> 12.480,00</td>
                            </tr>
                            <tr>
                            	<td class="rodape"></td>
                                <td colspan="2" class="rodape-dois"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <a class="adicionar-fornecedor" href="#"><span>adicionar novo fornecedor</span></a>
                </div>
                <div class="fornecedores">
                	<h1 class="titulo">Fornecedores</h1> 
                    <div class="fornecedores-vazio">Você ainda não possui nenhum fornecedor cadastrado para esta categoria. Pra adicionar um, clique no botão abaixo e preencha o cadastro.</div>
                    <a class="adicionar-fornecedor" href="#"><span>adicionar novo fornecedor</span></a>                
                </div>
                
				<?php require_once('modal.php'); ?>
                
            </div>