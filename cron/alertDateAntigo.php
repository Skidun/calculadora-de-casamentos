<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */

include_once("../class/MysqlConnPDO.php");
include_once("../class/class.calcData.php");
include_once("../class/app.facebook2.php");

//Pego os dados do usuário no casamento.
$sqlUser    =   "SELECT oauth_uid, username, email, dataCasamento, userperfil FROM users ORDER BY dataCasamento DESC";
try{
    $queryUser = $conecta->prepare($sqlUser);
    $queryUser->execute();
    
    $resultUser = $queryUser->fetchAll(PDO::FETCH_ASSOC);
    
}catch(PDOexception $errorUser){echo "Não foi possível selecionar os usuários do sistema ".$errorUser->getMessage();}

//Calculo do intervalo entre a data e atual e o casamento
$dataAtual      = date('Y-m-d');
$intervaloCasamento = new calcData();

foreach($resultUser as $user){
    $uidUser    = $user["oauth_uid"];
    $nameUser   = $user["username"];
    $emailUser  = $user["email"];
    $dataCasamento= $user["dataCasamento"];
    $userperfil = $user["userperfil"];
    
    $tempoCasamento     = $intervaloCasamento->dataDif($dataAtual, $dataCasamento, 'm');
    $tempoCasamentoDias = $intervaloCasamento->dataDif($dataAtual, $dataCasamento, 'd');
    
    

   switch($tempoCasamento){
        case(12):
            //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Falta um ano para o seu casamento. Está na hora de começar a resolver alguns itens importantes. Confira o que é aconselhável fazer agora:',
        					'message'=>
                            '
                            Falta um ano para o seu casamento. Está na hora de começar a resolver alguns itens importantes. Confira o que é aconselhável fazer agora:
                                - Feche a data do casamento
                                - Feche o aluguel do local onde o casamento será realizado
                                - Contrate cerimonial e decoração
                                - Defina o orçamento
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
        break;
        
        //Faltando 8 meses    
        case(8):
            //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Faltam oito meses para o seu casamento. Já escolheu seu vestido e contratou o bufê? Veja o que é importante fazer agora:',
        					'message'=>
                            '
                            Faltam oito meses para o seu casamento. Já escolheu seu vestido e contratou o bufê? Veja o que é importante fazer agora:
                                - Contrate o bufê 
                                - Contrate bolo, doces e bem-casados
                                - Feche o look da noiva (vestido e acessórios)
                                - Contrate som e iluminação
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
        break;
        //Faltando 6 meses
        case(6):
            //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Faltam seis meses para o seu casamento. Está na hora de mandar fazer os convites e definir o roteiro da lua de mel. Confira o que é aconselhável fazer agora:',
        					'message'=>
                            '
                            Faltam seis meses para o seu casamento. Está na hora de mandar fazer os convites e definir o roteiro da lua de mel. Confira o que é aconselhável fazer agora:
                                - Feche o traje do noivo
                                - Feche convites, lembrancinhas e papelaria personalizada
                                - Defina local e papelada para a cerimônia (religiosa e/ou civil)
                                - Alugue o carro que levará a noiva 
                                - Defina roteiro da lua de mel
                                - Feche cabelo e maquiagem
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
        break;
        //Faltando 3 meses
        case(3):
            //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Faltam só três meses para o seu casamento! Não deixe nada para a última hora. Saiba o que é importante você fazer agora:',
        					'message'=>
                            '
                            Faltam só três meses para o seu casamento! Não deixe nada para a última hora. Saiba o que é importante você fazer agora:
                                - Faça a lista de presentes nas lojas de sua preferência
                                - Convide madrinhas, padrinhos e daminhas 
                                - Contrate as bebidas
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
        break;
        //Faltando 2 meses
        case(2):
            //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Faltam dois meses para o seu casamento! Bateu o friozinho na barriga? Calma! Você já resolveu as coisas mais importantes. Agora é hora de:',
        					'message'=>
                            '
                             Faltam dois meses para o seu casamento! Bateu o friozinho na barriga? Calma! Você já resolveu as coisas mais importantes. Agora é hora de:   
                                - Enviar os convites para convidados de outras cidades 
                                - Definir roupas dos padrinhos, madrinhas e daminhas
                                - Combinar detalhes do chá de panela e chá bar com madrinhas e amigas próximas
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
        break;
        //Faltando 3 meses
        case(1):
            //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Falta só um mês para o seu casamento! Vai dar tudo certo! Agora você só precisa: ',
        					'message'=>
                            '
                            Falta só um mês para o seu casamento! Vai dar tudo certo! Agora você só precisa: 
                                - Confirmar os horários na igreja e no cabeleireiro
                                - Fazer o teste de cabelo e maquiagem, de preferência, junto com o vestido e acessórios usados no dia do casamento
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
        break;
  }
  //Rotina de quando a data for em dias
  switch($tempoCasamentoDias){
    //Faltando 15 dias
    case(15):
    //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Faltam só 15 dias para o seu casamento. Tá chegando a hora! Relaxa. Agora só falta:',
        					'message'=>
                            '
                            Faltam só 15 dias para o seu casamento. Tá chegando a hora! Relaxa. Agora só falta:
                                - Fazer a última prova do vestido
                                - Curtir o seu chá de panela!
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
    break;
    //Faltando 7 dias
    case(7):
    //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Falta uma semana para o seu casamento! É tempo de cuidar da sua beleza e correr para os braços do cônjuge.',
        					'message'=>
                            '
                            Falta uma semana para o seu casamento! É tempo de cuidar da sua beleza e correr para os braços do cônjuge.
                                - Faça depilação três dias antes da data
                                - Faça as unhas dois dias antes do casamento
                                - Confirme os serviços e profissionais contratados com a cerimonialista
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
    break;
  }
    if($tempoCasamentoDias <= 1){
    //Postando no Mural do usuário
        	try{
        			$post = $facebook->api("/$userperfil/feed", 'POST', 
        				array(
        					'name' => 'GNT - Calculadora de Casamentos',
                            'description' => 'Chegou seu grande dia! Nós desejamos a vocês muitas felicidades e estamos muito contentes de ter ajudado neste momento tão importante! Conte sempre com a gente! Abraços, equipe GNT.',
        					'message'=>
                            '
                            Chegou seu grande dia! Nós desejamos a vocês muitas felicidades e estamos muito contentes de ter ajudado neste momento tão importante! Conte sempre com a gente! Abraços, equipe GNT.
                            ',
        					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
        				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
}
}

?>