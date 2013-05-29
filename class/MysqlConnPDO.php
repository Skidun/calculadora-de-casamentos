<?php 
define('HOST',  'localhost');
define('DB', 'calcnoiva_db');
define('USER', 'calcnoiva_adm');
define('PASS', 'c8*HlBn6*JF0');
$conexao = 'mysql:host='.HOST.';dbname='.DB;
try{
	$conecta = new PDO($conexao, USER, PASS);
	$conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conecta->query('SET NAMES utf8');
	}catch(PDOexception $error_conecta){
		'Erro ao conectar, favor informe no e-mail contato@virtualimob.com';
		}
?>