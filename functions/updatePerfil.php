<?php 
	require '../class/MysqlConnPDO.php';
	
	//Recupera os dados que o Json passou
	$email		= $_GET["perfilEmail"];
	$nome 		= $_GET["perfilNome"];
	$formatData	= explode('/', $_GET["perfilData"]);
	$data 		= $formatData[2].'-'.$formatData[1].'-'.$formatData[0];
	$orcamento	= str_replace(',','.',str_replace('.','',$_GET["perfilOrcamento"]));
	//Executa a SQL
	
	if($nome != '' || $data != ''){
		$sqlUpdate	=	"UPDATE users SET username = :nome, dataCasamento = :data WHERE email = :email";
	try{
		$queryUpdate = $conecta->prepare($sqlUpdate);
		$queryUpdate->bindValue(':nome',$nome, PDO::PARAM_STR);
		$queryUpdate->bindValue(':data', $data, PDO::PARAM_STR);
		$queryUpdate->bindValue(':email', $email, PDO::PARAM_STR);
		$queryUpdate->execute();
		}catch(PDOexception $error_Update){ $error = array('Sucesso'=>'Erro ao atualizar os dados de usuário'); echo json_encode($error);}
		
	$result = array('Sucesso'=>'Parabéns seu perfil foi atualizado com sucesso!');	
	echo json_encode($result);
	
		}else{
		$result = array('Sucesso' =>'Oppps, Preencha todos os campos corretamente <br /> Tente novamente <a href="#lightbox12" name="modal">clicando aqui</a>!');	
			}
	
?>