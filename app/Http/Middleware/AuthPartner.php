<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use \DomainException;
use Config;

class AuthPartner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        $token = $request->bearerToken();
        
        $partner = $request->partner;
        
        switch($partner) {
            case Config::get('partners.partners.zee5.sub'):
                if($this->validateToken($token, Config::get('partners.partners.zee5.sub'))) 
                    return $next($request);
            break;
        }
        return response()->json(['error' => 'unauthenticated'], 401);
    }

    private function validateToken($token, $partner) {
        try{
            $decoded = JWT::decode($token, env('JWTKEY'), array(env('JWTALGO')));
            if($decoded->sub == $partner && $decoded->exp > time()) 
                return true;
        } catch (\Firebase\JWT\ExpiredException $e) {
            return false;
        } catch (DomainException $de) {
            return false;
        }
        
    }
}
