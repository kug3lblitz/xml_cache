<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.myrtlebeach.com/sitemap_index.xml');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$xml = curl_exec($ch);
curl_close ($ch);

$xml = simplexml_load_string($xml);
foreach($xml->sitemap as $item){
    if (strpos($item->loc, 'wpl-') !== false) {

        $sub_ch = curl_init();
        curl_setopt($sub_ch, CURLOPT_URL, $item->loc);
        curl_setopt($sub_ch, CURLOPT_RETURNTRANSFER, 1);
        $sub_xml = curl_exec($sub_ch);
        curl_close ($sub_ch);

        $sub_xml = simplexml_load_string($sub_xml);
        foreach($sub_xml as $sub_item){
            echo $sub_item->loc . "<Br />\n";

            $single_ch = curl_init();
            curl_setopt($single_ch, CURLOPT_URL, $sub_item->loc);
            curl_setopt($single_ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($single_ch, CURLOPT_TIMEOUT_MS, 1);
            curl_exec($single_ch);
            curl_close($single_ch);

            break; // REMOVE IN PRODUCTION
        }
    }
}
?>
