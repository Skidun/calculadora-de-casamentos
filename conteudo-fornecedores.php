<?php 
	$urlIdSubItem	=	$_GET["idSubItem"];
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	 //Agora vamos pegar a realizar uma SELECT para pegar as outras informações do subitens
	 ///////////////////////////////////////////////////////////////////////////////////////////////////////// 
	$sqlGetDadosSubItens = "SELECT * FROM cn_subitens WHERE idSubItem = :idSubItem";
	//Operação de consulta SQL usando PDO
	try{
		$queryGetDadosSubItens	=	$conecta->prepare($sqlGetDadosSubItens);
		$queryGetDadosSubItens->bindValue(':idSubItem',$urlIdSubItem,PDO::PARAM_STR);
		$queryGetDadosSubItens->execute();
		$resultGetDadosSubItens = $queryGetDadosSubItens->fetchAll(PDO::FETCH_ASSOC);
		$countGetDadosSubItens	= $queryGetDadosSubItens->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetDadosSubItens){echo "Erro na consulta dos valores de orçamento";}
    //Extrai todas os campos dentro do array $getDadosSubItens
	foreach($resultGetDadosSubItens as $getDadosSubItens){
		$getIdSubItem		=	$getDadosSubItens["idSubItem"];
		$getNomeSubItem		=	$getDadosSubItens["nomeSubItem"];
		$getIdItemSub		=	$getDadosSubItens["idItem"];
		$getOrcSubItem		=	$getDadosSubItens["orcamentoSubItem"];
	}
	//
	//SELECT para pegar o nome do Item na qual o Subitem pertece
	//
	$sqlGetDadosItens = "SELECT * FROM cn_itens WHERE idItem = :idItemSub";
	//Operação de consulta SQL usando PDO
	try{
		$queryGetDadosItens	=	$conecta->prepare($sqlGetDadosItens);
		$queryGetDadosItens->bindValue(':idItemSub', $getIdItemSub,PDO::PARAM_STR);
		$queryGetDadosItens->execute();
		$resultGetDadosItens = $queryGetDadosItens->fetchAll(PDO::FETCH_ASSOC);
		$countGetDadosItens	= $queryGetDadosItens->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetDadosItens){echo "Erro na consulta dos valores de orçamento";}
    //Estrai todas os campos dentro do array $getDadosSubItens
	foreach($resultGetDadosItens as $getDadosItens){
		$getIdItem		=	$getDadosItens["idItem"];
		$getNomeItem	=	$getDadosItens["nomeItem"];
	}
	
	//
	
	//SQL para selecionar o campo valorFornecedores e calcular o orçamento realizado
	$sqlGetFornecedores = "SELECT * FROM cn_fornecedores WHERE idSubItem = :idSubItem";
	//PDO que realiza a consulta no banco
	try{
		$queryGetFornecedores	=	$conecta->prepare($sqlGetFornecedores);
		$queryGetFornecedores->bindValue(':idSubItem', $urlIdSubItem,PDO::PARAM_STR);
		$queryGetFornecedores->execute();
		$resultGetFornecedores = $queryGetFornecedores->fetchAll(PDO::FETCH_ASSOC);
		$countGetFornecedores = $queryGetFornecedores->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetFornecedores){echo "Erro na consulta dos Fornecedores ".$errorGetFornecedores->getMessage();}
	// Orçamento
	//Fornecedor Fechado
	
	$sqlGetFornecedor = "SELECT * FROM cn_fornecedores WHERE idSubItem = :idSubItem AND statusNegocio = :statusFornecedor";
	//PDO que realiza a consulta no banco
	try{
		$queryGetFornecedor	=	$conecta->prepare($sqlGetFornecedor);
		$queryGetFornecedor->bindValue(':idSubItem', $urlIdSubItem,PDO::PARAM_STR);
		$queryGetFornecedor->bindValue(':statusFornecedor', "Fechado",PDO::PARAM_STR);
		$queryGetFornecedor->execute();
		$resultGetFornecedor = $queryGetFornecedor->fetchAll(PDO::FETCH_ASSOC);
		$countGetFornecedor = $queryGetFornecedores->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetFornecedor){echo "Erro na consulta dos Fornecedores ".$errorGetFornecedor->getMessage();}
 	//Extrai o valor total orçamento dos fornecedores cadastrado na categoria
	foreach($resultGetFornecedor as $getFornecedorFechado){
										$valorFornecedorFechado	=	$getFornecedorFechado["valorFornecedor"];

	}
	
	
	
	//Gera o tatal do orçamento previsto e realizado usando como base as tabelas cn_subitens e cn_fornecedores
	//SQL para selecionar o campo orcamentoSubItem e calcular o valor
	$sqlGetOrcEstimadoSub = "SELECT SUM(orcamentoItem) AS soma FROM cn_itens WHERE idItem = :idItem";
	//Operação de consulta SQL usando PDO
	try{
		$queryGetOrcEstimado	=	$conecta->prepare($sqlGetOrcEstimadoSub);
		$queryGetOrcEstimado->bindValue(':idItem',$getIdItemSub,PDO::PARAM_STR);
		$queryGetOrcEstimado->execute();
		$resultGetOrcEstimado = $queryGetOrcEstimado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcEstimado	= $queryGetOrcEstimado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de orçamento";}
    //Estrai o valor total do orçamento de subitens na variável $valorEstimadoSub
	foreach($resultGetOrcEstimado as $getOrcEstimado){
		$valorEstimadoSub	=	$getOrcEstimado["soma"];
	}
	//SQL para selecionar o campo valorFornecedores e calcular o orçamento realizado
	$sqlGetOrcRealizadoSub = "SELECT SUM(valorFornecedor) AS soma FROM cn_fornecedores WHERE idItem = :idItem AND statusNegocio = :statusNegocio";
	//PDO que realiza a consulta no banco
	try{
		$queryGetOrcRealizado	=	$conecta->prepare($sqlGetOrcRealizadoSub);
		$queryGetOrcRealizado->bindValue(':idItem',$getIdItemSub,PDO::PARAM_STR);
		$queryGetOrcRealizado->bindValue(':statusNegocio',"Fechado",PDO::PARAM_STR);
		$queryGetOrcRealizado->execute();
		$resultGetOrcRealizado = $queryGetOrcRealizado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcRealizado = $queryGetOrcRealizado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de orçamento";}
 	//Extrai o valor total orçamento dos fornecedores cadastrado na categoria
	foreach($resultGetOrcRealizado as $getOrcRealizado){
		$valorRealizadoForn	=	$getOrcRealizado["soma"];
	}
?>
            <div id="principal">
            	<div class="itens">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto" class="item">
                    	<thead>
                        	<tr>
                            	<td width="40%"></td>
                                <td width="60%"></td>
                            </tr>
                        </thead>
                    	<tbody>
                        	<tr>
                               	<td width="40%" class="first"><?php echo $getNomeItem;?></td>
                                <td width="60%" class="second">
                                	<table cellpadding="0" cellspacing="0" border="0" width="auto">
                                    	<tr>
                                        	<td>Estimado para este item:</td>
                                            <td><span><font style="font-size:14px">R$</font> <?php echo number_format($valorEstimadoSub,2,',','.');?></span></td>
                                        </tr>
                                        <tr>
                                        	<td>Realizado para este item:</td>
                                            <td><span><font color="#d9645b"><font style="font-size:14px">R$</font> <?php if($countGetOrcRealizado != 0)echo number_format($valorRealizadoForn, 2,',','.');?></font></span></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>                      
                         </tbody>
                         <tfoot>
                         	<tr>
                            	<td width="40%"></td>
                                <td width="60%"></td>
                            </tr>
                         </tfoot>
                    </table>
                </div>
                <div class="fornecedores">
                	<h1 class="titulo">
                    	Fornecedores de <span>"<?php echo $getNomeSubItem;?>":</span>
                    	<a class="excluir" title="Excluir Subitem" name="modal" href="#lightbox9"></a>
                        <a class="editar-subitem" title="Editar Subitem" name="modal" href="#lightbox3"></a>
                    </h1> 
                    <?php if($countGetFornecedores == 0){?>
                    <div class="fornecedores-vazio">Você não possui fornecedores cadastrados para este subitem. Para adicionar, clique no botão e preencha o cadastro.</div>
                    <?php 
						}else{
									foreach($resultGetFornecedores as $getFornecedores){
										$idFornecedor		=	$getFornecedores["idFornecedor"];
										$nomeFornecedor		=	$getFornecedores["nomeFornecedor"];
										$emailFornecedor	=	$getFornecedores["emailFornecedor"];
										$contatoFornecedor	=	$getFornecedores["contatoFornecedor"];
										$valorFornecedor	=	$getFornecedores["valorFornecedor"];
										$obsFornecedor		=	$getFornecedores["obsFornecedor"];
										$statusFornecedor	=	$getFornecedores["statusNegocio"];
										$idSubItemFornecedor=	$getFornecedores["idSubItem"];
																
					?>
                    <div id="fornecedor" class="frcd <?php if($statusFornecedor  == "Fechado"){echo "fecha";}?>">                    
                        <div class="titulo">
                        	<h1><?php echo $nomeFornecedor;?></h1>
                            <a class="expandir-fornecedor"></a>
                            <a class="valor-fornecedor">R$ <?php echo number_format($valorFornecedor, 2, ',','.');?></a>
                            <div class="status-fornecedor <?php if($statusFornecedor == "Fechado"){echo "fechado";}else{echo "";}?>"></div>                            
                        </div>
                        <ul class="corpo">
                            <li><span class="coluna-um">Telefone:</span><span class="coluna-dois contato"><?php echo $contatoFornecedor;?></span></li>                        
                            <li><span class="coluna-um">E-mail:</span><span class="coluna-dois email"><?php echo $emailFornecedor;?></span></li>
                            <li><span class="coluna-um">Valor:</span><span class="coluna-dois valor">R$ <?php echo number_format($valorFornecedor, 2,',','.');?></span></li>
                            <li><span class="coluna-um">Observação:</span><span class="coluna-dois observacao"><?php echo $obsFornecedor;?></span></li>
                            <li>
                            <?php if($statusFornecedor == 'Aberto'){?>
                            <a  href="functions/updateFecharFornecedor.php?id=<?php echo $idFornecedor;?>&subitem=<?php echo $idSubItemFornecedor;?>" class="fechar-negocio" id="statusNegocio"></a>
							<?php }else{?>
                            <a  href="<?php echo $idFornecedor;?>" class="cancelar-negocio" id="statusNegocio" rel="<?php echo $idSubItemFornecedor;?>"></a>
							<?php }?>
                            <a class="indicar-fornecedor" title="Indicar o Fornecedor para um amigo" name="modal" href="#lightbox11" rel="<?php echo $idFornecedor;?>"></a>
                            <a class="editar-fornecedor" title="Editar" name="modal" href="#lightbox5" rel="<?php echo $idFornecedor;?>"></a>
                            <a class="excluir-fornecedor" id="excluirFornecedor" title="Excluir" name="modal" href="#lightbox6" rel="<?php echo $idFornecedor;?>"></a>
                            </li>
                        </ul>                        
                    </div>
                    <?php }
						/*if($countGetFornecedores >= 1){
							$subItemFechado = "Fechado";
							$subItemAberto	= "Aberto";
							for($i = 0; $i < $countGetFornecedores; $i++){
							if($statusFornecedor == "Fechado"){
								$sqlFecharSubItem = "UPDATE cn_subitens SET statusSubItem = :subItemFechado WHERE idSubItem = :idSubItem";
								try{
									$queryFecharSubItem = $conecta->prepare($sqlFecharSubItem);	
									$queryFecharSubItem->bindValue(':subItemFechado', $subItemFechado, PDO::PARAM_STR);
									$queryFecharSubItem->bindValue(':idSubItem', $getIdSubItem, PDO::PARAM_STR);
									$queryFecharSubItem->execute();								
									}catch(PDOexception $errorFecharSubItem){echo $errorFecharSubItem;}
								}elseif($statusFornecedor == "Aberto"){
								  $sqlCancelarSubItem = "UPDATE cn_subitens SET statusSubItem = :subItemAberto WHERE idSubItem = :idSubItem";
								try{
									$queryCancelarSubItem = $conecta->prepare($sqlCancelarSubItem);	
									$queryCancelarSubItem->bindValue(':subItemAberto', $subItemAberto, PDO::PARAM_STR);
									$queryCancelarSubItem->bindValue(':idSubItem', $getIdSubItem, PDO::PARAM_STR);
									$queryCancelarSubItem->execute();								
									}catch(PDOexception $errorCancelarSubItem){echo $errorCancelarSubItem;}	
									
									}
							}
						}*/
					}
					?>
                           
                </div>
                <a class="adicionar-fornecedor" onClick="return false;" name="modal" href="#lightbox4"><span>adicionar novo fornecedor</span></a>

                