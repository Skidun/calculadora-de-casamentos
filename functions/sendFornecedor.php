<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	$nome	=	$_SESSION["NOME"];
	$email	=	$_SESSION["EMAIL"];
	// Dados do Amigo
	$nomeAmigo	= strip_tags(trim($_GET['nomeAmigo']));
	$emailAmigo = strip_tags(trim($_GET['emailAmigo']));
	$obsAmigo 	= strip_tags(trim($_GET['obsAmigo']));
	// Dados do Fornecedor
	$nomeF		= $_GET["nomeF"];
	$contatoF	= $_GET["contatoF"];
	$emailF		= $_GET["emailF"];
	$valorF		= $_GET["valorF"];
	$obsF		= $_GET["obsF"];
	
	$header  = "From: ".$nome." <".$email.">\r\n";
	$header .= "Reply-To: ".$nome." <".$email.">\r\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html; charset=utf-8\r\n";
	$header .= "X-Mailer: PHP/" . phpversion() . "\r\n";
	$header .= "X-Priority: 1";

	$subject = 'O seu amigo '.$nome.' lhe indicou um fornecedor';
    $html = 
    	'
    		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body style="margin:0; padding:0; color: #FBF5ED;">
<table bgcolor="#FBF5ED"  align="center" width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" width="232"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#fff8ed" width="232"><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/img1.jpg" width="232" height="110" style="display:block; border:0;" alt="GNT Calculadora de Casamentos" /></td>
					<td bgcolor="#fff8ed" width="30">&nbsp;</td>
					<td bgcolor="#fff8ed"><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:14px; text-align:left; color:#9c7a4d;" >Aqui você cadastra seus fornecedores e controla quanto está gastando nos preparativos para o seu casamento.</td>
							</tr>
						</table></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td align="center"><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/img2.jpg" width="600" height="17" style="display:block; border:0;" /></td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:17px; text-align:center; color:#9c7a4d; line-height:22px;">'.$nome.' gostou deste fornecedor e acha que pode ser do seu interesse.</td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:17px; text-align:left; color:#9c7a4d; line-height:22px; padding-left:36px;">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:17px; text-align:left; color:#9c7a4d; line-height:22px; padding-left:36px;">'.$obsAmigo.'</td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4" align="center" ><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/indic-forn.jpg" width="543" height="59" style="display:block; border:0;" alt="Indicação de fornecedor" /></td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:11px; text-align:left; color:#9c7a4d;">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#FBF5ED"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#9c7a4d; font-weight:bold; text-transform:uppercase;">Nome:&nbsp;</td>
					<td bgcolor="#FCF9F4"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#9c7a4d; padding-left:12px;">'.$nomeF.'</td>
				</tr>
				<tr>
					<td height="8" colspan="2" bgcolor="#FCF9F4"></td>
				</tr>
				<tr>
					<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#9c7a4d; font-weight:bold; text-transform:uppercase;">contato:&nbsp;</td>
					<td bgcolor="#FCF9F4"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#9c7a4d; padding-left:12px;">'.$contatoF.'</td>
				</tr>
				<tr>
					<td height="8" colspan="2" bgcolor="#FCF9F4"></td>
				</tr>
				<tr>
					<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#9c7a4d; font-weight:bold; text-transform:uppercase;">e-mail:&nbsp;</td>
					<td bgcolor="#FCF9F4"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#9c7a4d; padding-left:12px;">'.$emailF.'</td>
				</tr>
				<tr>
					<td height="8" colspan="2" bgcolor="#FCF9F4"></td>
				</tr>
				<tr>
					<td bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#9c7a4d; font-weight:bold; text-transform:uppercase;">valor:&nbsp;</td>
					<td bgcolor="#FCF9F4"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#9c7a4d; padding-left:12px;">R$ '.$valorF.'</td>
				</tr>
				<tr>
					<td height="8" colspan="2" bgcolor="#FCF9F4"></td>
				</tr>
				<tr>
					<td width="122" valign="top" bgcolor="#FCF9F4" style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:right; color:#9c7a4d; font-weight:bold; text-transform:uppercase;">observação:&nbsp;</td>
					<td bgcolor="#FCF9F4"  style="font-family:\'Trebuchet MS\', Arial, Helvetica, sans-serif; font-size:13px; text-align:left; color:#9c7a4d; padding-left:12px;">'.$obsF.'</td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td bgcolor="#FCF9F4">&nbsp;</td>
	</tr>
	
	<!--<tr>
								<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td width="240"><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/calc.png" width="250" height="34" style="display:block; border:0;" alt="Você ainda não conhece o calculadora de casamentos" /></td>
										<td align="left"><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/img5.png" width="320" height="65" style="display:block; border:0;" alt="Faça o login no facebook" /></td>
									</tr>
								</table></td>
	</tr>-->
	<tr>
		<td><a href="http://gntapps.com.br/calculadora-de-casamentos/login.php" target="_blank"> <img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/confira.jpg" width="600" height="176" style="display:block; border:0;" alt="Se você ainda não conhece Calculadora de Casamentos clique e confira." /> </a></td>
	</tr>
	<tr>
		<td height="80"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td  colspan="3"><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/bg-footer.jpg" width="600" height="7" style="display:block; border:0;" /></td>
				</tr>
				<tr>
					<td bgcolor="#9C7A4D" width="72">&nbsp;</td>
					<td bgcolor="#9C7A4D" height="80" width="355"><img src="http://gntapps.com.br/calculadora-de-casamentos/email-fornecedor/img6.jpg" width="204" height="53" style="display:block; border:0;" /></td>
					<td width="173" bgcolor="#9C7A4D" align="center"><a class="visite" href="http://gnt.globo.com/noivas/" target="_blank" style="font-family: \'Trebuchet MS\', Arial, Helvetica, sans-serif; color: #FBF5ED; text-align:center;">Noivas GNT</a></td>
				</tr>
			</table></td>
	</tr>
</table>
</body>
</html>
    	';
	$to = $emailAmigo;
	if(mail($to,$subject,$html,$header)) {
		$result = array(
			'sucesso' => "Fornecedor indicado com sucesso para o amigo $nomeAmigo"
		);
		echo json_encode($result);
	}

?>