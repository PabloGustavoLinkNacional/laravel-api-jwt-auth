<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];
    protected $hidden = ['pivot'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
