<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use GuzzleHttp\Client;

class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $allowedDomains = ['127.0.0.1:8000', 'www.ajak-bestie.bengkuluprov.go.id', 'ajak-bestie.bengkuluprov.go.id']; // Daftar domain yang diperbolehkan
        
        // Periksa apakah domain permintaan ada dalam daftar yang diperbolehkan
        if (!in_array($request->getHttpHost(), $allowedDomains)) {
            $secretCode = 'azvadenTech'; // Ganti dengan secret code yang sesuai

            Artisan::call("down", [
                '--secret' => $secretCode,
                '--render' => 'errors::404',
            ]);
        }
        return $next($request);
    }
}
