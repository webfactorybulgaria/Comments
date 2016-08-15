<?php

namespace TypiCMS\Modules\Comments\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;
use TypiCMS\Modules\Core\Shells\Observers\FileObserver;
use TypiCMS\Modules\Core\Shells\Observers\SlugObserver;
use TypiCMS\Modules\Core\Shells\Services\Cache\LaravelCache;
use TypiCMS\Modules\Comments\Shells\Models\Comment;
use TypiCMS\Modules\Comments\Shells\Repositories\CacheDecorator;
use TypiCMS\Modules\Comments\Shells\Repositories\EloquentComment;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.comments'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['comments' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'comments');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'comments');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/comments'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Comments',
            'TypiCMS\Modules\Comments\Shells\Facades\Facade'
        );
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Comments\Shells\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Comments\Shells\Composers\SidebarViewComposer');

        /*
         * Add the page in the view.
         */
        $app->view->composer('comments::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('comments');
        });

        $app->bind('TypiCMS\Modules\Comments\Shells\Repositories\CommentInterface', function (Application $app) {

            $config = config('typicms.comments');
            $repositoryClass = $config['sources'][$config['source']]['repository'];
            
            $repository = new $repositoryClass(new Comment());
            if (!config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'comments', 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }
}
