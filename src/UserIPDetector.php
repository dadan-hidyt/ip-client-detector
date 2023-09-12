<?php

namespace DadanDev\IPDetector;

class UserIPDetector
{
    public $proxy = [
        'HTTP_VIA',
        'VIA',
        'Proxy-Connection',
        'HTTP_X_FORWARDED_FOR',
        'HTTP_FORWARDED_FOR',
        'HTTP_X_FORWARDED',
        'HTTP_FORWARDED',
        'HTTP_CLIENT_IP',
        'HTTP_FORWARDED_FOR_IP',
        'X-PROXY-ID',
        'MT-PROXY-ID',
        'X-TINYPROXY',
        'X_FORWARDED_FOR',
        'FORWARDED_FOR',
        'X_FORWARDED',
        'FORWARDED',
        'CLIENT-IP',
        'CLIENT_IP',
        'PROXY-AGENT',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'FORWARDED_FOR_IP',
        'HTTP_PROXY_CONNECTION',
    ];
    public function isUseProxy()
    {
        foreach ($this->proxy as $prox) {
            if (isset($_SERVER[$prox]) && !empty($_SERVER[$prox])) {
                return true;
            }
        }
        return false;
    }
    public function getIP()
    {
        $ip = "UNKNOWN";
        $this->proxy[] = "REMOTE_ADDR";
        foreach ($this->proxy as $prox) {
            
            if (isset($_SERVER[$prox])) {
               if(strpos($_SERVER[$prox],',') !== false){
                  $ip = trim(end(explode(',',$_SERVER[$prox])));
               } else {
                  $ip = trim($_SERVER[$prox]);
               }
               break;
            }
        }
        return $ip;
    }
    public function getIpCountry($ip)
    {
        $data = @json_decode(@file_get_contents("http://ip-api.com/json/".$ip),true);
        if($data['status'] === 'success') {
            return $data;
        }
    }
}
