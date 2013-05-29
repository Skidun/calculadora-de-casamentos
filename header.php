<?php 

	include("logado.php");
	require 'class/MysqlConnPDO.php';
    require 'class/class.calcData.php';
	
	$idNoiva = $_SESSION["EMAIL"];
    
    include("queryDataCasamento.php");
	$sqlGetOrcEstimado = "SELECT SUM(orcamentoItem) AS soma FROM cn_itens WHERE idNoiva = :idNoiva";
	try{
		$queryGetOrcamentoEstimado	=	$conecta->prepare($sqlGetOrcEstimado);
		$queryGetOrcamentoEstimado->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
		$queryGetOrcamentoEstimado->execute();
		$resultGetOrcamentoEstimado = $queryGetOrcamentoEstimado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcamentoEstimado	= $queryGetOrcamentoEstimado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de or�amento";}
    foreach($resultGetOrcamentoEstimado as $getOrcamentoEstimado){
		$valorEstimado	=	$getOrcamentoEstimado["soma"];
	}
	$sqlGetOrcRealizado = "SELECT SUM(valorFornecedor) AS soma FROM cn_fornecedores WHERE idNoiva = :idNoiva AND statusNegocio = :statusNegocio";
	try{
		$queryGetOrcamentoRealizado	=	$conecta->prepare($sqlGetOrcRealizado);
		$queryGetOrcamentoRealizado->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
		$queryGetOrcamentoRealizado->bindValue(':statusNegocio',"Fechado",PDO::PARAM_STR);
		$queryGetOrcamentoRealizado->execute();
		$resultGetOrcamentoRealizado = $queryGetOrcamentoRealizado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcamentoRealizado	= $queryGetOrcamentoRealizado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de or�amento";}
    foreach($resultGetOrcamentoRealizado as $getOrcamentoRealizado){
		$valorRealizado	=	$getOrcamentoRealizado["soma"];
	}
	//Dados para Edição Perfil
			$filtroPerfil	=	$_SESSION["EMAIL"];
			//SQL para resgatar os dados
			$sqlPerfil	=	"SELECT username, email, dataCasamento, percentualView FROM users WHERE email = :filtroPerfil";
			try{
				$queryPerfil	=	$conecta->prepare($sqlPerfil);
				$queryPerfil->bindValue(':filtroPerfil', $filtroPerfil, PDO::PARAM_STR);
				$queryPerfil->execute();
				
				$resultPerfil = $queryPerfil->fetchAll(PDO::FETCH_ASSOC);
				}catch(PDOexception $errorPerfil){echo "Erro ao selecionar dados do Perfil ";}
			//Armazenar os dados do usuario em variaveis	
			foreach($resultPerfil as $perfil){
				$perfilNome		=	$perfil["username"];
				$perfilEmail	=	$perfil["email"];
				$perfilDataC	=	$perfil["dataCasamento"];
                $perfilPercent  =   $perfil["percentualView"];
				}
    $calculoData	=	new calcData();  
?>		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<meta name="robots" content="index, follow">
<meta name="Googlebot" content="index, follow">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>GNT - Calculadora de Noivas</title>
<meta name="description" content="Aplicativo GNT feito para noivas que desejam se planejar financeiramente para o granade dia. Gerencie os or�amentos de seus fornecedores e garanta uma festa inesquec�vel sem que precise iniciar sua nova vida no vermelho.">
<meta name="keywords" content="">
<meta name="Author" content="Skidun | Ag�ncia Hiperativa - http://www.skidun.com.br">

<meta property="og:title" content="GNT - Calculadora de Noivas">
<meta property="og:url" content="http://gntapps.com.br/calculadora-de-casamentos">
<meta property="og:description" content="Aplicativo GNT feito para noivas que desejam se planejar financeiramente para o granade dia. Gerencie os or�amentos de seus fornecedores e garanta uma festa inesquec�vel sem que precise iniciar sua nova vida no vermelho.">
<meta property="og:image" content="http://gntapps.com.br/calculadora-de-casamentos/img/share-facebook.jpg">
<meta property="og:type" content="website">

<link rel="stylesheet" type="text/css" href="style.css"  media="screen" />
<!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="styleie.css"  media="screen" /><![endif]-->
<link rel="stylesheet" type="text/css" href="scripts/facebox.css" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
<link href="img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">

<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="scripts/slides.min.jquery.js"></script>
<!--<script type="text/javascript" src="scripts/jquery.corner.js"></script>-->
<script type="text/javascript" src="scripts/jquery.tooltip.js"></script>
<script type="text/javascript" src="scripts/jquery.maskMoney.js"></script>
<script type="text/javascript" src="scripts/css_browser_selector.js"></script>


<script type="text/javascript" src="scripts/json.js"></script>

<script src='http://connect.facebook.net/en_US/all.js'></script>					
							<script> 
							  FB.init({appId: "321308224647667", status: true, cookie: true});
						
                            function postToFeed() {

                                // calling the API ...
                                var obj = {
                                  method: 'feed',
                                  link: 'https://apps.facebook.com/calculadoracasamento/',
                                  picture: 'http://gntapps.com.br/calculadora-de-casamentos/img/share-facebook.jpg',
                                  name: 'GNT Calculadora de Casamentos',
                                  caption: ' GNT Calculadora de Casamentos',
                                  description: 'Já comecei a calcular os gastos e escolher os melhores fornecedores para o meu casamento. Com a ajuda do GNT Calculadora de Casamentos, vou casar sem ficar no vermelho! Comece você também a planejar o seu.'
                                };
                        
                                function callback(response) {
                                  document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
                                }
                        
                                FB.ui(obj, callback);
                              }
							</script>
<script type="text/javascript">

/*
var variavel = location.search.split('?idSubItem=');
var subitem = variavel[1].split(',');

$(document).ready(function(){

	$('#sidebar .body a[href="?idSubItem=' + subitem + '"]').parents('.body').slideDown();
	$('#sidebar .body a[href="?idSubItem=' + subitem + '"]').parents('.body').prev('.head').addClass("ui-state-active");

});*/

</script>
<?php 
$urlAtual   = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];


    //if($urlAtual == "gntapps.com.br/calculadora-de-casamentos/index.php" || $urlAtual == "https://gntapps.com.br/calculadora-de-casamentos/index.php"|| $urlAtual == "gntapps.com.br/calculadora-de-casamentos/" || $urlAtual == "gntapps.com.br/calculadora-de-casamentos/index.php#_=_"){
    if($perfilPercent == "Não"){
        echo "<script type=\"text/javascript\">
             $(document).ready(function (){
                		var id = '#lightbox13';
	
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo('slow',0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		$(id).fadeIn(2000); 
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});
             });
             
             </script>";
    }
?>

<script type="text/javascript" src="scripts/event-tracker.js"></script>
<script type="text/javascript" src="scripts/PIE.js"></script>
<script type="text/javascript" src="scripts/geral.js"></script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31248363-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

</head>


<body>

<div id="tudo">

	<!-- [in�cio] header -->
	<div id="header">
		<div class="wrap">
        	
            <a href="." class="logo"><img src="img/icones/logo-topo.png" width="185" height="89" /></a>
            
            <div class="orcamento">
            	<h1>Seu Or&ccedil;amento</h1>
                <table cellpadding="0" cellspacing="0" border="0" width="auto">
                	<tr>
                    	<td>Total estimado <a class="duvida" title="Soma dos orçamentos estimados de todos os itens">[?]</a> </td>
                        <td><span>- R$</span>
								<?php 
									echo number_format($valorEstimado,2,',','.');
								?></td>
                    </tr>
                    <tr>
                    	<td>Total realizado <a class="duvida" title="Soma dos orçametos já fechados">[?]</a> </td>
                        <td><span>- R$</span> <?php echo number_format($valorRealizado, 2,',','.');?></td>
                    </tr>
                </table>
            </div>
            
            <div class="boas-vindas-novo">
            	<table cellpadding="0" cellspacing="0" border="0" width="auto">
                	<tr>
                    	<td>
                            <span>Ol&aacute;,&nbsp;</span>
                            <a href="class/LoginSistema.php?txtLocal=logOff" class="nome"><?php echo $perfilNome;?></a>
                            <a href="class/LoginSistema.php?txtLocal=logOff" class="sair" title="Sair">sair</a>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        <div class="data">
	                        Cas&oacute;rio em <b><?php  $dataPart = explode('-', $dataCasamento); echo substr($dataPart[2],0,2).'.'.$dataPart[1].'.'.$dataPart[0]; ?></b> - <span><?php if($calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'm') > 1 && $calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'm') != 0){echo "Faltam <b> ".$calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'm')." meses</b>";?>
                            <?php }elseif($calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'm') == 1){echo "Falta<b> ".$calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'm')." mês</b>";?> 
                            <?php }elseif($calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'd') <= 30 && $calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'd') >= 2){echo "Faltam <b> ".$calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'd')." dias</b>";?> 
                            <?php }elseif($calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'd') == 1){echo "Falta <b> ".$calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'd')." dia</b>";?>
                            <?php }elseif($calculoData->dataDif(date('Y-m-d'), $dataCasamento, 'd') <= 0){echo "Chegou o dia";}?></span>    	                	
							<a class="editar" name="modal" href="#lightbox12" title="Editar o Perfil"></a>
						</div>                        
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<div class="links">
        	                	<a class="dicas" href="dicas.php" title="Aqui você confere as melhores dicas para o seu casamento">Dicas GNT</a>
    	                        <a class="relatorio" href="overview.php" title="Relatório geral dos status e valores do orçamento">Relat&oacute;rio</a>                       
	                            <a class="ajuda" title="Clique aqui para exibir o passo a passo do aplicativo">Ajuda</a>
                                <div class="tapume"></div>                                
                            </div>
                        </td>
                    </tr>                    
                </table>
            </div>
            
        </div>
	</div>
	<!-- [final] header --> 