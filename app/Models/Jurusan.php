<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model {
    use HasFactory;

    protected $fillable = ['nama'];

    /*
    * Get the santris for the jurusans
    */

    public function santris(): HasMany {
        return $this->hasMany(Santri::class);
    }
}
