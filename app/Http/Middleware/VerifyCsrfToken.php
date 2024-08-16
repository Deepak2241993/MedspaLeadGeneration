<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/handle-call',
        '/connect-to-agent',
        'ivr/*',
        '/outbound',
        'twilio/user-gather',
        '/twilio/*',
        '/handle-gather',
        'messages/receive',
        
        

    ];
}
