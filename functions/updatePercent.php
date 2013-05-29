<?php 
	require '../class/MysqlConnPDO.php';
	require '../logado.php';
    
	//Recupera os dados que o Json passou
	$usuario = $_SESSION['EMAIL'];
    $percent = 'Sim';  
	//Executa a SQL
	
		$sqlUpdate	=	"UPDATE users SET percentualView = :percent WHERE email = :email";
	try{
		$queryUpdate = $conecta->prepare($sqlUpdate);
		$queryUpdate->bindValue(':percent',$percent, PDO::PARAM_STR);
		$queryUpdate->bindValue(':email', $usuario, PDO::PARAM_STR);
		$queryUpdate->execute();
		}catch(PDOexception $error_Update){ $error = array('Sucesso'=>'Erro ao atualizar os dados de usuário'); echo json_encode($error);}
		
	$result = array('Sucesso'=>'Parabéns seu perfil foi atualizado com sucesso!');	
	echo json_encode($result);
	
?>