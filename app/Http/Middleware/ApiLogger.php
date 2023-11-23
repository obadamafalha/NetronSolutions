<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ApiLogger
{
    use LogsActivity;

    public function handle($request, Closure $next)
    {
        // Log the API request
        $this->logApiRequest($request);

        // Proceed with the request
        $response = $next($request);

        // Log the API response
        $this->logApiResponse($response);

        return $response;
    }

    protected function logApiRequest($request)
    {
        activity()->withProperties([
            'url' => $request->url(),
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'content' => $request->getContent(),
        ])->log('API Request');
    }

    protected function logApiResponse($response)
    {
        activity()->withProperties([
            'status' => $response->status(),
            'headers' => $response->headers->all(),
            'content' => $response->getContent(),
        ])->log('API Response');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded();
    }
}
