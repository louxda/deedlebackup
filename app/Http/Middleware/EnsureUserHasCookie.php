<?php

namespace App\Http\Middleware;

use App\Facades\DeedlerFacade;
use App\Models\Deedler;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Ramsey\Uuid\Nonstandard\Uuid;

class EnsureUserHasCookie
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie('cdugid')) {
            $deedler = Deedler::findDeedlerByCookie($request->cookie('cdugid'));
            if($deedler instanceof Deedler){
                DeedlerFacade::setDeedler($deedler);
                return $next($request);

            }
        }

        $uuid = Str::uuid()->toString();
        $deedler = Deedler::createDeedleerWithCookie($uuid);
        DeedlerFacade::setDeedler($deedler);
        return $next($request)
            ->withCookie(cookie()->forever('cdugid', $uuid));
    }
}
