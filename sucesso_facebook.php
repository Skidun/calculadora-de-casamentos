<?php
require 'class/app.facebook.php';
require 'class/MysqlConnPDO.php';
if($user){
	try{
		$user_profile	=	$facebook->api('/me');
		
		$prov		=	'facebook';
		$uid		= 	$user_profile['id'];
		$username	=	$user_profile['name'];
        $userperfil =   $user_profile['username'];
		$email		=	$user_profile['email'];
		
		//Conecta no Banco de dados e verifica se o usuário está cadastro ou não
		$sql 		= 	"SELECT * FROM users WHERE email = :email";
		try{
		$query		= 	$conecta->prepare($sql);
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();
		
		$result 	= $query->fetchAll(PDO::FETCH_ASSOC);
		$countRow	= $query->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $error_query){echo "Erro com o Banco de dados".$error_query->getMessage();}
		if($countRow <= 0){
			$sqlCad		= "INSERT INTO users (oauth_provider, oauth_uid, username, email, userperfil) VALUES (:facebook, :uid, :username, :email, :userperfil)";
			try{
			$queryCad	= $conecta->prepare($sqlCad);
			$queryCad->bindValue(':facebook', $prov, PDO::PARAM_STR);
			$queryCad->bindValue(':uid', $uid, PDO::PARAM_STR);
			$queryCad->bindValue(':username', $username, PDO::PARAM_STR);
			$queryCad->bindValue(':email', $email, PDO::PARAM_STR);
            $queryCad->bindValue(':userperfil', $userperfil, PDO::PARAM_STR);
			$queryCad->execute();
/*			
		//Adiciona Itens Default no Id do Usuário
			//Itens Default
			$item1	=	"Cerimônia";
			$item2	=	"Decoração";
			$item3	=	"Festa";
			$item4	=	"Foto e Vídeo";
			$item5	=	"Som e Luz";
			$item6	=	"Convidados";
			$item7	=	"Lembranças";
			$item8	=	"Noiva";
			$item9	=	"Noivo";
			$item10	=	"Núpcias";
            //Ordem dos itens			
			//Item 1
			$sqlCadItem1 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item1, :uid)";
			try{
				$queryCadItem1 = $conecta->prepare($sqlCadItem1);
				$queryCadItem1->bindValue(':item1', $item1, PDO::PARAM_STR);
				$queryCadItem1->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem1->execute();
				}catch(PDOexception $error_QueryCadItem1){ echo $error_QueryCadItem1->getMessage();}
			//Item 2	
			$sqlCadItem2 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item2, :uid)";
			try{
				$queryCadItem2 = $conecta->prepare($sqlCadItem2);
				$queryCadItem2->bindValue(':item2', $item2, PDO::PARAM_STR);
				$queryCadItem2->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem2->execute();
				}catch(PDOexception $error_QueryCadItem2){ echo $error_QueryCadItem2->getMessage();}			
			//Item 3
			$sqlCadItem3 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item3, :uid)";
			try{
				$queryCadItem3 = $conecta->prepare($sqlCadItem3);
				$queryCadItem3->bindValue(':item3', $item3, PDO::PARAM_STR);
				$queryCadItem3->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem3->execute();
				}catch(PDOexception $error_QueryCadItem3){ echo $error_QueryCadItem3->getMessage();}
			//Item 4
			$sqlCadItem4 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item4, :uid)";
			try{
				$queryCadItem4 = $conecta->prepare($sqlCadItem4);
				$queryCadItem4->bindValue(':item4', $item4, PDO::PARAM_STR);
				$queryCadItem4->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem4->execute();
				}catch(PDOexception $error_QueryCadItem4){ echo $error_QueryCadItem4->getMessage();}
			//Item 5
			$sqlCadItem5 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item5, :uid)";
			try{
				$queryCadItem5 = $conecta->prepare($sqlCadItem5);
				$queryCadItem5->bindValue(':item5', $item5, PDO::PARAM_STR);
				$queryCadItem5->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem5->execute();
				}catch(PDOexception $error_QueryCadItem5){ echo $error_QueryCadItem5->getMessage();}			
			//Item 6
			$sqlCadItem6 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item6, :uid)";
			try{
				$queryCadItem6 = $conecta->prepare($sqlCadItem6);
				$queryCadItem6->bindValue(':item6', $item6, PDO::PARAM_STR);
				$queryCadItem6->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem6->execute();
				}catch(PDOexception $error_QueryCadItem6){ echo $error_QueryCadItem6->getMessage();}
			//Item 7
			$sqlCadItem7 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item7, :uid)";
			try{
				$queryCadItem7 = $conecta->prepare($sqlCadItem7);
				$queryCadItem7->bindValue(':item7', $item7, PDO::PARAM_STR);
				$queryCadItem7->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem7->execute();
				}catch(PDOexception $error_QueryCadItem7){ echo $error_QueryCadItem7->getMessage();}
			//Item 8
			$sqlCadItem8 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item8, :uid)";
			try{
				$queryCadItem8 = $conecta->prepare($sqlCadItem8);
				$queryCadItem8->bindValue(':item8', $item8, PDO::PARAM_STR);
				$queryCadItem8->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem8->execute();
				}catch(PDOexception $error_QueryCadItem8){ echo $error_QueryCadItem8->getMessage();}
			//Item 9
			$sqlCadItem9 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item9, :uid)";
			try{
				$queryCadItem9 = $conecta->prepare($sqlCadItem9);
				$queryCadItem9->bindValue(':item9', $item9, PDO::PARAM_STR);
				$queryCadItem9->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem9->execute();
				}catch(PDOexception $error_QueryCadItem9){ echo $error_QueryCadItem9->getMessage();}
			//Item 10
			$sqlCadItem10 = "INSERT INTO cn_itens(nomeItem, idNoiva) VALUES (:item10, :uid)";
			try{
				$queryCadItem10 = $conecta->prepare($sqlCadItem10);
				$queryCadItem10->bindValue(':item10', $item10, PDO::PARAM_STR);
				$queryCadItem10->bindValue(':uid', $email, PDO::PARAM_STR);
				$queryCadItem10->execute();
				}catch(PDOexception $error_QueryCadItem10){ echo $error_QueryCadItem10->getMessage();}
			//Se tudo correr bem ele redireciona para a o login								
		# let's check if the user has granted access to posting in the wall
		*/
		//Postando no Mural do usuário
		try{
			$post = $facebook->api('/me/feed', 'POST', 
				array(
					'name' => 'GNT - Calculadora de Casamentos',
					'message'=>'Estou usando a Calculadora de Casamentos do GNT para gerenciar os gastos e fornecedores do meu casamento.',
                    'link' => 'https://apps.facebook.com/calculadoracasamento/',
					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
		$urlUser = base64_encode($email);
		@header("Location: login2.php?user=$urlUser");
		}catch(PDOexception $error_QueryCad){echo "Erro no cadastro".$error_QueryCad->getMessage();}
		}else{
			
			@header("Location: class/LoginSistema.php?user=$email");
				}
		}catch(FacebookApiException $e){}
	}else{
		echo "Usuário não encontrado";		
		}
?>