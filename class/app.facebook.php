<?php
require "src/facebook.php";

$facebook = new Facebook(array(
  'appId'  => '321308224647667',
  'secret' => 'ba51db94a6c03ed6fbdc8881823ae949',
));

$user = $facebook->getUser();

?>