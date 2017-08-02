<?php

	include_once 'curl.php';
	
	$c = curl::app('http://ntschool.ru')
					->set(CURLOPT_HEADER, 1);
					
	$html = $c->request('courses');
	echo $html;