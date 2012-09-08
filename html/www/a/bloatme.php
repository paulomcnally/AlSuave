<?php
$c = curl_init('http://bloat.me/remote?website_url=http://rubular.com/regexes/11850');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($c);
curl_close($c);

echo substr($page,1125,20);
?>