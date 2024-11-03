<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SesisonException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SesisonException("Session already active.");
        }

        if (headers_sent($filename, $line)) {
            throw new SesisonException("Headers already sent. Consider enabling output buffering. Data outputted from {$filename} - Line: {$line}");
        }

        session_set_cookie_params([
            'secure' => $_ENV['APP_ENV'] === "production",
            'httponly' => true,
            'samesite' => 'lax'
        ]);

        session_start();

        $next();

        session_write_close();
    }
}
