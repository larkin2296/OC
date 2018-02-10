<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class isHasChoiceCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !$companyId = getCompanyId() ) {
            abort(404, '请先选择公司');
        }
        return $next($request);
    }
}
