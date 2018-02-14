<?php

namespace App\Http\Middleware;

use Closure;
use  App\Traits\EncryptTrait;

class ExchangeCompany
{
    use EncryptTrait;

    public function __construct()
    {
        $this->setEncryptConnection('company');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd(123);
        $companyId = getRouteParam('company');
        $companyId = $this->decodeId($companyId);

        session(['company_id' => $companyId]);

        return $next($request);
    }
}
