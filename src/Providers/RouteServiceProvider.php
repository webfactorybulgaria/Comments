<?php

namespace TypiCMS\Modules\Comments\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Shells\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Comments\Shells\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            /*
             * Public routes
             */
            $router->get('comments', 'PublicController@index')->name('public::index-comments');
            $router->post('comments', 'PublicController@store')->name('public::store-comment');
            /*
             * Admin routes
             */
            $router->get('admin/comments', 'AdminController@index')->name('admin::index-comments');
            $router->get('admin/comments/create', 'AdminController@create')->name('admin::create-comment');
            $router->get('admin/comments/{comment}/edit', 'AdminController@edit')->name('admin::edit-comment');
            $router->post('admin/comments', 'AdminController@store')->name('admin::store-comment');
            $router->put('admin/comments/{comment}', 'AdminController@update')->name('admin::update-comment');
            $router->post('admin/comments/sort', 'AdminController@sort')->name('admin::sort-comments');
            /*
             * API routes
             */
            $router->get('api/comments', 'ApiController@index')->name('api::index-comments');
            $router->put('api/comments/{comment}', 'ApiController@update')->name('api::update-comment');
            $router->delete('api/comments/{comment}', 'ApiController@destroy')->name('api::destroy-comment');
        });
    }
}
