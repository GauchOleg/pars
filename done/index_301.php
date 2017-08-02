<?php

	include_once 'curl.php';
	
	$c = curl::app('http://ntschool.ru')
					->set(CURLOPT_HEADER, 1)
					->set(CURLOPT_FOLLOWLOCATION, true);
					
	$html = $c->request('home');
	echo $html;