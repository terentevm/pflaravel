<?php

namespace App;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'login',
        'password',
        'admin',
        'total_row_limit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function settings()
    {
        return $this->hasOne('App\Settings', 'user_id', 'id');
    }

    /**
     * Check if user is admin
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->attributes['admin'];
    }

    /**
     * Return rows limit defined for user
     * @return int
     */
    public function getRowsLimit(): int
    {
        return $this->attributes['total_row_limit'];
    }

    /**
     * Return total rows count by user_id for all tables in db
     * @return int
     */
    public function getTotalRowsCount(): int
    {
        return UserRepository::getTotalRowsByUser($this);
    }

    /**
     * Return user id
     * @return string
     */
    public function getUserId() : string
    {
       return $this->attributes['id'];
    }
}
