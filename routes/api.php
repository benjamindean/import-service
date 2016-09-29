<?php

/*
* API Routes
*/

/**
 * Upload CSV file
 * @return \Illuminate\Support\Collection
 */
$app->post('api/upload', [
    'as' => 'upload',
    'uses' => 'UploadController@store'
]);

/**
 * Get user by id
 * @param $id
 * @return \Illuminate\Support\Collection
 */
$app->get('api/users/id/{id}', function ($id) {
    return DB::table('users')
        ->where('user_id', $id)
        ->get();
});

/**
 * Get all users (limited to 10)
 * @return \Illuminate\Support\Collection
 */
$app->get('api/users', function () {
    return DB::table('users')
        ->skip(0)
        ->take(10)
        ->get();
});

/**
 * Get users with limit and offset.
 * @param int $limit
 * @param int $offset
 * @return \Illuminate\Support\Collection
 */
$app->get('api/users/limit/{limit}/offset/{offset}', function ($limit = 10, $offset = 0) {
    return DB::table('users')
        ->skip($offset)
        ->take($limit)
        ->get();
});