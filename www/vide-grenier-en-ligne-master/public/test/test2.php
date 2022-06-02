<?php

include('test.php');

$s = "Connection";
$m = "Votre connection sur notre site s'est faite avec succes !";
$em = "bot.cesi@gmail.com";
sendmail($s, $m, $em);