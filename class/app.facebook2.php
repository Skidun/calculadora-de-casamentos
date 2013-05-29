<?php
require "../src/facebook.php";

$facebook = new Facebook(array(
  'appId'  => '376023352450938',
  'secret' => '86198c292a2bd9268d6e57d84f2e70c7',
));

$user = $facebook->getUser();

?>