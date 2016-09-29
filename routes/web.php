<?php

/*
 * App Routes
 */

$app->get('/', [
    'as' => 'index',
    'uses' => 'IndexController@show'
]);

$app->get('search', [
    'as' => 'search',
    'uses' => 'SearchController@show'
]);


