<?php
require 'class/app.facebook.php';
if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
	$logout		  = $facebook->getLogoutUrl();
	$email = $user_profile['email'];
	$id		 = $user_profile['id'];
	header("Location: class/LoginSistema.php?user=$email");
	//$query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'facebook' AND oauth_uid = ". $user_profile['id']);
	//$result = mysql_fetch_array($query);
	//$usuario = $user_profile['email'];
	//$id		 = $user_profile['id'];
	//header("Location: class/LoginSistema.php?user=$usuario&id=$id");
	//if(empty($result)){	
	//	$query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username, email) VALUES ('facebook', {$user_profile['id']}, '{$user_profile['name']}', {$user_profile['email']})");
	//	$query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());
	//	$result = mysql_fetch_array($query);
	//	$usuario = $user_profile['email'];
	//	$id		 = $user_profile['id'];
	//	header("Location: class/LoginSistema.php?user=$usuario&id=$id");
	//		}
  } catch (FacebookApiException $e) {
	  	  
	  }
}else{
	$params= array(scope => 'publish_stream, email', redirect_uri => 'http://gntapps.com.br/calculadora-de-casamentos/sucesso_facebook.php');
	$login = $facebook->getLoginUrl($params);
	header("Location: $login");
	}

?>