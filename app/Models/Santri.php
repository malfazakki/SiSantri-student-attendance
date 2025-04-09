<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Santri extends Model {
    use HasFactory;

    /*
    * Get the angkatan that owns the santri.
    */
    public function angkatan(): BelongsTo {
        return $this->belongsTo(Angkatan::class);
    }

    /*
    * Get the jurusan that owns the santri
    */
    public function jurusan(): BelongsTo {
        return $this->belongsTo(Jurusan::class);
    }

    /*
    * Get the absensi for the santri.
    */
    public function absensis(): HasMany {
        return $this->hasMany(Absensi::class);
    }
}
