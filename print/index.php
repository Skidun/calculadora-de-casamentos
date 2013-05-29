<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */

$dbhost							= "localhost";
$dbuser							= "calcnoiva_adm";
$dbpass							= "c8*HlBn6*JF0";
$dbname							= "calcnoiva_db";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
////////////////////////////////////////////////////////////////////////////////////////
include("../logado.php");
require '../class/MysqlConnPDO.php';

$idNoiva  =   $_SESSION["EMAIL"];
$nomeUsuario=	$_SESSION["NOME"];
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<meta name="robots" content="index, follow">
<meta name="Googlebot" content="index, follow">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="Author" content="Skidun | Agência Hiperativa - http://www.skidun.com.br">

<meta property="og:title" content="">
<meta property="og:url" content="">
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:type" content="">

<link rel="stylesheet" type="text/css" href="style.css"  media="all" />

<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
<link href="img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">


<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="scripts/geral.js"></script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'XX-XXXXXXXX-X']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>

	<!-- [início] header -->
	<div id="header">
		<div class="wrap">
			<img class="logo" src="img/logo.png" width="175" height="84" alt="" />
			<div class="orcamento">
				<h2>Orçamento</h2>
				<h3>Total estimado<span> - R$</span> <?php echo $valorEstimado;?></h3>
				<h3>Total relizado<span>&nbsp; - R$</span> <?php echo $valorRealizado;?></h3>
			</div>
			
			
		</div>
	</div>
	<!-- [final] header --> 
	
	<!-- [início] content -->
	<div id="content">
		<div class="wrap">
		<h3><img class="relatorio" src="img/img-relatorio.png" width="17" height="18" alt="" />Relatório completo dos orçamentos</h3>
        <div></div>
		<div class="bt-imprimir"><a href="#" onclick="window.print();"><img src="img/img4.jpg" alt="" width="82" height="24" /></a></div>
		<table width="520" border="0" cellspacing="0" cellpadding="0">
		<thead>
            <tr>
				<td width="180" class="tituloItem">item</td>
				<td width="210">status</td>
				<td width="130" class="valorItem">valor fechado</td>
			</tr>
		</thead>
		<tbody>
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
            $countSIP      = mysql_num_rows($querySubItemP);
			//Cria os Estilos das Colunas
				//Seta quantidade de itens pendentes ou resolvido		
			if(isset($statusAtual) && $statusAtual == "Aberto" || $countSubStatus == 0){
				if($countSubStatus >= 0){
				$quantidadeSubItem	=	$countSIP.' subitens pendentes</td>';
                $classItem = "item";
				}else{
				$quantidadeSubItem	=	$countSIP.' subitem pendente</td>';
                $classItem = "item";	
					}
			}else{
				$quantidadeSubItem  = '<img src="img/check-resolvido.png" width="13" height="12" alt="" />&nbsp;resolvido';
                $classItem = "item-resolvido";
				}					
			?>       
	<tr class="<?php echo $classItem;?>">
		<td class="nome-left"><?php echo $nomeDoItem;?></td>
		<td><?php echo $quantidadeSubItem;?></td>
		<td>R$ <?php echo $valorItem;?></td>
	</tr>
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
                $nomeSubItem      = htmlentities($dataSubItem["nomeSubItem"], ENT_COMPAT);
				if($statusFornecedor == "Fechado"){
					$statusSubItem	=	"<img src=\"img/check.png\" width=\"11\" height=\"8\" />&nbsp;fechado";
					$valorSubItem	=	number_format($resultCalc2["valorFornecedor"], 2, ',','.');
                    $classSubItem   =   "sub-item-fechado";
					}else{
					$statusSubItem	=	"pendente";	
					$valorSubItem	=	"--x--";
                    $classSubItem   =   "sub-item";	
						}
					?>
                    
                    <tr class="<?php echo $classSubItem;?>">
                        <td style="text-align:  left; padding-left: 20px"><?php echo $nomeSubItem;?></td>
                        <td><?php echo $statusSubItem;?></td>
                        <td><?php echo $valorSubItem?></td>
                    </tr>

                    <?php }?>
    <?php }?>
	
	</tbody>
</table>
		<img class="logo-footer" src="img/logo-footer.png" width="184" height="40" alt="" />
		
		
		
		</div>
	</div>
	<!-- [final] content --> 
                
</body>
</html>
