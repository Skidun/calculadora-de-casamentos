<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */

include_once("/home/calcnoiva/public_html/class/MysqlConnPDO.php");
include_once("/home/calcnoiva/public_html/class/class.calcData.php");
set_time_limit(0);
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
//Dados para envio da notificação para o facebook
$app_id = '321308224647667';
$app_secret = 'ba51db94a6c03ed6fbdc8881823ae949';
$fb_sdk_location = '/home/calcnoiva/public_html/src/facebook.php';
//Notificações
$text12 = "Falta 1 ano! Comece os preparativos pela data do casamento e pela lista de convidados. Depois defina o orçamento, alugue o local da festa, contrate o cerimonial e a decoração.";
$text8  = "Faltam 8 meses para o seu casamento. Agora é importante contratar o bufê, bolo, doces e bem-casados, fechar o vestido e os acessórios da noiva e contratar o som e a iluminação.";
$text6  = "Faltam 6 meses! Veja o que fazer agora: encomende os convites e lembrancinhas, resolva o local e a papelada da cerimônia, alugue o carro da noiva e escolha seu cabelo e maquiagem.";
$text3  = "Faltam 3 meses! Não deixe nada para a última hora. Faça a lista de presentes nas lojas de sua preferência, convide madrinhas, padrinhos e daminhas e contrate as bebidas.";
$text2  = "Só faltam 2 meses! É a hora de enviar convites de quem mora fora da cidade, combinar roupas de padrinhos e daminhas e organizar o chá de panela com madrinhas e amigas próximas.";
$text1  = "Falta só 1 mês! Vai dar tudo certo! Agora você precisa: confirmar os horários na igreja e no cabeleireiro e fazer o teste de cabelo e maquiagem, junto com o vestido e acessórios.";   
$text15 = "Faltam só 15 dias para o seu casamento. Tá chegando a hora! Relaxa. Agora só falta fazer a última prova do vestido e curtir o seu chá de panela!
";
$text7  = "Falta 1 semana! É tempo de cuidar da sua beleza! Faça depilação 3 dias antes da data e as unhas 2 dias antes. Confirme os serviços e profissionais contratados com a cerimonialista.";   
$text24 = "Chegou seu grande dia! Nós desejamos a vocês muitas felicidades e estamos muito contentes de ter ajudado neste momento importante. Conte sempre com a gente! Beijos do Canal GNT.";   

require($fb_sdk_location); // Bring through the Facebook PHP SDK
$fb = new Facebook(array('appId' => $app_id, 'secret' => $app_secret));
// See if there is a user from a cookie

//$notification_app_link = '?fb_source=notification&notif_t=app_notification';
$notification_app_link = '?notification=app_notification';

foreach($resultUser as $user){
    $uidUser    = $user["oauth_uid"];
    $nameUser   = $user["username"];
    $emailUser  = $user["email"];
    $dataCasamento= $user["dataCasamento"];
    $userperfil = $user["userperfil"];
    
    $tempoCasamento     = $intervaloCasamento->dataDif($dataAtual, $dataCasamento, 'd');
    $tempoCasamentoDias = $intervaloCasamento->dataDif($dataAtual, $dataCasamento, 'd');

    $user = $uidUser;     
//Configurações do Facebook
    if($user){
       switch($tempoCasamento){
        case(365):
            //Postando no Mural do usuário
        try {
                 // Try send this user a notification
         $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
             array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text12, // Message to be displayed within the notification
                 )
             );
         if (!$fb_response['success']) {
                 // Notification failed to send
             echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
             echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
         } else {
                 // Success!
             echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
         }
         
     }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
         $user = NULL;
     }
     
     break;
     
        //Faltando 8 meses    
     case(244):
            //Postando no Mural do usuário
     try {
                 // Try send this user a notification
         $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
             array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text8, // Message to be displayed within the notification
                 )
             );
         if (!$fb_response['success']) {
                 // Notification failed to send
             echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
             echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
         } else {
                 // Success!
             echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
         }
         
     }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
         $user = NULL;
     }
     break;
        //Faltando 6 meses
     case(183):
            //Postando no Mural do usuário
     try {
                 // Try send this user a notification
         $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
             array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text6, // Message to be displayed within the notification
                 )
             );
         if (!$fb_response['success']) {
                 // Notification failed to send
             echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
             echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
         } else {
                 // Success!
             echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
         }
         
     }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
         $user = NULL;
     }
     break;
        //Faltando 3 meses
     case(90):
            //Postando no Mural do usuário
     try {
                 // Try send this user a notification
         $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
             array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text3, // Message to be displayed within the notification
                 )
             );
         if (!$fb_response['success']) {
                 // Notification failed to send
             echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
             echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
         } else {
                 // Success!
             echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
         }
         
     }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
         $user = NULL;
     }
     break;
        //Faltando 2 meses
     case(60):
            //Postando no Mural do usuário
     try {
                 // Try send this user a notification
         $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
             array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text2, // Message to be displayed within the notification
                 )
             );
         if (!$fb_response['success']) {
                 // Notification failed to send
             echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
             echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
         } else {
                 // Success!
             echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
         }
         
     }catch(FacebookApiException $e) {
             // Notification failed to send
           // echo '<p><pre>' . print_r($e, true) . '</pre></p>';
         $user = NULL;
     }
     break;
        //Faltando 3 meses
     case(30):
            //Postando no Mural do usuário
     try {
                 // Try send this user a notification
         $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
             array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text1, // Message to be displayed within the notification
                 )
             );
         if (!$fb_response['success']) {
                 // Notification failed to send
           echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
           echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
       } else {
                 // Success!
           echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
       }
       
   }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
       $user = NULL;
   }
   break;
}
  //Rotina de quando a data for em dias
switch($tempoCasamentoDias){
    //Faltando 15 dias
    case(15):
    //Postando no Mural do usuário
    try {
                 // Try send this user a notification
       $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
           array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text15, // Message to be displayed within the notification
                 )
           );
       if (!$fb_response['success']) {
                 // Notification failed to send
           echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
           echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
       } else {
                 // Success!
           echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
       }
       
   }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
       $user = NULL;
   }   
   break;
    //Faltando 7 dias
   case(7):
    //Postando no Mural do usuário
   try {
                 // Try send this user a notification
       $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
           array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text7, // Message to be displayed within the notification
                 )
           );
       if (!$fb_response['success']) {
                 // Notification failed to send
           echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
           echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
       } else {
                 // Success!
           echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
       }
       
   }catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
       $user = NULL;
   }    
   break;
}
if($tempoCasamentoDias <= 1){
    //Postando no Mural do usuário
 try {
                 // Try send this user a notification
   $fb_response = $fb->api('/' . $user . '/notifications', 'POST',
       array(
                 'access_token' => $fb->getAppId() . '|' . $fb->getApiSecret(), // access_token is a combination of the AppID & AppSecret combined
                 'href' => $notification_app_link, // Link within your Facebook App to be displayed when a user click on the notification
                 'template' => $text24, // Message to be displayed within the notification
                 )
       );
   if (!$fb_response['success']) {
                 // Notification failed to send
       echo '<p><strong>Falha ao enviar notificação</strong></p>'."\n";
       echo '<p><pre>' . print_r($fb_response, true) . '</pre></p>'."\n";
   } else {
                 // Success!
       echo '<p>Notificação enviada com sucesso para '.$nameUser.'</p>'."\n";
   }
   
}catch(FacebookApiException $e) {
             // Notification failed to send
             //echo '<p><pre>' . print_r($e, true) . '</pre></p>';
   $user = NULL;
}            
}
}
}
exit;

?>