 <?php 
 //Chama o Arquivo do Banco de Dados no documento
 	  	require 'class/MysqlConnPDO.php'; 
 		//Edição de SubItem
		$idSubItemEdit	=	$_GET["idSubItem"];
		//SQL seleciona o item a ser editado
		$sqlGetSubItemEdit	=	"SELECT * FROM cn_subitens WHERE idSubItem = :idSubItem AND idNoiva = :idNoiva";
		try{
			$queryGetSubItemEdit	=	$conecta->prepare($sqlGetSubItemEdit);
			$queryGetSubItemEdit->bindValue(':idSubItem', $idSubItemEdit, PDO::PARAM_STR);
			$queryGetSubItemEdit->bindValue(':idNoiva', $idNoiva, PDO::PARAM_STR);
			$queryGetSubItemEdit->execute();
			
			$resultGetSubItemEdit	=	$queryGetSubItemEdit->fetchAll(PDO::FETCH_ASSOC);
			}catch(PDOexception $errorGetSubItemEdit){echo $errorGetSubItemEdit;}
			
			foreach($resultGetSubItemEdit as $getSubItemEdit){
				$editIdSubItem	=	$getSubItemEdit["idSubItem"];
				$editNomeSubItem=	$getSubItemEdit["nomeSubItem"];
				$editIdItem		=	$getSubItemEdit["idItem"];
				$editOrcSubItem	=	$getSubItemEdit["orcamentoSubItem"];
				}
			$sqlGetItemEditSub	=	"SELECT * FROM cn_itens WHERE idItem = :idItem";
			try{
				$queryGetItemEditSub = $conecta->prepare($sqlGetItemEditSub);
				$queryGetItemEditSub->bindValue(':idItem', $editIdItem, PDO::PARAM_STR);
				$queryGetItemEditSub->execute();
				
				$resultGetItemSub	=	$queryGetItemEditSub->fetchAll(PDO::PARAM_STR);
				
				}catch(PDOexception $errorGetItemEditSub){echo "Erro ao ao selecionar item dos subitens a serem editado ".$errorGetItemEditSub;}		
 ?>

<div id="boxes">

                <div id="lightbox1" class="lightbox-item window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>adicionar item</h2>
                    <p>Insira o nome do item que deseja adicionar</p>
                    <form name="formCadItem" id="formCadItem" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><div class="input"><input id="nomeItem" name="nomeItem" type="text" value="" size="40" style="text-transform:none;" /><span id="contador" style="width:14px; height:17px; min-width:14px; min-height:17px; display:inline-block"></span></div></td>
                    	</tr>
                        <tr>
                    		<td><p>Orçamento estimado para este item</p></td>
                    	</tr>
                        <tr>
                    		<td><div class="input">R$<input id="orcamentoItem" name="orcamentoItem" type="text" value="" size="16" class="money" /></div></td>
                    	</tr>
                        <tr>
                    		<td>
                            <input type="submit" id="executarCadItem" value="criar" class="submit" onClick="return false;" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox2" class="lightbox-subitem window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>adicionar subitem</h2>
                    <p>Insira o nome do subitem que deseja adicionar</p>
                    <form name="formCadSubItem" id="formCadSubItem" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><div class="input"><input id="nomeSubItem" name="nomeSubItem" type="text" value="" size="40" style="text-transform:none" /><span id="contadorSI"></span></div></td>
                    	</tr>
                        <tr>
                    		<td><p>Escolha o item a que ele pertence</p></td>
                        </tr>
                        <tr>
                        	<td>
                            	<select name="itemSubItem" id="itemSubItem">
                                	<option value="---">---</option>
                                    <?php
									$idNoiva			  = $_SESSION["EMAIL"];
									$sqlGetItemCadSubItem = "SELECT * FROM cn_itens WHERE idNoiva = :idNoiva ORDER BY nomeItem ASC";
									try{
									$queryGetItemCadSubItem = $conecta->prepare($sqlGetItemCadSubItem);
									$queryGetItemCadSubItem->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
									$queryGetItemCadSubItem->execute();
									//Resultado da Pesquisa
									$resultGetItemCadSubItem = $queryGetItemCadSubItem->fetchAll(PDO::FETCH_ASSOC);
									}catch(PDOexception $error_GetItemCadSubItem){echo "erro ao executar a consulta SQL".$error_GetItemCadSubItem->getMessage();}
									foreach($resultGetItemCadSubItem as $itens){
										$idItemCadSubItem		=	$itens["idItem"];
										$nomeItemCadSubItem		=	$itens["nomeItem"];
								  ?>
                                  
                                  <option value="<?php echo $idItemCadSubItem;?>"><?php echo $nomeItemCadSubItem;?></option>
	  							  <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                    		<td>
                            <input name="executarCadSubItem" type="submit" class="submit" id="executarCadSubItem" onClick="return false;" value="criar" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox3" class="lightbox-subitem-editar window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>editar subitem</h2>
                    <p>Insira o nome do subitem que deseja alterar</p>
                    <form id="formEditSubItem" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><div class="input"><input type="text" id="editNomeSubItem" value="<?php echo $editNomeSubItem;?>" size="40" /><span id="contadorEditNomeSubitem"></span></div></td>
                    	</tr>
                        <tr>
                    		<td><p>Escolha o item a que ele pertence</p></td>
                        </tr>
                        <tr>
                        	<td>
                            	<select id="editItemSubItem" disabled>
                                    <?php
                                    foreach($resultGetItemSub as $getItemSub){
										$idItemEditSubItem		=	$getItemSub["idItem"];
										$nomeItemEditSubItem	=	$getItemSub["nomeItem"];
								  ?>
                                  <option value="<?php echo $idItemEditSubItem;?>"><?php echo $nomeItemEditSubItem;?></option>
	  							  <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                    		<td>
                            <input name="editIdSubItem" type="hidden" id="editIdSubItem" value="<?php echo $idSubItemEdit;?>" />
                            <input type="submit" value="salvar" class="submit" id="executarEditSubItem" onClick="return false;" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox4" class="lightbox-fornecedor window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>ADICIONAR FORNECEDOR</h2>
                    <form id="formCadFornecedor" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                        <tr>
                    		<td><h3>nome:</h3></td>
                            <td><div class="input"><input name="nomeFornecedor" type="text" id="nomeFornecedor" value="" size="45" /><span id="contadorF"></span></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>telefone:</h3></td>
                            <td><div class="input"><input name="contatoFornecedor" type="text" id="contatoFornecedor" value="" size="45" /></div></td>
                        </tr>
                        <tr>
                        	<td><h3>e-mail:</h3></td>
                            <td><div class="input" style="text-transform:lowercase"><input name="emailFornecedor" type="text" id="emailFornecedor" value="" size="45" style="text-transform:lowercase" /></div></td>
                        </tr>
                        <tr>
                        	<td><h3>valor:</h3></td>
                            <td><div class="input"><input name="valorFornecedor" type="text" id="valorFornecedor" value="" size="45" class="money"/></div></td>
                        </tr>
                        <tr>
                        	<td style="vertical-align:top; padding-top:20px"><h3>observação:</h3></td>
                            <td><textarea name="obsFornecedor" cols="44" rows="5" id="obsFornecedor"></textarea></td>
                        </tr>
                        <tr>
                        	<td style="vertical-align:top; padding-top:20px"></td>
                            <td><span id="contadorObs"></span></td>
                        </tr>
                        <tr>
                        	<td><input name="idSubItem" type="hidden" id="idSubItem" value="<?php echo $_GET["idSubItem"];?>"></td>
                            <td>
                            	<input type="submit" value="criar" class="submit" id="executarCadFornecedor" onClick="return false;" />
                    			<input type="button" value="cancelar" class="reset" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox5" class="lightbox-fornecedor-editar window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>Editar FORNECEDOR</h2>
                    <form id="formEditFornecedor" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                        <tr>
                    		<td><h3>nome:</h3></td>
                            <td><div class="input"><input id="editNome" type="text" value="" size="45" /><span id="contadorEditNome"></span></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>telefone:</h3></td>
                            <td><div class="input"><input id="editContato" type="text" value="" size="45" /></div></td>
                        </tr>
                        <tr>
                        	<td><h3>e-mail:</h3></td>
                            <td><div class="input" style="text-transform:lowercase"><input id="editEmail" type="text" value="" size="45" style="text-transform:lowercase" /></div></td>
                        </tr>
                        <tr>
                        	<td><h3>valor:</h3></td>
                            <td><div class="input"><input id="editValor" type="text" value="" class="money" size="45"/></div></td>
                        </tr>
                        <tr>
                        	<td style="vertical-align:top; padding-top:20px"><h3>observação:</h3></td>
                            <td><textarea cols="44" rows="5" id="editObs"></textarea></td>
                        </tr>
                        <tr>
                        	<td style="vertical-align:top; padding-top:20px"></td>
                            <td><span id="contadorEditObs"></span></td>
                        </tr>
                        <tr>
                        	<td><input type="hidden" name="editId" id="editId"></td>
                            <td>
                            	<input type="submit" value="salvar" class="submit"  id="executarEditFornecedor" onClick="return false;"/>
                    			<input type="reset" value="cancelar" class="reset" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox6" class="lightbox-excluir-fornecedor window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>EXCLUIR</h2>
                    <p>Tem certeza que deseja excluir esse fornecedor?</p>
                    <form id="formExcluiFornecedor" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                        <tr>
                    		<td>
                            
                            <input type="submit" value="sim" id="executarDeleteFornecedor" class="submit" onClick="return false;" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox7" class="lightbox-editar window">
                <div class="top"></div>
                <div class="inside">
                <a href="#" class="close"></a>
                	<h2>Editar item</h2>
                    <p>Insira o nome do item que deseja adicionar</p>
                    <form id="formEditItem">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><div class="input"><input id="nomeItem" name="nomeItem" type="text" value="" size="40" /><span id="contador"></span></div></td>
                    	</tr>
                        <tr>
                    		<td><p>Orçamento estimado para este item</p></td>
                    	</tr>
                        <tr>
                    		<td><div class="input">R$<input id="orcamentoItem" name="orcamentoItem" type="text" value="" size="16" class="money"/></div></td>
                    	</tr>
                        <tr>
                    		<td>
                            <input type="hidden" name="editIdItem" id="editIdItem" value="" />
                            <input type="submit" id="executarEditItem" value="editar" class="submit" onClick="return false;" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox8" class="lightbox-excluir-item window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>EXCLUIR</h2>
                    <p align="center">Tem certeza que deseja excluir esse item?</p>
                    <p align="center">Excuindo esse item todos os subitens e fornecedores desse item serão excluidos automaticamente!</p>
                    <form name="formDeleteItem" id="formDeleteItem" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                        <tr>
                    		<td>
                            <input type="submit" id="executarDelItem" value="sim" class="submit" onClick="return false;" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox9" class="lightbox-excluir-subitem window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>EXCLUIR</h2>
                    <p align="center">Tem certeza que deseja excluir esse subitem?</p>
                    <p align="center">Excluindo esse subitem todos os fornecedores desse subitem serão excluidos automaticamente!</p>
                    <form id="formDeleteSubItem" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                        <tr>
                    		<td>
                            <input id="idSubItemExcluir" type="hidden" value="<?php echo $_GET["idSubItem"];?>" />
                            <input id="executarDeleteSubItem" type="submit" value="sim" class="submit" onClick="return false;" />
                    		<input type="reset" value="cancelar" class="reset" />
                            </td>
                    	</tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox10" class="lightbox-envie-email window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>envie por e-mail</h2>
                    <p style="font-size:14px; margin-top:0;">Preencha os dados da pessoa que receberá o relatório.</p>
                    <form id="formEnviaRelatorio" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><h3>nome:</h3></td>
                            <td><div class="input"><input name="relatorioNome" id="relatorioNome" type="text" value="" size="45" /></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>e-mail:</h3></td>
                            <td><div class="input" style="text-transform:lowercase"><input name="relatorioNome" id="relatorioEmail" type="text" value="" size="45" style="text-transform:lowercase" /></div></td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td>
                            	<input type="submit" id="executaEnviarRelatorio" value="enviar" class="submit"  onClick="return false;"/>
                    			<input type="reset" value="cancelar" class="reset" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox11" class="lightbox-indique-fornecedor window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>indique o fornecedor</h2>
                    <form id="formIndicarFornecedor" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><h3>para:</h3></td>
                            <td><div class="input"><input name="indicaNomeAmigo" type="text" id="indicaNomeAmigo" value="" size="45" /></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>e-mail:</h3></td>
                            <td><div class="input" style="text-transform:lowercase"><input name="indicaEmailAmigo" type="text" id="indicaEmailAmigo" value="" size="45" style="text-transform:lowercase" /></div></td>
                        </tr>
                        <tr>
                        	<td style="vertical-align:top; padding-top:20px;"><h3>mensagem:</h3></td>
                            <td><textarea name="indicaObsAmigo" cols="44" rows="5" id="indicaObsAmigo"></textarea></td>
                        </tr>
                        <tr>
                        	<td colspan="2"><div class="dashed"></div></td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><h3>nome:</h3></td>
                            <td><div class="input readonly"><input type="text" id="indicaNome" value="" size="45" readonly /></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>telefone:</h3></td>
                            <td><div class="input readonly"><input type="text" id="indicaContato" value="" size="45" readonly/></div></td>
                        </tr>
                        <tr>
                    		<td><h3>email:</h3></td>
                            <td><div class="input readonly" style="text-transform:lowercase"><input type="text" id="indicaEmail" value="" size="45" readonly /></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>valor:</h3></td>
                            <td><div class="input readonly"><font style="font-family: 'BreeRgRegular';">R$</font><input type="text" id="indicaValor" value="" size="45" readonly/></div></td>
                        </tr>
                        <tr>
                        	<td style="vertical-align:top; padding-top:20px;"><h3>OBSERVAÇÃO:</h3></td>
                            <td><textarea cols="44" id="indicaObs" rows="5" class="readonly" readonly></textarea></td>
                        </tr>
                        <tr>
                        	<td><input name="indicaId" id="indicaId" type="hidden" value=""></td>
                            <td>
                            	<input name="executarIndicar" type="submit" class="submit" id="executarIndicar"  onClick="return false;" value="enviar"/>
                    			<input type="reset" value="cancelar" class="reset" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>
                
                <div id="lightbox12" class="lightbox-perfil window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close"></a>
                	<h2>editar perfil</h2>
                    <form id="formEditarPerfil" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" width="auto">
                    	<tr>
                    		<td><h3>nome:</h3></td>
                            <td><div class="input"><input name="perfilNome" type="text" id="perfilNome" value="<?php echo $perfilNome;?>" size="40" /></div></td>
                    	</tr>
                        <tr>
                        	<td><h3>data do<br />casamento:</h3></td>
                            <td><div class="input"><input name="perfilData" type="text" id="perfilData" value="<?php echo date('d/m/Y', strtotime($perfilDataC));?>" size="11" onkeyup="Formatadata(this,event)" /></div></td>
                        </tr>
                        <tr>
                        	<td><h3>orçamento:</h3></td>
                            <td><div class="input readonly">R$<input name="" type="text" id="" value="<?php echo number_format($valorEstimado, 2,',','.');?>" size="20" readonly/></div></td>
                        </tr>
                        <tr>
                        	<td colspan="2">
                            	<div class="indicacao"><p>Para alterar o orçamento, você deve ajustar as estimativas de cada item, clicando no botão editar em cada um deles.</p></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                            	<input name="perfilEmail" id="perfilEmail" type="hidden" value="<?php echo $perfilEmail;?>">
                            	<input name="executarEditarPerfil" type="submit" class="submit" id="executarEditarPerfil"  onClick="return false;" value="salvar"/>
                    			<input type="reset" value="cancelar" class="reset" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="bottom"></div>
                </div>  
                
                <div id="lightbox13" class="lightbox-percentual window">
                <div class="top"></div>
                <div class="inside">
                	<a href="#" class="close" id="close-percentual"></a>
                	<h2>Bem-vindo (a) à Calculadora de Casamentos GNT</h2>
                    <p>De acordo com a cerimonialista <a href="http://www.cerimoniale.com.br/" target="_blank">Flávia Cavaliere</a>, usualmente se gasta:</p>
                    <ul>
                    	<li>35% do orçamento total para Cerimonial</li>
                        <li>32% para o Bufê</li>
                        <li>5% para gastos com a Noiva</li>
                        <li>1% para gastos com o Noivo</li>
                        <li>5% para o Local da Festa</li>
                        <li>5% para Som e Luz</li>
                        <li>1,5% para Convites e Lembranças</li>
                        <li>10% com a Cerimônia</li>
                        <li>0,5% com Aluguel de Carro</li>
                        <li>5% com Foto e Filmagem</li>
                    </ul>
                    <p style="font-weight:bold; letter-spacing:-1px; line-height:110%; width:408px;">Para facilitar, dividimos o valor total que você deve gastar pelos itens essenciais do seu casamento. Fique à vontade para trocar o valor estimado para cada item, clicando em “editar item”.</p>
                </div>
                <div class="bottom"></div>
                </div>          
                

<div id="mask"></div>

</div>