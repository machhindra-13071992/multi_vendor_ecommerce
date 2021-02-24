<?php

namespace App\Services;


class PaytmVideoUploadService {
    
    private $providerKey = '81494aa-908f-4db6-9f94-052127a53b05';

    private $url = 'https://stag-content-apiproxy.paytmdgt.io/content-media/v1/';
    
    public function GetToken() {

        try  {
            // $url = 'http://192.168.0.60/token.php?key='.$this->providerKey;
            $url = $this->url.'auth/token?key='.$this->providerKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec ($ch);
            $err = curl_error($ch);  //if you need
            curl_close ($ch);
            $response = json_decode($response, true);
            if( isset($response['message']) && $response['message'] == "Successful" && isset($response['token']) && $response['token'] != ""  ) {
                return $response['token'];
            }
        } catch (Exception $e) {
            report($e);
            return '';
        }
    }

    public function PostVideoOld($payload) {
        $token = $this->GetToken();
        if($token == "") {
            report('Paytem Report not found');
            return false;
        }
        // $url = 'http://192.168.0.60/post.php';
        $url = $this->url.'upload/video?token='.$token;

        $ch = curl_init($url);

        $payload = json_encode($payload);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);
    }


    public function PostVideo($payload) {
        //$url = 'http://192.168.0.60/pp.php';
        $token = $this->GetToken();
        if($token == "") {
            report('Paytem Report not found');
            return false;
        }
        // $url = 'http://192.168.0.60/post.php';
        $url = $this->url.'upload/video?token='.$token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        //curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        $content = curl_exec($ch);
        $response = curl_getinfo($ch);
        curl_close($ch);
        report($response);
    }

}

