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

////////////////////////////////////////////////////////////////////////////////////////
$idUsuario  =   $_SESSION["EMAIL"];
$nomeUsuario=	$_SESSION["NOME"];

include("../logado.php");
require '../class/MysqlConnPDO.php';
/////////////////////////////////////////////////////////////////////////////////////////////
$hash    = md5(uniqid(rand(), true));
$arquivo = ('Calculadora-De-Casamento-GNT-Relatorio.xls');
//$arquivo = ('planilhas/planilha-'.$hash.'.xls');
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
//Gera os itens da tabela
$html = "<table width=\"800\" border=\"0\">
  <tr>
    <td colspan=\"3\" style=\"text-align: center;\"><strong>Calculadora de Casamentos</strong></td>
  </tr> 
  <tr>
    <td colspan=\"3\" align=\"center\" valign=\"middle\">Orçamento</td>
  </tr>
  <tr>
    <td width=\"237\" height=\"39\">Estimado: R$ $valorEstimado</td>
    <td width=\"252\" colspan=\"2\">Realizado: R$ $valorRealizado</td>
  </tr>
  <tr><td colspan=\"3\"></td></tr>
  <tr bgcolor=\"#E1E1E1\">
    <td height=\"51\" align=\"center\">Item</td>
    <td align=\"center\"> Status</td>
    <td align=\"center\">Valor</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
            ";

$SQL = "SELECT * FROM cn_itens WHERE idNoiva = '$idUsuario' ORDER BY ordemItem ASC ";
$query       = mysql_query($SQL) or die("Error".mysql_error());
//$result      = mysql_fetch_assoc($query);
$countResult = mysql_num_rows($query);
    while($dataItem = mysql_fetch_assoc($query))
        {
			$idItem = $dataItem["idItem"];
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
			$sqlSubItemP = "SELECT statusSubItem, idItem FROM cn_subitens WHERE idItem = '$idItem' AND statusSubItem = 'Aberto'";
                $querySubItemP = mysql_query($sqlSubItemP) or die("Erro ao selecionar a quantidade de SubItem Pendente");
                $countSIP      = mysql_num_rows($querySubItemP);
            
            $statusAtual 	= $resultSubStatus["statusSubItem"];
            $nomeDoItem = htmlentities($dataItem["nomeItem"], ENT_COMPAT, 'ISO-8859-1');
			//Cria os Estilos das Colunas
			if($statusAtual == 'Aberto'){
				$bgColor1 = "#fbf5ed";
				$bgColor2 = "#efdcc3";
				$bgColor3 = "#fff8ed";
				$style	  = 'style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:16px; color:#9c7a4d;  text-align:left; padding-left:8px; font-weight:bold;"';
				}else{
					$bgColor1 = "#fbf5ed";
					$bgColor2 = "#fff8ed";
					$style	 = 'style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:16px; color:#00aba7; text-transform:uppercase; font-weight:bold; text-align:left; padding-left:8px;"';
					}
			//Seta quantidade de itens pendentes ou resolvido		
			if(isset($statusAtual) && $statusAtual == "Aberto" || $countSubStatus == 0){
				if($countSubStatus > 1){
				$quantidadeSubItem	=	$countSIP.' subitens pendentes';
				}else{
				$quantidadeSubItem	=	$countSIP.' subitem pendente';	
					}
			}//else{
				//$quantidadeSubItem  = 'Fechado';
				//}
$html .= "

        <tr bgcolor=\"#EEEEEE\">
            <td align=\"center\" valign=\"middle\">$nomeDoItem</td>
            <td align=\"center\" valign=\"middle\">$quantidadeSubItem</td>
            <td align=\"center\" valign=\"middle\">R$ $valorItem</td>
        </tr>
";                
         //SQL do subitem
          $idItem   = $dataItem["idItem"];
          $SQL2     = "SELECT * FROM cn_subitens WHERE idItem = '$idItem'";
          $query2   = mysql_query($SQL2) or die ("Erro nas consultas dos Subitens".mysql_error());
          $count2   = mysql_num_rows($query2);
          //////////
          if($count2 != 0){

            while($dataSubItem = mysql_fetch_assoc($query2)){
				$idSubItem	=	$dataSubItem["idSubItem"];
				$SQLCalc2 	= "SELECT valorFornecedor, statusNegocio FROM cn_fornecedores WHERE idSubItem = '$idSubItem' AND statusNegocio = 'Fechado'";
				$queryCalc2	= mysql_query($SQLCalc2) or die ("Erro ao recuperar dados de valor do subitem ".mysql_error());
				$resultCalc2= mysql_fetch_assoc($queryCalc2);
				$statusFornecedor = $resultCalc2["statusNegocio"];
                $nomeSubItem      = $dataSubItem["nomeSubItem"];
				if($statusFornecedor == "Fechado"){
					$statusSubItem	=	"fechado";
					$valorSubItem	=	number_format($resultCalc2["valorFornecedor"], 2, ',','.');
					}else{
					$statusSubItem	=	"pendente";	
					$valorSubItem	=	"--x--";	
						}
$html .=    "
                <tr>
                    <td align=\"center\" valign=\"middle\">$nomeSubItem</td>
                    <td align=\"center\" valign=\"middle\">$statusSubItem</td>
                    <td align=\"center\" valign=\"middle\">$valorSubItem</td>
                </tr>
            ";
            }
          }else{                                        
$html .= "
             <tr>
                <td align=\"center\" valign=\"middle\">&nbsp;</td>
                <td align=\"center\" valign=\"middle\">&nbsp;</td>
                <td align=\"center\" valign=\"middle\">&nbsp;</td>
             </tr>
             ";
  }	
             
 } 
                       
$html .= "</table>";            
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Exporta os Dados

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

echo $html;

exit;


?>