<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    /**
     * Table name.
     * @var string
     */
    protected $table = 'users';
    /**
     * Fillable fields.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'address',
        'team'
    ];
}