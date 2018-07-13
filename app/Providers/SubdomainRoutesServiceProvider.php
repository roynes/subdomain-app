<?php


namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class SubdomainRoutesServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Subdomain';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapSubdomainWebRoutes();
    }

    public function mapSubdomainWebRoutes()
    {
        $dir = scandir(app_path('Subdomain'));

        unset($dir[0]);
        unset($dir[1]);

        foreach ( $dir as $index => $domain)
        {
            $fullPath = app_path('Subdomain').DIRECTORY_SEPARATOR.$domain.DIRECTORY_SEPARATOR.'routes/web.php';

            Route::middleware('web')
                ->namespace($this->namespace.'\\'.$domain.'\\Controllers')
                ->group($fullPath);
        }
    }
}
