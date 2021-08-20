<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

/*
 *  Set up locale and locale_prefix if other language is selected
 */
if (in_array(Request::segment(1), Config::get('app.alt_langs'))) {

    App::setLocale(Request::segment(1));
    Config::set('app.locale_prefix', Request::segment(1));
}

/*
 * Set up route patterns - patterns will have to be the same as in translated route for current language
 */
foreach (Lang::get('routes') as $k => $v) {
    Route::pattern($k, $v);
}

Route::group(array('prefix' => Config::get('app.locale_prefix')), function () {
    Route::get(
        '/',
        function () {
            return "main page - " . App::getLocale();
        }
    );

    Route::get(
        '/{contact}/',
        function () {
            return "contact page " . App::getLocale();
        }
    );

    Route::get(
        '/{about}/',
        function () {
            return "about page " . App::getLocale();

        }
    );

});
