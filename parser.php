<?php
$request_url = "https://www.myrtlebeach.com/sitemap_index.xml";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $request_url);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl, CURLOPT_TIMEOUT, 3);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($response);
$json = json_encode($xml);
$arr = json_decode($json,true);

$top_lvl = array();

foreach($arr as $key=>$value) {
    foreach($value as $key1=>$value1) {
        $top_lvl[$key][$key1] = $value1;
        $urls = $value1;
    }
}

$toplvl_arr = print_r($top_lvl);

echo "<pre>";$toplvl_arr;echo "</pre>";


$lookfor='/wpl-';

foreach ($urls as $url){
    if(substr($url->getAttribute('loc'), 0, strlen($lookfor)) == $lookfor) {
        echo "<br> $url";
        echo "<hr><br>";
    }
}

//second version - meh
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, 'https://www.myrtlebeach.com/sitemap_index.xml');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$xml = curl_exec ($ch);
//curl_close ($ch);

//if (@simplexml_load_string($xml)) {
//$fp = fopen('feed.xml', 'w');
//fwrite($fp, $xml);
//echo $xml;
//fclose($fp);
//}

//$xml = new SimpleXMLElement($data);
//foreach ($xml->url as $url_list) {
//$url = $url_list->loc;
//echo $url;
//}
