<?php
if (isset($_POST['search'])) {
$name = $_POST['search'];

$url = 'https://domain:port/system/login';
$headers = ['Content-Type: text/plain']; 
$post_data = '<in><login user = "********" password="********" /></in>';
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HEADER, true);
$result = curl_exec($curl); 
preg_match('/token=.*;/', $result, $cook);

$url = 'https://domain:port/commands/list_of_domains';
$headers = ['Content-Type: text/plain' , "Cookie:$cook[0]"]; 
$post_data = '<?xml version="1.0" ?><in xmlns:xs="http://www.w3.org/2001/XMLSchema-instance" xs:noNamespaceSchemaLocation="domains.xsd" ><request storage="ds1"/></in>';
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl); 

preg_match_all('/name="\S*"/', $result, $matches);

for ($i = 0; $i < count($matches[0]); $i++) {
    $domains[$i] = $matches[0][$i] ;
}

for ($k = 0; $k < count($domains); $k++) {
    $domains[$k] = substr($domains[$k], 6);
    $domains[$k] = substr($domains[$k], 0, -1);
}
 
for ($s = 0; $s < count($domains); $s++) {
    if (strpos($domains[$s], $name) !== false) {
        echo "<p><a href='https://domain/global_domain/index/" . $domains[$s] . "' target='_blank'>" . $domains[$s] . "</a></p>";
    }
}
}
