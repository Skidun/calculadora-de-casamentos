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
<link rel="shortcut icon" href="img/favicon.ico" ty
pe="image/x-icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
<link href="img/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
<link href="img/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">


<script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="scripts/geral.js"></script>
<script type="text/javascript" src="scripts/facebox.js"></script> 

</head>

<body class="bg-capa">
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '321308224647667',                        // App ID from the app dashboard
      channelUrl : '//gntapps.com.br/', // Channel file for x-domain comms
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here
  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<div id="tudo">

	<!-- [início] header -->
	<div id="header">
		<div class="wrap"></div>
	</div>
	<!-- [final] header --> 
	
	<!-- [início] content -->
	<div id="content">
		<div class="wrap">
            <!-- [início] capa -->
            <div id="capa">
                <div class="titulo"><img src="img/backgrounds/titulo.png" /></div>
                <form action="login_facebook.php" method="post" target="_self">
                <input type="submit" rel="facebox" name="login-fb" id="login-fb" class="fb-login" value="" onclick="return false;" />
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