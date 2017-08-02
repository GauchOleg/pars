<?php
/**
 * Created by PhpStorm.
 * User: developer-pc
 * Date: 02.08.2017
 * Time: 15:33
 */
class Curl{
    private $ch;        // экземпляр курла
    private $host;      // хост, базовая часть URL-а без слеша на конце
    private $config = array();

    // инициализация класса для конкретного домена
    public static function app($host){
        return new self($host);
    }
    private function __construct($host){
        $this->ch = curl_init();
        $this->host = $host;
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }
    public function __destruct(){
        curl_close($this->ch);
    }
    // устанока опций
    public function set($name,$value){
        curl_setopt($this->ch, $name, $value);
        return $this;
    }
    // выполнение запроса
    public function request($url){
        curl_setopt($this->ch, CURLOPT_URL, $this->make_url($url));
        $data = curl_exec($this->ch);
        return $this->process_result($data);
    }
    // создание URL
    private function make_url($url){
        if ($url[0] != '/')
            $url = '/' . $url;
        return $this->host . $url;
    }
    // разбиение заголоки/тело
    private function process_result($data){
        $n = "\n";
        $rn = "\r\n";

        $n_n = strpos($data,$n . $n);
        $r_n = strpos($data,$rn . $rn);
        $start = $n_n;      // int первое вхождение
        $p = $n;            // розделитель
        if ($n_n === false || $r_n < $n_n){
            $start = $r_n;  // int первое вхождение
            $p = $rn;
        }
        $headers_part = substr($data, 0, $start);
        $body_part = substr($data, $start + strlen($p) * 2);

        $lines = explode($p, $headers_part);
        $headers = array();
        $headers['start'] = $lines[0];
        for ($i = 1; $i < count($lines); $i++){
            $del_pos = strpos($lines[$i],':');
            $name = substr($lines[$i], 0, $del_pos);
            $value = substr($lines[$i], $del_pos + 2);
            $headers[$name] = $value;
        }
        return array(
            'headers' => $headers,
            'html' => $body_part
        );
    }
    // для SSL-соединения
    public function ssl($value){
        curl_setopt($this->ch,CURLOPT_SSL_VERIFYPEER, $value);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, $value);
        return $this;
    }
    // для авторизации
    public function post($value=true, $array){
        curl_setopt($this->ch, CURLOPT_POST, $value);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($array));
        return $this;
    }
    //работа с куками
    public function cookie($filename_txt){
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'] . '/' . $filename_txt);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'] . '/' . $filename_txt);
    }
    // установка заголовков
    public function setHeader($array){
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $array);
        return $this;
    }
    public function config_load($file){

    }
    public function config_save($file){

    }
    public function random_user_agent(){
        $user_agent = array(
            'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0',
            'Opera/9.80 (X11; Linux x86_64; U; ru) Presto/2.2.15 Version/10.10',
            'Mozilla/5.0 (X11; Linux x86_64; U; ru; rv:1.8.1) Gecko/20061208 Firefox/2.0.0 Opera 10.10',
            'Mozilla/4.0 (compatible; MSIE 6.0; X11; Linux x86_64; ru) Opera 10.10',
            'Mozilla/5.0 (X11; Linux x86_64; U; ru; rv:1.8.1) Gecko/20061208 Firefox/2.0.0',
            'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; ru)'
        );
        for ($i = 0; $i < count($user_agent); $i++){
            $value = $user_agent[rand($i,6)];
        }
        curl_setopt($this->ch, CURLOPT_USERAGENT,$value);
        return $this;
    }
    public function referrer(){
        curl_setopt($this->ch, CURLOPT_REFERER, 'google.com');
        return $this;
    }
}