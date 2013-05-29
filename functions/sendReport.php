<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */
//Envio do OrverView Por E-mail
$dbhost							= "localhost";
$dbuser							= "calcnoiva_adm";
$dbpass							= "c8*HlBn6*JF0";
$dbname							= "calcnoiva_db";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);

include("../logado.php");

////////////////////////////////////////////////////////////////////////////////////////
$idUsuario  =   $_SESSION["EMAIL"];
$nomeUsuario=	$_SESSION["NOME"];

include("../logado.php");
require '../class/MysqlConnPDO.php';
/////////////////////////////////////////////////////////////////////////////////////////////

//PEGA OS VALORES DE ORÇAMENTO
$idUsuario  =   $_SESSION["EMAIL"];
$sqlGetOrcEstimado = "SELECT SUM(orcamentoItem) AS soma FROM cn_itens WHERE idNoiva = :idNoiva";
	try{
		$queryGetOrcamentoEstimado	=	$conecta->prepare($sqlGetOrcEstimado);
		$queryGetOrcamentoEstimado->bindValue(':idNoiva',$idUsuario,PDO::PARAM_STR);
		$queryGetOrcamentoEstimado->execute();
		$resultGetOrcamentoEstimado = $queryGetOrcamentoEstimado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcamentoEstimado	= $queryGetOrcamentoEstimado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de or?amento";}
    foreach($resultGetOrcamentoEstimado as $getOrcamentoEstimado){
		$valorEstimado	=	number_format($getOrcamentoEstimado["soma"],2,',','.');
	}
	$sqlGetOrcRealizado = "SELECT SUM(valorFornecedor) AS soma2 FROM cn_fornecedores WHERE idNoiva = :idNoiva AND statusNegocio = :statusNegocio";
	try{
		$queryGetOrcamentoRealizado	=	$conecta->prepare($sqlGetOrcRealizado);
		$queryGetOrcamentoRealizado->bindValue(':idNoiva',$idUsuario,PDO::PARAM_STR);
		$queryGetOrcamentoRealizado->bindValue(':statusNegocio',"Fechado",PDO::PARAM_STR);
		$queryGetOrcamentoRealizado->execute();
		$resultGetOrcamentoRealizado = $queryGetOrcamentoRealizado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcamentoRealizado	= $queryGetOrcamentoRealizado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de or?amento";}
    foreach($resultGetOrcamentoRealizado as $getOrcamentoRealizado){
		$valorRealizado	=	number_format($getOrcamentoRealizado["soma2"],2,',','.');
	}
//////////////////////////////////////////////////////////////////////////////////////////////


$envioNome	=	$_GET["relatorioNome"];
$envioEmail	=	$_GET["relatorioEmail"];

$header  = "From: ".$nomeUsuario." <".$idUsuario.">\r\n";
$header .= "Reply-To: ".$idUsuario."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=utf-8\r\n";
$header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$header .= "X-Priority: 1";

$subject = "Acompanhe detalhadamente o relatório dos orçamentos para o casamento.";

$mensagem = '
!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body style="margin:0; padding:0;">
<table bgcolor="#fdfaf6"  align="center" width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" width="232"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#fff8ed" width="232"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/img1.jpg" width="232" height="110" style="display:block; border:0;" alt="GNT Calculadora de Casamentos" /></td>
					<td bgcolor="#fff8ed" width="30">&nbsp;</td>
					<td bgcolor="#fff8ed"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="center" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-transform:uppercase; color:#e37970; padding-top:15px;">orçamento</td>
							</tr>
							<tr>
								<td valign="middle" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:20px; color:#9c7a4d; padding-top:12px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="66" style="border-left:2px dashed #cbb49b;" >&nbsp;</td>
											<td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td align="left">Total estimado <span style="color:#e37970;">- R$</span> '.$valorEstimado.'</td>
													</tr>
													<tr>
														<td align="center" height="6"></td>
													</tr>
													<tr>
														<td align="left">Total realizado <span style="color:#e37970;">- R$</span> '.$valorRealizado.'
													</tr>
												</table></td>
											<td height="5" style="border-right:2px dashed #cbb49b;">&nbsp;</td>
											<td width="20">&nbsp;</td>
										</tr>
									</table></td>
							</tr>
							
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table></td>
						
						
				</tr>
			</table></td>
	</tr>
	
	<tr>
		<td align="center"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/img2.jpg" width="600" height="17" style="display:block; border:0;" /></td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:14px; text-align:left; color:#9c7a4d; line-height:22px; padding-left:36px; padding-right:27px;">Aqui você cadastra seus fornecedores e controla quanto está gastando nos preparativos para o seu casamento.</td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:11px; text-align:left; color:#9c7a4d;">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:11px; text-align:left; color:#9c7a4d;">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:14px; text-align:left; color:#9c7a4d; padding-left:36px;">'.$nomeUsuario.' está lhe enviando o Relatório atual dos orçamentos de seu casamento.</td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6">&nbsp;</td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="32" bgcolor="#fdfaf6">&nbsp;</td>
				<td bgcolor="#fdfaf6" width="462" style="padding-bottom:10px;"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/img3.jpg" width="462" height="32" style="display:block; border:0;" alt="Relatório completo dos orçamentos" /></td>
				<td bgcolor="#fdfaf6">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="32">&nbsp;</td>
				<td style="border-top:1px dashed #cbb49b; padding-top:5px;" align="right" ></td>
				<td width="32">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td bgcolor="#fdfaf6">&nbsp;</td>
	</tr>
	
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="#fdfaf6" width="32">&nbsp;</td>
				<td height="51" bgcolor="#fdfaf6" style="border-top:2px solid #d3c1ab;border-bottom:2px solid #d3c1ab;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="11" bgcolor="#fdfaf6">&nbsp;</td>
						<td width="100" bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:18px; color:#9c7a4d; text-transform:uppercase; text-align:left;">Item</td>
						<td width="250" bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:18px; color:#9c7a4d; text-transform:uppercase; text-align:center;">Status</td>
						<td bgcolor="#fdfaf6" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:18px; color:#9c7a4d; text-transform:uppercase; text-align:right;">valor fechado</td>
						<td width="11" bgcolor="#fdfaf6">&nbsp;</td>
					</tr>
				</table></td>
				<td bgcolor="#fdfaf6" width="32">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="35"></td>
				<td></td>
				<td width="32"></td>
			</tr>
		</table></td>
	</tr>
';
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
            
            $nomeDoItem = $result["nomeItem"];

            if($statusAtual == 'Fechado'){
            	$color = '#e37970';
            }else{
            	$color = '#9c7a4d';
            }
			//Cria os Estilos das Colunas
				//Seta quantidade de itens pendentes ou resolvido		
			//if(isset($statusAtual) && $statusAtual == "Aberto" || $countSubStatus == 0){
			//	if($countSubStatus > 1){
				//$quantidadeSubItem	=	$countSubStatus.' subitens pendentes</td>';
				//}else{
				//$quantidadeSubItem	=	$countSubStatus.' subitem pendente</td>';	
				//	}
			//}else{
			//	$quantidadeSubItem  = 'fechado';
				//}
$mensagem .= 
			'
				<tr>
		<td bgcolor="#fdfaf6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="#fdfaf6" width="35">&nbsp;</td>
				<td height="40" bgcolor="#fdfaf6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						
						<td bgcolor="#fdfaf6" width="100" height="22"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; text-transform:uppercase; font-size:16px; color: #9c7a4d;  text-align:left; padding-left:8px;">'.$nomeDoItem.'</td>
						<td bgcolor="#fdfaf6" width="250"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:16px; color: #9c7a4d; text-align:center;"></td>
						<td bgcolor="#fdfaf6"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:16px; color: #9c7a4d; text-transform:uppercase; text-align:center; font-weight:bold;">R$ '.$valorItem.'</td>
						
					</tr>
				</table></td>
				<td width="32">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="35"></td>
				<td style="border-top:1px solid #d7c6ad;"></td>
				<td width="32"></td>
			</tr>
		</table></td>
	</tr>
			';
                        
         //SQL do subitem
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
                $nomeSubItem      = $dataSubItem["nomeSubItem"];
				if($statusFornecedor == "Fechado"){
					$statusSubItem	=	"fechado";
					$color2			= 	'#e37970';
					$valorSubItem	=	number_format($resultCalc2["valorFornecedor"], 2, ',','.');
					}else{
					$statusSubItem	=	"pendente";
					$color2			=	'#9c7a4d';	
					$valorSubItem	=	"--x--";	
						}
$mensagem .=
			'
				<tr>
		<td bgcolor="#fdfaf6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td bgcolor="#fdfaf6" width="35">&nbsp;</td>
				<td height="40" bgcolor="#fdfaf6" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						
						<td width="100" bgcolor="#fdfaf6"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:16px; color:'.$color2.'; text-align:left; padding-left:8px;">'.$nomeSubItem.'</td>
						<td width="250" bgcolor="#fdfaf6"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:14px; color:'.$color2.';  text-align:center;">'.$statusSubItem.'</td>
						<td bgcolor="#fdfaf6"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:14px; color:'.$color2.'; text-transform:uppercase; text-align:center;">R$ '.$valorSubItem.'</td>
						
					</tr>
				</table></td>
				<td width="32">&nbsp;</td>
			</tr>
		</table></td>
	</tr>
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="35"></td>
				<td style="border-top:1px solid #d7c6ad;"></td>
				<td width="32"></td>
			</tr>
		</table></td>
	</tr>
			';
        }

    }                  
$mensagem .= 
			'
	<tr>
		<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
							
								
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><a href="#" target="_blank"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/img5.jpg" width="535" height="62" style="display:block; border:0;" alt="Se você ainda não conhece Calculadora de Casamentos clique e confira." /></a></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>				
		<td height="80"><table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td  colspan="3"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/bg-footer.png" width="600" height="10" style="display:block; border:0;" /></td>
			</tr>
			<tr>
				<td bgcolor="#9C7A4D" width="28">&nbsp;</td>
				<td bgcolor="#9C7A4D" height="80" width="419"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/img6.jpg" width="259" height="37" style="display:block; border:0;" alt="GNT Chuva de arroz" /></td>
				<td bgcolor="#9C7A4D"><a href="http://gnt.globo.com/noivas/"><img src="http://gntapps.com.br/calculadora-de-casamentos/Email-Relatorio/Html/noivas.jpg" width="84" height="28"  style="display:block; border:0;" alt="Noivas GNT"  /></a></td>
			</tr>
		</table>
	</td>
	</tr>
</table>
</body>
</html>
			';                   


//echo $mensagem;             
                         
	if(mail($envioEmail,$subject,$mensagem,$header)) {
	$resultado = array("result"=>"Relatório enviado por e-mail com sucesso");
		echo json_encode($resultado);
	}


?>