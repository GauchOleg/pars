<?php

	include_once 'curl.php';
	
	$headers = array(
		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Accept-Encoding: gzip, deflate',
		'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
		'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0'	
	);
	
	
	$c = curl::app('http://ntschool.ru')
					->set(CURLOPT_HEADER, 1)
					->set(CURLOPT_HTTPHEADER, $headers)
					;
					

	$html = $c->request('courses');
	var_dump($html);