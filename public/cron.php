<?php
// Perfex CRM cron işlemleri için
$url = 'http://my.fulexo.com/crm/cron/index';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>
