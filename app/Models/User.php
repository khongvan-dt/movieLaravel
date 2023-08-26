<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'current_team_id',
        'remember_token',
        'profile_photo_path',
    ];

    public function getAuthIdentifierName()
    {
        return 'id'; // Change this to the actual column name representing the user's identifier in your table
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
