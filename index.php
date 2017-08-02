<?php
/**
 * Created by PhpStorm.
 * User: developer-pc
 * Date: 02.08.2017
 * Time: 15:41
 */
include_once 'curl.php';

//$x = Curl::app('http://yknow.ru');
$c = Curl::app('https://astar.ua')
                ->set(CURLOPT_HEADER,1)
                ->set(CURLOPT_FOLLOWLOCATION, true)
                ->ssl(0)
                ->random_user_agent();
$html = $c->request('autoparts');

echo '<pre>';
print_r($html);
echo '</pre>';
