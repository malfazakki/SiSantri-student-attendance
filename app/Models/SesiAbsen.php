<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SesiAbsen extends Model {
    use HasFactory;

    protected $fillable = ['nama', 'waktu', 'aktif'];

    /*
    * Get the absensis for the sesi absen
    */
    public function absensis(): HasMany {
        return $this->hasMany(Absensi::class);
    }
}
