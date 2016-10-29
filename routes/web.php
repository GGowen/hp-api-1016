<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/api/households/{x}/{y}/{type}', 'Controller@getHouseholds');
    
$app->post('/api/household', 'Controller@createHousehold');

$app->post('/api/submission', 'Controller@createSubmission');