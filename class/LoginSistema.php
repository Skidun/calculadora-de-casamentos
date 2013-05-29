<?php 
	include_once("mySqlConn.php");
	
	class LoginSistema extends MySqlConn{
		
		private $usuario, $senha;
		
		public function setUsuario($usr){
			$this->usuario = $usr;
		}
		
		public function setSenha($snh){
			$this->senha = $snh;
		}		
	
		public function executeLogin(){
			$sql = "SELECT * FROM users WHERE email = '$this->usuario'";
			$qr = self::execSql($sql);
			$total = self::countData($qr);  // resgatar quantos dados foram encontrados
			
			if($total > 1){
				$erro = base64_encode("Dados Duplicados, login n&atilde;o efetuado, entre em contato com o Administrador");
				@header("Location: ../login.php");
			}else if($total <= 0){
				$erro = base64_encode("Login ou Senha Inv&aacute;lidos ");
				
				//echo base64_decode($erro);
				
				@header("Location: ../login.php");
			}else if($total == "1"){
				session_start();						//abre a sessao
				$dados = self::listQr($qr);				// resgato os dados
				$_SESSION["LOGADO"] = "TRUE";			// carregar a sessão logado
				$_SESSION["NOME"] = $dados["username"];	// carregar a sessão nome
				$_SESSION["ID"]	=	$dados["oauth_uid"];
				$_SESSION["EMAIL"]	=	$dados["email"];
				//$uid			=	$dados["oauth_uid"];
				@header("Location: ../index.php");		// faço o redirect	
			}
		}
	}
/****************************************
**	executando o login
*****************************************/
	if(isset($_GET['user'])){
		$login = new LoginSistema();
		$login->setUsuario($_GET["user"]);
		//$login->setSenha($_GET["id"]);
		$login->executeLogin();
	}else if($_GET["txtLocal"] == "logOff"){
		require"app.facebook2.php";
		$logout = $facebook->getLogoutUrl();
		session_start();
		session_destroy();
		session_unset();
		$erro = base64_encode("Muito Obrigado por utilizar nosso sistema!!!");
		@header("Location: ../index.php");
	}else{
		$erro = base64_encode("Acesso de forma inadequada, entre em contato com o Administrador");
		@header("Location: ../login.php");
	}
?>