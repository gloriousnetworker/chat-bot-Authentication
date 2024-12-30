public function mapApiRoutes()
{
    Route::prefix('api')  // Make sure all API routes are prefixed with /api
        ->middleware('api')  // Apply API middleware group
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php')); // This should point to routes/api.php
}
