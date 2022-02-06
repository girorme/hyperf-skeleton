<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 * @property $created_at
 * @property $updated_at
 */
class User extends Model
{
    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'email', 'password', 'created_at', 'updated_at'];
    protected $hidden = [
        'password'
    ];
}