<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */
//Arquivo que inicia a sessão de login nas páginas
session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}

?>