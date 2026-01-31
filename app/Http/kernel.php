<?php 
protected $routeMiddleware = [
   'auth' => \App\Http\Middleware\Authenticate::class,
'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
    'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
'can' => \Illuminate\Auth\Middleware\Authorize::class,
];
