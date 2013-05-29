<?php

require 'class/app.facebook.php';
require 'class/MysqlConnPDO.php';

$user_profile = $facebook->api('/me/');
$nomeUsuario  =	$user_profile['name'];
$email		  =	$user_profile['email'];
$getEmail	  = base64_decode($_GET["user"]);

if(isset($_POST["iniciar"])){
    if($_POST["dataCasamento"] && $_POST["orcamentoCasamento"] != ''){
	$nome 		= $_POST["nomeUsuario"];
	$formatData	= explode('/', $_POST["dataCasamento"]);
	$data 		= $formatData[2].'-'.$formatData[1].'-'.$formatData[0];
	$orcamento	= str_replace(',','.',str_replace('.','',$_POST["orcamentoCasamento"]));
	//Itens Default
			$item1	=	"Cerimonial e decoração";
			$item2	=	"Bufê";
			$item3	=	"Noiva";
			$item4	=	"Noivo";
			$item5	=	"Local da festa";
			$item6	=	"Som e iluminação";
			$item7	=	"Cerimônia";
			$item8	=	"Foto e filmagem";
			$item9	=	"Convites e lembranças";
            $item10 =   "Aluguel de Carros";
    //Ordem do Menu        
	//Percentuais de cada item
			$percent1 = ($orcamento*35)/100;
			$percent2 = ($orcamento*32)/100;
			$percent3 = ($orcamento*5)/100;
			$percent4 = ($orcamento*1)/100;
			$percent5 = ($orcamento*5)/100;
			$percent6 = ($orcamento*5)/100;
			$percent7 = ($orcamento*10)/100;
			$percent8 = ($orcamento*5)/100;
			$percent9 = ($orcamento*1.5)/100;
            $percent10=($orcamento*0.5)/100;
        	
	$sqlUpdate	=	"UPDATE users SET username = :nome, dataCasamento = :data, orcamentoCasamento = :orcamento WHERE email = :email";
	try{
		$queryUpdate = $conecta->prepare($sqlUpdate);
		$queryUpdate->bindValue(':nome',$nome, PDO::PARAM_STR);
		$queryUpdate->bindValue(':data', $data, PDO::PARAM_STR);
		$queryUpdate->bindValue(':orcamento', $orcamento, PDO::PARAM_STR);
		$queryUpdate->bindValue(':email', $email, PDO::PARAM_STR);
		$queryUpdate->execute();
		}catch(PDOexception $error_Update){ echo "Erro ao atualizar dados ".$error_Update->getMessage();}

		//Adiciona Itens Default no Id do Usuário
			//Item 1
			$sqlCadItem1 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item1, :orcamento, :uid)";
			try{
				$queryCadItem1 = $conecta->prepare($sqlCadItem1);
				$queryCadItem1->bindValue(':item1', $item1, PDO::PARAM_STR);
				$queryCadItem1->bindValue(':orcamento', $percent1, PDO::PARAM_STR);				
				$queryCadItem1->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem1->execute();
				}catch(PDOexception $error_QueryCadItem1){ echo $error_QueryCadItem1->getMessage();}
			//Item 2	
			$sqlCadItem2 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item2, :orcamento, :uid)";
			try{
				$queryCadItem2 = $conecta->prepare($sqlCadItem2);
				$queryCadItem2->bindValue(':item2', $item2, PDO::PARAM_STR);
				$queryCadItem2->bindValue(':orcamento', $percent2, PDO::PARAM_STR);		
				$queryCadItem2->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem2->execute();
				}catch(PDOexception $error_QueryCadItem2){ echo $error_QueryCadItem2->getMessage();}			
			//Item 3
			$sqlCadItem3 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item3, :orcamento, :uid)";
			try{
				$queryCadItem3 = $conecta->prepare($sqlCadItem3);
				$queryCadItem3->bindValue(':item3', $item3, PDO::PARAM_STR);
				$queryCadItem3->bindValue(':orcamento', $percent3, PDO::PARAM_STR);		
				$queryCadItem3->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem3->execute();
				}catch(PDOexception $error_QueryCadItem3){ echo $error_QueryCadItem3->getMessage();}
			//Item 4
			$sqlCadItem4 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item4, :orcamento, :uid)";
			try{
				$queryCadItem4 = $conecta->prepare($sqlCadItem4);
				$queryCadItem4->bindValue(':item4', $item4, PDO::PARAM_STR);
				$queryCadItem4->bindValue(':orcamento', $percent4, PDO::PARAM_STR);		
				$queryCadItem4->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem4->execute();
				}catch(PDOexception $error_QueryCadItem4){ echo $error_QueryCadItem4->getMessage();}
			//Item 5
			$sqlCadItem5 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item5, :orcamento, :uid)";
			try{
				$queryCadItem5 = $conecta->prepare($sqlCadItem5);
				$queryCadItem5->bindValue(':item5', $item5, PDO::PARAM_STR);
				$queryCadItem5->bindValue(':orcamento', $percent5, PDO::PARAM_STR);		
				$queryCadItem5->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem5->execute();
				}catch(PDOexception $error_QueryCadItem5){ echo $error_QueryCadItem5->getMessage();}			
			//Item 6
			$sqlCadItem6 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item6, :orcamento, :uid)";
			try{
				$queryCadItem6 = $conecta->prepare($sqlCadItem6);
				$queryCadItem6->bindValue(':item6', $item6, PDO::PARAM_STR);
				$queryCadItem6->bindValue(':orcamento', $percent6, PDO::PARAM_STR);		
				$queryCadItem6->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem6->execute();
				}catch(PDOexception $error_QueryCadItem6){ echo $error_QueryCadItem6->getMessage();}
			//Item 7
			$sqlCadItem7 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item7, :orcamento, :uid)";
			try{
				$queryCadItem7 = $conecta->prepare($sqlCadItem7);
				$queryCadItem7->bindValue(':item7', $item7, PDO::PARAM_STR);
				$queryCadItem7->bindValue(':orcamento', $percent7, PDO::PARAM_STR);		
				$queryCadItem7->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem7->execute();
				}catch(PDOexception $error_QueryCadItem7){ echo $error_QueryCadItem7->getMessage();}
			//Item 8
			$sqlCadItem8 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item8, :orcamento, :uid)";
			try{
				$queryCadItem8 = $conecta->prepare($sqlCadItem8);
				$queryCadItem8->bindValue(':item8', $item8, PDO::PARAM_STR);
				$queryCadItem8->bindValue(':orcamento', $percent8, PDO::PARAM_STR);		
				$queryCadItem8->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem8->execute();
				}catch(PDOexception $error_QueryCadItem8){ echo $error_QueryCadItem8->getMessage();}
			//Item 9
			$sqlCadItem9 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item9, :orcamento, :uid)";
			try{
				$queryCadItem9 = $conecta->prepare($sqlCadItem9);
				$queryCadItem9->bindValue(':item9', $item9, PDO::PARAM_STR);
				$queryCadItem9->bindValue(':orcamento', $percent9, PDO::PARAM_STR);		
				$queryCadItem9->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem9->execute();
				}catch(PDOexception $error_QueryCadItem9){ echo $error_QueryCadItem9->getMessage();}
            $sqlCadItem10 = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUES (:item10, :orcamento, :uid)";
			try{
				$queryCadItem10 = $conecta->prepare($sqlCadItem10);
				$queryCadItem10->bindValue(':item10', $item10, PDO::PARAM_STR);
				$queryCadItem10->bindValue(':orcamento', $percent10, PDO::PARAM_STR);		
				$queryCadItem10->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem10->execute();
				}catch(PDOexception $error_QueryCadItem10){ echo $error_QueryCadItem10->getMessage();}
		header("Location: class/LoginSistema.php?user=$email");
        }else{
            echo "<script>alert('Informe todos os dados');</script>";            
        }
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR" xmlns:fb="http://www.facebook.com/2008/fbml">
<meta name="robots" content="index, follow">
<meta name="Googlebot" content="index, follow">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>GNT - Calculadora de Noivas</title>
<meta name="description" content="Aplicativo GNT feito para noivas que desejam se planejar financeiramente para o granade dia. Gerencie os orçamentos de seus fornecedores e garanta uma festa inesquecível sem que precise iniciar sua nova vida no vermelho.">
<meta name="keywords" content="">
<meta name="Author" content="Skidun | Agência Hiperativa - http://www.skidun.com.br">

<meta property="og:title" content="GNT - Calculadora de Noivas">
<meta property="og:url" content="http://gntapps.com.br/calculadora-de-casamentos">
<meta property="og:description" content="Aplicativo GNT feito para noivas que desejam se planejar financeiramente para o granade dia. Gerencie os orçamentos de seus fornecedores e garanta uma festa inesquecível sem que precise iniciar sua nova vida no vermelho.">
<meta property="og:image" content="http://gntapps.com.br/calculadora-de-casamentos/img/share-facebook.jpg">
<meta property="og:type" content="website">

<link rel="stylesheet" type="text/css" href="style.css"  media="screen" />
<link rel="stylesheet" type="text/css" href="scripts/facebox.css" />
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
<link href="img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">


<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="scripts/jquery.maskMoney.js"></script>
<script type="text/javascript" src="scripts/facebox.js"></script>
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

  <script src='http://connect.facebook.net/en_US/all.js'></script>					
							<script> 
							  FB.init({appId: "376023352450938", status: true, cookie: true});
						
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
</head>


<body class="bg-capa">

<div id="tudo">

	<!-- [início] header -->
	<div id="header">
		<div class="wrap"></div>
	</div>
	<!-- [final] header --> 
     
     <script>
	function Formatadata(Campo, teclapres)
				{
					var tecla = teclapres.keyCode;
					var vr = new String(Campo.value);
					vr = vr.replace("/", "");
					vr = vr.replace("/", "");
					vr = vr.replace("/", "");
					tam = vr.length + 1;
					if (tecla != 8 && tecla != 8)
					{
						if (tam > 0 && tam < 2)
							Campo.value = vr.substr(0, 2) ;
						if (tam > 2 && tam < 4)
							Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
						if (tam > 4 && tam < 7)
							Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
					}
				}  	 
	 $(function(){
     	$(".money").maskMoney({symbol:'R$ ', thousands:'.', decimal:','});
	 })
     </script>     
        
	<!-- [início] content -->
	<div id="content">
		<div class="wrap">
            <!-- [início] capa -->
            <div id="capa">
                <div class="titulo"><img src="img/backgrounds/titulo.png" /></div>
                <form name="formIniciar" id="formIniciar" action="" method="post" enctype="multipart/form-data">
                <table class="home" cellpadding="0" cellspacing="0" border="0" width="auto">
                	<tr>
                    	<td class="first">nome</td>
                        <td><div class="input"><input name="nomeUsuario" id="nomeUsuario" type="text" size="31" value="<?php echo $nomeUsuario;?>" /></div></td>
                    </tr>
                    <tr>
                    	<td class="first">data do<br />casamento</td>
                        <td><div class="input"><input name="dataCasamento" id="dataCasamento" type="text" size="31" onkeyup="Formatadata(this,event)" /></div></td>
                    </tr>
                    <tr>
                    	<td class="first">orçamento</td>
                        <td><div class="input">R$&nbsp;<input name="orcamentoCasamento" id="orcamentoCasamento" type="text" value="" size="25" class="money" /></div></td>
                    </tr>
                </table>
                <div class="subtitulo2"></div>
                
                <input type="submit" class="btn-iniciar" name="iniciar" value=""/>
                </form>
                <div class="editoria"><a href="http://gnt.globo.com/noivas/" target="_blank" title="Clique e veja a editoria de noivas">Clique</a> e veja a editoria de noivas</div>
            </div>
            <!-- [final] capa --> 
        </div>
	</div>
	<!-- [final] content --> 
	
	<!-- [início] footer -->
	<div id="footer">
		<div class="wrap">
	        <div class="assista">
				<table>
					<tr>
						<td><p>Assista ao programa no GNT</p></td>
						<td>
							veja os horários:<br />
							<a href="http://www.gnt.com.br/chuvadearroz" target="_blank" title="veja os horários" rel="link">www.gnt.com.br/chuvadearroz</a>
						</td>
					</tr>
				</table>
			</div>
			<div class="adicione"></div>
        </div>
	</div>
	<!-- [final] footer --> 

</div><!--tudo-->
	
</body>
</html>