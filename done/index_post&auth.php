<?php
	include_once 'curl.php';
	
	$post = array(
		'email' => 'dmitrylavr@gmail.com',
		'password' => 'XkJT8a7',
		'remember' => 'on'
	);
	
	$c = curl::app('http://yknow.ru')
					->set(CURLOPT_HEADER, 1)
					->set(CURLOPT_POST, true)
					->set(CURLOPT_POSTFIELDS, http_build_query($post))
					->set(CURLOPT_COOKIEJAR,  $_SERVER['DOCUMENT_ROOT'] . '/1.txt')
					->set(CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'] . '/1.txt');
					
	$data = $c->request('clients/login');
	$data = $c->request('clients/office');
	
	var_dump($data);