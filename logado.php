<?php

/**
 * @author Wesley S. Ara�jo
 * @copyright 2012
 */
//Arquivo que inicia a sess�o de login nas p�ginas
session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}

?>