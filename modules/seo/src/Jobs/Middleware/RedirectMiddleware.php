<?php

namespace Seo\Jobs\Middleware;

use Closure;
use Illuminate\Http\Request;
use Seo\Models\Redirect;

class RedirectMiddleware
{
    /**
     * Process the queued job.
     *
     * @param  \Closure(object): void  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $path = trim($request->path(), '/');

        $redirect = Redirect::where('from', $path)->first();

        if ($redirect) {
            return redirect($redirect->to, $redirect->status_code);
        }

        return $next($request);
    }

}
