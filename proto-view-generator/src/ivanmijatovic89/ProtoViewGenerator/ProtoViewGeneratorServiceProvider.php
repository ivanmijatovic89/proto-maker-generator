<?php 
namespace ivanmijatovic89\ProtoViewGenerator;

use Illuminate\Support\ServiceProvider;

class ProtoViewGeneratorServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

        $this->app['command.hello'] = $this->app->share(function()
        {
            return $this->app->make('ivanmijatovic89\ProtoViewGenerator\HelloCommand');
        });

        $this->commands('command.hello');

	}

	public function boot()
	{
		// VIEWS php artisan vendor:publish
	    $this->loadViewsFrom(__DIR__.'/resources/views', 'protomaker');

	    $this->publishes([
	        __DIR__.'/resources/views' => base_path('resources/views/vendor/protomaker'),
	    ]);

	    // ROUTES
	    include __DIR__.'/routes.php';

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
