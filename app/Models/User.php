<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';
    protected $keyType = 'integer';
    public $auth = [];

    protected $guarded = [];
    protected $hidden = ['detail_id'];

    public function permission() {
        return $this->belongsToMany(Permission::class);
    }
}
