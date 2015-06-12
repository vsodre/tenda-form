<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/admin', function() {
    return redirect('/admin/questionario.html');
});
$app->get('/admin/questionario.html', function() {
    return view('questionario');
});
$app->get('/admin/questionario.json', 'App\Http\Controllers\Questionario@getJsonShow');
