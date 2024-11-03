<?php

namespace App\Http\Middleware;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Visit;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $ip =  $request->ip();
        $agent =  $request->header('User-Agent');

        if(!Visit::where('ip_address', $ip)->where('user_agent', $agent)->exists()){
            Visit::create([
                'ip_address' => $ip,
                'user_agent' => $agent
            ]);
        }

        // Verifica se já existe um idioma salvo na sessão
        if (Session::has('locale')) {
            // Define o idioma da sessão
            App::setLocale(Session::get('locale'));
        } else {
            // Obtém o idioma do navegador do cliente
            $locale = $request->server('HTTP_ACCEPT_LANGUAGE', '');

            // Pega o primeiro idioma e transforma no formato desejado
            $locale = explode(',', $locale)[0];
            $locale = str_replace('-', '_', $locale);
            $locale = strtolower(substr($locale, 0, 2));

            // Verifica se o idioma é suportado
            if (!in_array($locale, ['en', 'pt'])) {
                $locale = 'en';
            }
            // Salva o idioma na sessão
            Session::put('locale', $locale);

            // Define o idioma para o aplicativo
            App::setLocale($locale);
        }

        // Continua o fluxo da aplicação
        return $next($request);
    }
}
