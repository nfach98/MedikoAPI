<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/soal',
        '/add_soal',
        '/edit_soal',
        '/delete_soal',
        '/login',
        '/user',
        '/nilai',
        '/submit_nilai'
    ];
}
