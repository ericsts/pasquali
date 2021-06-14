<?php

use Illuminate\Support\ServiceProvider;


class ClassificacaoAgenteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->app->bind(ClassificacaoAgenteRepositoryInterface::class, function () {
            return (new ClassificacaoAgenteRepositoryFactory())();
        });

        $this->app->bind(ClassificacaoAgenteMapperInterface::class, function () {
            return (new ClassificacaoAgenteMapperFactory())();
        });
    }
}
