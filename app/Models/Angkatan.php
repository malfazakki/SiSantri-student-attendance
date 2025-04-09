<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Angkatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'tahun'];

    /*
    * Get the santris for the angkatan.
    */
    public function santris(): HasMany
    {
        return $this->hasMany(Santri::class);
    }
}
