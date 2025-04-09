<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mentor extends Authenticatable {
    use HasFactory;

    protected $fillable = ['nama', 'email', 'password'];

    /*
    * The attributes that should be hidden for serialization
    *
    * @var array<int, string>
    */
    protected $hidden = ['password', 'remember_token'];

    /*
    * Get the absensis for the mentor.
    */
    public function absensis(): HasMany {
        return $this->hasMany(Absensi::class);
    }
}
