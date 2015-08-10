<?php
/**
 * Created by PhpStorm.
 * User: JFog
 * Date: 6/28/15
 * Time: 5:13 PM
 */

$url = 'http://ecasmart.homelinux.com:8888/videostream.cgi?rate=0&user=ecaprovn&pwd=1q2w3e4r';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
$picture = curl_exec($ch);
curl_close($ch);

//Display the image in the browser
header('Content-type: image/jpeg');
echo $picture;