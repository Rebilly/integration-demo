<?php

namespace App\Http\Middleware;
use Closure;
use Rebilly\Client;
use Rebilly\Http\Exception\NotFoundException;

class AuthMiddleware
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function handle($request, Closure $next)
    {
        // We verify the token is still valid, see: https://www.rebilly.com/api/documentation/v2.1/#authToken-Verify
        try {
            if (isset($_SESSION['token'])
                && $this->client()->authenticationTokens()->verify($_SESSION['token'])
            ) {
                return $next($request);
            }
        } catch (NotFoundException $e) {
            // we'll redirect to the login screen
        }
        return redirect(url('/login'));
    }

    /**
     * @return Client
     */
    protected function client()
    {
        return new Client([
            'apiKey' => getenv('REBILLY_API_KEY'),
            'baseUrl' => getenv('REBILLY_API_HOST'),
        ]);
    }
} 
