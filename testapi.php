<?php

require 'config.php';
require 'FreemobileNotificationSender.php';

$fms = new FreemobileNotificationSender(USERID,APIKEY);
$fms->sendMessage('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pulvinar metus purus, eu adipiscing tortor condimentum ut. Maecenas eget elementum nisi volutpat');
$fms->sendMessage("First line\nSecond line\nThird line");
?>
