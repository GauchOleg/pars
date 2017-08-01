<?php
	include_once 'curl.php';
	
	$c = curl::app('http://yknow.ru')
					->set(CURLOPT_HEADER, 1)
					->set(CURLOPT_COOKIEJAR,  $_SERVER['DOCUMENT_ROOT'] . '/1.txt')
					->set(CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'] . '/1.txt');

	$data = $c->request('clients/office');
	var_dump($data);