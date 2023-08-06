<?php

$sub = $_GET['sub'];
$pix = $_GET['pix'];


// Функция для выполнения запроса с использованием прокси
function executeCurlRequest($targetUrl, $proxyHost, $proxyPort, $proxyUser, $proxyPass) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $targetUrl);
    curl_setopt($ch, CURLOPT_PROXY, $proxyHost);
    curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUser:$proxyPass");
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); // Используем HTTP прокси, для HTTPS можно использовать CURLPROXY_HTTPS

    // Включаем проверку сертификата безопасности
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Ошибка cURL: ' . curl_error($ch);
        $response = false;
    }

    curl_close($ch);
    return $response;
}


// Функция для редиректа на целевой сайт с добавлением параметра "?sub=123"
function redirectToTarget($domain, $sub, $pix) {
    header("Location: https://$domain/?sub=$sub&pix=$pix");
    exit();
}



// Читаем текстовый файл с доменами
$file = "domains.txt";
$domains = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Прокси данные
$proxyHost = '005.connect-uasocks.net';
$proxyPort = 8080;
$proxyUser = 'ualog5.9';
$proxyPass = 'WAK37h1h';



// Перебираем домены
foreach ($domains as $key => $domain) {
    $domain = trim($domain);
    $targetUrl = "https://$domain"; // Используем HTTPS для проверки сертификата.

    // Проверяем запрос к сайту
    $response = executeCurlRequest($targetUrl, $proxyHost, $proxyPort, $proxyUser, $proxyPass);

    if ($response == false) {
		unset($domains[$key]);
		
        // Записываем обновленные домены обратно в текстовый файл
        file_put_contents($file, implode("\n", $domains));
        // Запрос удался, редиректим на сайт с добавлением параметра "?sub=123"
		
		function sendTel2($message1){
		$idd1 = "-1001816913668";
        $tokken1 = "5225285412:AAEyx-bI1b2XfrPdnmqeSk1tXGNmwxWpKsc";
		$filename1 = "https://api.telegram.org/bot".$tokken1."/sendMessage?chat_id=".$idd1."&text=".urlencode($message1)."&parse_mode=html";
		file_get_contents($filename1);
    }
       $message1 = '
❌ Удален домен: '.$domain.' ';
sendTel2($message1);	
	
        
    } else {
		
		function sendTel2($message1){
		$idd1 = "-1001816913668";
        $tokken1 = "5225285412:AAEyx-bI1b2XfrPdnmqeSk1tXGNmwxWpKsc";
		$filename1 = "https://api.telegram.org/bot".$tokken1."/sendMessage?chat_id=".$idd1."&text=".urlencode($message1)."&parse_mode=html";
		file_get_contents($filename1);
    }
       $message1 = '
✅ Берем домен: '.$domain.' ';
//sendTel2($message1);
		
        // Запрос не удался, удаляем домен из списка
        redirectToTarget($domain, $sub, $pix);
    }
}



?>
