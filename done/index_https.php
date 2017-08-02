<?php

	include_once 'curl.php';
	
	$c = curl::app('https://en.wikipedia.org')
					->set(CURLOPT_HEADER, 1)
					->https(0);
					
	$data = $c->request('wiki/S%C3%A3o_Lu%C3%ADs');
	var_dump($data);