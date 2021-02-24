<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Config;

class APIAuthController extends Controller
{
    public function validateClient($secret) {
        $payload  = [];
        $expiry = time();
        switch ($secret) {
            case (env('ZEE5SECRET')):
                $expiry = $expiry + Config::get('partners.partners.zee5.exp')*1;
                $payload = [
                    "iss" => Config::get('partners.partners.zee5.iss'),
                    "sub" => Config::get('partners.partners.zee5.sub'),
                    "aud" => 'partner',
                    "iat" => time(),
                    "exp" => $expiry,
                ];
                break; 
            default:
                break;  
        }
        if(!empty($payload)) {
            $token = JWT::encode($payload, env('JWTKEY'), env('JWTALGO'));
            return response()->json([
                'token' => $token,
                'type' => 'bearer',
                'expires' => $expiry, // time to expiration
            ]);
        }
        else {
            return response()->json(['error' => 'unauthenticated'], 401);
        }
    }

    public function getVideos($partner) {
        var_dump($partner);die('fdsfsdfs');
    }
}